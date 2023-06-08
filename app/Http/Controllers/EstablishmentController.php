<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstablishmentRequest;
use App\Models\Establishment;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $establishments = Establishment::all();

        return $establishments;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EstablishmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstablishmentRequest $request)
    {
        $establishment = Establishment::create($request->validated());
        $establishment->pointsOfSale()->createMany($request->validated()['points_of_sale']);
        $establishment->load(['business', 'pointsOfSale']);

        return $establishment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $establishmentId
     * @return \Illuminate\Http\Response
     */
    public function show($establishmentId)
    {
        $establishment = Establishment::findOrFail($establishmentId);
        $establishment->load(['business', 'pointsOfSale']);
        return $establishment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EstablishmentRequest  $request
     * @param  int  $establishmentId
     * @return \Illuminate\Http\Response
     */
    public function update(EstablishmentRequest $request, $establishmentId)
    {
        $establishment = Establishment::findOrFail($establishmentId);
        $establishment->update($request->validated());
        $establishment->load(['business', 'pointsOfSale']);

        return $establishment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $establishmentId
     * @return \Illuminate\Http\Response
     */
    public function destroy($establishmentId)
    {
        $establishment = Establishment::findOrFail($establishmentId);
        $establishment->delete();

        return $establishment;
    }
}
