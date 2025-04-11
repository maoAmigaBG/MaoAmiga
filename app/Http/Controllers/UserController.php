<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    public function login(Request $request) {
        $request_data = $request->validate([
            "email" => ["required"],
            "password" => ["required"],
        ]);
        if (Auth::attempt(["email" => $request_data["email"], "password" => $request_data["password"]])) {
            $request->session()->regenerate();
        }
        return redirect("/");
    }
    public function logout() {
        Auth::logout();
        return redirect("/");
    }
    public function register(Request $request) {
        $request_data = $request->validate([
            "email" => ["required", "email", Rule::unique("users", "email")],
            "password" => ["required"],
            "name" => ["required", "min:5"],
            "birth_date" => ["required"]
        ]);
        $request_data["password"] = bcrypt($request_data["password"]);
        $request_data["level"] = 1;
        $user = User::create($request_data);
        Auth::login($user);
        return redirect("/");
    }
}
