<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\BinaryOp;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);

        return view('users.show', compact('user', 'ideas'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $editing = true;
        $ideas = $user->ideas()->paginate(5);

        return view('users.edit', compact('user', 'editing', 'ideas'));
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        
        $validated = $request->validated();

        // $validated = request()->validate(
        //     [
        //         'name'=>'required|min:3|max:40',
        //         'bio' =>'nullable|min:1|max:255',
        //         'image'=>'image'
        //     ]
        //     );
        if(request()->has('image')){
            
            $imagePath = request()->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;
            Storage::disk('public')->delete($user->image ?? '');

        }

        $user->update($validated);
        return redirect()->route('profile');

    }

    
    
    public function profile()
    {
        return $this->show(auth()->user());
    }


}
