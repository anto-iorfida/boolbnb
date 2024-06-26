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

    public function view() {
        return $this->belongsTo(View::class);
    }
}
