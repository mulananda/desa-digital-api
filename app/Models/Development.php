<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Development extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $fillable = [
        'thumbnail',
        'name',
        'description',
        'person_in_charge',
        'start_date',
        'end_date',
        'amount',
        'status'
    ];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    public function scopeSearch($query, $search)
    {
       return $query->where('name', 'like', '%' . $search . '%');
    }

    public function DevelopmentApplicant()
    {
        return $this->hasMany(DevelopmentApplicant::class);
    }
    
}
