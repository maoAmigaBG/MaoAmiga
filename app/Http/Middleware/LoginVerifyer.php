<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginVerifyer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        if (!Auth::check()) {
            $data_list = [];
            $data = $request->route()->parameters();
            foreach ($data as $value) {
                $data_list[] = $value["id"];
            }
            return redirect()->route("login", [
                "redirect" => request()->route()->getName(),
                "data_list" => urlencode(json_encode($data_list)),
            ]);
        }
        return $next($request);
    }
}
