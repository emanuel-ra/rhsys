<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StateOfACountry;

class StatesOfCountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware(['role:admin','permission: roles.index|roles.create|roles.update|roles.delete']);
    }
    // AJAX
    public function getJson(Request $request){
        $data = StateOfACountry::where('country_id',$request->country_id)->get(); 

        return Response()->json($data,200);
    }
}
