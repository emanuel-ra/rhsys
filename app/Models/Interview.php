<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;
    public function prospect(){ 
        return $this->hasOne(Prospects::class,'id', 'prospect_id')->with('ProspectSource')->with('Requisitions')->with('Status');
    }
    public function status(){ 
        return $this->hasOne(Status::class,'id', 'status_id')->select('id','name');
    }
    public function type_interview(){ 
        return $this->hasOne(TypeInterview::class,'id', 'type_interview_id')->select('id','name');
    }

}
