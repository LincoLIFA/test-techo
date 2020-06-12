<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'reference'
    ];

    public function TableWork()
    {
        return $this->hasMany('App\TableWork');
    }
}
