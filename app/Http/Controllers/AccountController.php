<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
/**
 * @author Pawel Kopec
 */
class AccountController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }
    public function index(Request $request) {
        
    }
    
    public function account(Request $request){
        return view('auth.account', [
            'user' => $request->user(),            
        ]);
        
    }
    
    public function edit(Request $request){
        
        $data = array();
        
        if($request->user()->email != $request->email )
            $data['email']='required|email|max:255|unique:users';
        $data['password']='required|min:6|confirmed';
        $this->validate($request,$data);
        
        $request->user()->email =  $request->email ;
        $request->user()->password = bcrypt($request->password);
        $request->user()->save();
        return redirect('/account');
    }
    
    
    
}
