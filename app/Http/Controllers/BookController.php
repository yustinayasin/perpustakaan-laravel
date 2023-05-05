<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index($id) {
        $book = Book::where('id', $id);

        return response()->json([
            'data' => [
                'nama'        => $book->nama,
                'ringkasan'   => $book->ringkasan,
                'id_kategori' => $book->id_kategori,
                'kategori'    => $book->category->name
            ]
        ], 200);
    }

    public function store(Request $request) {
        //create a custom validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'ringkasan' => 'required',
            'id_kategori' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book = Book::create([
            'nama'        => $request->nama,
            'ringkasan'   => $request->ringkasan,
            'id_kategori'   => $request->id_kategori,
        ]);

        return response()->json([
            'message' => 'Buku berhasil disimpan',
            'data' => [
                'nama'        => $book->nama,
                'ringkasan'   => $book->ringkasan,
                'id_kategori' => $book->id_kategori,
                'kategori'    => $book->category->name
            ]
        ], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'ringkasan' => 'required',
            'id_kategori' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //it will return the first result of the query
        $book = Book::findOrFail($id);

        $book = Book::update([
            'nama'        => $request->nama,
            'ringkasan'   => $request->ringkasan,
            'id_kategori'   => $request->id_kategori,
        ]);

        return response()->json([
            'message' => 'Buku berhasil diubah',
            'data' => [
                'nama'        => $book->nama,
                'ringkasan'   => $book->ringkasan,
                'id_kategori' => $book->id_kategori,
                'kategori'    => $book->category->name
            ]
        ], 200);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete();

        return response()->json([
            'message' => 'Buku berhasil dihapus'
        ], 200);
    }
}
