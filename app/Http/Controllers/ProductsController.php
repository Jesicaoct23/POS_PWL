<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ProductsController extends Controller
{
    public function index()
    {
        return  view('product.index');
    }
    public function foodBeverage()
    {
        return view('product.food');
    }
    public function beautyHealth()
    {
        return view('product.beauty');
    }
    public function homeCare()
    {
        return view('product.home');
    }
    public function babyKid()
    {
        return view('product.baby');
    }
}
