<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Typed;
use Illuminate\Http\Request;
use App\Http\Resources\Banner as BannerResource;
use App\Http\Resources\Typed as TypedResource;
use App\Http\Resources\BannerImage as BannerImageResource;
use App\Http\Resources\TypedCollection as TypedCollection;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Classes\ImageObj;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannerInfo = Banner::where('id', Auth()->id())->first();

        return new BannerResource($bannerInfo);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeBannerPart()
    {
        $data = request()->validate([
            'banner_id' => 'required',
            'banner_info_one' => 'required',
            'banner_info_two' => 'required',
            'banner_info_three' => 'required',
        ]);

        Banner::where('id', $data['banner_id'])->update([
            'banner_info_one' => $data['banner_info_one'],
            'banner_info_two' => $data['banner_info_two'],
            'banner_info_three' => $data['banner_info_three'],
        ]);

        $updatedBannerInfo = Banner::where('id', $data['banner_id'])->first();

        return new BannerResource($updatedBannerInfo);

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeBannerImage(Request $request)
    {


        $request->validate([
            'file' => 'image',
        ]);

        $bannerImage = Banner::where('id', 1)->first();
        if($bannerImage->banner_image != null){
            unlink('app/public/banner/', $bannerImage->banner_image);
        }
        $bannerImageName = Auth()->id() . '-' . str_replace(' ', '', 'banner-image') . '-' . time() . '.' . $request->file->extension();
        Image::make($request->file)
            ->save(storage_path('app/public/banner/' . $bannerImageName));

        Banner::where('id', 1)->update([
            'banner_image' => $bannerImageName,
        ]);

        $imageObj = new ImageObj($bannerImageName);
        // $request->file->move(storage_path('app/public/book-pages/'), $picName);
        // return response($picName);
        return new BannerImageResource($imageObj);
    }


    public function removeBannerImage(Request $request)
    {
        $image_name = Banner::where('id', 1)->first();



        $image_path = storage_path('app/public/banner/' . $image_name->banner_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        Banner::where('id', 1)->update([
            'banner_image' => null,
        ]);
        return response('done');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    public function storeTyped(){
        $data = request()->validate([
            'typed_name' => 'required',
        ]);

        $typed = Typed::create([
            'typed_name' => $data['typed_name'],
        ]);

        return new TypedResource($typed);

    }


    public function editTyped(){
        $data = request()->validate([
            'typed_name' => 'required',
            'typed_id' => 'required',
        ]);

        Typed::where('id', $data['typed_id'])->update([
            'typed_name' => $data['typed_name'],
        ]);

        $updatedTyped = Typed::where('id', $data['typed_id'])->first();

        return new TypedResource($updatedTyped);

    }


    public function deleteTyped(){
        $data = request()->validate([
            'typed_id' => 'required',
        ]);

        Typed::where('id', $data['typed_id'])->delete();
        return response()->json('done');
    }


    public function getTyped(){
        if(Typed::all()->count() < 2){
            $Typed = Typed::all();
            return new TypedCollection($Typed);
        }else{
            $Typed = Typed::orderBy('id', 'desc')->get();
            return new TypedCollection($Typed);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
