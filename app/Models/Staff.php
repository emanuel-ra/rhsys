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
        return $this->hasOne(JopPosition::class, 'id','jop_position_id');
    }
    public function Department(){ 
        return $this->hasOne(Department::class,'id', 'department_id');
    }
    public function Company(){ 
        return $this->hasOne(Company::class,'id', 'company_id');
    }
    public function Branch(){ 
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }
    public function MaritalStatus(){ 
        return $this->hasOne(MaritalStatus::class, 'id', 'maritial_status_id');
    }
    public function Scholarship(){ 
        return $this->hasOne(Scholarship::class, 'id', 'scholarship_id');
    }
    public function Country(){ 
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
    public function State(){ 
        return $this->hasOne(State::class, 'id', 'state_id');
    }

}
