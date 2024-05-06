<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TlaporanHeader;

class TabelLaporanHeaderController extends Controller
{
    public function index()
    {
        try {
            $data = TlaporanHeader::all();
            return response()->json(['status' => 'success', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'disclosure_id' => 'required|integer',
                'm_ruang_lingkup_id' => 'nullable|integer',
                'lampiran_file' => 'required|string|max:255', 
            ]);

            $data = TlaporanHeader::create($validatedData);

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dibuat', 'data' => $data], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = TlaporanHeader::findOrFail($id);

            $validatedData = $request->validate([
                'disclosure_id' => 'required|integer',
                'm_ruang_lingkup_id' => 'nullable|integer',
                'lampiran_file' => 'required|string|max:255', 
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
            $data = TlaporanHeader::findOrFail($id);
            $data->delete();

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
