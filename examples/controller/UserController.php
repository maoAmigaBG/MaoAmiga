<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; //rule creater
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; //authentication

class UserController extends Controller {
    public function register(Request $request) {
        $request_data = $request->validate([
            "name" => ["required"],
            "email" => ["required", "min:3", Rule::unique("users", "email")],
            "password" => ["required"],
        ]);
        $request_data["password"] = bcrypt($request_data["password"]);
        $user = User::create($request_data);
        Auth::login($user);
        return redirect("/");
    }
    public function logout() {
        Auth::logout();
        return redirect("/");
    }
    public function login(Request $request) {
        $request_data = $request->validate([
            "email" => ["required"],
            "password" => ["required"]
        ]);
        if (Auth::attempt(["email" => $request_data["email"], "password" => $request_data["password"]])) {
            $request->session()->regenerate();
        }
        return redirect("/");
    }
}
