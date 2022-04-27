<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'max_people_count'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

}
