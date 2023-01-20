<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    public function Status(){ 
        return $this->hasOne(Status::class, 'id', 'status_id')->select('id','name');
    }

    public function Staff(){ 
        return $this->hasOne(Staff::class, 'id', 'staff_id')->with('company')->with('Position')->with('Department');
    }
}
