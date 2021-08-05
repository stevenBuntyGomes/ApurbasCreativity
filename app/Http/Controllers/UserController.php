<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource as UserResource;
use App\User;
use App\UserImage;
use App\Logo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Resources\UserImage as UserImageResource;
use App\Classes\ImageObj;
use App\Http\Resources\Logo as LogoResource;
use App\Http\Resources\LogoImage as LogoImageResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAuthUser()
    {
        return new UserResource(Auth()->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAuthInformation()
    {
        $data = request()->validate([
            'updateUserName' => 'required',
            'updateUserEmail' => 'required',
        ]);

        $authUser = User::where('id', Auth()->id())->first();
        if($data['updateUserName'] == $authUser->name){
            $status = 1;
            return response()->json($status);
        }else{
            User::where('id', Auth()->id())->update([
                'name' => $data['updateUserName'],
                'email' => $data['updateUserEmail'],
            ]);

            $userUpdate = User::where('id', auth()->id())->first();
            return new UserResource($userUpdate);
        };
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){

    }



    public function updatePassword()
    {

        $data =request()->validate([
            'oldPassword' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required',
        ]);

        $user = User::where('id', Auth()->id())->first();
        if(Hash::check($data['oldPassword'], $user->password)){
            if($data['oldPassword'] == $data['password']){
                $status = 2;
                return response()->json($status);
            }else{
                if($data['password'] != $data['confirmPassword']){
                    $status = 3;
                return response()->json($status);
                }else{
                    User::where('id', Auth()->id())->update([
                        'password' => Hash::make($data['password']),
                    ]);
                    $status = 4;
                    return response()->json($status);
                }
            }
        }else{
            $status = 1;
            return response()->json($status);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);
        $userImage = UserImage::where('id', Auth()->id())->first();
        if($userImage != null){
            unlink('app/public/auth/', $userImage->path);
            UserImage::where('id', Auth()->id())->delete();
        }
        $userImageName = Auth()->id() . '-' . str_replace(' ', '', Auth()->user()->name) . '-' . time() . '.' . $request->file->extension();
        Image::make($request->file)
            ->save(storage_path('app/public/auth/' . $userImageName));

        $newUserImage = auth()->user()->images()->create([
            'path' => $userImageName,
            'width' => 130,
            'height' => 130,
            'location' => null,
        ]);

        // $imageObj = new ImageObj($userImageName);
        // $request->file->move(storage_path('app/public/book-pages/'), $picName);
        // return response($picName);
        return new UserImageResource($newUserImage);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeImage(Request $request)
    {
        $image_name = $request->imageName;

        UserImage::where('user_id', auth()->id())->where('path', $image_name)->delete();

        $image_path = storage_path('app/public/auth/' . $image_name);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        return response('done');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserLogo()
    {
        $getLogo = Logo::where('id', 1)->first();

        return new LogoResource($getLogo);
    }


    public function updateLogoImage(Request $request)
    {
        $request->validate([
            'file' => 'image',
        ]);

        $logoImage = Logo::where('id', 1)->first();
        if($logoImage->logo_image != null){
            unlink('app/public/logo/', $logoImage->logo_image);
        }
        $logoImageName = Auth()->id() . '-' . str_replace(' ', '', 'logo-image') . '-' . time() . '.' . $request->file->extension();
        Image::make($request->file)
            ->save(storage_path('app/public/logo/' . $logoImageName));

        Logo::where('id', 1)->update([
            'logo_image' => $logoImageName,
        ]);

        $imageObj = new ImageObj($logoImageName);
        // $request->file->move(storage_path('app/public/book-pages/'), $picName);
        // return response($picName);
        return new LogoImageResource($imageObj);
    }


    public function removeLogoImage(){
        $image_name = Logo::where('id', 1)->first();



        $image_path = storage_path('app/public/logo/' . $image_name->logo_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        Logo::where('id', 1)->update([
            'logo_image' => null,
        ]);
        return response('done');
    }
}
