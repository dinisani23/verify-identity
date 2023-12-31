<?php

namespace App\Http\Controllers;

use App\InputIC;
use App\ExtractIC;
use App\ScrapedSPR;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class semakSPRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify_SPR()
    {
        $process = shell_exec("python semakspr.py");
        return redirect()->route('verification_ic.show_spr');
    }
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
     * @param  \App\InputIC  $inputIC
     * @return \Illuminate\Http\Response
     */
    public function show_spr(InputIC $inputIC)
    {
        $latestID = InputIC::orderBy('id', 'desc')->first();
        $latestIDextract = ExtractIC::orderBy('id', 'desc')->first();
        $latestIDscrape = ScrapedSPR::orderBy('id', 'desc')->first();
        $id = array($latestID->input_ID);
        $spr_res = $latestID->input_result;
        $m_one = array('The identity card ID: ');
        $m_two = array('is verified as VALID by Suruhanjaya Pilihan Raya Malaysia ');
        $m_three = array('is verified as INVALID by Suruhanjaya Pilihan Raya Malaysia ');
        #global $message;

        if ($spr_res == 'default'){
            return view('errors.nospr');
        }
        else {
            if ($spr_res == 'TRUE') {
                $message_spr = array_merge($m_one, $id, $m_two);
                $message_spr = implode(' ', $message_spr);
                return view('verification_ic.showspr', compact('message_spr', 'latestID', 'latestIDextract', 'latestIDscrape'));
            }
            else {
                $message_spr = array_merge($m_one, $id, $m_three);
                $message_spr = implode(' ', $message_spr);
                return view('verification_ic.showspr', compact('message_spr', 'latestID', 'latestIDextract', 'latestIDscrape'));
            }
        }
        /*
        #if ($message == "Successfully updated the value in the database"){
            if ($spr_res == 'TRUE') {
                $message_spr = array_merge($m_one, $id, $m_two);
                $message_spr = implode(' ', $message_spr);
                return view('verification_ic.showspr', compact('message_spr'));
            }
            if ($spr_res == 'default') {
                return view('errors.nospr');
            }
            else {
                $message_spr = array_merge($m_one, $id, $m_three);
                $message_spr = implode(' ', $message_spr);
                return view('verification_ic.showspr', compact('message_spr'));
            }*/
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
