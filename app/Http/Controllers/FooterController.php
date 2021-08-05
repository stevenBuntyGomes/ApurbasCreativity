<?php

namespace App\Http\Controllers;

use App\Footer;
use App\FooterSocial;
use Illuminate\Http\Request;
use App\Http\Resources\Footer as FooterResource;
use App\Http\Resources\FooterImage as FooterImageResource;
use App\Http\Resources\FooterSocial as FooterSocialResource;
use App\Http\Resources\FooterSocialCollection as FooterSocialCollection;
use App\Classes\ImageObj;

class FooterController extends Controller
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


    public function getFooter(){
        $footer = Footer::where('id', 1)->first();

        return new FooterResource($footer);
    }

    public function updateFootertext(){
        $data = request()->validate([
            'site_name' => 'required',
            'site_note' => 'required',
            'site_address' => 'required',
            'site_city' => 'required',
            'site_email' => 'required',
            'site_contact' => 'required',
        ]);

        Footer::where('id', 1)->update([
            'site_name' => $data['site_name'],
            'site_note' => $data['site_note'],
            'site_address' => $data['site_address'],
            'site_city' => $data['site_city'],
            'site_email' => $data['site_email'],
            'site_contact' => $data['site_contact'],
        ]);

        $updatedFooter = Footer::where('id', 1)->first();

        return new FooterResource($updatedFooter);

    }


    public function addFooterSocialImage(Request $request){
        $footerImage = Auth()->id() . '-' . str_replace(' ', '', 'footer-social') . '-' . time() . '.' . $request->file->extension();

        $request->file->move(storage_path('app/public/footer/'), $footerImage);

        $imageObj = new ImageObj($footerImage);

        return new FooterImageResource($imageObj);
    }


    public function deleteFooterSocialImage(){
        $data = request()->validate([
            'image' => 'required',
        ]);

        $image_path = storage_path('app/public/footer/' . $data['image']);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        return response('done');
    }


    public function addSocialImageDB(){
        $data = request()->validate([
            'social_name' => 'required',
            'social_link' => 'required',
            'image_name' => 'required',
        ]);

        $newFooterSocial = FooterSocial::create([
            'social_name' => $data['social_name'],
            'social_link' => $data['social_link'],
            'image_name' => $data['image_name'],
        ]);

        return new FooterSocialResource($newFooterSocial);
    }

    public function deleteSocialFooterDB(){
        $data = request()->validate([
            'social_id' => 'required',
        ]);

        $social = FooterSocial::where('id', $data['social_id'])->first();

        $image_path = storage_path('app/public/footer/' . $social->image_name);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        FooterSocial::where('id', $data['social_id'])->delete();

        return response()->json('deleted');
    }


    public function getSocialFooter(){
        if(FooterSocial::all()->count() < 2){
            $footerSocial = FooterSocial::all();
            return new FooterSocialCollection($footerSocial);
        }else{
            $footerSocial = FooterSocial::orderBy('id', 'desc')->get();
            return new FooterSocialCollection($footerSocial);
        }
    }


    public function searchSocialFooter(Request $request){
        if($request->keywords == ''){
            $videos = FooterSocial::orderBy('id', 'desc')->get();
            return new FooterSocialCollection($videos);
        }else{
            $videos = FooterSocial::where('social_name', 'like', '%' . $request->keywords . '%')->orderBy('id', 'desc')->get();
            return new FooterSocialCollection($videos);
        }
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
     * @param  \App\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function show(Footer $footer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function edit(Footer $footer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Footer $footer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Footer $footer)
    {
        //
    }
}
