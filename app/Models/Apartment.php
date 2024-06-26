<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Apartment extends Model
{
    use HasFactory;
    public function services(){
        return $this->belongsToMany(Service::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
