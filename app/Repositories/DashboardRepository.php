<?php

namespace App\Repositories;

use App\Interfaces\DashboardRepositoryInterface;
use App\Models\Development;
use App\Models\Event;
use App\Models\FamilyMember;
use App\Models\HeadOfFamily;
use App\Models\SocialAssistance;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function getDashboardData()
    {
        return [
            'residents' => HeadOfFamily::count() + FamilyMember::count(),
            'head_of_families' => HeadOfFamily::count(),
            'social_assistances' => SocialAssistance::count(),
            'events' => Event::count(),
            'developments' => Development::count(),
        ];
    }

    public function getStatistic(): array
    {
     
        return Cache::remember(
            'population_statistic',
            now()->addMinutes(10),
            fn () => $this->queryStatistic()
        );
    }

    /**
     * Query asli (dipisah agar clean & testable)
     */
    private function queryStatistic(): array
    {
        $headOfFamilies = HeadOfFamily::query()
            ->select(
                'gender',
                DB::raw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) AS age')
            );

        $familyMembers = FamilyMember::query()
            ->select(
                'gender',
                DB::raw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) AS age')
            );

        $people = $headOfFamilies->unionAll($familyMembers);

        $row = DB::query()
            ->fromSub($people, 'people')
            ->selectRaw("
                MIN(CASE WHEN age BETWEEN 0 AND 5 THEN age END) AS balita_min,
                MAX(CASE WHEN age BETWEEN 0 AND 5 THEN age END) AS balita_max,
                COUNT(CASE WHEN age BETWEEN 0 AND 5 THEN 1 END) AS balita_count,

                MIN(CASE WHEN age BETWEEN 6 AND 12 THEN age END) AS anak_min,
                MAX(CASE WHEN age BETWEEN 6 AND 12 THEN age END) AS anak_max,
                COUNT(CASE WHEN age BETWEEN 6 AND 12 THEN 1 END) AS anak_count,

                MIN(CASE WHEN age > 12 AND gender = 'male' THEN age END) AS pria_min,
                MAX(CASE WHEN age > 12 AND gender = 'male' THEN age END) AS pria_max,
                COUNT(CASE WHEN age > 12 AND gender = 'male' THEN 1 END) AS pria_count,

                MIN(CASE WHEN age > 12 AND gender = 'female' THEN age END) AS wanita_min,
                MAX(CASE WHEN age > 12 AND gender = 'female' THEN age END) AS wanita_max,
                COUNT(CASE WHEN age > 12 AND gender = 'female' THEN 1 END) AS wanita_count,

                COUNT(*) AS total
            ")
            ->first();

        return [
            'list' => [
                $this->item('male', 'Pria', $row->pria_min, $row->pria_max, $row->pria_count),
                $this->item('female', 'Wanita', $row->wanita_min, $row->wanita_max, $row->wanita_count),
                $this->item('child', 'Anak-anak', $row->anak_min, $row->anak_max, $row->anak_count),
                $this->item('toddler', 'Balita', $row->balita_min, $row->balita_max, $row->balita_count),
            ],
            'chart' => [
                'labels' => ['Pria', 'Wanita', 'Anak-anak', 'Balita'],
                'datasets' => [
                    [
                        'label' => 'Jumlah Penduduk',
                        'data' => [
                            (int) $row->pria_count,
                            (int) $row->wanita_count,
                            (int) $row->anak_count,
                            (int) $row->balita_count,
                        ],
                    ],
                ],
            ],
            'total_population' => (int) $row->total,
        ];
    }

    private function item(string $key, string $label, $min, $max, $count): array
    {
        return [
            'key' => $key,
            'label' => $label,
            'age_range' => $min !== null ? "{$min}-{$max} tahun" : '-',
            'count' => (int) $count,
        ];
    }
}
