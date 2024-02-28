<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function store(CreateCommentRequest $request, Idea $id){

        // request()->validate([
        //     'content' =>'required|min:5|max:240'
        // ]);

        $validated = $request->validated();
        
        // $comment = new Comment(); 
        // $comment->idea_id = $id->id;
        // $comment->user_id = auth()->id();
        // $comment->content = request()->get('content');
        // $comment->save();

        $validated['user_id'] = auth()->id();
        $validated['idea_id'] = $id->id;
        Comment::create($validated);

        return redirect()->route('ideas.show', $id->id)
                ->with('success', 'Comment created successfully');

    }
}
