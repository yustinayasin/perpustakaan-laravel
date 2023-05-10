<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id) {
        $category = Category::where('id', $id);

        return $category;
    }

    public function store(Request $request) {
        //create a custom validator
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $borrower = Borrower::create([
            'kode' => $request->kode,
            'nama'  => $request->nama,
        ]);

        return response()->json([
            'message' => 'Kategori berhasil disimpan',
            'data' => [
                'kode' => $borrower->kode,
                'nama'  => $borrower->nama,
            ]
        ], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //it will return the first result of the query
        $category = Category::findOrFail($id);

        $category = Category::update([
            'kode' => $request->kode,
            'nama'  => $request->nama,
        ]);

        return response()->json([
            'message' => 'Kategori berhasil diubah',
            'data' => [
                'kode' => $borrower->kode,
                'nama'  => $borrower->nama,
            ]
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus'
        ], 200);
    }
}
