<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    protected $table='customer';
    protected $primaryKey='Id';
    const CREATED_AT='CreatedAt';
    const UPDATED_AT='UpdatedAt';
}