<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'address', 'mobile'];
    public function orders()
{
    return $this->hasMany( \App\Models\Order::class);
}
}
