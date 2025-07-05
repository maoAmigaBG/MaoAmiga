<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Membro;
use App\Models\Campanha;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
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
            return redirect()->route("user.login")->withErrors([
                "Login" => "Email não encontrado"
            ])->withInput([
                "email" => $request_data["email"],
                "password" => $request_data["password"],
            ]);
        }
        if (!Hash::check($request_data["password"], $user["password"])) {
            return redirect()->route("user.login")->withErrors([
                "Senha" => "Senha incorreta"
            ])->withInput([
                "email" => $request_data["email"],
                "password" => $request_data["password"],
            ]);
        }
        if (Auth::attempt(["email" => $request_data["email"], "password" => $request_data["password"]])) {
            $request->session()->regenerate();
        }
        if ($request["redirect"]) {
            $data_list = json_decode(urldecode($request["data_list"]), true);
            return $data_list ? redirect()->route($request["redirect"], $data_list) : redirect()->route($request["redirect"]);
        }
        return redirect()->route("index");
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
        return Inertia::render('Profile/User/UserProfile', [
            "user" => $user,
            "own_profile" => Auth::check() && Auth::user()->id == $user->id,
            "ranking" => Membro::ranking(),
            "campaigns" => Campanha::orderByDesc('created_at')->limit(5)->get()
        ]);
    }
    public function edit_profile(User $user){
        if (Gate::denies("update", $user)) {
            return redirect()->route("user.profile", [
                "user" => $user->id,
            ])->withErrors([
                "Acesso negado" => "Você não possui permissão para editar este perfil"
            ]);
        }
        return Inertia::render('Profile/User/EditProfile', [
            "user" => $user,
            "ranking" => Membro::ranking(),
            "campaigns" => Campanha::orderByDesc('created_at')->limit(5)->get()
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
        $user->delete();
        return Auth::user()->id == $user->id ? redirect()->route("logout") : redirect()->route("index")->with(["Sucesso" => "Perfil deletado com sucesso"]);
    }
}
