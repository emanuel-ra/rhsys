<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisitions extends Model
{
    use HasFactory;

    public function Supervisor(){ 
        return $this->hasOne(Staff::class,'id', 'supervisor_id')->select('id','name');
    }
    public function Company(){ 
        return $this->hasOne(Company::class,'id', 'company_id')->select('id','name');
    }
    public function Branch(){ 
        return $this->hasOne(Branch::class, 'id', 'branch_id')->select('id','name');
    }
    public function Position(){ 
        return $this->hasOne(JopPosition::class, 'id','jop_position_id')->select('id','name');
    }
    public function Department(){ 
        return $this->hasOne(Department::class,'id', 'department_id')->select('id','name');
    }
    public function Status(){ 
        return $this->hasOne(Status::class,'id', 'status_id')->select('id','name');
    }
}
