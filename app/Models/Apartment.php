<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\View;

class Apartment extends Model
{
    use HasFactory;
    public function services(){
        return $this->belongsToMany(Service::class);
    }

    public function view() {
        return $this->hasMany(View::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user'); 
    }
}
