<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    public function index($id) {
        $user = User::where('id', $id);

        return $user;
    }

    public function store(Request $request, $idPengguna, $idBuku) {
        //create a custom validator
        $validator = Validator::make($request->all(), [
            'lama_pinjam' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $borrower = Borrower::create([
            'id_pengguna' => $idPengguna,
            'id_buku' => $idBuku,
            'lama_pinjam' => $request->lama_pinjam,
            'tanggal_pinjam'  => $request->tanggal_pinjam,
            'tanggal_kembali'  => $request->tanggal_kembali,
        ]);

        return response()->json([
            'message' => 'Peminjam berhasil disimpan',
            'data' => [
                'id_pengguna' => $borrower->$idPengguna,
                'id_buku' => $borrower->$idBuku,
                'lama_pinjam' => $borrower->lama_pinjam,
                'tanggal_pinjam'  => $borrower->tanggal_pinjam,
                'tanggal_kembali'  => $borrower->tanggal_kembali,
            ]
        ], 200);
    }

    public function update(Request $request, $id, $idPengguna, $idBuku) {
        $validator = Validator::make($request->all(), [
            'lama_pinjam' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //it will return the first result of the query
        $borrower = Borrower::findOrFail($id);

        $borrower = Borrower::update([
            'id_pengguna' => $idPengguna,
            'id_buku' => $idBuku,
            'lama_pinjam' => $request->lama_pinjam,
            'tanggal_pinjam'  => $request->tanggal_pinjam,
            'tanggal_kembali'  => $request->tanggal_kembali,
        ]);

        return response()->json([
            'message' => 'Peminjam berhasil diubah',
            'data' => [
                'id_pengguna' => $borrower->$idPengguna,
                'id_buku' => $borrower->$idBuku,
                'lama_pinjam' => $borrower->lama_pinjam,
                'tanggal_pinjam'  => $borrower->tanggal_pinjam,
                'tanggal_kembali'  => $borrower->tanggal_kembali,
            ]
        ], 200);
    }

    public function destroy($id)
    {
        $borrower = Borrower::findOrFail($id);

        $borrower->delete();

        return response()->json([
            'message' => 'Peminjam berhasil dihapus'
        ], 200);
    }
}
