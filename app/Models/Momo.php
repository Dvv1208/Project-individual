<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Momo extends Model
{
    protected $table = 'ttmomo';
    protected $primaryKey = 'Id';
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';
}
