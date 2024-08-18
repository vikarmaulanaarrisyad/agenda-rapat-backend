<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{
    public function data()
    {
        $query = Agenda::orderBy('id', 'DESC');
        return datatables($query)
            ->addIndexColumn()
            ->editColumn('nama_kegiatan', function ($query) {
                return wordwrap($query->nama_kegiatan, 40, '<br>', true);
            })
            ->editColumn('kategori', function ($query) {
                return $query->kategori->nama;
            })
            ->editColumn('tanggal', function ($query) {
                return tanggal_indonesia($query->tanggal, true);
            })
            ->editColumn('waktu_mulai', function ($query) {
                return date_format(date_create($query->waktu_mulai), 'H:i:s') . ' WIB';
            })
            ->addColumn('aksi', function ($query) {
                return
                    '
                    <button class="btn text-md text-primary" onclick="editForm(`' . route('agenda.show', $query->id) . '`, `' . $query->nama_kegiatan . '`)"> <i class="fas fa-edit"></i> </button>
                    <button class="btn btn-md text-danger" onclick="deleteData(`' . route('agenda.destroy', $query->id) . '`, `' . $query->nama_kegiatan . '`)"> <i class="fas fa-trash"></i> </button>
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
        return view('agenda.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_kegiatan' => 'required',
            'tanggal' => 'required|date_format:Y-m-d',
            'waktu_mulai' => 'required|date_format:H:i',
            'kategori' => 'required',
            'tempat_kegiatan' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
                'message' => 'Maaf inputan yang anda masukan salah, silahkan periksa kembali dan coba lagi',
            ], 422);
        }

        $data = $request->all();
        $data['kategori_id'] = $request->kategori;
        $data['user_id'] = auth()->user()->id;
        $data['tempat'] = $request->tempat_kegiatan ?? 'Tidak ada lokasi';

        Agenda::create($data);

        return response()->json(['message' => 'Data berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        $agenda->kategori = $agenda->kategori;
        $agenda->tempat_kegiatan = $agenda->tempat;
        return response()->json(['data' => $agenda]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $rules = [
            'nama_kegiatan' => 'required',
            'tanggal' => 'required|date_format:Y-m-d',
            'waktu_mulai' => 'required|date_format:H:i',
            'kategori' => 'required',
            'tempat_kegiatan' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
                'message' => 'Maaf inputan yang anda masukan salah, silahkan periksa kembali dan coba lagi',
            ], 422);
        }

        $data = $request->all();
        $data['kategori_id'] = $request->kategori;
        $data['user_id'] = auth()->user()->id;
        $data['tempat'] = $request->tempat_kegiatan ?? 'Tidak ada lokasi';
        $agenda->update($data);

        return response()->json(['message' => 'Data berhasil diubah.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return response()->json(['message' => 'Data berhasil dihapus.']);
    }
}
