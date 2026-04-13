<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutModel extends Model
{
    use HasFactory;
    protected $fillable = ['custname','address','mobileno','custemail','pincode','billno','custid','shippingtype','total','orderdate'];
}
