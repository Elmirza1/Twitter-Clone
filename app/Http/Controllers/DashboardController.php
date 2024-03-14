<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {   
   
        $ideas = Idea::orderby('created_at', 'DESC');

        if(request()->has('search')){
            
            // $search=request()->get('search', '');
            // $ideas=$ideas->where('content','LIKE','%'.$search.'%');

            $ideas = $ideas->search(request('search', ''));    

        }
        //Comment::where('idea_id', $ideas->id);

        $topUsers = User::withCount('ideas')->orderBy('ideas_count', 'Desc')->limit(5)->get();

        return view('dashboard', [
            'ideas'=>$ideas->paginate(5),
            'topUsers'=> $topUsers,
        ]);
    }

}
