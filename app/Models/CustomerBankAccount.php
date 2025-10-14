<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerBankAccount extends Model
{
    protected $table = 'customer_bank_accounts';

    protected $fillable = [
        'customer_id',
        'bank_id',
        'account_number',
        'account_type',
        'ifsc_code',
        'branch_name',
        'account_creation_date',
        'passbook_received',
        'atm_received',
        'is_primary',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    // Many-to-many with schemes (pivot has extra fields)
    public function socialSchemes()
    {

        return $this->belongsToMany(SocialScheme::class, 'customer_bank_social_schemes')
                        ->withPivot(['is_active', 'activation_date', 'deactivation_date'])
                        ->withTimestamps();

    }
}
