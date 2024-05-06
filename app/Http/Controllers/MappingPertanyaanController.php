<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MmappingPertanyaan;
use Illuminate\Support\Facades\Validator;

class MappingPertanyaanController extends Controller
{
    public function index()
    {
        try {
            $data = MmappingPertanyaan::select("m_ruang_lingkup_id")->get();
            return response()->json(['message' => 'Data berhasil didapatkan', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data gagal didapatkan', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'm_ruang_lingkup_id' => 'required|integer|exists:m_ruang_lingkup,id', 
                'm_pertanyaan_id' => 'required|integer:m_pertanyaan,id', 
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Validation error', 'errors' => $validator->errors()], 400);
            }

            $mapping = MmappingPertanyaan::create([
                'm_ruang_lingkup_id' => $request->m_ruang_lingkup_id,
                'm_pertanyaan_id' => $request->m_pertanyaan_id,
            ]);
            
            return response()->json(['message' => 'Data berhasil ditambahkan', 'data' => $mapping], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data gagal ditambahkan', 'error' => $e->getMessage()], 500);
        }
    }
}
