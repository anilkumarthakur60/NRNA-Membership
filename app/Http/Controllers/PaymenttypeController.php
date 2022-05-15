<?php

namespace App\Http\Controllers;

use App\Models\Paymenttype;
use App\Http\Requests\StorePaymenttypeRequest;
use App\Http\Requests\UpdatePaymenttypeRequest;

class PaymenttypeController extends Controller
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
     * @param  \App\Http\Requests\StorePaymenttypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymenttypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paymenttype  $paymenttype
     * @return \Illuminate\Http\Response
     */
    public function show(Paymenttype $paymenttype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paymenttype  $paymenttype
     * @return \Illuminate\Http\Response
     */
    public function edit(Paymenttype $paymenttype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymenttypeRequest  $request
     * @param  \App\Models\Paymenttype  $paymenttype
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymenttypeRequest $request, Paymenttype $paymenttype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paymenttype  $paymenttype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paymenttype $paymenttype)
    {
        //
    }
}
