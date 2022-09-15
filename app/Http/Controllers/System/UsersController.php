<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

use App\Models\User;
use Spatie\Permission\Models\Role;


class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:admin','permission: users.index|users.create|users.update|users.delete']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = User::get();        
        return view('system.users.app',['data'=>$data]);
    }   
    public function register(){
       
        $Role = Role::get();
        return view('system.users.register',['Role'=>$Role]);
    }   
    public function store(Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255',         
            'email' => 'required|max:255|unique:users',         
            'password' => [
                'required' ,
                'string',
                Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(),
            ],         
            'cpassword' => 'required|same:password',  
            'role_id' => 'required',       
        ]); 
      
        User::create([
            'name' => $request->name ,
            'email' => $request->email ,
            'email_verified_at' => now(),
            'password' => bcrypt($request->password) ,
            'remember_token' => Str::random(10),
        ])->assignRole($request->role_id);
       
        return redirect()->route('system.users');
    }
    public function edit($id){             

        $Role = Role::get();      
        $user = User::with('roles')->find($id);

        //return Response()->json($user);

        return view('system.users.edit',['user'=>$user,'Role'=>$Role,'id'=>$id]);
    }
    public function update($id,Request $request)
    {
        $this->validate($request, [               
            'name' => 'required|max:255',         
            'email' => 'required|max:255|unique:users,id,'.$id,                    
            'role_id' => 'required',       
        ]); 

        if(isset($request->password))
        {
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
                'cpassword' => 'required|same:password',                    
            ]); 
        }

       
        $User = User::find($id);
        $User->name = $request->name;
        $User->email = $request->email;

        if(isset($request->password))
        {
            $User->password = bcrypt($request->password);
        }
        
        $User->save();

        $User->assignRole($request->role_id);     

        return redirect()->route('system.users');

    }
}
