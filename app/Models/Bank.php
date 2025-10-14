<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'bank_master';
    protected $fillable = [
        'code',
        'name',
        'description',
        'status'
    ];

    // A bank can have many customer accounts
    public function customerAccounts()
    {
        return $this->hasMany(CustomerBankAccount::class);
    }

}
