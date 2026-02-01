<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAssistanceRecipient extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $fillable = [
        'social_assistance_id',
        'head_of_family_id',
        'amount',
        'reason',
        'bank',
        'account_number',
        'proof',
        'status'
    ];

   public function scopeSearch($query, ?string $search)
    {
        if (blank($search)) {
            return $query;
        }

        return $query->whereHas('headOfFamily.user', function ($q) use ($search) {
            $q->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        });
    }


    public function socialAssistance()
    {
        return $this->belongsTo(SocialAssistance::class);
    }

     public function headOfFamily()
    {
        return $this->belongsTo(HeadOfFamily::class);
    }
}
