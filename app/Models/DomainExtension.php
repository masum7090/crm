<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomainExtension extends Model
{
        protected $fillable = [
        'extension',
        'register_price',
        'renewal_price',
        'transfer_price',
        'provider',
        'status',
    ];

}
