<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    public function CandidateSource(){ 
        return $this->hasOne(CandidateSource::class, 'id','sources_id')->select('id','name');
    }
    public function Requisitions(){ 
        return $this->hasOne(Requisitions::class, 'id','requisition_id')->select('id','branch_id','jop_position_id')->with('Branch')->with('Position');
    }
    public function Status(){ 
        return $this->hasOne(Status::class, 'id','status_id')->select('id','name');
    }

}
