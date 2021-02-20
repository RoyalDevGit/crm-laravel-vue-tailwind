<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = "people";
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function companies(){
        return $this->belongsTo(Company::class);
    }

}
