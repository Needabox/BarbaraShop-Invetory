<?php

namespace App\Models;

use App\Models\Purchase_order_line;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goods_receipt extends Model
{
    use HasFactory;

    protected $table = 'goods_receipt';

    protected $guarded = [];

    public function purchase_orders()
    {
        return $this->belongsTo(Purchase_order::class, 'purchase_order');
    }

    public function total_item()
    {
        $id_po = $this->purchase_order;
        $total = Purchase_order_line::where('purchase_order', $id_po)->count();
        return $total;
    }
}
