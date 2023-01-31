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
        $request->validate([
            'voice_file' => 'required|file',
            'name'=>'required|string'
        ]);
        $data=$request->all();
//        $voice_file = $request->file('voice_file');

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
            $data['voice_file']=$audiopath;
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
    public function show(Voice $voice)
    {
        $path = storage_path("app/public/upload/files/audio/".$voice->voice_file);

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
    public function edit( $id)
    {
        $voicecategory=VoiceCategory::all();

        $voice=Voice::find($id);
        return view('dashboard.voice.edit',compact('voice','voicecategory'));
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
        $voice=Voice::find($id);
        $request->validate([
            'voice_file' => 'required|file',
            'name'=>'required|string'
        ]);
        $data=$request->all();
//        $voice_file = $request->file('voice_file');

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
            $data['voice_file']=$audiopath;
        }
        $voice->update($request->all());
        return redirect()->route('voice.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voice=Voice::find($id);
        $voice->delete();
        return redirect()->route('voice.index');
    }
}
