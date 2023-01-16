<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCardNumberRequest;
use App\Http\Requests\UpdateCardNumberRequest;
use App\Models\CardNumber;

class CardNumberController extends Controller
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
     * @param  \App\Http\Requests\StoreCardNumberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCardNumberRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CardNumber  $cardNumber
     * @return \Illuminate\Http\Response
     */
    public function show(CardNumber $cardNumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CardNumber  $cardNumber
     * @return \Illuminate\Http\Response
     */
    public function edit(CardNumber $cardNumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardNumberRequest  $request
     * @param  \App\Models\CardNumber  $cardNumber
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCardNumberRequest $request, CardNumber $cardNumber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CardNumber  $cardNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardNumber $cardNumber)
    {
        //
    }
}
