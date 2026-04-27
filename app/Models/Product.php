<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'image', 'stock_quantity', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockItems()
    {
        return $this->hasMany(StockInItem::class);
    }

    public function getActualStockAttribute()
    {
        return $this->stockItems()->sum('quantity');
    }
}
