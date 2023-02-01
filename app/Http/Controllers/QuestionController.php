<?php

namespace App\Http\Controllers;

use App\Models\CategoryOfGames;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isInstanceOf;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question=Question::all();
        $category=CategoryOfGames::all();
        return view('dashboard.question.index',compact('category','question'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question=Question::all();
        $category=CategoryOfGames::all();
        return view('dashboard.question.create',compact('category','question'));
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
        'name'=>'required|string',
        'link'=>'required|url',
        'image'=>'required|image',
    ]);

        $data=$request->all();
        $image = $request->file('image');
        if ($request->hasFile('image')){
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = Storage::putFileAs('public/images', $image, $fileName);
            $url = Storage::url($path);
            $data['image']=$url;
        }

        $question=Question::create($data);
        return redirect()->route('question.index');

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
        $question=Question::find($id);
        $category=CategoryOfGames::all();
        return view('dashboard.question.edit',compact('question','category'));
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
        $question=Question::find($id);
        $request->validate([
            'name'=>'required|string',
            'link'=>'required|url',
            'image'=>'required|image',
        ]);
        $oldImage = public_path("/uploads/items/{$question->image}");
        if (File::exists('public/images'.$oldImage)) {
            File::delete('public/images'.$oldImage);
        }

        $data=$request->all();
        $image = $request->file('image');
        if ($request->hasFile('image')){
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = Storage::putFileAs('public/images', $image, $fileName);
            $url = Storage::url($path);
            $data['image']=$url;
        }

        $question->update($data);
        return redirect()->route('question.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question=Question::find($id);
        $question->delete();
        return redirect()->route('question.index');
    }
}
