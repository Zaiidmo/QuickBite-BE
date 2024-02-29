<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_number',
        'total_price',
        'status',
        'payment_date',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function meals()
    {
        return $this->belongsToMany(Meals::class);
    }
    
}
