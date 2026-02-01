<?php 

namespace App\Repositories;

use App\Interfaces\SocialAssistanceRecipientRepositoryInterface;
use App\Models\SocialAssistanceRecipient;
use Exception;
use Illuminate\Support\Facades\DB;

class SocialAssistanceRecipientRepository implements SocialAssistanceRecipientRepositoryInterface
{
    
    public function getAll(?string $search = null, ?int $limit = null, bool $execute = true)
    {
       // Mulai query Eloquent untuk model SocialAssistance
        $query = SocialAssistanceRecipient::query()
            // Tambahkan kondisi search hanya jika parameter $search tidak null
            // Fitur 'search()' biasanya berasal dari local scope: scopeSearch() di model
            ->when($search, fn($q) => $q->search($search))

            // Urutkan data berdasarkan created_at (desc)
            // Sama dengan orderBy('created_at', 'desc')
            ->latest();

        // Jika limit diberikan dan nilainya lebih dari 0, batasi jumlah data
        if (!is_null($limit) && $limit > 0) {
            $query->limit($limit);
        }

        // Jika execute = true, langsung eksekusi query dan ambil hasilnya
        // Jika false, kembalikan objek Query Builder untuk fleksibilitas chaining
        return $execute ? $query->get() : $query;
    }
    
    public function getAllPaginated(?string $search, ?int $PerPage)
    {
        $query = $this->getAll(
            $search,
            $PerPage,
            false
        );  
        return $query->paginate($PerPage);
    }

    public function getById(string $id)
    {
        $query = SocialAssistanceRecipient::where('id', $id);

        return $query->first();
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
            $socialAssistanceRecipient = SocialAssistanceRecipient::find($id);
            $socialAssistanceRecipient->delete();

            DB::commit();

            return $socialAssistanceRecipient;
        } catch (\Exception $e){
             DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }
}