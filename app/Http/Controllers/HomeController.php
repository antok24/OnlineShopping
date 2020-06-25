<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $barangs = Barang::paginate(3);

        return view('home', compact('barangs'));
    }
}
