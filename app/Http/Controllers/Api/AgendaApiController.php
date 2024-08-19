<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaApiController extends Controller
{
    public function index()
    {
        $data = Agenda::orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'data' => $data,
        ]);
    }
}
