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
        return view("user.login");
    }
    public function logon() {
        return view("user.logon");
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
        dd($request_data);
        if ($request->hasFile("foto")) {
            $path = $request->file("foto")->store('profiles', 'public');
            $request_data["foto"] = $path;
        }
        $request_data["password"] = Hash::make($request_data["password"]);
        $user = User::create($request_data);
        dd($user);
        Auth::login($user);

        return Inertia::location(route('index'));
    }
    public function logout() {
        Auth::logout();
        return Inertia::location(route('index'));
    }
}
