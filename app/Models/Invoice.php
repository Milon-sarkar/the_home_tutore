<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        // Add other fields as needed...
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function calculateTotalAmount()
    {
        // Implement your logic to calculate the total amount for this invoice
        // You may want to adjust this based on how you calculate the total amount for an invoice
        return $this->tuition->calculateTotalAmount();
    }
}
