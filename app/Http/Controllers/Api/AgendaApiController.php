<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaApiController extends Controller
{
    public function index()
    {
        // Mendapatkan type dari pengguna yang saat ini diautentikasi
        $userType = auth()->user()->type;

        // Mengambil data Agenda dengan type yang sesuai dengan type pengguna
        $data = Agenda::where('type', $userType)->orderBy('id', 'DESC')->get();

        // Mengembalikan data dalam format JSON
        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'data' => $data,
        ]);
    }
}
