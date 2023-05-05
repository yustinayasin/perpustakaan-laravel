<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index($id) {
        $author = Author::where('id', $id);

        return response()->json([
            'data' => [
                'nama' => $author->nama,
            ]
        ], 200);
    }

    public function store(Request $request) {
        //create a custom validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $author = Author::create([
            'nama'=> $request->nama,
        ]);

        return response()->json([
            'message' => 'Penulis berhasil disimpan',
            'data' => [
                'nama' => $author->nama,
            ]
        ], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //it will return the first result of the query
        $author = Author::findOrFail($id);

        $author = Author::update([
            'nama'        => $request->nama,
        ]);

        return response()->json([
            'message' => 'Penulis berhasil diubah',
            'data' => [
                'nama' => $author->nama,
            ]
        ], 200);
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);

        $author->delete();

        return response()->json([
            'message' => 'Penulis berhasil dihapus'
        ], 200);
    }
}
