<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VnPay extends Model
{
    protected $table = 'ttvnpay';
    protected $primaryKey = 'Id';
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';
}
