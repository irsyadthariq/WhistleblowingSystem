<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TlaporanHeader;
use Illuminate\Support\Facades\Validator;

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

    public function detail($laporan_id)
    {
        try {
            $data = TlaporanHeader::select("disclosure_status", "id", "nama_pelapor", "departemen", "alamat_email", "nomor_kontak", "status")
            ->where("id", $laporan_id)
            ->get();

            return response()->json(['message' => 'Data berhasil didapatkan', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data gagal didapatkan', 'error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'disclosure_status' => 'required|integer',
                'lampiran_file' => 'required|file|mimes:pdf,doc,docx|max:2048', 
                'nama_pelapor' => 'required|string|max:255',
                'departemen' => 'required|string|max:255',
                'alamat_email' => 'required|string|max:255',
                'nomor_kontak' => 'required|string|max:255',
                'informasi_lain' => 'required|string|max:255',
                'koneksi' => 'required|string|max:255',
                'password' => 'required|string|max:255',
                'status' => 'required|integer',
                'bobot_status' => 'required|integer',
                'keterangan' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()], 422);
            }

            $data = TlaporanHeader::create($request->all());

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dibuat', 'data' => $data], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = TlaporanHeader::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'disclosure_status' => 'required|integer',
                'lampiran_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', 
                'nama_pelapor' => 'required|string|max:255',
                'departemen' => 'required|string|max:255',
                'alamat_email' => 'required|string|max:255',
                'nomor_kontak' => 'required|string|max:255',
                'informasi_lain' => 'required|string|max:255',
                'koneksi' => 'required|string|max:255',
                'password' => 'required|string|max:255',
                'status' => 'required|integer',
                'bobot_status' => 'required|integer',
                'keterangan' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()], 422);
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
            $data = TlaporanHeader::findOrFail($id);
            $data->delete();

            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
