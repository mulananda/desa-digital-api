<?php 

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(
        ?string $search, 
        ?int $limit, 
        bool $execute
    ){
        $query = User::where (function ($query) use ($search){
            // jika di parameternya ada keyword search maka akan melakukan query serch
            if($search){
                $query->search($search);
            }
        });
            // mengambil data berdasarkan limit utk pagination 
            if($limit){
                $query->take($limit);
            }

            if($execute){
                return $query->get();
            }

            // jika tidak tampilkan data dari query
            return $query;
    }

    public function getAllPaginated(
        ?string $search, 
        ?int $rowPerPage
    ){
        $query = $this->getAll(
            $search,
            $rowPerPage,
            // false $execute agar tidak tampil semua datannya
            false
        );  
        return $query->paginate($rowPerPage);
    }

    public function getById(string $id)
    {
        $query = User::where('id', $id);

        return $query->first();
    }

    // insert data
    public function create(
        array $data
    ){
       // beginTransction = ketika data terdapat sebuah kelahan data tdk akan terinput/masuk database
       DB::beginTransaction();

       try{
            $user = new User;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            DB::commit();

            return $user;

       } catch(\Exception $e){

            DB::rollBack();
            
            throw new Exception($e->getMessage());
       }

    }


    public function update(
        string $id, 
        array $data    
    ){
       // beginTransction = ketika data terdapat sebuah kelahan data tdk akan terinput/masuk database
       DB::beginTransaction();

        try{
            $user = User::find($id);
            $user->name = $data['name'];  
            if(isset($data['password'])){
                $user->password = bcrypt($data['password']);
            }

            $user->save();

            DB::commit();

            return $user;

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
            $user = User::find($id);

            $user->delete();

            DB::commit();

            return $user;

       } catch(\Exception $e){

            DB::rollBack();
            
            throw new Exception($e->getMessage());
       }
    }

}