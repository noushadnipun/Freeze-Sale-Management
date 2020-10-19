<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $table = 'sales_item';
    protected $fillable = [ 
        'sales_id', 'service_id', 'service_qty'
    ];
}
