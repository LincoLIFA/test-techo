<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableWork extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'region_id', 'name', 'comuna', 'comunidad', 'latitud', 'longitud'
    ];

    public function region()
    {
        return $this->belongsTo('App\Region', 'region_id');
    }
}
