<?php

namespace App\Http\Controllers;

use App\ExtractDL;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\DB;
use App\InputDL;

class ExtractedDlController extends Controller
{
    public function extract()
    {
        $process = exec("python license.py");
        echo "<script> alert('Information is being processed.'); 
                                  window.location.href='/verification_dl/show';
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
     * @param  \App\ExtractDL  $extractDL
     * @return \Illuminate\Http\Response
     */
    public function show(ExtractDL $extractDL)
    {
        $latestED = ExtractDL::orderBy('id', 'desc')->first();
        $latestID = InputDL::orderBy('id', 'desc')->first();

        if ($latestED){
            $one = $latestED->elm_one;
            $two = $latestED->elm_two;
            $three = $latestED->elm_three;
            $four = $latestED->elm_four;
            $five = $latestED->elm_five;
            $six = $latestED->elm_six;
            $seven = $latestED->dl_name;
            $sevenIn = $latestID->input_dlName;
            $eight = $latestED->dl_nationality;
            $eightIn = $latestID->input_dlNationality;
            $nine = $latestED->dl_ID;
            $nineIn = $latestID->input_dlID;
            $ten = $latestED->dl_class;
            $tenIn = $latestID->input_dlClass;
            $eleven = $latestED->dl_validity;
            $elevenIn = $latestID->input_dlValidity;
            $twelve = $latestED->dl_address;
            $twelveIn = $latestID->input_dlAddress;
            $arrayEl = [$one, $two, $three, $four, $five, $six];
            $arrayVar = [$seven, $eight, $nine, $ten, $eleven, $twelve];
            $count = 6;
            $incomplete = array();

            foreach ($arrayVar as $item){
                switch(true){
                    case empty($item):
                        //var_dump($item); //tak read card
                        return view('errors.noread_dl');
                        break;
                    default:
                        foreach ($arrayEl as $element){
                            switch (true){
                                case $element == 'false':
                                    return view('errors.noelement_dl'); //element tak complete
                                    break;
                                default:
                                    if (strcasecmp($seven, $sevenIn) !== 0){
                                        $count = $count-1;
                                        $joinName = array('Name');
                                        $incomplete = array_merge($incomplete, $joinName);
                                        //return ('1');
                                    }
                                    if (strcasecmp($eight, $eightIn) !== 0){
                                        $count = $count-1;
                                        $joinNat = array('Nationality');
                                        $incomplete = array_merge($incomplete, $joinNat);
                                        //return ('2');
                                    }
                                    if (strcasecmp($nine, $nineIn) !== 0){
                                        $count = $count-1;
                                        $joinID = array('ID Number');
                                        $incomplete = array_merge($incomplete, $joinID);
                                        //return ('3');
                                    }
                                    if (strcasecmp($ten, $tenIn) !== 0){
                                        $count = $count-1;
                                        $joinClass = array('Class');
                                        $incomplete = array_merge($incomplete, $joinClass);
                                        //return ('4');
                                    }
                                    if (strcasecmp($eleven, $elevenIn) !== 0){
                                        $count = $count-1;
                                        $joinVal = array('Validity');
                                        $incomplete = array_merge($incomplete, $joinVal);
                                        //return ('5');
                                    }
                                    if (strcasecmp($twelve, $twelveIn) !== 0){
                                        $count = $count-1;
                                        $joinAdd = array('Address');
                                        $incomplete = array_merge($incomplete, $joinAdd);
                                        //return ('6');
                                    }
                                    $count = round(($count/6)*100);
                                    $incomplete = implode(', ', $incomplete);
                                    return view('verification_dl.result', compact('count', 'latestID', 'incomplete'));
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
     * @param  \App\ExtractDL  $extractDL
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtractDL $extractDL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtractDL  $extractDL
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExtractDL $extractDL)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtractDL  $extractDL
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExtractDL $extractDL)
    {
        //
    }
}
