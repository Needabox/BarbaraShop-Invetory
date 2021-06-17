<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_order extends Model
{
    use HasFactory;

    protected $table = 'purchase_order';

    protected $guarded = [];

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'supplier');
    }

    public function lines()
    {
        return $this->hasMany(Purchase_order_line::class, 'purchase_order');
    }

    public function grand_total()
    {
        $po = $this->id;

        $total = Purchase_order_line::where('purchase_order', $po)->sum('grand_total');

        return $total;
    }
}
