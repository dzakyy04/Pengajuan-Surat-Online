<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        $title = 'Login Admin';
        return view('admin.auth.login', compact('title'));
    }
}
