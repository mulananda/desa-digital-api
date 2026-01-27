<?php

namespace App\Interfaces;

interface SocialAssistanceRepositoryInterface
{
    public function getAll(
        ?string $search = null, 
        ?int $limit = null,
        array $with = [],
        bool $execute = true
    );

    public function getAllPaginated(
        ?string $search = null,
        int $rowPerPage = 15,
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