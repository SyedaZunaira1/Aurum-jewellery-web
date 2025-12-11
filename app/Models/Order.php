<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone',
        'total_price',
        'status',
    ];

    // RELATIONSHIP Implementation
    // This order belongs to ONE User.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELATIONSHIP Implementation
    // An Order can have MANY items (products).
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
