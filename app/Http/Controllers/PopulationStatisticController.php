<?php

namespace App\Http\Controllers;

use App\Interfaces\PopulationStatisticRepositoryInterface;

class PopulationStatisticController extends Controller
{
    public function __construct(
        private PopulationStatisticRepositoryInterface $repository
    ) {}

    public function __invoke()
    {
        return response()->json(
            $this->repository->getStatistic()
        );
    }
}
