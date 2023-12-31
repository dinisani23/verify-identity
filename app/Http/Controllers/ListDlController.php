<?php

namespace App\Http\Controllers;

use App\InputDL;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ListDlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = InputDL::where('input_dlResult', 'TRUE')->paginate(10);
        //$data->paginate(10);
        return view('verification_dl.list',compact('data'));
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
     * @param  \App\InputDL  $inputDL
     * @return \Illuminate\Http\Response
     */
    public function show(InputDL $inputDL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InputDL  $inputDL
     * @return \Illuminate\Http\Response
     */
    public function edit(InputDL $inputDL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InputDL  $inputDL
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InputDL $inputDL)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InputDL  $inputDL
     * @return \Illuminate\Http\Response
     */
    public function destroy(InputDL $inputDL)
    {
        //
    }
}
