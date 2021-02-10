<?php

namespace App\Shop\Attributes;

use App\Shop\AttributeValues\AttributeValue;
use App\Shop\Products\Product;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(AttributeValue::class)->orderBy('sort_order');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_attribute');
    }
}
