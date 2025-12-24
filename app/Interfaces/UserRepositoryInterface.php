<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    // parameter yang akan dikirim

    public function getAll(
        ?string $search, 
        ?int $limit,
        bool $execute
    );
    
    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage
    );  

    public function getById(
        string $id
    );
    
    // insert data
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