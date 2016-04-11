<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;

class AdminController extends Controller{
    
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function accounts(Request $request) {
        
        $this->authorize('administration', $request->user());
        
        return view('admin.accounts', [
            'users' => \App\Models\User::all(),
        ]);
        
    }
    
    public function destroyUser(Request $request, User $user){
        
        $this->authorize('administration', $request->user());
        $user->delete();
        return redirect('/admin/accounts');
        
    }
    
    public function courses(Request $request) {
        
        $this->authorize('administration', $request->user());
        return view('admin.courses', [
            'courses' => \App\Models\Course::all()
        ]);
        
    }
    
    
}
