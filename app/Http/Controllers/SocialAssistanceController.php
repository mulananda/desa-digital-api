<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\SocialAssistanceStoreRequest;
use App\Http\Requests\SocialAssistanceUpdateRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\SocialAssistanceResource;
use App\Interfaces\SocialAssistanceRepositoryInterface;
use App\Models\SocialAssistance;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class SocialAssistanceController extends Controller implements HasMiddleware
{
    private SocialAssistanceRepositoryInterface $socialAssistanceRepository;

    public function __construct(SocialAssistanceRepositoryInterface $socialAssistanceRepository)
    {
        $this->socialAssistanceRepository = $socialAssistanceRepository;
    }

    public static function middleware()
    {
        return [
            new Middleware(PermissionMiddleware::using(['social-assistance-list|social-assistance-create|social-assistance-edit|social-assistance-delete']), only:['index', 'getAllPaginnated', 'show']),
            new Middleware(PermissionMiddleware::using(['social-assistance-create']), only:['store']),
            new Middleware(PermissionMiddleware::using(['social-assistance-edit']), only:['update']),
            new Middleware(PermissionMiddleware::using(['social-assistance-delete']), only:['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         try{
            $socialAssistance = $this->socialAssistanceRepository->getAll(
                search: $request->search,
                limit: $request->limit,
                with: ['socialAssistanceRecipients'], // Eager load untuk prevent N+1
                execute: true
            );

            return ResponseHelper::jsonResponse(true, 'Data Bantuan Sosial Berhasil Diambil', SocialAssistanceResource::collection($socialAssistance), 200);

        } catch (\Exception $e){
            return ResponseHelper::jsonResponse(false, 'Data Bantuan Sosial Gagal Diambil', null, 500);
        }
    }

     public function getAllPaginated(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'row_per_page' => 'required|integer|min:1|max:100'
        ]);

        try{
            $socialAssistance = $this->socialAssistanceRepository->getAllPaginated(
                search: $validated['search'] ?? null,
                rowPerPage: $validated['row_per_page'],
            );

            return ResponseHelper::jsonResponse(true, 'Data Bantuan Sosial Berhasil Diambil', PaginateResource::make($socialAssistance, socialAssistanceResource::class), 200);

        } catch (\Exception $e){

            return ResponseHelper::jsonResponse(false, 'Data Bantuan Sosial Gagal Diambil', null, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialAssistanceStoreRequest $request)
    {
        $request = $request->validated();

        try{
            $socialAssistance = $this->socialAssistanceRepository->create($request);

            return ResponseHelper::jsonResponse(true, 'Data Bantuan Sosial berhasil ditambahkan', new socialAssistanceResource($socialAssistance), 201);

        } catch(\Exception $e){

            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Display the specified resource.
     * GET /api/head-of-families/{id}
     */
    public function show(string $id)
    {
        try {
            $socialAssistance = $this->socialAssistanceRepository->getById(
                $id, 
                ['socialAssistanceRecipients'] // Eager load relations
            );

            if (!$socialAssistance) {
                return ResponseHelper::jsonResponse(
                    false, 
                    'Data Bantuan Sosial tidak ditemukan', 
                    null, 
                    404
                );
            }

            return ResponseHelper::jsonResponse(
                true, 
                'Detail Bantuan Sosial berhasil diambil', 
                new socialAssistanceResource($socialAssistance), 
                200
            );

        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(
                false, 
                $e->getMessage(), 
                null, 
                500
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialAssistanceUpdateRequest $request, string $id)
    {
        $request = $request->validated();

        try{
            $socialAssistance = $this->socialAssistanceRepository->getById($id);

            if(!$socialAssistance){
                return ResponseHelper::jsonResponse(false, 'Data Bantuan Sosial tidak ditemukan', null, 404);
            }

            $socialAssistance = $this->socialAssistanceRepository->update(
                $id,
                $request
            );
            return ResponseHelper::jsonResponse(true, 'Data Bantuan Sosial berhasil Diupdate', new socialAssistanceResource($socialAssistance), 200);

        } catch (\Exception $e){
             return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try{
            $socialAssistance = $this->socialAssistanceRepository->getById($id);

            if(!$socialAssistance){
                return ResponseHelper::jsonResponse(false, 'Data Bantuan Sosial Tidak Ditemukan', null, 404);
            }

            $socialAssistance = $this->socialAssistanceRepository->delete($id);

            return ResponseHelper::jsonResponse(true, 'Data Bantuan Sosial berhasil Dihapus', null, 200);

        } catch(\Exception $e){

            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
}
