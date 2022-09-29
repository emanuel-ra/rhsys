<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    public function User(){ 
        return $this->hasOne(User::class, 'id','user_id');
    }
    public function Position(){ 
        return $this->hasOne(JopPosition::class, 'id','jop_position_id')->select('id','name');
    }
    public function Department(){ 
        return $this->hasOne(Department::class,'id', 'department_id')->select('id','name');
    }
    public function Company(){ 
        return $this->hasOne(Company::class,'id', 'company_id')->select('id','name');
    }
    public function Branch(){ 
        return $this->hasOne(Branch::class, 'id', 'branch_id')->select('id','name');
    }
    public function MaritalStatus(){ 
        return $this->hasOne(MaritalStatus::class, 'id', 'maritial_status_id')->select('id','name');
    }
    public function Scholarship(){ 
        return $this->hasOne(Scholarship::class, 'id', 'scholarship_id')->select('id','name');
    }
    public function Country(){ 
        return $this->hasOne(Country::class, 'id', 'country_id')->select('id','name');
    }
    public function State(){ 
        return $this->hasOne(State::class, 'id', 'state_id')->select('id','name');
    }

    public function Status(){ 
        return $this->hasOne(Status::class, 'id', 'status_id')->select('id','name');
    }

    public function unsubscribe(){ 
        return $this->hasOne(ReasonsToLeaveWork::class, 'id', 'reason_unsubscribe_id')->select('id','name');
    }
    public function stafflogs(){ 
        return $this->hasMany(StaffLogs::class, 'staff_id', 'id')->with('User')->orderBy('created_at','desc');
    }
    public function Boss(){ 
        return $this->belongsTo(self::class, 'supervisor_id', 'id')->select('id','name');
    }
    public function StaffRotation(){
        return $this->hasOne(StaffRotation::class, 'staff_id', 'id')->select('id','name');
    }
}
