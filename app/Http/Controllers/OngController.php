<?php

namespace App\Http\Controllers;

use App\Models\Ong;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OngController extends Controller {
    function index() {
        return Inertia::render('Ong');
    }
    function map() {
        return Inertia::render('Mapa');
    }
    public function page(Ong $ong) {
        //return Inertia::render('Ong/Page', [
        // "ong" => $ong
        // "admin" => a programar
        // ]);
    }
}
