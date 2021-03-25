<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    use HasFactory;

    protected $table = "people";
    protected $guarded = [];

    public function user() : BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function companies() : BelongsTo{
        return $this->belongsTo(Company::class);
    }

    public function mod() : BelongsTo{
        return $this->belongsTo(Mod::class);
    }
}
