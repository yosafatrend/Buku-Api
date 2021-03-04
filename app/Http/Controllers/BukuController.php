<?php

namespace App\Http\Controllers;

use App\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function create(Request $request){
        $gambar = $request->file('gambar')->store('gambar_buku');
        $buku = Buku::create([
            'judul'=>$request->get('judul'),
            'deskripsi'=>$request->get('deskripsi'),
            'gambar' => $gambar, 
            'harga'=>$request->get('harga'),
            'stok'=>$request->get('stok'),
        ]);
        
        return response()->json([
            'status'=>1,
            'message'=>'Berhasil membuat buku',
            'buku'=>$buku
        ], 200);
    }

    public function index(){
        $buku = Buku::all();

        return response()->json([
            'status'=>1,
            'message'=>'daftar buku',
            'buku'=> $buku
        ], 200);
    }

    public function detail($id){
        $buku = Buku::findOrFail($id);

        return response()->json([
            'status' => 1,
            'message' => 'Detail buku',
            'buku' => $buku
        ], 200);
    }

    public function update(Request $request){
        $id = $request->get('id');
        $buku = Buku::findOrFail($id); //ngambil buku dari db
        $buku->update($request->all()); //update buku dari db sesuai request
        $buku->refresh();
        return response()->json([
            'status' => 1,
            'message' => 'Buku berhasil diupdate',
            'buku' => $buku
        ], 200);
    }

    public function delete(Request $request){
        $id = $request->get('id');
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Buku berhasil dihapus',
            'buku' => $buku
        ], 200);
    }
}
