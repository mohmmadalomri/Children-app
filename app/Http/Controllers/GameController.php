<?php

namespace App\Http\Controllers;

use App\Models\CategoryOfGames;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        $category = CategoryOfGames::all();
        return view('dashboard.games.index', compact('games', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = Game::all();
        $gamescategory = CategoryOfGames::all();
        return view('dashboard.games.create', compact('games', 'gamescategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $games = Game::all();
        $request->validate([
            'name' => 'required|string',
            'link' => 'string',
            'description' => 'string',
            'image' => 'file',
            'category_id' => 'required|integer',
            'backgrounder' => 'file',
        ]);

        $data = $request->all();
        $image = $request->file('image');
        if ($request->hasFile($data)) {
            $imgurl = $image->store('image', 'public');
            $data['image'] = $imgurl;
        }
        $game = Game::create($request->all());
        return redirect()->route('games.index');
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
        $games=Game::all();
        $category=CategoryOfGames::all();
        $games=Game::find($id);
        return view('dashboard.games.edit',compact('games','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
