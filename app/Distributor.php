<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = "distributors";
    protected $fillable = ['name', 'mobile', 'description'];
}
