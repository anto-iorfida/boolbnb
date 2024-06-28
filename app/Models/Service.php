<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;
class Service extends Model
{
    use HasFactory;
    // public function apartaments(){
    //     return $this->belongsToMany(Apartment::class);
    // }

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class, 'apartments_services', 'id_service', 'id_apartment');
    }
    
}
