<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|email|min:6',
            'password' => 'required|min:6'
        ]);
        
        if($validation->fails()){
            return response()->json(['errors' => $validation->errors()],HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        $user = User::where('email',$request->email)->first();
        // if(!Auth::attempt($request->only('email','password')))
        // {
        //     return response()->json(['errors' => 'Wrong Username or Password !'],HttpResponse::HTTP_UNAUTHORIZED);
        // }
        
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['errors' => 'Wrong Username or Password !'],HttpResponse::HTTP_UNAUTHORIZED);            
        }
        $token = $user->createToken('app')->plainTextToken;
        return response()->json(['token' => $token,'userData'=>$user],HttpResponse::HTTP_OK);
    }


    public function register(Request $request){
        $validation = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'contact' =>'required|regex:/^\+\d{3}-\d{2}-\d{3}-\d{2}-\d{2}$/|min:17',
            'email' => 'required|unique:users|email|min:6',
            'password' => 'required|min:6'
        ]);
        if($validation->fails()){
            return response()->json(['errors' => $validation->errors()],HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        } 
        // return response()->json($request->contact);
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'password'=> Hash::make($request->password) // Because we turn off the hash from User model
        ]);
        return response()->json($data,HttpResponse::HTTP_CREATED);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out'],HttpResponse::HTTP_OK);
    }
}
