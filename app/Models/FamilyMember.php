<?php

namespace App\Models;

// use App\Traits\UUID;
use App\Traits\HasUlidUnique;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyMember extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

     protected $fillable = [
        'head_of_family_id',
        'user_id',
        'profile_picture',
        'identity_number',
        'gender',
        'date_of_birth',
        'phone_number',
        'occupation',
        'marital_status',
        'relation'
    ];

    public function headOfFamily()
    {
        return $this->belongsTo(HeadOfFamily::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%'. $search. '%')
        ->orWhere('email', 'like', '%'. $search. '%');
        // return $query->where(function ($q) use ($search) {
        // $q->where('name', 'like', "%{$search}%")   // Cari di kolom 'name'
        //   ->orWhere('email', 'like', "%{$search}%"); // Atau cari di kolom 'email'
        // });
    }
}
