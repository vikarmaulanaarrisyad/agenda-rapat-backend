<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function data()
    {
        $query = Kategori::all();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return '
                <button class="btn text-md text-primary" onclick="editForm(`' . route('kategori.show', $query->id) . '`, `' . $query->nama . '`)"> <i class="fas fa-edit"></i> </button>
                <button class="btn btn-md text-danger" onclick="deleteData(`' . route('kategori.destroy', $query->id) . '`, `' . $query->nama . '`)"> <i class="fas fa-trash"></i> </button>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules  = [
            'nama' => 'required|unique:kategoris',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->first(),
                'message' => 'Maaf inputan yang anda masukan salah, silahkan periksa kembali dan coba lagi',
            ], 422);
        }

        $data = [
            'nama' => $request->nama,
        ];

        Kategori::create($data);

        return response()->json(['message' => 'Kategori berhasil ditambahkan', 'data' => $data], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        return response()->json(['data' => $kategori]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $rules  = [
            'nama' => 'required|unique:kategoris,nama,' . $kategori->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->first(),
                'message' => 'Maaf inputan yang anda masukan salah, silahkan periksa kembali dan coba lagi',
            ], 422);
        }

        $data = [
            'nama' => $request->nama,
        ];

        $kategori->update($data);

        return response()->json(['message' => 'Kategori berhasil diperbaharui', 'data' => $data], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $data = $kategori->delete();
        return response()->json(['message' => 'Kategori berhasil dihapus', 'data' => $data], 200);
    }

    public function search(Request $request)
    {
        $keyword = request('keyword');
        $result = Kategori::where('nama', 'like', "%" . $keyword . "%")->get();
        return $result;
    }
}
