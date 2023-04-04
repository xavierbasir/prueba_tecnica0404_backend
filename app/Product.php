<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "products";
    protected $fillable = [
        'name', 'value', 'description', 'softDelete'
    ];

}
