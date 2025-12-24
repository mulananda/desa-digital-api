<?php 

namespace App\Repositories;

use App\Interfaces\DevelopmentRepositoryInterface;
use App\Models\Development;
use Exception;
use Illuminate\Support\Facades\DB;

class DevelopmentRepository implements DevelopmentRepositoryInterface
{
    public function getAll(?string $search = null, ?int $limit = null, bool $execute = true)
    {
       
        $query = Development::query()
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
        $query = Development::where('id', $id);

        return $query->first();
    }

    public function create(
        array $data
    ){
       // beginTransction = ketika data terdapat sebuah kelahan data tdk akan terinput/masuk database
       DB::beginTransaction();

       try{
            $development = new Development();
            $development->thumbnail = $data['thumbnail']->store('assets/developments', 'public');
            $development->name = $data['name'];
            $development->description = $data['description'];
            $development->person_in_charge = $data['person_in_charge'];
            $development->start_date = $data['start_date'];
            $development->end_date = $data['end_date'];
            $development->amount = $data['amount'];
            $development->status = $data['status'];

            $development->save();

            DB::commit();

            return $development;

       } catch(\Exception $e){

            DB::rollBack();
            
            throw new Exception($e->getMessage());
       }

    }


    public function update(string $id, array $data)
    {
        // beginTransction = ketika data terdapat sebuah kelahan data tdk akan terinput/masuk database
       DB::beginTransaction();

       try{
            $development = Development::find($id);
            if(isset($data['thumbnail'])){
                $development->thumbnail = $data['thumbnail']->store('assets/developments', 'public');
            }
            $development->name = $data['name'];
            $development->description = $data['description'];
            $development->person_in_charge = $data['person_in_charge'];
            $development->start_date = $data['start_date'];
            $development->end_date = $data['end_date'];
            $development->amount = $data['amount'];
            $development->status = $data['status'];
            
            $development->save();

            DB::commit();

            return $development;

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
            $development = Development::find($id);

            $development->delete();

            DB::commit();

            return $development;

       } catch(\Exception $e){

            DB::rollBack();
            
            throw new Exception($e->getMessage());
       }
    }

}