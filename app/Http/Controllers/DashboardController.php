<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Story;
class DashboardController extends Controller
{
    public function index()
    {
        $query = Story::where('status','1');
        $type = request()->input('type');

        if(in_array($type,['long','short'])){
            $query->where('type',$type);
        }
        $stories = $query
                   ->with('user')
                   ->orderBy('id','desc')
                   ->paginate(10);
       //dd($stories);
        return view('dashboard.index')->with('stories',$stories);
    }
    public function show(Story $activeStory)
    {
        return view('dashboard.show',[
            'story' => $activeStory
        ]);
    }

}
