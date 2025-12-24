<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAssistance extends Model
{
    use SoftDeletes, HasUuids;

    protected $fillable = [
        'thumbnail',
        'name',
        'category',
        'amount',
        'provider',
        'description',
        'is_available'
    ];

    protected $casts = [
        'is_available' => 'boolean'
    ];

    public function scopeSearch($query, ?string $search)
    {
       return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('provider', 'like', '%' . $search . '%')
                    ->orWhere('amount', 'like', '%' . $search . '%');
    }


    public function SocialAssistanceRecipient()
    {
        return $this->hasMany(SocialAssistanceRecipient::class);
    }

}
