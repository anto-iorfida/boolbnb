<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentSponsor extends Model
{
    use HasFactory;

    protected $table = 'apartments_sponsors';
    // Aggiungi le colonne che possono essere assegnate in massa
    protected $fillable = [
        'id_apartment',
        'id_sponsor',
        'start_time',
        'end_time',
    ];
}
