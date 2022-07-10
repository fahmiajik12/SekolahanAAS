<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $pesan = $validator->errors();

            return $this->failedResponse($pesan,422);
        }

        $credentials = request(['username', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return $this->failedResponse('Username atau password salah!',401);
        }

        return response()->json([
                        'status' => true,
                        'message' => 'Logged in.',
                        'token' => $token
                    ]);
    }

    private function success($data,$statusCode,$message='success')
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'status_code' => $statusCode
        ],$statusCode);
    }

    private function failedResponse($message,$statusCode)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => null,
            'status_code' => $statusCode
        ],$statusCode);
    }
}
