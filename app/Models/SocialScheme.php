<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialScheme extends Model
{
    protected $table = 'social_scheme_master';
    protected $fillable = [
        'code',
        'name',
        'description',
        'status'
    ];


    public function bankAccounts()
    {

        return $this->belongsToMany(CustomerBankAccount::class, 'customer_bank_social_schemes')
                        ->withPivot(['is_active', 'activation_date', 'deactivation_date'])
                        ->withTimestamps();

    }

}
