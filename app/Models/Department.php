<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;    


    public function jop_positions(){ 
        return $this->hasMany(JopPosition::class,'department_id', 'id');
    }

}
