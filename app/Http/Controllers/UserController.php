<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller {
    public function login() {
        return Inertia::render('User/Login');
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
        return Inertia::location(route('index'));
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
        return Inertia::render('User/Profile', [
            "user" => $user,
            "own_profile" => Auth::check() && Auth::user()->id == $user->id // verify if the user is accessing his own profile
        ]);
    }
    public function edit_profile(User $user){
        if (Auth::check() && Auth::user()->id == $user->id) {
            return Inertia::render('User/EditProfile', [
                "user" => $user,
            ]);
        }
        return redirect()->back()->withErrors([
            "Acesso negado" => Auth::check() ? "Você não possui permissão de alterar dados desse perfil" :  "Realize login antes de alterar uma conta"
        ]);
    }
}
