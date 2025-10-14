<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile_no',
        'alternate_no',
        'addr_details',
        'location',
        'aadhaar_no',
        'user_identification_mark',
        'bank_id',
        'supporting_doc',
        'status',
        'pan_no',
        'gender',
        'age_classification',
    ];

    // A customer can have many documents
    public function documents()
    {
        return $this->hasMany(CustomerDocument::class);
    }

    // A customer can have many bank accounts
    public function bankAccounts()
    {
        return $this->hasMany(CustomerBankAccount::class);
    }

}
