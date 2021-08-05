<?php

namespace App\Http\Controllers;

use App\Logo;
use App\Banner;
use App\About;
use App\Skill;
use App\Service;
use App\Testimonial;
use App\Footer;
use App\FooterSocial;
use App\ImageCategory;
use App\Image;
use App\VideoPlayList;
use App\Video;
use App\Typed;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontEnd', [
            'logo_info' => Logo::where('id', 1)->first(),
            'banner_info' => Banner::where('id', 1)->first(),
            'typed_info' => Typed::orderBy('id', 'desc')->get(),
            'about_info' => About::where('id', 1)->first(),
            'skill_info' => Skill::where('id', 1)->first(),
            'service_info' => Service::orderBy('id', 'desc')->get(),
            'testimonial_info' => Testimonial::orderBy('id', 'desc')->limit(3)->get(),
            'footer_info' => Footer::where('id', 1)->first(),
            'footer_social' => FooterSocial::orderBy('id', 'desc')->limit(5)->get(),
        ]);
    }


    public function portfolioVideos(){
        return view('video', [
            'logo_info' => Logo::where('id', 1)->first(),
            'video_playlist' => VideoPlayList::orderBy('id', 'desc')->get(),
            'video_info' => Video::orderBy('id', 'desc')->get(),
            'footer_info' => Footer::where('id', 1)->first(),
            'footer_social' => FooterSocial::orderBy('id', 'desc')->limit(5)->get(),
        ]);
    }


    public function portfolioImages(){
        return view('image', [
            'logo_info' => Logo::where('id', 1)->first(),
            'image_categories' => ImageCategory::orderBy('id', 'desc')->get(),
            'images_info' => Image::orderBy('id', 'desc')->get(),
            'footer_info' => Footer::where('id', 1)->first(),
            'footer_social' => FooterSocial::orderBy('id', 'desc')->limit(5)->get(),
        ]);
    }


    public function testimonial(){
        return view('testimonial', [
            'logo_info' => Logo::where('id', 1)->first(),
            'testimonial_info' => Testimonial::orderBy('id', 'desc')->get(),
            'footer_info' => Footer::where('id', 1)->first(),
            'footer_social' => FooterSocial::orderBy('id', 'desc')->limit(5)->get(),
        ]);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
