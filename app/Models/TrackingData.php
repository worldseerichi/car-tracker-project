<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrackingData extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['latitude', 'longitude','altitude','bearing','velocity','gir_x','gir_y','gir_z','acel_x','acel_y','acel_z','device_id','recorded_at'];

    public function device(){
        return $this->belongsTo('App\Models\Device')->withTrashed();
    }
}
