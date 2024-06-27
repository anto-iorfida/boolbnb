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
    protected $fillable = [
        'id_user',
        'title',
        'slug',
        'description',
        'number_rooms',
        'number_beds',
        'number_baths',
        'square_meters',
        'thumb',
        'address',
        'longitude',
        'latitude',
        'price',
        'visibility',
    ];
    // public function services(){
    //     return $this->belongsToMany(Service::class);
    // }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'apartments_services', 'id_apartment', 'id_service');
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
