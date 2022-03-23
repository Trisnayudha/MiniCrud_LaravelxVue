<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::get();
        return response()->json($user, 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user, 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:5'],
            ],
            [
                'name.required' => 'Nama Harap diisi',
                'password.required' => 'Password Harap diisi',
                'password.min' => 'Password minimal 5 karakter',
                'email.required' => 'Email Harap diisi',
                'email.unique' => 'Email sudah digunakan',
                'email.email' => 'Email tidak Valid'
            ]
        );

        if ($validate->fails()) {
            $response['status'] = false;
            $response['message'] = $validate->errors();

            return response()->json($response, 403);
        } else {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password'])
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil ditambah',
                'data' => $user
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ],
            [
                'name.required' => 'Nama Harap diisi',
                'email.required' => 'Email Harap diisi',
                'email.unique' => 'Email sudah digunakan',
                'email.email' => 'Email tidak Valid'
            ]
        );

        if ($validate->fails()) {
            $response['status'] = false;
            $response['message'] = $validate->errors();

            return response()->json($response, 403);
        } else {
            $user = User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil di Ubah',
                'data' => $user
            ], 201);
        }
    }

    public function destroy($id)
    {

        $user = User::find($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data Berhasil di Hapus',
            'data' => $user
        ]);
    }
}
