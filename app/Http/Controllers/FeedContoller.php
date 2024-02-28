<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class FeedContoller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $followingIDs = $user->followings()->pluck('user_id');
       
        $ideas = Idea::whereIn('user_id', $followingIDs)->latest();

        if(request()->has('search')){
            
            $search=request()->get('search', '');
            $ideas=$ideas->where('content','LIKE','%'.$search.'%');
        }
        //Comment::where('idea_id', $ideas->id);
        return view('dashboard', [
            'ideas'=>$ideas->paginate(5),
        ]);
    }
}
