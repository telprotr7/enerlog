<?php

namespace App\Http\Controllers;

use App\Models\Controlling;
use Illuminate\Http\Request;

class ControllingContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('controlling.index', [
            'title' => 'EnerTrack Monitor'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Controlling $controlling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Controlling $controlling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Controlling $controlling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Controlling $controlling)
    {
        //
    }
}
