<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'geo_id',
        'province_id',
        'district_id',
        'postcode',
    ];
}
