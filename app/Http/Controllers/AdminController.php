<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function crudUser()
    {
        return view('admin.crud-user');
    }

    public function dataPresensi()
    {
        return view('admin.data-presensi');
    }
}
