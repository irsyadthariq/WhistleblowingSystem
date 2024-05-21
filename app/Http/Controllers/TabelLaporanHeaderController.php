<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TlaporanHeader;
use App\models\TlaporanDetail;
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

    public function detail($laporan_id, Request $request)
    {
        try {
            $password = $request->get("password");
            $cek = TlaporanHeader::where("id", $laporan_id)->where("password", $password)->first();
            if(!$cek){
                return response()->json(['status' => 'error', 'message' => "data tidak ditemukan"], 500);
            }
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
                'lampiran_file' => 'required|file|mimes:pdf,jpg|max:2048',
                'm_ruang_lingkup_id'=> 'required|integer', 
                'nama_pelapor' => 'required|string|max:255',
                'departemen' => 'required|string|max:255',
                'alamat_email' => 'required|string|max:255',
                'nomor_kontak' => 'required|string',
                'informasi_lain' => 'required|string|max:255',
                'koneksi' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()], 422);
            }

            $lampiran_file = "";

            if ($request->file('lampiran_file')) {
                $lampiran_file = $request->file('lampiran_file')->store('uploads', 'public');
            }

            $data = TlaporanHeader::create([
                'disclosure_status'=> $request->get('disclosure_status'),
                'm_ruang_lingkup_id'=> $request->get('m_ruang_lingkup_id'),
                'lampiran_file'=> $lampiran_file,
                'nama_pelapor'=> $request->get('nama_pelapor'),
                'departemen'=> $request->get('departemen'),
                'alamat_email'=> $request->get('alamat_email'),
                'nomor_kontak'=> $request->get('nomor_kontak'),
                'informasi_lain'=> $request->get('informasi_lain'),
                'koneksi'=> $request->get('koneksi'),
                'status'=> 1,
            ]);

            foreach(json_decode($request->input('pertanyaan'), true) as $key => $value) {
                TlaporanDetail::create([
                    't_laporan_header_id'=> $data->id,
                    'm_pertanyaan_id'=> $key,
                    'jawaban'=> $value,
                ]);
            }

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
