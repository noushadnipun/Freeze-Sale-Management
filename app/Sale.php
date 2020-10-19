<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'outlet_id', 'call_no', 'call_date', 'visi_id' ,'visi_size', 'delivery_date', 'grand_total', 'discount', 'paid_amount'
    ];
}
