<?php

namespace App\Http\Controllers;

use App\Models\Muser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = Muser::all();
            return response()->json(['status' => 'success', 'data' => $users], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'password' => 'required|string',
                'role' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()], 422);
            }

            $user = Muser::create($request->all());

            return response()->json(['status' => 'success', 'message' => 'User created successfully', 'data' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
  