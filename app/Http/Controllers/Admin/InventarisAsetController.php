<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class InventarisAsetController extends Controller
{
    public function index()
    {
        return view('admin.inventaris.index');
    }
}
