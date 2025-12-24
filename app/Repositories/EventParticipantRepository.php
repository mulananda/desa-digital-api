<?php
namespace App\Repositories;

use App\Interfaces\EventParticipantRepositoryInterface;
use App\Models\Event;
use App\Models\EventParticipant;
use Exception;
use Illuminate\Support\Facades\DB;

class EventParticipantRepository implements EventParticipantRepositoryInterface
{
     public function getAll(?string $search = null, ?int $limit = null, bool $execute = true)
    {
        $query = EventParticipant::query()
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
        $query = EventParticipant::where('id', $id);

        return $query->first();
    }


    public function create(
        array $data
    ){
       // beginTransction = ketika data terdapat sebuah kelahan data tdk akan terinput/masuk database
       DB::beginTransaction();

       try{

            $event = Event::where('id', $data['event_id'])->first();

            $eventParticipant = new EventParticipant();
            $eventParticipant->event_id = $data['event_id'];
            $eventParticipant->head_of_family_id = $data['head_of_family_id'];
            $eventParticipant->quantity = $data['quantity'];
            $eventParticipant->total_price = $event->price * $data['quantity'];
            $eventParticipant->payment_status = 'pending';
            $eventParticipant->save();

            DB::commit();

            return $eventParticipant;

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

            $event = Event::where('id', $data['event_id'])->first();

            $eventParticipant = EventParticipant::find($id);
            $eventParticipant->event_id = $data['event_id'];
            $eventParticipant->head_of_family_id = $data['head_of_family_id'];

            if(isset($data['quantity'])){
                $eventParticipant->quantity = $data['quantity'];
            }else{
                $data['quantity'] = $eventParticipant->quantity;
            }
            $eventParticipant->total_price = $event->price * $data['quantity'];
            $eventParticipant->payment_status = $data['payment_status'];
            $eventParticipant->save();

            DB::commit();

            return $eventParticipant;

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
            $eventParticipant = EventParticipant::find($id);

            $eventParticipant->delete();

            DB::commit();

            return $eventParticipant;

       } catch(\Exception $e){

            DB::rollBack();
            
            throw new Exception($e->getMessage());
       }
    }
}