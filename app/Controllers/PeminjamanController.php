<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }
}
