<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Contact;
use Carbon\Carbon;
use App\Models\Ong;
use App\Models\Post;
use Inertia\Inertia;
use App\Models\Member;
use App\Models\Report;
use App\Models\Ong_type;
use Illuminate\Http\Request;
use App\Http\Requests\OngRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class OngController extends Controller
{
    function index()
    {
        $ongs = Ong::orderBy("created_at", "asc")
            ->limit(20)
            ->get();

        $ongs->transform(function ($ong) {
            $ong->membersAmount = Member::members_amount($ong->id);
            return $ong;
        });

        return Inertia::render('Ong', [
            "ongs" => $ongs,
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ]);
    }

    function map()
    {
        return Inertia::render('Mapa', [
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ]);
    }
    function map_location($lat, $lng, $radius = 10, $theme_list = null)
    {
        $ongs = Ong::select(["ongs.id", "ongs.nome", "ongs.subtitulo", "ongs.descricao", "ongs.lat", "ongs.lng", "ongs.endereco", "ongs.banner", "ongs.foto", "ong_types.nome as type"])->join("ong_types", "ong_types.id", "=", "ongs.ong_type_id")->get();
        $possible_locations = [];
        foreach ($ongs as $ong) {
            $response = Http::get("http://router.project-osrm.org/route/v1/driving/$lng,$lat;$ong->lng,$ong->lat?overview=false")['routes'][0]['distance'];
            if ($response < $radius * 1000) {
                if (!empty($theme_list) && in_array($ong->type, $theme_list)) {
                    $possible_locations[] = $ong;
                } else if (empty($theme_list)) {
                    $possible_locations[] = $ong;
                }
            }
        }
        return [
            "ongs" => $possible_locations,
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ];
    }
    public function page(Ong $ong)
    {
        return Inertia::render("Profile/Ong/OngProfile", [
            "ong" => $ong,
            "ong_type" => Ong_type::find($ong->ong_type_id),
            "members_amount" => Member::members_amount($ong->id),
            "contacts" => Contact::where("ong_id", $ong->id)->get(),
            "reports" => Report::where("ong_id", $ong->id)->get(),
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get(),
            "posts" => Post::getWithLikes()->select(["posts.id", "posts.nome", "posts.descricao",])
                ->selectSub(function ($query) {
                    $query->from('post_likes')
                        ->selectRaw('COUNT(*)')
                        ->whereColumn('post_likes.post_id', 'posts.id');
                }, 'likes_num')
                ->where("posts.ong_id", $ong->id)
                ->groupBy("posts.id", "posts.nome", "posts.descricao")
                ->get(),
            "ong_campaigns" => Campaign::select(["nome", "tipo", "descricao", "materiais", "meta", "foto", "ong_id"])
                ->selectRaw("SUM(members_donations.doacao) as donation_amount")
                ->leftJoin("members_donations", "members_donations.campaign_id", "=", "campaigns.id")
                ->where("campaigns.ong_id", $ong->id)
                ->groupBy("campaigns.id", "nome", "tipo", "descricao", "materiais", "meta", "foto", "ong_id")
                ->get(),
            "members" => Member::select(['members.id', 'members.admin', 'members.anonimo', 'members.user_id', 'members.ong_id',])
                ->selectRaw("SUM(doacao) as donate_amount")
                ->join("members_donations", "members_donations.member_id", "=", "members.id")
                ->where("members.ong_id", $ong->id)
                ->groupBy('members.id', 'members.admin', 'members.anonimo', 'members.user_id', 'members.ong_id')
                ->orderByDesc("donate_amount")
                ->get(),
            "is_adm" => Ong::is_adm($ong),
        ]);
    }
    public function create()
    {
        return [
            "ong_types" => Ong_type::all(),
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ];
    }
    public function adress_provider($cep)
    {
        $cep = str_replace("-", "", $cep);
        $url = "https://cep.awesomeapi.com.br/json/$cep";
        $response = Http::withOptions(['verify' => false])->get($url);
        return $response->json();
        /*
        // response example
        {
            "cep": "95700206",
            "address_type": "Avenida",
            "address_name": "Osvaldo Aranha",
            "address": "Avenida Osvaldo Aranha",
            "state": "RS",
            "district": "Juventude da Enologia",
            "lat": "-29.164745",
            "lng": "-51.521011",
            "city": "Bento Gonçalves",
            "city_ibge": "4302105",
            "ddd": "54"
        }
            ou
        {
            "code":"not_found",
            "message":"O CEP 95700201 nao foi encontrado"
        }
        */
    }
    public function coordinates_api($adress, $request_data)
    {
        $coordinates = [
            "lat" => null,
            "lon" => null,
        ];
        $api_key = env("GEOAPIFY_API_KEY");
        $url = "https://api.geoapify.com/v1/geocode/search";
        $response = Http::withOptions(['verify' => false])->get($url, [
            "text" => $adress,
            "apiKey" => $api_key,
        ]);
        if (isset($response["features"])) {
            foreach ($response["features"] as $item) {
                if (isset($item["properties"]["name"])) {
                    $coordinates["lat"] = $item["properties"]["lat"];
                    $coordinates["lon"] = $item["properties"]["lon"];
                }
            }
        } else {
            return redirect()->route("ong.create")->withInput($request_data)->withErrors([
                "Não encontrado" => "Endereço inserido não encontrado"
            ]);
        }
        $request_data = [
            'nome' => $request_data["nome"],
            'subtitulo' => $request_data["subtitulo"],
            'descricao' => $request_data["descricao"],
            'lat' => $coordinates["lat"],
            'log' => $coordinates["lon"],
            'endereco' => $request_data["endereco"],
            'banner' => $request_data["banner"],
            'foto' => $request_data["foto"],
            'ong_type_id' => $request_data["ong_type_id"],
        ];
        return $request_data;
    }
    public function store(OngRequest $request)
    {
        $request_data = $request->validated();
        if ($request_data["ong_type"] == 0) {
            $type = Ong_type::create([
                "nome" => $request_data["ong_new_type"],
            ]);
            $request_data["ong_type"] = $type->id;
        }
        $adress = $request["endereco"] . " " . $request["instituicao"] . " " . $request["cep"];
        $request_data = $this->coordinates_api($adress, $request_data);
        $ong = Ong::create($request_data);
        Member::create([
            "admin" => true,
            "anonimo" => false,
            "user_id" => Auth::user()->id,
            "ong_id" => $ong->id,
        ]);
        return redirect()->route("ong.profile", [
            "ong" => $ong->id,
        ])->with([
            "Sucesso" => "Ong inserida com sucesso",
        ]);
    }
    public function edit(Ong $ong)
    {
        if (Gate::denies("update", $ong)) {
            return Inertia::location("/ong/profile/" . $ong->id);
        }

        return Inertia::render("Profile/Ong/EditProfile", [
            "ong" => $ong,
            "ong_types" => Ong_type::all(),
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ]);
    }
    public function update(Request $request, Ong $ong)
    {
        if (Gate::denies("update", $ong)) {
            return redirect()->route("ong.profile", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para alterar esta Ong"
            ]);
        }

        // Manually validate just the fields present in edit // AQUI QUE TU POE TUA LOGICA NOVA KRL
        $request_data = $request->validate([
            "nome" => "required",
            "subtitulo" => "nullable|max:20",
            "descricao" => "nullable|max:5000",
            "endereco" => "required",
            "ong_type" => "required",
            "banner" => ["nullable", 'image', 'mimes:jpg,jpeg,png'],
            "foto" => ["nullable", 'image', 'mimes:jpg,jpeg,png'],
        ]);

        // Handle new type creation if needed
        if ($request_data["ong_type"] == 0 && $request->filled("ong_new_type")) {
            $type = Ong_type::create([
                "nome" => $request->input("ong_new_type"),
            ]);
            $request_data["ong_type_id"] = $type->id;
        } else {
            $request_data["ong_type_id"] = $request_data["ong_type"];
        }

        if ($request->hasFile('banner')) {
            // Deleta a imagem anterior, se existir
            if ($ong->banner && Storage::disk('public')->exists($ong->banner)) {
                Storage::disk('public')->delete($ong->banner);
            }

            $path = $request->file('banner')->store('ongs', 'public');
            $request_data['banner'] = $path;
        }


        if ($request->hasFile('foto')) {
            if ($ong->foto && Storage::disk('public')->exists($ong->foto)) {
                Storage::disk('public')->delete($ong->foto);
            }

            $path = $request->file('foto')->store('ongs', 'public');
            $request_data['foto'] = $path;
        }


        // Update  // AQUI TMB
        $ong->update([
            'nome' => $request_data['nome'],
            'subtitulo' => $request_data['subtitulo'],
            'descricao' => $request_data['descricao'],
            'endereco' => $request_data['endereco'],
            'ong_type_id' => $request_data['ong_type_id'],
            'banner' => $request_data['banner'] ?? $ong->banner,
            'foto' => $request_data['foto'] ?? $ong->foto,
        ]);

        return redirect()->route("ong.profile", [
            "ong" => $ong->id,
        ])->with([
            "Sucesso" => "Ong alterada com sucesso",
        ]);
    }

    public function destroy(Ong $ong)
    {
        if (Gate::denies("delete", $ong)) {
            return redirect()->route("ong.profile", [
                "ong" => $ong->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para alterar esta Ong"
            ]);
        }
        $ong->delete();
        return redirect()->route("index")->with([
            "Sucesso" => "Ong excluída",
        ]);
    }
}
