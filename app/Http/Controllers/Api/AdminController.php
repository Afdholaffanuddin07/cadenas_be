<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AdminResource;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    
    public function index()
    {
        //get posts
        $admins = Admin::latest()->paginate(5);

        //return collection of posts as a resource
        return new AdminResource(true, 'List Data Admin', $admins);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'admin'  => 'required',
            'passadmin'  => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create post
        $admins = Admin::create([
            'admin'     => $request->admin,
            'passadmin'   => $request->passadmin,
        ]);

        //return response
        return new AdminResource(true, 'Data Post Berhasil Ditambahkan!', $admins);
    }

    public function show(Admin $admin)
    {
        //return single post as a resource
        return new AdminResource(true, 'Data Post Ditemukan!', $admin);
    }

    public function update(Request $request, Admin $admin)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'admin'  => 'required',
            'passadmin'  => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


            //update post without image
        $admin->update([
            'admin'       => $request->admin,
            'passadmin'   => $request->passadmin,
        ]);
        

        //return response
        return new AdminResource(true, 'Data Post Berhasil Diubah!', $admin);
    }

    public function destroy(Admin $admin)
    {

        //delete post
        $admin->delete();

        //return response
        return new AdminResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}
