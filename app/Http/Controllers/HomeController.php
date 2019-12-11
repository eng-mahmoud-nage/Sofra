<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }
    
    function edit_profile(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        auth()->user()->update($request->all());
        return redirect(url('/admin/profile'))->with('success', 'Profile Updated.');
    }
}
