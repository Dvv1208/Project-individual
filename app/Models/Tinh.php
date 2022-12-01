<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tinh extends Model
{
    protected $table = 'devvn_tinhthanhpho';
    protected $primaryKey = 'matp';
    public function huyen()
    {
        return $this->hasMany(Huyen::class, 'matp', 'name');
    }
}
