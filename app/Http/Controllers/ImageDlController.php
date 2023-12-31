<?php

namespace App\Http\Controllers;

use App\ImageDL;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ImageDlController extends Controller
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
        return view('images_dl.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ensure the request has a file before we attempt anything else.
        if ($request->hasFile('imageDL')) {

            $request->validate([
                'imageDL' => 'mimes:jpg' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            //$request->imageDL->store('dl', 'public');
            $request->imageDL->storeAs('dl', Carbon::now()->format('Y-m-d_H-i-s') . '.' . $request->imageDL->extension(), 'public');

            // Store the record, using the new file hashname which will be it's new filename identity.
            /*$image = new ImageDL([
                "imageDL" => $request->imageDL->hashName()
            ]);*/
            $image = new ImageDL([
                "imageDL" => Carbon::now()->format('Y-m-d_H-i-s') . '.' . $request->imageDL->extension()
            ]);
            $image->save(); // Finally, save the record.
        }
        $give = (new ExtractedDlController)->extract();
        //dd($give);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImageDL  $imageDL
     * @return \Illuminate\Http\Response
     */
    public function show(ImageDL $imageDL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImageDL  $imageDL
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageDL $imageDL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImageDL  $imageDL
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageDL $imageDL)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImageDL  $imageDL
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageDL $imageDL)
    {
        //
    }
}
