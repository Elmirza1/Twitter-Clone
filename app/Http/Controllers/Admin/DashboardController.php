<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        
        // if(!Gate::allows('admin')){
        //     abort(403);
        // }
        // $this->authorize('admin');
        return view('admin.dashboard');
    }
}
