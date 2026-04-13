<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductModel;

class ProductEntryModel extends Model
{
    use HasFactory;
    protected $fillable = ['pnameid', 'size','image', 'image1', 'image2', 'image3', 'image4','price'];

public function product_entry()
{
    return $this->belongsTo(ProductModel::class,'pnameid','id');
}

}


