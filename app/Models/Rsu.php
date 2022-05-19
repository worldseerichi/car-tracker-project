<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rsu extends Model
{
    use HasFactory;
    protected $fillable = ['range','description','user_id'];

}
