<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function user(){
        $this->belongsTo(User::class,'user_level_id');
    }
}

