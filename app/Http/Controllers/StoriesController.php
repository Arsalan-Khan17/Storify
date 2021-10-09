<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use App\Http\Requests\StoryRequest;
use Illuminate\Support\Facades\Gate;
class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::where('user_id',auth()->id())->orderBy('id','desc')->paginate(5);
       
        return view('stories.index')->with('stories',$stories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $story = new Story;
        return view('stories.create',[
            'story' => $story
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {

    //    $data =  $request->validate();
        

      

        auth()->user()->stories()->create($request->all());

        return redirect('/stories')->with('status','Story created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        return view('stories.show',[
            'story' => $story
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        $this->authorize('update',$story);
        return view('stories.edit',[
            'story' => $story
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(StoryRequest $request, Story $story)
    {

        //dd($request->all());
       // $data =  $request->validate();
        

      

        $story->update($request->all());
        return redirect('/stories')->with('status','Story Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
       $this->authorize('delete',$story);
       $story->delete();
       return redirect('/stories')->with('status','Story Deleted successfully');
    }
}
