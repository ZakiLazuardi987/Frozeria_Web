<?php

namespace App\Http\Controllers;

class BantuanController extends Controller
{
    /**
     * Tampilkan halaman bantuan penggunaan sistem
     */
    public function index()
    {
        return view('bantuan.index');
    }
}