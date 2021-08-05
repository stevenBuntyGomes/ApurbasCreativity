<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use App\Http\Resources\TestimonialImage as TestiImageResource;
use App\Http\Resources\Testimonial as TestimonialResource;
use App\Http\Resources\TestimonialCollection as TestimonialCollection;
use App\Classes\ImageObj;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Testimonial::all()->count() < 2){
            $testimonial = Testimonial::all();
            return new TestimonialCollection($testimonial);
        }else{
            $testimonial = Testimonial::orderBy('id', 'desc')->get();
            return new TestimonialCollection($testimonial);
        }
    }


    public function searchTestiDB(Request $request){
        if($request->keywords == ''){
            $testimonial = Testimonial::orderBy('id', 'desc')->get();
            return new TestimonialCollection($testimonial);
        }else{
            $testimonial = Testimonial::where('testi_name', 'like', '%' . $request->keywords . '%')->orderBy('id', 'desc')->get();
            return new TestimonialCollection($testimonial);
        }
    }

    public function storeTestiImage(Request $request){
        $testiImage = Auth()->id() . '-' . str_replace(' ', '', 'testi-image') . '-' . time() . '.' . $request->file->extension();

        $request->file->move(storage_path('app/public/testimonial/'), $testiImage);

        $imageObj = new ImageObj($testiImage);

        return new TestiImageResource($imageObj);
    }


    public function deleteTestiImage(){
        $data = request()->validate([
            'image' => 'required',
        ]);

        $image_path = storage_path('app/public/testimonial/' . $data['image']);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        return response('done');

    }

    public function storeTestimonialDB(){
        $data = request()->validate([
            'testi_name' => 'required',
            'testi_position' => 'required',
            'testi_description' => 'required',
            'image_name' => 'required',
        ]);


        $newTestimonial = Testimonial::create([
            'testi_name' => $data['testi_name'],
            'testi_position' => $data['testi_position'],
            'testi_description' => $data['testi_description'],
            'image_name' => $data['image_name'],
        ]);

        return new TestimonialResource($newTestimonial);
    }


    public function editTestiDB(){
        $data = request()->validate([
            'testi_name' => 'required',
            'testi_position' => 'required',
            'testi_description' => 'required',
            'image_name' => 'required',
            'testi_id' => 'required',
        ]);


        Testimonial::where('id', $data['testi_id'])->update([
            'testi_name' => $data['testi_name'],
            'testi_position' => $data['testi_position'],
            'testi_description' => $data['testi_description'],
            'image_name' => $data['image_name'],
        ]);

        $updatedTestimonial = Testimonial::where('id', $data['testi_id'])->first();
        return new TestimonialResource($updatedTestimonial);
    }


    public function deleteTestiDB(){
        $data = request()->validate([
            'testi_id' => 'required',
        ]);

        $testimonial = Testimonial::where('id', $data['testi_id'])->first();

        $image_path = storage_path('app/public/testimonial/' . $testimonial->image_name);

        if(file_exists($image_path)){
            unlink($image_path);
        }

        Testimonial::where('id', $data['testi_id'])->delete();

        return response()->json('done');
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
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        //
    }
}
