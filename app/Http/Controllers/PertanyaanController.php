<?php

namespace App\Http\Controllers;

use App\Models\Mpertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PertanyaanController extends Controller
{
    public function index()
    {
        try {
            $data = Mpertanyaan::select("nama_pertanyaan")->get();

            return response()->json(['message' => "Berhasil didapat", 'data' => $data, 'error' => null], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'data' => [], 'error' => $e->getTrace()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'nullable|integer',
                'nama_pertanyaan' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Invalid input', 'data' => [], 'error' => $validator->errors()], 400);
            }

            $params = [
                'nama_pertanyaan' => $request->nama_pertanyaan
            ];

            if ($request->id) {
                $data = Mpertanyaan::find($request->id);
                if (!$data) {
                    return response()->json(['message' => 'Data tidak ditemukan', 'data' => [], 'error' => null], 404);
                }
                $data->update($params);
            } else {
                Mpertanyaan::create($params);
            }

            return response()->json(['message' => "Berhasil disimpan", 'data' => [], 'error' => null], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'data' => [], 'error' => $e->getTrace()], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Invalid input', 'data' => [], 'error' => $validator->errors()], 400);
            }

            $data = Mpertanyaan::find($request->id);
            if (!$data) {
                return response()->json(['message' => 'Data tidak ditemukan', 'data' => [], 'error' => null], 404);
            }

            $data->delete();

            return response()->json(['message' => "Berhasil dihapus", 'data' => [], 'error' => null], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'data' => [], 'error' => $e->getTrace()], 500);
        }
    }
}
