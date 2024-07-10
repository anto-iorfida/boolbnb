<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\Sponsor;
use App\Models\View;
use App\Models\User;
use App\Models\Album;
use Illuminate\Database\Eloquent\SoftDeletes;


class Apartment extends Model
{
    use HasFactory;
    
    use SoftDeletes;

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
        'visibility',
        'id_service'
    ];
    // public function services(){
    //     return $this->belongsToMany(Service::class);
    // }

    public function services()
    {
        return $this->belongsToMany(Service::class ,'apartments_services', 'id_apartment', 'id_service');
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

    public function albums() {
        return $this->hasMany(Album::class);
    }

    public function getVisibilityTextAttribute()
    {
        return $this->visibility ? 'visibile' : 'non visibile';
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class, 'apartments_sponsors', 'id_apartment', 'id_sponsor')
                    ->withPivot('start_time', 'end_time');
    }
    public function sponsor()
    {
        return $this->hasMany(Sponsor::class);
    }
}
