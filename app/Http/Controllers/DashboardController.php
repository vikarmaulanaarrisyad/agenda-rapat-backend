<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kategori = Kategori::count();
        $agenda = Agenda::count();
        $user = User::count();

        return view('dashboard.index', compact('kategori', 'agenda', 'user'));
    }
}
