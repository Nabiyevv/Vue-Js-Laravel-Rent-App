<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(Request $request)
    {
        // dd($request->all());
        // return $request->all();
        $validation = $request->validate([
            'name' => 'required|min:3|max:30',
            'contact' => ['required', 'size:17', 'regex:/^\+\d{3}-\d{2}-\d{3}-\d{2}-\d{2}$/'],
        ]);
        // 
        // dd($request->all());
        $path = null;
        
        if ($request->avatar && gettype($request->avatar) != 'string') {
            $request->validate([
                'avatar' => ['max:2048', 'image'],
            ]);
            $imageFile = $request->file('avatar');
            $path = Storage::putFileAs('public/avatar', $imageFile, $imageFile->hashName());
            $path = Storage::url($path);
        }
        // dd($request->user()->id);
        try {
            if (!$path) {
                User::where('id', $request->user()->id)
                    ->update([
                        'name' => $request->name,
                        'contact' => $request->contact,
                    ]);
            }
            else {
                User::where('id', $request->user()->id)
                ->update([
                    'name' => $request->name,
                    'contact' => $request->contact,
                    'avatar' => $path,
                ]);
            }
            $user = User::where('id', $request->user()->id)->get();
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()->json($user);
    }
}
