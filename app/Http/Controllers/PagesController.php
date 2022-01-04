<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('index');
    }

    public function login(){//
        return view('login');
    }

    public function register(){//
        return view('register');
    }

    public function search(){
        return view('search');
    }

    public function cart(){
        return view('cart');
    }

    public function store(){
        return view('store');
    }

    public function sellercenter(){
        return view('sellercenter');
    }

    public function productDetail(){
        return view('productDetail');
    }

    public function dindan(){
        return view('dindan');
    }

    public function category(){
        return view('category');
    }

    public function accountadjust(){
        return view('accountadjust');
    }

    public function administrator(){
        return view('administrator');
    }
}
