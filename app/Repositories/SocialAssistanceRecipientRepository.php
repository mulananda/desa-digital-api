<?php 

namespace App\Repositories;

use App\Interfaces\SocialAssistanceRecipientRepositoryInterface;
use App\Models\SocialAssistanceRecipient;
use Exception;
use Illuminate\Support\Facades\DB;

class SocialAssistanceRecipientRepository implements SocialAssistanceRecipientRepositoryInterface
{
    
    public function getAll(
        ?string $search = null, 
        ?int $limit = null,
        array $with = [],
        bool $execute = true)
    {
       // Mulai query Eloquent untuk model SocialAssistance
        $query = SocialAssistanceRecipient::query();
        
        // Eager load relations to prevent N+1
        if (!empty($with)) {
            $query->with($with);
        }

        // Apply search filter
        if ($search) {
            $query->search($search);
        }

        // Order by latest
        $query->orderBy('created_at', 'desc');

        if (!is_null($limit)) {
            $query->limit($limit);
        }


        return $execute ? $query->get() : $query;
    }
    
    public function getAllPaginated(
        ?string $search = null,
        int $perPage = 10,
        array $with = []
    ) {
        
        $query = $this->getAll($search, null, $with, false);

         // Eager load relations to prevent N+1
        if (!empty($with)) {
            $query->with($with);
        }
        
        return $query->paginate($perPage);
    }

    public function getById(string $id, array $with = [], array $withCount = [])
    {
        $query = SocialAssistanceRecipient::query();

         // Eager load relations if specified
        if (!empty($with)) {
            $query->with($with);
        }

        // count dengan nested relasi
        foreach ($withCount as $relation => $countRelation) {
            $query->with([
                $relation => fn ($q) => $q->withCount($countRelation)
            ]);
        }
        

        return $query->find($id);
    }

    public function create(array $data)
    {
         DB::beginTransaction();

        try{

            $socialAssistanceRecipient = new SocialAssistanceRecipient;
            $socialAssistanceRecipient->social_assistance_id = $data['social_assistance_id'];
            $socialAssistanceRecipient->head_of_family_id = $data['head_of_family_id'];
            $socialAssistanceRecipient->amount = $data['amount'];
            $socialAssistanceRecipient->reason = $data['reason'];
            $socialAssistanceRecipient->account_number = $data['account_number'];

            if(isset($data['proof'])){
                $socialAssistanceRecipient->proof = $data['proof'];
            }
            if(isset($data['status'])){
                $socialAssistanceRecipient->status = $data['status'];
            }
           
            $socialAssistanceRecipient->save();

            DB::commit();

            return $socialAssistanceRecipient;

        } catch (\Exception $e){
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();

        try{

            $socialAssistanceRecipient =  SocialAssistanceRecipient::find($id);
            $socialAssistanceRecipient->social_assistance_id = $data['social_assistance_id'];
            $socialAssistanceRecipient->head_of_family_id = $data['head_of_family_id'];
            $socialAssistanceRecipient->amount = $data['amount'];
            $socialAssistanceRecipient->reason = $data['reason'];
            $socialAssistanceRecipient->account_number = $data['account_number'];

            if(isset($data['proof'])){
                $socialAssistanceRecipient->proof = $data['proof'];
            }
            if(isset($data['status'])){
                $socialAssistanceRecipient->status = $data['status'];
            }
           
            $socialAssistanceRecipient->save();

            DB::commit();

            return $socialAssistanceRecipient;

        } catch (\Exception $e){
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try{
            $socialAssistanceRecipient = SocialAssistanceRecipient::findOrFail($id);
            $socialAssistanceRecipient->delete();

            DB::commit();

            return $socialAssistanceRecipient;
        } catch (\Exception $e){
             DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }
}