<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UUID
{
 // ✅ PERBAIKAN: Pakai bootUuid() bukan boot()
    protected static function bootUuid()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    // Set autoincrement jadi false
    public function getIncrementing()
    {
        return false;
    }

    // Set key type jadi string
    public function getKeyType()
    {
        return 'string';
    }
}