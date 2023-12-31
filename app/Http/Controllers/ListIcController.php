<?php

namespace App\Http\Controllers;

use App\InputIC;
use Illuminate\Http\Request;

class ListIcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = InputIC::where('input_result', 'TRUE')->paginate(10);
        //$data->paginate(10);
        $space = "<br>";
        return view('verification_ic.list',compact('data', 'space'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InputIC  $inputIC
     * @return \Illuminate\Http\Response
     */
    public function show(InputIC $inputIC)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InputIC  $inputIC
     * @return \Illuminate\Http\Response
     */
    public function edit(InputIC $inputIC)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InputIC  $inputIC
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InputIC $inputIC)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InputIC  $inputIC
     * @return \Illuminate\Http\Response
     */
    public function destroy(InputIC $inputIC)
    {
        //
    }
}
