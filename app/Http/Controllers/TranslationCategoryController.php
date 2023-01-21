<?php

namespace App\Http\Controllers;

use App\Models\TranslationCategory;
use Illuminate\Http\Request;

class TranslationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translationcategoy=TranslationCategory::all();
        return view('dashboard.translation-category.index',compact('translationcategoy'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $translationcategoy=TranslationCategory::all();
        return view('dashboard.translation-category.create',compact('translationcategoy'));
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
            'name'=>'string|required'
        ]);
        $translationcategoy=TranslationCategory::create($request->all());
        return redirect()->route('translation-category.index');
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
        $translationcategoy=TranslationCategory::find($id);
        return view('dashboard.translation-category.edit',compact('translationcategoy'));
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
        $translationcategoy=TranslationCategory::find($id);

        $request->validate([
            'name'=>'string|required'
        ]);
        $translationcategoy->update($request->all());
        return redirect()->route('translation-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $translationcategoy=TranslationCategory::find($id);
        $translationcategoy->delete();
        return redirect()->route('translation-category.index');

    }
}
