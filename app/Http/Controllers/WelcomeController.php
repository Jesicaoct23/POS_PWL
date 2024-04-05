<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    // JS7 Praktikum 2 bagian 1
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Selamat Datang',
            'list' => ['Home','Welcome'],
        ];

        $activeMenu='dashboard';

        return view('welcome', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}