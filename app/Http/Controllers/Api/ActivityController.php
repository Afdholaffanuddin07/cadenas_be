<?php

namespace App\Http\Controllers\Api;

use App\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ActivityResource;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    

    public function index()
    {
        //get posts
        $activity = Activity::latest()->paginate(5);

        //return collection of posts as a resource
        return new ActivityResource(true, 'List Data Activity', $activity);
    }
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'user_id'  => 'required',
            'jam'  => 'required',
            'tanggal'  => 'required',
            'foto'  => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create post
        $activity = Activity::create([
            'user_id'  => $request->user_id,
            'jam'      => $request->jam,
            'tanggal'  => $request->tanggal,
            'foto'     => $request->foto,
        ]);

        //return response
        return new ActivityResource(true, 'Data Post Berhasil Ditambahkan!', $activity);
    }

    public function show(Activity $activity)
    {
        //return single post as a resource
        return new ActivityResource(true, 'Data Post Ditemukan!', $activity);
    }

    public function update(Request $request, Activity $activity)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'user_id'  => 'required',
            'jam'      => 'required',
            'tanggal'  => 'required',
            'foto'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


            //update post without image
        $activity->update([
            'user_id'  => $request->user_id,
            'jam'      => $request->jam,
            'tanggal'  => $request->tanggal,
            'foto'     => $request->foto,
        ]);
        

        //return response
        return new ActivityResource(true, 'Data Post Berhasil Diubah!', $activity);
    }

    public function destroy(Activity $activity)
    {

        //delete post
        $activity->delete();

        //return response
        return new ActivityResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}
