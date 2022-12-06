<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'Id';
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    public function images()
    {
        return $this->hasMany(ProductsImages::class, 'proId', 'Id');
    }
    public $sortable = [
        'id',
        'name',
        'email',
        'created_at',
        'updated_at'
    ];
}
