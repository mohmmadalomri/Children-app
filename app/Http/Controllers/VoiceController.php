<?php

namespace App\Http\Controllers;

use App\Models\Voice;
use App\Models\VoiceCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voices=Voice::all();
        $voicecategory=VoiceCategory::all();
        return view('dashboard.voice.index',compact('voices','voicecategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $voices=Voice::all();
        $voicecategory=VoiceCategory::all();
        return view('dashboard.voice.create',compact('voices','voicecategory'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'name'=>'required|string',
//            'voice'=>'required'
//        ]);
        $data=$request->all();
//        $voice_file = $request->file('voice_file');
//        $path = $voice_file->store('public/voice_files');

//        $voice_file = $request->file('voice_file');
//        if ($request->hasFile($data)) {
//            $voice_fileurl = $voice_file->store('voice', 'public');
//            $data['voice_file'] = $voice_fileurl;
//        }

        if($request->hasFile('voice_file')){
            $uniqueid=uniqid();
            $file = $request->file('voice_file');
            $originalname=$request->file('voice_file')->getClientOriginalName();
            $size=$request->file('voice_file')->getSize();
            $extension=$request->file('voice_file')->getClientOriginalExtension();
            $filename=Carbon::now()->format('Ymd').''.$uniqueid.'.'.$extension;
            $audiopath=url('/storage/upload/files/audio/'.$filename);
            $path=$file->storeAs('public/upload/files/audio/',$filename);
            $all_audios=$audiopath;
        }

        $voicefile=Voice::create($data);
        return redirect()->route('voice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        $path = storage_path("app/storage/upload/files/audio/");

        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
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
