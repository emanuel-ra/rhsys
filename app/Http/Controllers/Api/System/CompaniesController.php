<?php

namespace App\Http\Controllers\Api\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompaniesController extends Controller
{
    public function getListWithRfc(){        
        $data = Company::select('id','name','rfc')->where('enable',1)->whereNotNull('rfc')->get();
        return Response()->json([
            'message'=>'Your request is successfully' ,
            'data' => $data 
        ],201);
    }
}
