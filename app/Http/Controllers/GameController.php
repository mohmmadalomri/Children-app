<?php

namespace App\Http\Controllers;

use App\Models\CategoryOfGames;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

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

    public function allgame(CategoryOfGames $category)
    {

        $category = CategoryOfGames::all();

        $games = Game::where('category_id', $category->id)->get();
        return view('dashboard.games.allgame', compact('games', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'required|integer',
            'backgrounder' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $data = $request->all();
        $backgrounder = $request->file('backgrounder');

        if ($request->file('backgrounder')) {
            $backgrounderfileName = uniqid() . '.' . $backgrounder->getClientOriginalExtension();
            $backgrounderpath = Storage::putFileAs('public/images', $backgrounder, $backgrounderfileName);
            $backgrounderurl = Storage::url($backgrounderpath);
            $data['backgrounder'] = $backgrounderurl;
        }

        $image = $request->file('image');
        if ($request->file('image')) {
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = Storage::putFileAs('public/images', $image, $fileName);
            $url = Storage::url($path);
            $data['image'] = $url;
        }


        $game = Game::create($data);
        return redirect()->route('games.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryOfGames $category)
    {
        $category = CategoryOfGames::all();
        $games = Game::where('category_id', $category)->get();

        return view('dashboard.games.allgame', compact('games', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $games = Game::all();
        $category = CategoryOfGames::all();
        $games = Game::find($id);
        return view('dashboard.games.edit', compact('games', 'category'));
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
        $data = $request->all();
        $games = Game::find($id);
        $oldimage = $games->image;
        $request->validate([
            'name' => 'required|string',
            'link' => 'string',
            'description' => 'string',
            'image' => 'file',
            'category_id' => 'required|integer',
            'backgrounder' => 'file',
        ]);
//        $oldImage = public_path("/app/public/images/".$games->image);
//        if (Storage::exists($oldImage)) {
//            Storage::delete($oldImage);
//        }
//        $oldbackgrounder = public_path("/app/public/images/{$games->backgrounder}");
//        if (Storage::exists($oldbackgrounder)) {
//            Storage::delete($oldbackgrounder);
//        }

        $oldimage = $games->image;
        $image = $request->file('image');
        if ($request->hasFile('image')) {
            if (Storage::exists('/images/' .$oldimage)) {
                Storage::delete('/images/' . $oldimage);


            }
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = Storage::putFileAs('public/images', $image, $fileName);
            $url = Storage::url($path);
            $data['image'] = $url;
        }

//
//        $backgrounder=$request->file('backgrounder');
//            $backgrounderfileName=uniqid() . '.' . $backgrounder->getClientOriginalExtension();
//            $backgrounderpath=Storage::putFileAs('public/images', $backgrounder, $backgrounderfileName);
//            $backgrounderurl=Storage::url($backgrounderpath);
//            $data['backgrounder']=$backgrounderurl;


        $games->update($data);
        return redirect()->route('games.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $games = Game::find($id);
        $games->delete();
        return redirect()->route('games.index');


    }
}
