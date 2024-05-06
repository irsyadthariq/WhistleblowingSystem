<?php

namespace App\Http\Controllers;
use App\Models\MruangLingkup;
use Illuminate\Http\Request;

class RuangLingkupController extends Controller
{
    public function index(){
        try{
           
            $data = MruangLingkup::select("nama_ruang_lingkup")->get();

            return response()->json(['message'=>"Berhasil didapat", "data"=>$data, "error"=>[]], 200);
        }
        catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage(), "data"=>[], "error"=>$e], 500);
        }
    }
    public function store(Request $request){
        try{
            $params = [
                'id' => $request->id,
                'nama_ruang_lingkup' => $request->nama_ruang_lingkup
            ];

            if($params['id']){
                // update
                $data = MruangLingkup::find($params['id']);
                $data->update($params);
            }
            else{
                // insert
                MruangLingkup::create($params);
            }
        
            return response()->json(['message'=>"Berhasil disimpan", "data"=>[], "error"=>[]], 200);
        }
        catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage(), "data"=>[], "error"=>$e], 500);
        }
        
    }

    public function delete(Request $request){
        try{
           
            $data = MruangLingkup::find($request->id);
            $data->delete();

            return response()->json(['message'=>"Berhasil dihapus", "data"=>[], "error"=>[]], 200);
        }
        catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage(), "data"=>[], "error"=>$e], 500);
        }
    }
}
