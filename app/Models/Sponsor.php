<?php

namespace App\Models;
use App\Models\Apartment;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    public function apartments()
    {
        return $this->belongsToMany(Apartment::class, 'apartments_sponsors', 'id_sponsor', 'id_apartment')
                    ->withPivot('start_time', 'end_time');
    }
}
