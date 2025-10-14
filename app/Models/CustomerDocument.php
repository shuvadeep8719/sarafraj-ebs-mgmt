<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'doc_type',
        'file_path',
        'file_type',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
