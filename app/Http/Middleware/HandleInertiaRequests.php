<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    public function rootView(Request $request): string
    {
        return 'app';
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            // Share authenticated user data with Inertia
            'auth' => [
                'user' => $request->user(),
            ],
            // Share flash messages
            'flash' => [
                'success' => session('success'),
                'error' => session('error'),
            ],
        ]);
    }
}