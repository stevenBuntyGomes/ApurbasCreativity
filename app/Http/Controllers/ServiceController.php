<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Resources\Service as ServiceResource;
use App\Http\Resources\ServiceCollection as ServiceCollection;
use App\Classes\ImageObj;
use Intervention\Image\Facades\Image;
use App\Http\Resources\ServiceImage as ServiceImageResource;



class ServiceController extends Controller
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
    public function addServiceImage(Request $request)
    {
        $serviceImageName = Auth()->id() . '-' . str_replace(' ', '', 'service-image') . '-' . time() . '.' . $request->file->extension();
        // $image_path = storage_path('app/public/banner/' . $image_name->banner_image);
        // if(file_exists($image_path)){
        //     unlink($image_path);
        // }
        // Image::make($request->file)
        //     ->save(storage_path('app/public/services/' . $serviceImageName));
            $request->file->move(storage_path('app/public/services/'), $serviceImageName);

        // Service::where('id', 1)->update([
        //     'about_image' => $aboutImageName,
        // ]);

        $imageObj = new ImageObj($serviceImageName);
        // $request->file->move(storage_path('app/public/book-pages/'), $picName);
        // return response($picName);
        return new ServiceImageResource($imageObj);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeService()
    {
        $data = request()->validate([
            'servicesTitle' => 'required',
            'servicesDescription' => 'required',
            'servicesImage' => 'required',
        ]);

        $service = Service::create([
            'service_title' => $data['servicesTitle'],
            'service_description' => $data['servicesDescription'],
            'service_image' => $data['servicesImage'],
        ]);

        return new ServiceResource($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function deleteServiceImage()
    {
        $data = request()->validate([
            'image' => 'required',
        ]);

        $image_path = storage_path('app/public/services/' . $data['image']);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        return response('done');
    }


    public function getServices(){
        $services = Service::all();
        return new ServiceCollection($services);
    }


    public function searchService(Request $request)
    {

        if($request->keywords == ''){
            $services = Service::all();
            return new ServiceCollection($services);
        }else{
            $services = Service::where('service_title', 'like', '%' . $request->keywords . '%')->where('id', '!=', Auth()->id())->get();
            return new ServiceCollection($services);
        }

    }

    public function updateService(){
        $data = request()->validate([
            'serviceEditId' => 'required',
            'servicesTitleEdit' => 'required',
            'servicesDescriptionEdit' => 'required',
            'servicesImage' => 'required',
        ]);

        Service::where('id', $data['serviceEditId'])->update([
            'service_title' => $data['servicesTitleEdit'],
            'service_description' => $data['servicesDescriptionEdit'],
            'service_image' => $data['servicesImage'],
        ]);

        $updatedService = Service::where('id', $data['serviceEditId'])->first();

        return new ServiceResource($updatedService);
    }


    public function editServiceImage(Request $request){
        $request->validate([
            'serviceEditId' => 'required',
            'file' => 'required',
        ]);

        $serviceImage = Service::where('id', $request->serviceEditId)->first();
        $image_path = storage_path('app/public/services/' . $serviceImage->service_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $serviceImageName = Auth()->id() . '-' . str_replace(' ', '', 'service-image') . '-' . time() . '.' . $request->file->extension();
        $imageObj = new ImageObj($serviceImageName);
        $request->file->move(storage_path('app/public/services/'), $serviceImageName);
        // return response($picName);
        return new ServiceImageResource($imageObj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function deleteService(Request $request)
    {
        $data = request()->validate([
            'service_id' => 'required',
        ]);

        $service_image = Service::where('id', $data['service_id'])->first();

        $image_path = storage_path('app/public/services/' . $service_image->service_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        Service::where('id', $data['service_id'])->delete();
        return response()->json('deleted');


    }
}
