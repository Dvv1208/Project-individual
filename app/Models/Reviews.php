<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'review_id';

    public function ids()
    {
        return $this->hasMany(Product::class, 'Id', 'pro_id');
    }
}
