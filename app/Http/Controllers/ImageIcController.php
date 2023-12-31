<?php

namespace App\Http\Controllers;

use App\ImageIC;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ImageIcController extends Controller
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
        return view('images_ic.create');
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
        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'mimes:jpg' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            //$request->image->store('ic', 'public');
            $request->image->storeAs('ic', Carbon::now()->format('Y-m-d_H-i-s') . '.' . $request->image->extension(), 'public');

            // Store the record, using the new file hashname which will be it's new filename identity.
            /*$image = new ImageIC([
                "image" => $request->image->hashName()
            ]);*/
            $image = new ImageIC([
                "image" => Carbon::now()->format('Y-m-d_H-i-s') . '.' . $request->image->extension()
            ]);

            $image->save(); // Finally, save the record.
        }
        $give = (new ExtractedIcController)->extract();
        //dd($give);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImageIC  $imageIC
     * @return \Illuminate\Http\Response
     */
    public function show(ImageIC $imageIC)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImageIC  $imageIC
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageIC $imageIC)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImageIC  $imageIC
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageIC $imageIC)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImageIC  $imageIC
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageIC $imageIC)
    {
        //
    }
}
