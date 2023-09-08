<?php

namespace App\Http\Controllers;

use App\Models\FavoriteProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class FavoriteProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // FavoriteProduct::query()->delete();
        // return  Cache::remember('favorite_products',60,
        // fn () => FavoriteProduct::where('user_id',$request->user()->id)->orderBy('created_at', 'desc')->get());
       
        return response()->json(FavoriteProduct::where('user_id',$request->user()->id)
        ->orderBy('created_at', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = FavoriteProduct::firstOrCreate([
            'user_id'=>$request->user()->id,
            'product_id'=>$request->product_id
        ]);
        // FavoriteProduct::where('user_id','1')->delete();
        return response()->json(['product'=>$product],Response::HTTP_CREATED);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(FavoriteProduct $favoriteProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FavoriteProduct $favoriteProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        return FavoriteProduct::where('product_id',$request->product_id)->delete();
    }
}
