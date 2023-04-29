<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware(['permission: roles.index|roles.create|roles.update|roles.delete']);
    }
    /**
     * Show the app module.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function form_change_password()
    {
        return view('system.profile.changepassword');
    }   
    public function action_update_password(Request $request){
                
        $this->validate($request, [               
            'password' => [
                'required' ,
                'string',
                Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(),
            ],         
            'c_password' => 'required|same:password',  
        ]); 

        $User = User::findOrFail($request->user()->id);
        
        $User->password = bcrypt($request->password);

        $User->save();

        return redirect()->back()->withSuccess('Contraseña actualizada');
        
    }

}
