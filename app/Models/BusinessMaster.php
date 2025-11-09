<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessMaster extends Model
{
    use HasFactory;

    protected $table = 'business_master';

    protected $fillable = [
        'customer_id',
        'name',
        'phone_no',
        'location',
        'policy_note',
        'business_status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
