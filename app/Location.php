<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'longitude', 'latitude', 'person_id'
    ];

    public function person() {
        return $this->belongsTo(Person::class, 'person_id');
    }

}
