<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'supplier_id', 'stock_quantity', 'description', 'image', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockItems()
    {
        return $this->hasMany(StockInItem::class);
    }
    public function stockInItems()
    {
        return $this->hasMany(\App\Models\StockInItem::class);
    }
    public function getActualStockAttribute()
    {
        return $this->stockItems()->sum('quantity');
    }

    public function getStockQuantityAttribute()
    {
        return $this->stockItems()->sum('quantity');
    }

    public function supplier(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function requisitionItems()
    {
        // A product can be linked to many requisition items
        return $this->hasMany(RequisitionItem::class);
    }

    public function stockIns()
    {
        // Now that product_id is in stock_ins, we use a simple hasMany
        return $this->hasMany(StockIn::class);
    }

    public function stockHistory() // Renaming it to avoid confusion
    {
        // Point to the table that ACTUALLY has the product_id
        return $this->hasMany(StockInItem::class, 'product_id');
    }

    public function requisitionHistory() // Renaming it to avoid confusion
    {
        // Point to the table that ACTUALLY has the product_id
        return $this->hasMany(RequisitionItem::class, 'product_id');
    }

    public function isItProduct(): bool
    {
        return $this->category->name === 'IT Products';
    }

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
}
