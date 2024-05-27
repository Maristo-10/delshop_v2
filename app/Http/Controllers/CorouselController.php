<?php

namespace App\Http\Controllers;

use App\Models\Corousel;
use Illuminate\Http\Request;

class CorouselController extends Controller
{
    public function kelolacorousel(){
        $corousel = Corousel::all();
        return view('admin.kelolacorousel',[
            'corousel' => $corousel
        ]);
    }

    public function ubahCorousel(Request $request, $id)
    {
        $corousel = Corousel::find($id);
        if($request->file('gambar_corousel')){
            if ($request->hasfile('gambar_corousel')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('gambar_corousel')->getClientOriginalName());
                $request->file('gambar_corousel')->move(public_path('corousel-images'), $filename);
                $corousel->update(['gambar_corousel'=>$filename]);
            }
        }
        return redirect()->route('admin.kelolacorousel')->with('success','Data Corousel Berhasil di Ubah');
    }

    public function ustatus_corousel($id){

        $corousel = Corousel::find($id);

        if($corousel->status == 0){
            $status = "Aktifkan";
            $corousel->update([
                'status'=> 1
            ]);

            return redirect()->route('admin.kelolacorousel')->with('success','Data Corousel Berhasil di '. $status );
        }

        if($corousel->status == 1){
            $status = "Non-Aktifkan";
            $corousel->update([
                'status'=> 0
            ]);

            return redirect()->route('admin.kelolacorousel')->with('success','Data Corousel Berhasil di '. $status );
        }


    }

}
