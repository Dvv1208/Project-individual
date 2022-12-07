<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'Id';
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orderdetail', 'Orderid', 'Productid', 'Code', 'Id')->withPivot(['Quantity', 'Amount', 'Orderid']);
    }
}
