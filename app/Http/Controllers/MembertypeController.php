<?php

namespace App\Http\Controllers;

use App\Models\Membertype;
use App\Http\Requests\StoreMembertypeRequest;
use App\Http\Requests\UpdateMembertypeRequest;

class MembertypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMembertypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembertypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membertype  $membertype
     * @return \Illuminate\Http\Response
     */
    public function show(Membertype $membertype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membertype  $membertype
     * @return \Illuminate\Http\Response
     */
    public function edit(Membertype $membertype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMembertypeRequest  $request
     * @param  \App\Models\Membertype  $membertype
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembertypeRequest $request, Membertype $membertype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membertype  $membertype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membertype $membertype)
    {
        //
    }
}
