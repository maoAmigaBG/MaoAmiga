<?php

namespace App\Http\Controllers;

use App\Models\Ong;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Ong $ong = null) {
        return [
            "ong" => $ong,
            "user" => Auth::user(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request_data = $request->validate([
            "motivo" => ["required"],
            "user_id" => ["required"],
            "ong_id" => ["required"],
        ]);
        Report::create($request_data);
        return redirect()->route("index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
