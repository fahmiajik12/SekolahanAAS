<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Model\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->success($users,200); //sttp request status code 200
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type' => 'required|in:admin,guru',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            $pesan = $validator->errors();

            return $this->failedResponse($pesan,422);
        }

        $user = new User();
        $user->type = $request->type;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $saveUser = $user->save();
        if ($saveUser) {
            return $this->success($user,201);
        } else {
            return $this->failedResponse('User gagal ditambahkan!', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->success($user,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(),[
            'type' => 'required|in:admin,guru',
            'username' => 'required|unique:users,username,'.$user->id,
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            $pesan = $validator->errors();

            return $this->failedResponse($pesan,422);
        }

        $user->type = $request->type;
        $user->username = $request->username;
        if ($request->has('password')) {
            $user->password = $request->password ? Hash::make($request->password) : $user->password;
        }
        $saved = $user->save();

        if ($saved) {
            return $this->success($user,200);
        } else {
            return $this->failedResponse('User gagal diupdate!',500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleteData = $user->delete();

        if ($deleteData) {
            return $this->success(null,200);
        } else {
            return $this->failedResponse('User gagal dihapus!',500);
        }
    }

    public function cek_token()
    {
        $user = JWTAuth::parseToken()->authenticate();
        
        return $this->success($user,200);
    }

    public function get_user_guru()
    {
        $data = User::where('type','guru')->whereNotIn('id',Guru::pluck('user_id'))->get();

        return $this->success($data,200);
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
