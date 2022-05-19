<?php

namespace App\Http\Controllers;

use App\Models\PaymentInfo;
use App\Http\Requests\StorePaymentInfoRequest;
use App\Http\Requests\UpdatePaymentInfoRequest;

class PaymentInfoController extends Controller
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
     * @param  \App\Http\Requests\StorePaymentInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentInfo  $paymentInfo
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentInfo $paymentInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentInfo  $paymentInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentInfo $paymentInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentInfoRequest  $request
     * @param  \App\Models\PaymentInfo  $paymentInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentInfoRequest $request, PaymentInfo $paymentInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentInfo  $paymentInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentInfo $paymentInfo)
    {
        //
    }
}
