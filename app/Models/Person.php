<?php

namespace App\Models;

use Epigra\TrGeoZones\Models\City;
use Epigra\TrGeoZones\Models\CityDistrict;
use Epigra\TrGeoZones\Models\Country;
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

    public function countries() : BelongsTo{
        return $this->belongsTo(Country::class,'person_countries');
    }

    public function cities() : BelongsTo{
        return $this->belongsTo(City::class,'person_cities');
    }

    public function district() : BelongsTo
    {
        return $this->belongsTo(CityDistrict::class,'person_district');
    }

}
