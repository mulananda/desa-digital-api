<?php

namespace App\Repositories;

use App\Interfaces\DevelopmentApplicantRepositoryInterface;
use App\Models\DevelopmentApplicant;
use Exception;
use Illuminate\Support\Facades\DB;

class DevelopmentApplicantRepository implements DevelopmentApplicantRepositoryInterface
{
    public function getAll(?string $search = null, ?int $limit = null, bool $execute = true)
    {
       
        $query = DevelopmentApplicant::query()
            ->when($search, fn($q) => $q->search($search))
            ->latest();

        if (!is_null($limit) && $limit > 0) {
            $query->limit($limit);
        }

        return $execute ? $query->get() : $query;
    }

    public function getAllPaginated(?string $search, ?int $rowPerPage)
    {
        $query = $this->getAll(
            $search,
            $rowPerPage,
            false
        );  
        return $query->paginate($rowPerPage);
    }

    public function getById(string $id)
    {
        $query = DevelopmentApplicant::where('id', $id);

        return $query->first();
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try{
            $developmentApplicant = new DevelopmentApplicant;
            $developmentApplicant->development_id = $data['development_id'];
            $developmentApplicant->user_id = $data['user_id'];
            // di model status defaultnya = pending
            if(isset($data['status'])){
                $developmentApplicant->status = $data['status'];
            }

            $developmentApplicant->save();

            DB::commit();

            return $developmentApplicant;

        } catch(\Exception $e){
            DB::rollBack();

            throw new Exception($e->getMessage());
        }

    }


    public function update(string $id, array $data)
    {
        DB::beginTransaction();

        try{
            $developmentApplicant = DevelopmentApplicant::find($id);
            $developmentApplicant->development_id = $data['development_id'];
            $developmentApplicant->user_id = $data['user_id'];
            // di model status defaultnya = pending
            if(isset($data['status'])){
                $developmentApplicant->status = $data['status'];
            }

            $developmentApplicant->save();

            DB::commit();

            return $developmentApplicant;

        } catch(\Exception $e){
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function delete(
        string $id
    ){
        // beginTransction = ketika data terdapat sebuah kelahan data tdk akan terinput/masuk database
       DB::beginTransaction();

        try{
            $development = DevelopmentApplicant::find($id);

            $development->delete();

            DB::commit();

            return $development;

       } catch(\Exception $e){

            DB::rollBack();
            
            throw new Exception($e->getMessage());
       }
    }
}