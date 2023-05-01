<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index($id) {
        $user = User::where('id', $id);

        return $user;
    }

    public function store(Request $request) {
        //create a custom validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:10',
            'confirmPassword' => 'required|min:10',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'email'          => $request->email,
            'password'   => Hash::make($request->password),
            'name'   => $request->name,
        ]);

        return response()->json([
            'message' => 'User berhasil diubah',
            'data' => [
                'email' => $user->email,
                'name' => $user->name
            ]
        ], 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:10',
            'confirmPassword' => 'required|min:10',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //it will return the first result of the query
        $user = User::findOrFail($id);

        $user = User::update([
            'email'          => $request->email,
            'password'   => Hash::make($request->password),
            'name'   => $request->name,
        ]);

        return response()->json([
            'message' => 'User berhasil diubah',
            'data' => [
                'email' => $user->email,
                'name' => $user->name
            ]
        ], 200);
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->delete();

        return response()->json([
            'message' => 'User berhasil dihapus'
        ], 200);
    }
}
