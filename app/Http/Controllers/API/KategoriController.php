<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriRequest;
use App\Http\Resources\KategoriResource;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nette\Schema\Message;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(10);

        return KategoriResource::collection($kategoris)
        ->response()
        ->setStatusCode(Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriRequest $request)
    {
        $kategori = Kategori::create($request->validated());
        return response()->json([
            'status' => true,
            'message' => 'Kategori created successfully',
            'data' => new KategoriResource($kategori),
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::find($id);

        if(!$kategori){
            return response()->json([
                'succes' => false,
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        return new KategoriResource($kategori);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriRequest $request, Kategori $kategori)
    {
        
        $kategori->update($request->validated());
        return response()->json([
            'status' => true,
            'message' => 'Kategori updated successfully',
            'data' => new KategoriResource($kategori),
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return response()->json([
            'status' => true,
            'message' => 'Kategori deleted successfully',
        ], Response::HTTP_OK);
    }
}
