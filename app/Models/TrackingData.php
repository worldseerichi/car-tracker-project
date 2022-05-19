<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingData extends Model
{
    use HasFactory;
    protected $fillable = ['latitude', 'longitude','altitude','bearing','velocity','gir_x','gir_y','gir_z','acel_x','acel_y','acel_z','rsu_id'];
}
