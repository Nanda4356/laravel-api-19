<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['name'];

    public function product()
    {
        return $this->hasMany(Product::class, 'kategori_id');
    }
}
