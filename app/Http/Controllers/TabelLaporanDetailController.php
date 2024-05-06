<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TlaporanDetail;
use Illuminate\Support\Facades\Validator;

class TabelLaporanDetailController extends Controller
{
    public function index()
    {
        try {
            $data = TlaporanDetail::all();
            return response()->json(['status' => 'success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                't_laporan_header_id' => 'required|integer',
                'm_pertanyaan_id' => 'required|integer',
                'jawaban' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
            }

            $data = TlaporanDetail::create($request->all());

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dibuat', 'data' => $data], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = TlaporanDetail::findOrFail($id);

            $validator = Validator::make($request->all(), [
                't_laporan_header_id' => 'required|integer',
                'm_pertanyaan_id' => 'required|integer',
                'jawaban' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
            }

            $data->update($request->all());

            return response()->json(['status' => 'success', 'message' => 'Data berhasil diperbarui', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = TlaporanDetail::findOrFail($id);
            $data->delete();

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
