<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'outlet_id', 'call_no', 'call_date', 'pull_date',  'delivery_date', 'grand_total'
    ];


    public function saleItems()
    {
        return $this->hasMany('App\SaleItem', 'sales_id', 'id');
    }
}
