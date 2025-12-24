<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

trait HasUlidUnique
{
    /**
     * Boot trait ini dan pasang event saat model dibuat.
     * Event creating dijalankan otomatis sebelum model disimpan ke database.
     */
    public static function bootHasUlidUnique(): void
    {
        static::creating(function (Model $model) {
            $key = $model->getKeyName(); // Ambil nama primary key model (biasanya 'id')

            // Jika primary key kosong, generate ULID unik
            if (empty($model->{$key})) {
                $model->{$key} = static::generateUniqueUlid($model, $key);
            }

            // Set type primary key menjadi string dan non-incrementing
            $model->initializeHasUlidUnique();
        });
    }

    /**
     * Inisialisasi atribut model untuk ULID.
     * Mengatur primary key menjadi string dan tidak auto-increment.
     */
    public function initializeHasUlidUnique(): void
    {
        $this->keyType = 'string';      // Tipe primary key menjadi string
        $this->incrementing = false;    // Primary key tidak auto-increment
    }

    /**
     * Generate ULID unik untuk model tertentu.
     *
     * @param Model  $model     Instance model yang akan diberi ULID
     * @param string $keyName   Nama primary key (biasanya 'id')
     * @param int    $maxAttempts Jumlah maksimal percobaan generate ULID
     *
     * @return string ULID unik
     * @throws RuntimeException Jika terjadi collision ULID lebih dari maxAttempts
     */
    public static function generateUniqueUlid(Model $model, string $keyName, int $maxAttempts = 5): string
    {
        // Loop hingga maxAttempts untuk menghindari collision ULID
        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            $ulid = (string) Str::ulid(); // Generate ULID baru

            // Cek apakah ULID sudah ada di database
            if (!$model->newModelQuery()->where($keyName, $ulid)->exists()) {
                return $ulid; // Jika belum ada, kembalikan ULID
            }
        }

        // Jika sampai maxAttempts masih collision, lempar exception
        throw new RuntimeException("ULID collision detected after {$maxAttempts} attempts.");
    }
}
