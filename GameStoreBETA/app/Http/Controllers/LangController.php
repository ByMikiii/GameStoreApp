<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function index($lang)
    {
        return response()->json($lang);
    }
}
