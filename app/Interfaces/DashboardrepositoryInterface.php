<?php

namespace App\Interfaces;

interface DashboardRepositoryInterface
{
    public function getDashboardData();

    public function getStatistic(): array;
}