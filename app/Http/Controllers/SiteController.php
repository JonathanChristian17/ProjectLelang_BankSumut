<?php

namespace App\Http\Controllers;

use App\KabKota;
use App\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index(){
        return redirect()->route('barang');
    }
    public function barang(Request $request){
        $data = [];
        $data['page_title'] = 'Beranda';
        
        $data['kategori'] = DB::table('j_kategori')->get();
        $data['prov'] = DB::table('d_provinsi')->get();
        $data['slider'] = DB::table('d_slider')->get();

        if ($request->ajax()) {
            $start = $request->start; // min price value
            $end = $request->end; // max price value
            $brand = $request->brand; //brand
            $village = $request->village; //brand
         // $village1 = (int)$village;
           // dd($village1.' & '.$village);
            if($brand === NULL && $village === NULL){
                $row = DB::table('d_barang')->where('status','Posting')
                ->where('harga', '>=', $start*1000000)->where('harga', '<=', $end*1000000)   
                ->orderby('harga', 'ASC')
                ->paginate(12);
                //dd('brand kosong desa kosong');
            }elseif($brand === NULL && !empty($village)){
                $row = DB::table('d_barang')->where('status','Posting')
                ->where('harga', '>=', $start*1000000)->where('harga', '<=', $end*1000000)
                ->where('d_kel_desa_id', $village)                    
                ->orderby('harga', 'ASC')
                ->paginate(12);
                //dd($village);
            }elseif($village === NULL && !empty($brand)){
                $row = DB::table('d_barang')->where('status','Posting')
                ->where('harga', '>=', $start*1000000)->where('harga', '<=', $end*1000000)
                ->whereIN('j_kategori_id', explode( ',', $brand ))                   
                ->orderby('harga', 'ASC')
                ->paginate(12);
               // dd('brand ada desa kosong');
            }else{
                
                $row = DB::table('d_barang')->where('status','Posting')
                ->where('harga', '>=', $start*1000000)->where('harga', '<=', $end*1000000)
                ->whereIN('j_kategori_id', explode( ',', $brand ))
                ->where('d_kel_desa_id', $village)                     
                ->orderby('harga', 'ASC')
                ->paginate(12);
               // dd('ada semua');
            }
            //dd($brand);
           
           // dd($row);

            response()->json($row); //return to ajax
             return view('frontend.lelang',compact('row'));
        }
       
        else {

            $data['row'] = DB::table('d_barang')->where('status','Posting')->paginate(12);
            return view('frontend.index',$data);
        }
       // dd(asset('eshopper/css/bootstrap.min.css'));
       
    }

    public function detail($id){
        $data = [];
        $data['page_title'] = 'Detail Barang';
        $data['row'] = DB::table('d_barang')->where('id',$id)->first();
        $data['kategori'] = DB::table('j_kategori')->get();
        $data['prov'] = DB::table('d_provinsi')->get();
        $data['fot'] = DB::table('d_foto')->where('d_barang_id',$id)->get();
        $data['jumlah'] = DB::table('d_foto')->where('d_barang_id',$id)->count();
        //dd($data['jumlah']);
        return view('frontend.detail',$data);
        
    }


}
