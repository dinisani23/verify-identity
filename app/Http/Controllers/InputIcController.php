<?php

namespace App\Http\Controllers;

use App\InputIC;
use Illuminate\Http\Request;

class InputIcController extends Controller
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
        return view('input_ic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'input_ID' => 'required',
            'input_name' => 'required',
            'input_address' => 'required',
            'input_citizenship' => '',
            'input_religion' => 'required',
            'input_gender' => 'required',
        ]);

  
        InputIC::create($request->all());

        echo "<script> alert('Information is successfully submitted! One more step to verify identity card.'); 
                                  window.location.href='/images_ic/create';
              </script>";
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
        return view('verification_ic.edit',compact('inputIC'));
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
        $request->validate([
            'input_ID' => 'required',
            'input_name' => 'required',
            'input_address' => 'required',
            'input_citizenship' => 'required',
            'input_religion' => 'required',
            'input_gender' => 'required',
        ]);
        InputIC::update($request->all());

        return redirect()->route('verification_ic.list')
                        ->with('success','Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InputIC  $inputIC
     * @return \Illuminate\Http\Response
     */
    public function destroy(InputIC $inputIC)
    {
        $inputIC->delete();
  
        return redirect()->route('verification_ic.list')
                        ->with('success','Record deleted successfully');
    }
}
