<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable=['name','county_id'];
    public $timestamps="true";
    protected $table="cities";

    public function counties()
    {
        return $this->belongsTo('App\County','county_id');
    }
}
