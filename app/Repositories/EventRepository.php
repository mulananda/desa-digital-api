<?php

namespace App\Repositories;

use App\Interfaces\EventRepositoryInterface;
use App\Models\Event;
use Exception;
use Illuminate\Support\Facades\DB;

class EventRepository implements EventRepositoryInterface
{
    public function getAll(?string $search = null, ?int $limit = null, bool $execute = true)
    {
       // Mulai query Eloquent untuk model Event
        $query = Event::query()
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
        $query = Event::where('id', $id);

        return $query->first();
    }

    // insert data
    public function create(
        array $data
    ){
       // beginTransction = ketika data terdapat sebuah kelahan data tdk akan terinput/masuk database
       DB::beginTransaction();

       try{
            $event = new Event;
            $event->thumbnail = $data['thumbnail']->store('assets/events', 'public');
            $event->name = $data['name'];
            $event->description = $data['description'];
            $event->price = $data['price'];
            $event->date = $data['date'];
            $event->time = $data['time'];
            if(isset($data['is_active'])){
                $event->is_active = $data['is_active'];         
            }
            $event->save();

            DB::commit();

            return $event;

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
            $event = Event::find($id);
            if(isset($data['thumbnail'])){
                $event->thumbnail = $data['thumbnail']->store('assets/events', 'public');
            }
            $event->name = $data['name'];
            $event->description = $data['description'];
            $event->price = $data['price'];
            $event->date = $data['date'];
            $event->time = $data['time'];
            if(isset($data['is_active'])){
                $event->is_active = $data['is_active'];         
            }
            $event->save();

            DB::commit();

            return $event;

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
            $event = Event::find($id);

            $event->delete();

            DB::commit();

            return $event;

       } catch(\Exception $e){

            DB::rollBack();
            
            throw new Exception($e->getMessage());
       }
    }

}