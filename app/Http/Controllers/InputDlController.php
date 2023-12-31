<?php

namespace App\Http\Controllers;

use App\InputDL;
use Illuminate\Http\Request;

class InputDlController extends Controller
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
        return view('input_dl.create');
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
            'input_dlName' => 'required',
            'input_dlNationality' => '',
            'input_dlID' => 'required',
            'input_dlClass' => 'required',
            'input_dlValidity' => 'required',
            'input_dlAddress' => 'required',
        ]);

        InputDL::create($request->all());

        echo "<script> alert('Information is successfully submitted! One more step to verify driving license.'); 
                                  window.location.href='/images_dl/create';
              </script>";
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
        return view('verification_dl.edit',compact('inputDL'));
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
        $request->validate([
            'input_dlName' => 'required',
            'input_dlNationality' => 'required',
            'input_dlID' => 'required',
            'input_dlClass' => 'required',
            'input_dlValidity' => 'required',
            'input_dlAddress' => 'required',
        ]);
        $inputDL->update($request->all());
  
        return redirect()->route('verification_dl.list')
                        ->with('success','Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InputDL  $inputDL
     * @return \Illuminate\Http\Response
     */
    public function destroy(InputDL $inputDL)
    {
        $inputDL->delete();
  
        return redirect()->route('verification_dl.list')
                        ->with('success','Record deleted successfully');
    }
}
