<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_line extends Model
{
    use HasFactory;

    protected $table = 'sales_line';

    public function products()
    {
        return $this->belongsTo(product::class, 'product');
    }
}
