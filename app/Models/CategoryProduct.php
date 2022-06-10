<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    /*
     * Connect with product
     *
     * @return App/Models/Product
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
