<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WartaNewsController extends Controller
{
    public function index()
    {
        return view('admin.warta.index');
    }
}
