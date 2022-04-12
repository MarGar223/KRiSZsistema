<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserLevel extends Model
{
    use HasFactory;

    public function users(){
        $this->belongsToMany(User::class);
    }
}
