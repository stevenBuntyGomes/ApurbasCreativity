<?php

namespace App\Http\Controllers;

use App\Video;
use App\VideoPlaylist;
use Illuminate\Http\Request;
use App\Http\Resources\VideoPlaylist as VideoPlaylistResource;
use App\Http\Resources\VideoPlaylistCollection as VideoPlaylistCollection;
use App\Classes\ImageObj;
use App\Http\Resources\VideoImage as VideoImageResource;
use App\Http\Resources\Video as VideoResource;
use App\Http\Resources\VideoCollection as VideoCollection;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Video::all()->count() < 2){
            $videos = Video::all();
            return new VideoCollection($videos);
        }else{
            $videos = Video::orderBy('id', 'desc')->get();
            return new VideoCollection($videos);
        }
    }

    public function searchVideoDB(Request $request){
        if($request->keywords == ''){
            $videos = Video::orderBy('id', 'desc')->get();
            return new VideoCollection($videos);
        }else{
            $videos = Video::where('video_name', 'like', '%' . $request->keywords . '%')->orderBy('id', 'desc')->get();
            return new VideoCollection($videos);
        }
    }


    public function addVideo(){
        $data = request()->validate([
            'playlist_id' => 'required',
            'video_name' => 'required',
            'video_link' => 'required',
            'image_name' => 'required',
                        // data.search = response.data;
        ]);

        $storeVideo = Video::create([
            'playlist_id' => $data['playlist_id'],
            'video_name' => $data['video_name'],
            'video_link' => $data['video_link'],
            'image_name' => $data['image_name'],
        ]);

        return new VideoResource($storeVideo);
    }


    public function editVideoDB(){
        $data = request()->validate([
            'video_id' => 'required',
            'playlist_id' => 'required',
            'video_name' => 'required',
            'image_name' => 'required',
            'video_link' => 'required',
        ]);

        Video::where('id', $data['video_id'])->update([
            'playlist_id' => $data['playlist_id'],
            'video_name' => $data['video_name'],
            'video_link' => $data['video_link'],
            'image_name' => $data['image_name'],
        ]);

        $udatedVideo = Video::where('id', $data['video_id'])->first();

        return new VideoResource($udatedVideo);
    }

    public function deleteVideoDB(){
        $data = request()->validate([
            'video_id' => 'required',
        ]);

        $video = Video::where('id', $data['video_id'])->first();

        $image_path = storage_path('app/public/video/' . $video->image_name);
        if(file_exists($image_path)){
            unlink($image_path);
        }

        Video::where('id', $data['video_id'])->delete();

        return response()->json('deleted');
    }

    public function addVideoImage(Request $request){
        $videoImage = Auth()->id() . '-' . str_replace(' ', '', 'video-image') . '-' . time() . '.' . $request->file->extension();

        $request->file->move(storage_path('app/public/video/'), $videoImage);

        $imageObj = new ImageObj($videoImage);

        return new VideoImageResource($imageObj);
    }


    public function deleteVideoImage(){
        $data = request()->validate([
            'image' => 'required',
        ]);

        $image_path = storage_path('app/public/video/' . $data['image']);
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
    public function addVideoPlaylist()
    {
        $data = request()->validate([
            'playlist_title' => 'required',
            'playlist_description' => 'required',
        ]);

        $newVideoPlaylist = VideoPlaylist::create([
            'playlist_title' => $data['playlist_title'],
            'playlist_description' => $data['playlist_description'],
        ]);

        return new VideoPlaylistResource($newVideoPlaylist);
    }

    public function getVideoPlaylist(){
        if(VideoPlaylist::all()->count() < 2){
            $videoPlaylist = VideoPlaylist::all();
            return new VideoPlaylistCollection($videoPlaylist);
        }else{
            $videoPlaylist = VideoPlaylist::orderBy('id', 'desc')->get();
            return new VideoPlaylistCollection($videoPlaylist);
        }

    }

    public function editVideoPlaylist(){
        $data = request()->validate([
            'playlist_id' => 'required',
            'playlist_title' => 'required',
            'playlist_description' => 'required',
        ]);

        VideoPlaylist::where('id', $data['playlist_id'])->update([
            'playlist_title' => $data['playlist_title'],
            'playlist_description' => $data['playlist_description'],
        ]);

        $updatedPlaylist = VideoPlaylist::where('id', $data['playlist_id'])->first();

        return new VideoPlaylistResource($updatedPlaylist);

    }

    public function searchVideoPlaylist(Request $request){
        if($request->keywords == ''){
            $playlist = VideoPlaylist::orderBy('id', 'desc')->get();
            return new VideoPlaylistCollection($playlist);
        }else{
            $playlist = VideoPlaylist::where('playlist_title', 'like', '%' . $request->keywords . '%')->orderBy('id', 'desc')->get();
            return new VideoPlaylistCollection($playlist);
        }
    }

    public function deleteVideoPlaylist(){
        $data = request()->validate([
            'playlist_id' => 'required',
        ]);

        VideoPlaylist::where('id', $data['playlist_id'])->delete();

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
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
