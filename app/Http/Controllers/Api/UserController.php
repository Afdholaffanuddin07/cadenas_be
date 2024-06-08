<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    

    public function index()
    {
        // $users = User::latest()->paginate(5);
        // return new UserResource(true, 'List Data Users', $users);
        $Users=User::all();
        return response()->json($Users);
    }

    public function store(Request $request)
    {
        $rules=[
            'username'  => 'required',
            'password'  => 'required',
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }
        $Users=User::create([
            'username'     => $request->username,
            'password'   => $request->password,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Users created successfully',
            'data' => $Users,
        ]);
        // $validator = Validator::make($request->all(), [
        //     'username'  => 'required',
        //     'password'  => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }
        // $users = User::create([
        //     'username'     => $request->username,
        //     'password'   => $request->password,
        // ]);
        // return new UserResource(true, 'Data Post Berhasil Ditambahkan!', $users);
    }

    public function show($id)
    {
        // return new UserResource(true, 'Data Post Ditemukan!', $user);
        $Users=User::find($id);
        return response()->json($Users);
    }

    public function update(Request $request, $id)
    {
        $Users=User::find($id);

        if(!$Users){
            return response()->json([
                'status'=>false,
                'message'=>'Users not found',
            ]);
        }
        $validator = Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $Users->update([
            'username'     => $request->username,
            'password'   => $request->password,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Users updated successfully',
            'data' => $Users,
        ]);

        // $validator = Validator::make($request->all(), [
        //     'username'  => 'required',
        //     'password'  => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);

        // $user->update([
        //     'username'     => $request->username,
        //     'password'   => $request->password,
        // ]);
        // return new UserResource(true, 'Data Post Berhasil Diubah!', $user);
        // }
    }    
    public function destroy($id)
    {
        $Users=User::find($id);

        if(!$Users){
            return response()->json([
                'status' => false,
                'message'=>'not found'
            ]);
        }
        $Users->delete();

        return response()->json([
                'status' => false,
                'message'=>'selete succes',
        ]);
        // $user->delete();
        // return new UserResource(true, 'Data Post Berhasil Dihapus!', null);
    }
    
}
