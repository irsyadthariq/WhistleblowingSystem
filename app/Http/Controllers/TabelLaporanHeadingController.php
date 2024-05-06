<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TlaporanHeading;

class TabelLaporanHeadingController extends Controller
{
    public function index()
    {
        try {
            $data = TlaporanHeading::all();
            return response()->json(['status' => 'success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                't_laporan_header_id' => 'required|integer',
                'password' => 'nullable|string',
                'ket_laporan' => 'nullable|string',
                'status' => 'nullable|string',
            ]);

            $data = TlaporanHeading::create($validatedData);

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dibuat', 'data' => $data], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = TlaporanHeading::findOrFail($id);

            $validatedData = $request->validate([
                't_laporan_header_id' => 'required|integer',
                'password' => 'nullable|string',
                'ket_laporan' => 'nullable|string',
                'status' => 'nullable|string',
            ]);

            $data->update($validatedData);

            return response()->json(['status' => 'success', 'message' => 'Data berhasil diperbarui', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $data = TlaporanHeading::findOrFail($id);
            $data->delete();

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
