<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class FrontendController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->paginate(3); // Tampilkan 3 berita per halaman
    return view('frontend.home', compact('berita'));

    }
}
