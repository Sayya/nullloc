<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function json()
    {
        return response()->json(['Hatena' => 'HeroMan']);
    }
}
