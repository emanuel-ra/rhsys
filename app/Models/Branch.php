<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    public function company(){
        return $this->hasOne(Company::class,'id','company_id');
    }
    public function AuthorizedPost(){
        return $this->hasMany(AuthorizedPost::class,'branch_id','id')->with('CurrentStaff');
    }
}
