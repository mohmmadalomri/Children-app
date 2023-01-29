<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use App\Models\TranslationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translation=Translation::all();
        $category=TranslationCategory::all();
        return view('dashboard.translation.index',compact('translation','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $translation=Translation::all();
        $category=TranslationCategory::all();
        return view('dashboard.translation.create',compact('translation','category'));
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
            'name'=>'string|required',
            'link'=>'string|required',
            'image'=>'file|required'
        ]);
        $data=$request->all();
        $image=$request->file('image');
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
        $path = Storage::putFileAs('public/images', $image, $fileName);
        $url = Storage::url($path);
        $data['image']=$url;
        $translation=Translation::create($data);
        return redirect()->route('translation.index');
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
        $category=TranslationCategory::all();
        $translation=Translation::find($id);
        return view('dashboard.translation.edit',compact('translation','category'));
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
        $translation=Translation::find($id);

        $request->validate([
            'name'=>'string|required',
            'link'=>'string|required',
            'image'=>'file|required'
        ]);
        $data=$request->all();
        $translation=Translation::update($data);
        return redirect()->route('translation.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $translation=Translation::find($id);
        $translation->delete();
        return redirect()->route('translation.index');

    }
}
