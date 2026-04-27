<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductType extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'status'];

    /**
     * A Product Type has many Categories.
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
