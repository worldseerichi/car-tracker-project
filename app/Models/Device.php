<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['device_id','range','description','user_id'];

    public function user(){
        return $this->belongsTo('App\Models\User')->withTrashed();
    }

    public function trackingdata(){
        return $this->hasMany('App\Models\TrackingData')->withTrashed();
    }
}
