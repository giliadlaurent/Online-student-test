<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function error403()
    {
        return view('errors.403');
    }

    public function error404()
    {
        return view("errors.404");
    }

    public function error503()
    {
        return view("errors.503");
    }
}
