<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;
    public function candidate(){ 
        return $this->hasOne(Candidate::class,'id', 'candidate_id')->with('CandidateSource')->with('Requisitions')->with('Status');
    }
    public function status(){ 
        return $this->hasOne(Status::class,'id', 'status_id')->select('id','name');
    }
    public function type_interview(){ 
        return $this->hasOne(TypeInterview::class,'id', 'type_interview_id')->select('id','name');
    }
    public function User(){ 
        return $this->hasOne(User::class,'id', 'user_id')->select('id','name');
    }
}
