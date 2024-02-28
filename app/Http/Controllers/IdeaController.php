<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;

class IdeaController extends Controller
{
    public function show(Idea $idea)
    {

        return view('ideas.show', compact('idea'));
    }


    public function store(CreateIdeaRequest $request)
    {
        // $idea = new Idea('content'->request()->get('idea', ''));
        // $idea->save();
        
        // $validated = request()->validate([
        //     'content' => 'required|min:5|max:240'
        // ]);

        $validated = $request->validated();

        $validated['user_id'] = auth()->id();

        Idea::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Idea created successfully');
    }
    public function destroy(Idea $idea)
    {
        //$idea = Idea::where('id', $id)->firstOrFail();
        //$idea->delete();


        // if (auth()->id() !== $id->user_id) {
        //     abort(403);
        // }
                
                //with gates
        //$this->authorize('idea.edit', $id);
        
                //with policy
        $this->authorize('delete', $idea);
        $idea->delete();
        return redirect()->route('dashboard')
            ->with('success', 'Idea deleted successfully');
    }

    public function edit(Idea $idea)
    {
        // if (auth()->id() !== $id->user_id) {
        //     abort(403);
        // }

                //with gates
        //$this->authorize('idea.edit', $id);

                // with policy
        $this->authorize('update', $idea);

        $editing = true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        // if (auth()->id() !== $id->user_id) {
        //     abort(403);
        // }
        $this->authorize('idea.edit', $idea);
        

        // request()->validate([
        //     'content' => 'required|min:5|max:240'
        // ]);

        $validated = $request->validated();

        // $id->content = request()->get('content', '');
        // $id->save();
        $idea->update($validated);

        return redirect()->route('ideas.show', $idea->id)
            ->with('success', 'Idea updated successfully');
    }
}
