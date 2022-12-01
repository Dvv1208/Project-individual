<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Huyen extends Model
{
    protected $table = 'devvn_quanhuyen';
    protected $primaryKey = 'maqh';

    public function tinh()
    {
        return $this->hasMany(Tinh::class, 'matp', 'name');
    }
}
