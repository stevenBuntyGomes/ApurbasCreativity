<?php

namespace App\Http\Controllers;

use App\Image;
use App\ImageCategory;
use Illuminate\Http\Request;
use App\Http\Resources\ImageCategory as ImageCategoryResource;
use App\Http\Resources\ImageCategoryCollection as ImageCategoryCollection;
use App\Classes\ImageObj;
use App\Http\Resources\Image as ImageResource;
use App\Http\Resources\ImageImage as portgolioImageResource;
use App\Http\Resources\ImageCollection as ImageCollection;


class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imageCount = Image::all();
        if($imageCount->count() > 1){
            $images = Image::orderBy('id', 'desc')->get();
            return new ImageCollection($images);
        }else{
            $images = Image::all();
            return new ImageCollection($images);
        }
    }

    public function searchPortfolioImages(Request $request){
        if($request->keywords == ''){
            $images = Image::orderBy('id', 'desc')->get();
            return new ImageCollection($images);
        }else{
            $imageCategory = ImageCategory::where('category_name', 'like', '%' . $request->keywords . '%')->first();
            if($imageCategory == null){
                return new ImageCollection([]);
            }else{
                $image = Image::where('image_category_id', $imageCategory->id)->get();
                return new ImageCollection($image);
            }

        }
    }


    public function addImageToDB(){
        $data = request()->validate([
            'image_category_id' => 'required',
            'image_name' => 'required',
        ]);

        $newImage = Image::create([
            'image_category_id' => $data['image_category_id'],
            'image_name' => $data['image_name'],
        ]);

        return new ImageResource($newImage);
    }


    public function eiditPortfolioImage(){
        $data = request()->validate([
            'image_edit_id' => 'required',
            'image_name' => 'required',
            'category_id' => 'required',
        ]);

        Image::where('id', $data['image_edit_id'])->update([
            'image_name' => $data['image_name'],
            'image_category_id' => $data['category_id'],
        ]);

        $updatedImage = Image::where('id', $data['image_edit_id'])->first();

        return new ImageResource($updatedImage);
    }

    public function deletePortfolioImageDB(){
        $data = request()->validate([
            'image_id' => 'required',
        ]);

        $image = Image::where('id', $data['image_id'])->first();

        $image_path = storage_path('app/public/portfolio/' . $image->image_name);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        Image::where('id', $data['image_id'])->delete();

        return response()->json('deleted');

    }

    public function storeImage(Request $request){
        $portfolioImage = Auth()->id() . '-' . str_replace(' ', '', 'portfolio-image') . '-' . time() . '.' . $request->file->extension();

        $request->file->move(storage_path('app/public/portfolio/'), $portfolioImage);

        $imageObj = new ImageObj($portfolioImage);

        return new portgolioImageResource($imageObj);
    }


    public function deleteImage(){
        $data = request()->validate([
            'image' => 'required',
        ]);

        $image_path = storage_path('app/public/portfolio/' . $data['image']);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        return response('done');
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


    public function getImageCategory(){
        $imageCategoriesCount = ImageCategory::all();
        if($imageCategoriesCount->count() > 1){
            $imageCategories = ImageCategory::orderBy('id', 'desc')->get();
            return new ImageCategoryCollection($imageCategories);
        }else{
            $imageCategories = ImageCategory::all();
            return new ImageCategoryCollection($imageCategories);
        }

    }


    public function searchImageCategory(Request $request){

        if($request->keywords == ''){
            $imageCategory = ImageCategory::orderBy('id', 'desc')->get();
            return new ImageCategoryCollection($imageCategory);
        }else{
            $imageCategory = ImageCategory::where('category_name', 'like', '%' . $request->keywords . '%')->orderBy('id', 'desc')->get();
            return new ImageCategoryCollection($imageCategory);
        }
    }

    public function addImageCategory(){
        $data = request()->validate([
            'categoryName' => 'required',
        ]);

        $newImageCategory = ImageCategory::create([
            'category_name' => $data['categoryName'],
        ]);

        return new ImageCategoryResource($newImageCategory);
    }


    public function editImageCategory(){
        $data = request()->validate([
            'category_id' => 'required',
            'category_name' => 'required',
        ]);

        ImageCategory::where('id', $data['category_id'])->update([
            'category_name' => $data['category_name'],
        ]);

        $updatedImageCategory = ImageCategory::where('id', $data['category_id'])->first();
        return new ImageCategoryResource($updatedImageCategory);
    }


    public function deleteImageCategory(){
        $data = request()->validate([
            'category_id' =>  'required',
        ]);

        ImageCategory::where('id', $data['category_id'])->delete();

        return response()->json('done');
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
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
