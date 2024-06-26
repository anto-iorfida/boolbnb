<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appartament;
class Service extends Model
{
    use HasFactory;
    public function appartaments(){
        return $this->belongsToMany(Appartament::class);
    }
}
