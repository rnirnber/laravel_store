<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'identifier';
    public $incrementing = false;
    protected $keyType = 'string';
}
