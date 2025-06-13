<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function login($redirect = null) {
        return Inertia::render('User/Login', [
            "redirect" => $redirect,
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
        return $request["redirect"] ? redirect()->route($request["redirect"]) : redirect()->route("index");
    }
    public function auth_logon(UserRequest $request) {
        $request_data = $request->validated();
        if ($request->hasFile("foto")) {
            $path = $request->file("foto")->store('profiles', 'public');
            $request_data["foto"] = $path;
        }
        $request_data["password"] = Hash::make($request_data["password"]);
        $user = User::create($request_data);
        Auth::login($user);

        return Inertia::location(route('index'));
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
        ]);
    }
    public function edit_profile(User $user){
        if (Auth::user()->id == $user->id) {
            return Inertia::render('Profile/User/EditProfile', [
                "user" => $user,
            ]);
        }
        return redirect()->route("user.profile", [
            "user" => Auth::user()->id,
        ])->withErrors([
            "Acesso negado" => "Você não possui permissão para editar este perfil"
        ]);
    }
}
