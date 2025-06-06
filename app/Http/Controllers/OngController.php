<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Membro;
use App\Models\Ong;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OngController extends Controller {
    function index() {
        return Inertia::render('Ong', [
            "ongs" => Ong::orderBy("created_at", "asc")->limit(20)->get(),
        ]);
    }
    function map() {
        return Inertia::render('Mapa');
    }
    public function page(Ong $ong) {
        return Inertia::render('Ong/Page', [
            "ong" => $ong,
        ]);
    }
}
