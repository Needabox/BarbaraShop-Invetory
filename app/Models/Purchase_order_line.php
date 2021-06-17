<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_order_line extends Model
{
    use HasFactory;

    protected $table = 'purchase_order_line';

    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product');
    }

    public function sum_buy()
    {
        return $this->where('purchase_order', $this->purchase_order)->sum('buy');
    }

    public function sum_grand_total()
    {
        return $this->where('purchase_order', $this->purchase_order)->sum('grand_total');
    }
}
