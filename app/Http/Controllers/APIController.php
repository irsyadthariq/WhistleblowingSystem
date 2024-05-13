<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function index()
    {
        $data = [
            'message' => 'Hello from Laravel API!'
        ];

        return response()->json($data);
    }
}
