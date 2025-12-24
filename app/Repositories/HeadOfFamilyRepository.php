<?php 

namespace App\Repositories;

use App\Interfaces\HeadOfFamilyRepositoryInterface;
use App\Models\HeadOfFamily;
use Exception;
use Illuminate\Support\Facades\DB;

class HeadOfFamilyRepository implements HeadOfFamilyRepositoryInterface
{
    public function getAll(
        ?string $search, 
        ?int $limit, 
        bool $execute
    ){
        $query = HeadOfFamily::where (function ($query) use ($search){
            // jika di parameternya ada keyword search maka akan melakukan query serch
            if($search){
                $query->search($search);
            }
        });

        $query->orderBy('created_at', 'desc');
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
        $query = HeadOfFamily::where('id', $id);

        return $query->first();
    }

    public function create(
        array $data
    ){
        DB::beginTransaction();

        try{
            $userRepository = new UserRepository;

            $user = $userRepository->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ])->assignRole('head-of-family');

            $headOfFamily = new HeadOfFamily;
            $headOfFamily->user_id = $user->id;
            $headOfFamily->profile_picture = $data['profile_picture']->store('assets/head-of-families', 'public');
            $headOfFamily->identity_number = $data['identity_number'];
            $headOfFamily->gender = $data['gender'];
            $headOfFamily->date_of_birth = $data['date_of_birth'];
            $headOfFamily->phone_number = $data['phone_number'];
            $headOfFamily->occupation = $data['occupation'];
            $headOfFamily->marital_status = $data['marital_status'];
            $headOfFamily->save();

            DB::commit();

            return $headOfFamily;

        } catch (\Exception $e){
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

     public function update(
        string $id, 
        array $data    
    ){
       // beginTransction = ketika data terdapat sebuah kesalahan data tdk akan terinput/masuk database
       DB::beginTransaction();

        try{
            $headOfFamily = HeadOfFamily::find($id);
            if(isset($data['profile_picture'])){
                $headOfFamily->profile_picture = $data['profile_picture']->store('assets/head-of-families', 'public');
            }
            $headOfFamily->identity_number = $data['identity_number'];
            $headOfFamily->gender = $data['gender'];
            $headOfFamily->date_of_birth = $data['date_of_birth'];
            $headOfFamily->phone_number = $data['phone_number'];
            $headOfFamily->occupation = $data['occupation'];
            $headOfFamily->marital_status = $data['marital_status'];
            $headOfFamily->save();

            $userRepository = new UserRepository;
            $userRepository->update($headOfFamily->user_id, [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => isset($data['password']) ? bcrypt($data['password']) : $headOfFamily->user->password
            ]);

            DB::commit();

            return $headOfFamily;

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
            $headOfFamily = HeadOfFamily::find($id);

            $headOfFamily->delete();

            DB::commit();

            return $headOfFamily;

       } catch(\Exception $e){

            DB::rollBack();
            
            throw new Exception($e->getMessage());
       }
    }

}