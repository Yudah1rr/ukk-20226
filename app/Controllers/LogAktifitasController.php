<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;

class LogAktifitasController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }
}
