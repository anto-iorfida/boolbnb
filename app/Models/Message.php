<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;

class Message extends Model
{
    public function apartment()
    {
        return $this->belongsTo(Apartment::class, 'apartment_id');
    }
}