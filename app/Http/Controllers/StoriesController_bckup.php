<?php

namespace App\Http\Controllers;
use App\Models\Story;

use Illuminate\Http\Request;

class StoriesController extends Controller
{
    
    public function index(){

        $stories = Story::where('user_id',auth()->id())->orderBy('id','desc')->paginate(4);
       
        return view('stories.index')->with('stories',$stories);
    }

    public function show(Story $story){

         //$story = Story::findorFail($story);
       
        
         return view('stories.show',[
             'story' => $story
         ]);
    }
}
