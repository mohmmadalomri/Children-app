<?php

namespace App\Http\Controllers;

use App\Models\CategoryOfGames;
use Illuminate\Http\Request;

class CategoryOfCamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categoryofgame = CategoryOfGames::all();
        return view('dashboard.categoryofgames.index', compact('categoryofgame'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryofgame = CategoryOfGames::all();

        return view('dashboard.categoryofgames.create', compact('categoryofgame'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);
        $category = CategoryOfGames::create($request->all());
        return redirect()->route('categoryofgames.index')->with('done', 'category add sucess fuly');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryofgames = CategoryOfGames::all();
        $categoryofgames = CategoryOfGames::findOrFail($id);
        return view('dashboard.categoryofgames.edit', compact('categoryofgames'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$categoryOfGames)
    {

        $categoryOfGames=CategoryOfGames::find($categoryOfGames);

        $categoryOfGames->update(['name'=> $request->name]);
        $categoryOfGames->save();
        return redirect()->route('categoryofgames.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
