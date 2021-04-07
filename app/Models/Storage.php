<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Storage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class);
    }
}
