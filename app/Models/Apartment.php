<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\View;
use App\Models\User;


class Apartment extends Model
{
    use HasFactory;
    public function services(){
        return $this->belongsToMany(Service::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
}
    public function views() {
        return $this->hasMany(View::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user'); 

    }
}
