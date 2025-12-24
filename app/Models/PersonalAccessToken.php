<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasFactory, HasUuids;

     /**
     * Primary key type = string, bukan integer
     */
    protected $keyType = 'string';

    /**
     * Tidak auto increment
     */
    public $incrementing = false;
}
