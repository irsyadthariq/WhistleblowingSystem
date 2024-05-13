<?php

namespace App\Http\Controllers;
use App\Models\MsaluranPelaporan;
use App\Models\TLaporanHeader;
use App\Models\MruangLingkup;
use Illuminate\Http\Request;

class SaluranPelaporanController extends Controller
{
    public function index(){
        try{
           
            $data = MsaluranPelaporan::select("nama_saluran")->get();

            return response()->json(['message'=>"Berhasil didapat", "data"=>$data, "error"=>[]], 200);
        }
        catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage(), "data"=>[], "error"=>$e], 500);
        }
    }

    public function detail($tahun)
    {
        try {
            $total_laporan = TLaporanHeader::whereYear('created_at', $tahun)->count("id");
            $close = TLaporanHeader::whereIn('status', [3,4])->whereYear('created_at', $tahun)->count("id");
            $open = TLaporanHeader::whereIn('status', [1,2])->whereYear('created_at', $tahun)->count("id");

            $get_saluran = MsaluranPelaporan::where("tahun", $tahun)->get();
            $saluran = [];
            foreach($get_saluran as $s){
               $saluran[$s->nama_saluran] = $s->jumlah;
            }

            $ruang_lingkup_list = MruangLingkup::all();
            $kategori_laporan = []; 
            foreach($ruang_lingkup_list as $s){
                $nama_ruang_lingkup=$s->nama_ruang_lingkup;
                $value = TlaporanHeader::whereYear("created_at", $tahun)->where("m_ruang_lingkup_id", $s->id)->count("id");
                $kategori_laporan[$nama_ruang_lingkup] = $value;
            }
            $data = [
                'total_laporan' => $total_laporan,
                'close' => $close,
                'open' => $open,
                'saluran_pelaporan' => $saluran, 
                    
                'kategori_laporan' => $kategori_laporan,
            ];

            return response()->json(['message' => 'Data berhasil didapatkan', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data gagal didapatkan', 'error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request){
        try{
            $params = [
                'nama_saluran' => 'request|string',
                'jumlah' => 'request|integer',
                'tanggal' => 'request|date',
            ];

            if($params['id']){
                $data = MsaluranPelaporan::find($params['id']);
                $data->update($params);
            }
            else{
                MsaluranPelaporan::create($params);
            }
        
            return response()->json(['message'=>"Berhasil disimpan", "data"=>[], "error"=>[]], 200);
        }
        catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage(), "data"=>[], "error"=>$e], 500);
        }
        
    }
}
