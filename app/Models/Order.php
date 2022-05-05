<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'description',
        'total_price',
        'customer_id',
    ];
    public function customer(){        
        return $this->belongsTo(\App\Models\Customer::class);   
}
}
