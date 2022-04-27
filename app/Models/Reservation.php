<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Zone;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_id',
        'user_id',
        'people_count',
        'date_when',
        'start_time',
        'end_time',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function zone(){
        return $this->hasOne(Zone::class,'id', 'zone_id');
    }
}
