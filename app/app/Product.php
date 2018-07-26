<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'identifier';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
