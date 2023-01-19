<?php

namespace App\Http\Controllers;

use App\Models\VoiceCategory;
use Illuminate\Http\Request;

class VoiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voicecategory=VoiceCategory::all();
        return view('dashboard.voice-category.index',compact('voicecategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.voice-category.create');
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
            'name'=>'string'
        ]);
        $voicecategory=VoiceCategory::create($request->all());
        return redirect()->route('voice-category.index');
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
        $voicecategory=VoiceCategory::all();
        $voicecategory=VoiceCategory::find($id);
        return view('dashboard.voice-category.edit',compact('voicecategory'));
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
        $voicecategory=VoiceCategory::all();
        $voicecategory=VoiceCategory::find($id);
        $request->validate([
            'name'=>'string'
        ]);
        $data=$request->all();
        $voicecategory->update($data);
        $voicecategory->save();
        return redirect()->route('voice-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voicecategory=VoiceCategory::find($id);
        $voicecategory->delete();
        return redirect()->route('voice-category.index');

    }
}
