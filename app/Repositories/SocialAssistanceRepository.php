<?php 

namespace App\Repositories;

use App\Interfaces\SocialAssistanceRepositoryInterface;
use App\Models\SocialAssistance;
use Exception;
use Illuminate\Support\Facades\DB;

class SocialAssistanceRepository implements SocialAssistanceRepositoryInterface
{
     public function getAll(
        ?string $search = null, 
        ?int $limit = null,
        array $with = [],
        bool $execute = true
    ) {
        $query = SocialAssistance::query();

        // Eager load relations to prevent N+1
        if (!empty($with)) {
            $query->with($with);
        }

        // TAMBAHAN: Load counts untuk mendapatkan total
        $query->withCount([
            'socialAssistanceRecipients'
        ]);
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
        int $rowPerPage = 15,
        array $with = []
    ) {
        
        $query = $this->getAll($search, null, $with, false);
        
        return $query->paginate($rowPerPage);
    }

    public function getById(string $id, array $with = [])
    {
        $query = SocialAssistance::query();

        // Eager load relations if specified
        if (!empty($with)) {
            $query->with($with);
        }

        // TAMBAHAN: Load counts untuk mendapatkan total
        $query->withCount([
            'socialAssistanceRecipients'
        ]);

        return $query->find($id);
    }

    public function create(array $data)
    {
         DB::beginTransaction();

        try{

            $socialAssistance = new SocialAssistance;
            $socialAssistance->thumbnail = $data['thumbnail']->store('assets/social-assistance', 'public');
            $socialAssistance->name = $data['name'];
            $socialAssistance->category = $data['category'];
            $socialAssistance->amount = $data['amount'];
            $socialAssistance->provider = $data['provider'];
            $socialAssistance->description = $data['description'];
            $socialAssistance->is_available = $data['is_available'];
            $socialAssistance->save();

            DB::commit();

            return $socialAssistance;

        } catch (\Exception $e){
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();

        try{

            $socialAssistance = SocialAssistance::find($id);

            if(isset($data['thumbnail'])){
                $socialAssistance->thumbnail = $data['thumbnail']->store('assets/social-assistance', 'public');
            }
            $socialAssistance->name = $data['name'];
            $socialAssistance->category = $data['category'];
            $socialAssistance->amount = $data['amount'];
            $socialAssistance->provider = $data['provider'];
            $socialAssistance->description = $data['description'];
            $socialAssistance->is_available = $data['is_available'];
            $socialAssistance->save();

            DB::commit();

            return $socialAssistance;

        } catch (\Exception $e){
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try{
            $socialAssistance = SocialAssistance::find($id);
            $socialAssistance->delete();

            DB::commit();

            return $socialAssistance;
        } catch (\Exception $e){
             DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }
}