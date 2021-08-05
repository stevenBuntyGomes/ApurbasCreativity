<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use App\Http\Resources\About as AboutResource;
use Intervention\Image\Facades\Image;
use App\Classes\ImageObj;
use App\Http\Resources\AboutImage as AboutImageResource;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getAbout = About::where('id', 1)->first();

        return new AboutResource($getAbout);
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
    public function updateAboutInfo(Request $request)
    {
        $data = request()->validate([
            'about_header' => 'required',
            'about_title' => 'required',
            'about_title_two' => 'required',
            'about_description' => 'required',
            'about_button' => 'required',
        ]);

        About::where('id', 1) ->update([
            'about_header' => $data['about_header'],
            'about_title' => $data['about_title'],
            'about_title_two' => $data['about_title_two'],
            'about_description' => $data['about_description'],
            'about_button' => $data['about_button'],
        ]);

        $updatedAbout = About::where('id', 1)->first();

        return new AboutResource($updatedAbout);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAboutImage(Request $request)
    {
        $request->validate([
            'file' => 'image',
        ]);

        $aboutImage = About::where('id', 1)->first();
        if($aboutImage->about_image != null){
            unlink('app/public/about/', $aboutImage->about_image);
        }
        $aboutImageName = Auth()->id() . '-' . str_replace(' ', '', 'about-image') . '-' . time() . '.' . $request->file->extension();
        Image::make($request->file)
            ->save(storage_path('app/public/about/' . $aboutImageName));

        About::where('id', 1)->update([
            'about_image' => $aboutImageName,
        ]);

        $imageObj = new ImageObj($aboutImageName);
        // $request->file->move(storage_path('app/public/book-pages/'), $picName);
        // return response($picName);
        return new AboutImageResource($imageObj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeImage()
    {
        $aboutImage = About::where('id', 1)->first();



        $image_path = storage_path('app/public/about/' . $aboutImage->about_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        About::where('id', 1)->update([
            'about_image' => null,
        ]);
        return response('done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
