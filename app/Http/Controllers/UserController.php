<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Member;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function login($redirect = null, $data_list = null) {
        return Inertia::render('User/Login', [
            "redirect" => $redirect,
            "data_list" => $data_list,
        ]);
    }
    public function logon() {
        return Inertia::render('User/Logon');
    }
    public function auth_login(Request $request) {
        $request_data = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);
        $user = User::where("email", "=", $request_data["email"])->first();
        if (empty($user)) {
            return redirect()->route("login")->withErrors([
                "Login" => "Email não encontrado"
            ])->withInput([
                "email" => $request_data["email"],
                "password" => $request_data["password"],
            ]);
        }
        if (!Hash::check($request_data["password"], $user["password"])) {
            return redirect()->route("login")->withErrors([
                "Senha" => "Senha incorreta"
            ])->withInput([
                "email" => $request_data["email"],
                "password" => $request_data["password"],
            ]);
        }
        if (Auth::attempt(["email" => $request_data["email"], "password" => $request_data["password"]])) {
            $request->session()->regenerate();
        }
        Auth::login($user);
        if ($request["redirect"]) {
            $data_list = json_decode(urldecode($request["data_list"]), true);
            return $data_list ? redirect()->route($request["redirect"], $data_list) : redirect()->route($request["redirect"]);
        }

        return Inertia::location(route("index"));
    }
    public function auth_logon(UserRequest $request) {
        $request->merge(['is_update' => false]);
        $request_data = $request->validated();
        if ($request->hasFile("foto")) {
            $path = $request->file("foto")->store('profiles', 'public');
            $request_data["foto"] = $path;
        }
        $request_data["password"] = Hash::make($request_data["password"]);
        $user = User::create($request_data);
        Auth::login($user);

        return Inertia::location(route('index'))->with([
            "Sucesso" => "Perfil criado com sucesso, bem vindo!",
        ]);
    }
    public function logout() {
        Auth::logout();
        return Inertia::location(route('login'));
    }
    public function profile(User $user) {
        Carbon::setLocale('pt_BR');
        $user["format_data"] = isset($user["created_at"]) ? Carbon::parse($user["created_at"])->translatedFormat('d \d\e F \d\e Y') : null;
        $user["age"] = isset($user["data_nasc"]) ? Carbon::parse($user["data_nasc"])->age : null;

        $user_id = $user->id;
        $isAdminOfOng = $user ? $user->isAdminOfOng() : false;

        $posts = collect();
        $postsNext = null;

        if ($isAdminOfOng) {
            $postsPaginated = Post::whereHas('ong.members', function ($query) use ($user_id) {
                $query->where('user_id', $user_id)->where('admin', true);
            })
                ->with([
                    'ong',
                    'likes' => fn($q) => $q->where('user_id', $user_id),
                ])
                ->withExists([
                    'likes as liked' => fn($q) => $q->where('user_id', $user_id),
                ])
                ->latest()
                ->paginate(10);

            $posts = $postsPaginated->items();
            $postsNext = $postsPaginated->nextPageUrl();
        }

        $ranking = Member::ranking();

        $own_rank = null;
        foreach ($ranking as $index => $rankedUser) {
            if ($rankedUser->user_id == $user->id) {
                $own_rank = [
                    'position' => $index + 1,
                    'donate_amount' => $rankedUser->donate_amount,
                ];
                break;
            }
        }

        $likedPostsPaginated = Post::getWithLikes()
            ->whereHas('likes', fn($q) => $q->where('user_id', $user_id))
            ->paginate(10);

        $ong_relations = Member::select([
            'ongs.id',
            'ongs.nome',
            'ong_types.nome as type',
            'ongs.foto',
            'members.created_at'
        ])
            ->join('ongs', 'ongs.id', '=', 'members.ong_id')
            ->join('ong_types', 'ong_types.id', '=', 'ongs.ong_type_id')
            ->where('user_id', $user_id)
            ->get();

        return Inertia::render('Profile/User/UserProfile', [
            "user" => $user,
            "own_profile" => Auth::check() && Auth::user()->id == $user_id,
            "own_rank" => $own_rank,
            "isAdminOfOng" => $isAdminOfOng,
            "posts" => $posts,
            "postsNext" => $postsNext,
            "likes" => $likedPostsPaginated,
            "likesNext" => $likedPostsPaginated->nextPageUrl(),
            "ong_relations" => $ong_relations,
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get(),
        ]);
    }
    public function edit_profile(User $user) {
        if (Gate::denies("update", $user)) {
            return redirect()->route("user.profile", [
                "user" => $user->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        return Inertia::render('Profile/User/EditProfile', [
            "user" => $user,
            "ranking" => Member::ranking(),
            "campaigns" => Campaign::orderByDesc('created_at')->limit(5)->get()
        ]);
    }
    public function update(UserRequest $request) {
        $user = User::find($request->id);

        if (Gate::denies("update", $user)) {
            return redirect()->route("user.profile", [
                "user" => $user->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        $request->merge(['is_update' => true]);
        $request_data = $request->validated();
        if (!empty($request_data['password'])) {
            if (!Hash::check($request_data['password'], $user->password)) {
                return redirect()->route("user.edit", [
            "user" => $user->id,
                ])->withErrors([
                    "Senha incorreta" => "A senha informada está incorreta",
                ]);
            }
        } else {
            return redirect()->route("user.profile", [
                "user" => $user->id,
            ])->withErrors([
                "Senha obrigatória" => "Informe sua senha atual para salvar as alterações",
            ]);
        }

        unset($request_data['password']);

        if ($request->hasFile('foto')) {
            if (Storage::disk('public')->exists($user->foto) && $user->foto != "profiles/default_user.jpg") {
                Storage::disk('public')->delete($user->foto);
            }
            $path = $request->file('foto')->store('profiles', 'public');
            $request_data['foto'] = $path;
        } else {
            $request_data['foto'] = $user->foto;
        }

        $user->update($request_data);

        return redirect()->route("user.profile", [
            "user" => $user->id,
        ])->with([
            "Sucesso" => "Perfil editado com sucesso",
        ]);
    }

    public function destroy(User $user) {
        if (Gate::denies("delete", $user)) {
            return redirect()->route("user.profile", [
                "user" => $user->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        if (Auth::user()->id == $user->id) {
            Auth::logout();
        }
        if ($user->foto != "profiles/default_user.jpg") {
            Storage::disk('public')->delete($user->foto);
        }
        $user->delete();
        return redirect()->route("index")->with(["Sucesso" => "Perfil deletado com sucesso"]);
    }
}
