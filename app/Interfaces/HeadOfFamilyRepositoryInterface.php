<?php

namespace App\Interfaces;

use App\Models\HeadOfFamily;
use Illuminate\Pagination\LengthAwarePaginator;

interface HeadOfFamilyRepositoryInterface
{
    // parameter yang akan dikirim

    // public function getAll(
    //     ?string $search, 
    //     ?int $limit,
    //     bool $execute
    // );
    
    // public function getAllPaginated(
    //     ?string $search,
    //     ?int $rowPerPage
    // );  
    

    // public function getById(
    //     string $id
    // );

    public function getAll(
        ?string $search = null, 
        ?int $limit = null,
        array $with = [],
        bool $execute = true
    );

    public function getAllPaginated(
        ?string $search = null,
        int $rowPerPage = 15,
        array $with = []
    ); 
    
    public function getById(
        string $id,
        array $with = []
    );

    public function create(
        array $data
    );

    public function update(
        string $id,
        array $data
    );

    public function delete(
        string $id
    );
}