<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\SocialAssistanceRecipientStoreRequest;
use App\Http\Requests\SocialAssistanceRecipientUpdateRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\SocialAssistanceRecipientResource;
use App\Interfaces\SocialAssistanceRecipientRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class SocialAssistanceRecipientController extends Controller implements HasMiddleware
{
    private SocialAssistanceRecipientRepositoryInterface $socialAssistanceRecipientRepository;

    public function __construct(SocialAssistanceRecipientRepositoryInterface $socialAssistanceRecipientRepository)
    {
        $this->socialAssistanceRecipientRepository = $socialAssistanceRecipientRepository;
    }

    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using(['social-assistance-recipient-list|social-assistance-recipient-create|social-assistance-recipient-edit|social-assistance-recipient-delete']), only:['index', 'getAllPaginnated', 'show']),
            new Middleware(PermissionMiddleware::using(['social-assistance-recipient-create']), only:['store']),
            new Middleware(PermissionMiddleware::using(['social-assistance-recipient-edit']), only:['update']),
            new Middleware(PermissionMiddleware::using(['social-assistance-recipient-delete']), only:['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $socialAssistanceRecipients = $this->socialAssistanceRecipientRepository->getAll(
                search: $request->search,
                limit: $request->limit,
                with: ['socialAssistance', 'headOfFamily'], // Eager load untuk prevent N+1
                execute: true
            );

            return ResponseHelper::jsonResponse(true, 'Data Penerima Bantuan Sosial Berhasil Diambil', SocialAssistanceRecipientResource::collection($socialAssistanceRecipients), 200);

        } catch (Exception $e){

            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

     public function getAllPaginated(Request $request)
    {
         $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'per_page' => 'required|integer|min:1|max:100'
        ]);

        try{
            $socialAssistanceRecipients = $this->socialAssistanceRecipientRepository->getAllPaginated(
                search: $validated['search'] ?? null,
                perPage: $validated['per_page'],
                with: ['socialAssistance', 'headOfFamily.user'],
            );

            return ResponseHelper::jsonResponse(true, 'Data Penerima Bantuan Sosial Berhasil Diambil', PaginateResource::make($socialAssistanceRecipients, SocialAssistanceRecipientResource::class), 200);

        } catch (\Exception $e){

            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialAssistanceRecipientStoreRequest $request)
    {
        $request = $request->validated();

        try{
            $socialAssistanceRecipient = $this->socialAssistanceRecipientRepository->create($request);

            return ResponseHelper::jsonResponse(true, 'Data Penerima Bantuan Sosial berhasil Dibuat', new SocialAssistanceRecipientResource($socialAssistanceRecipient), 201);

        } catch(\Exception $e){

            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $socialAssistanceRecipient = 
            $this->socialAssistanceRecipientRepository->getById(
                 $id,
                with: ['socialAssistance','headOfFamily.user'],
                // count dengan nested relation whenCounted di resource
                withCount: [
                    'headOfFamily' => 'familyMembers', 'socialAssistance' => 'socialAssistanceRecipients'
                ]
            );

            if(!$socialAssistanceRecipient){
                return ResponseHelper::jsonResponse(false, 'Data Penerima Bantuan Sosial tidak ditemukan', null, 404);
            }

             return ResponseHelper::jsonResponse(true, 'Data Penerima Bantuan Sosial berhasil Ditemukan', new SocialAssistanceRecipientResource($socialAssistanceRecipient), 200);
        } catch (\Exception $e){

            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialAssistanceRecipientUpdateRequest $request, string $id)
    {
        $request = $request->validated();

        try{
            $socialAssistanceRecipient = $this->socialAssistanceRecipientRepository->getById($id);

            if(!$socialAssistanceRecipient){
                return ResponseHelper::jsonResponse(false, 'Data Penerima Bantuan Sosial tidak ditemukan', null, 404);
            }

            $socialAssistanceRecipient = $this->socialAssistanceRecipientRepository->update($id, $request);

            return ResponseHelper::jsonResponse(true, 'Data Penerima Bantuan Sosial berhasil Diupdate', new SocialAssistanceRecipientResource($socialAssistanceRecipient), 200);

        } catch(\Exception $e){

            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $socialAssistanceRecipient = $this->socialAssistanceRecipientRepository->getById($id);

            if(!$socialAssistanceRecipient){
                return ResponseHelper::jsonResponse(false, 'Data Penerima Bantuan Sosial Tidak Ditemukan', null, 404);
            }

            $socialAssistanceRecipient = $this->socialAssistanceRecipientRepository->delete($id);

            return ResponseHelper::jsonResponse(true, 'Data Penerima Bantuan Sosial berhasil Dihapus', null, 200);

        } catch(\Exception $e){

            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
}
