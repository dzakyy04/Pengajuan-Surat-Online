<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    public function index() {
        return view('frontend.beranda');
    }

    public function form() {
        return view('frontend.form-pengajuan');
    }
}
