<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::orderBy('nama','asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $data
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataProduk = new Product;

        $rules = [
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Data gagal ditambahkan',
                'data' => $validator->errors()
            ], 400);
        }


        $dataProduk->nama = $request->nama;
        $dataProduk->deskripsi = $request->deskripsi;
        $dataProduk->harga = $request->harga;
        $dataProduk->stok = $request->stok;
        $dataProduk->save();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
        ], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::find($id);
        if($data){
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditemukan',
                'data' => $data
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataProduk = Product::find($id);
        if(empty($dataProduk)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $rules = [
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Data gagal di update',
                'data' => $validator->errors()
            ], 400);
        }


        $dataProduk->nama = $request->nama;
        $dataProduk->deskripsi = $request->deskripsi;
        $dataProduk->harga = $request->harga;
        $dataProduk->stok = $request->stok;
        $dataProduk->save();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diupdate',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataProduk = Product::find($id);
        if(empty($dataProduk)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $post = $dataProduk->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Delete Data Berhasil',
        ],200);
    }
}
