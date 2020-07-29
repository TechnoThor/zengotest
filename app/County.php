<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $fillable=['name'];
    public $timestamps="true";
    protected $table="counties";

    public function cities()
    {
        return $this->hasMany('App\City','county_id');
    }
}
