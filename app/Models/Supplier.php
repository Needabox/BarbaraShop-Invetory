<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchaseorder()
    {
        return $this->belongsTo(Purchase_order::class);
    }
}
