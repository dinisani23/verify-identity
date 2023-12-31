<?php

namespace App\Http\Controllers;

use App\ExtractIC;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\DB;
use App\InputIC;

class ExtractedIcController extends Controller
{
    public function extract()
    {
        $process = exec("python ic.py");
        echo "<script> alert('Information is being processed.'); 
                                  window.location.href='/verification_ic/show';
              </script>";
    }
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
     * @param  \App\ExtractIC  $extractIC
     * @return \Illuminate\Http\Response
     */
    public function show(ExtractIC $extractIC)
    {
        $latestED = ExtractIC::orderBy('id', 'desc')->first();
        $latestID = InputIC::orderBy('id', 'desc')->first();

        if ($latestED){
            $one = $latestED->el_one;
            $two = $latestED->el_two;
            $three = $latestED->el_three;
            $four = $latestED->el_four;
            $five = $latestED->el_five;
            $six = $latestED->el_six;
            $seven = $latestED->IDnum;
            $sevenIn = $latestID->input_ID;
            $eight = $latestED->name;
            $eightIn = $latestID->input_name;
            $nine = $latestED->address;
            $nineIn = $latestID->input_address;
            $ten = $latestED->citizenship;
            $tenIn = $latestID->input_citizenship;
            $eleven = $latestED->religion;
            $elevenIn = $latestID->input_religion;
            $twelve = $latestED->gender;
            $twelveIn = $latestID->input_gender;
            $arrayEl = [$one, $two, $three, $four, $five, $six];
            $arrayVar = [$seven, $eight, $nine, $ten, $eleven, $twelve];
            $count = 6;
            $incomplete = array();
            
            foreach ($arrayVar as $item){
                switch(true){
                    case empty($item):
                        //var_dump($item); //tak read card
                        return view('errors.noread_ic');
                        break;
                    default:
                        foreach ($arrayEl as $element){
                            switch (true){
                                case $element == 'false':
                                    return view('errors.noelement_ic'); //element tak complete
                                    break;
                                default:
                                    if (strcasecmp($seven, $sevenIn) !== 0){
                                        $count = $count-1;
                                        $joinID = array('ID number');
                                        $incomplete = array_merge($incomplete, $joinID);
                                        //return ('1');
                                    }
                                    if (strcasecmp($eight, $eightIn) !== 0){
                                        $count = $count-1;
                                        $joinName = array('Name');
                                        $incomplete = array_merge($incomplete, $joinName);
                                        //return ('2');
                                    }
                                    if (strcasecmp($nine, $nineIn) !== 0){
                                        $count = $count-1;
                                        $joinAddress = array('Address');
                                        $incomplete = array_merge($incomplete, $joinAddress);
                                        //return ('3');
                                    }
                                    if (strcasecmp($ten, $tenIn) !== 0){
                                        $count = $count-1;
                                        $joinCitiz = array('Citizenship');
                                        $incomplete = array_merge($incomplete, $joinCitiz);
                                        //return ('4');
                                    }
                                    if (strcasecmp($eleven, $elevenIn) !== 0){
                                        $count = $count-1;
                                        $joinReligion = array('Religion');
                                        $incomplete = array_merge($incomplete, $joinReligion);
                                        //return ('5');
                                    }
                                    if (strcasecmp($twelve, $twelveIn) !== 0){
                                        $count = $count-1;
                                        $joinGender = array('Gender');
                                        $incomplete = array_merge($incomplete, $joinGender);
                                        //return ('6');
                                    }
                                    $count = round(($count/6)*100);
                                    $incomplete = implode(', ', $incomplete);
                                    return view('verification_ic.result', compact('count', 'latestID', 'incomplete'));
                                    break;
                            }
                        }
                        break;
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExtractIC  $extractIC
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtractIC $extractIC)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtractIC  $extractIC
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExtractIC $extractIC)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtractIC  $extractIC
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExtractIC $extractIC)
    {
        //
    }
}
