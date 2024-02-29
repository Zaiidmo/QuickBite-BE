<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function meals() {
        return $this->belongsToMany(Meals::class);
    }
}
