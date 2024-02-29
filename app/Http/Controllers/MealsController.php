<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMealsRequest;
use App\Http\Requests\UpdateMealsRequest;
use App\Models\Meals;

class MealsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreMealsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Meals $meals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meals $meals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMealsRequest $request, Meals $meals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meals $meals)
    {
        //
    }
}
