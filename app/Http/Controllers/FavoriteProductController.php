<?php

namespace App\Http\Controllers;

use App\Models\FavoriteProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FavoriteProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Cache::remember('favorite_products',60,fn () => FavoriteProducts::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(int $user_id,Request $request)
    {
        //
        return FavoriteProducts::where('user_id',$user_id)->orderBy('created_at', 'desc')->get();
    }
    
    /**
     * Display the specified resource.
     */
    public function show(FavoriteProducts $favoriteProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FavoriteProducts $favoriteProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $user_id,int $product_id, FavoriteProducts $favoriteProduct)
    {
        //
        
        return FavoriteProducts::where(['user_id' => $user_id,'product_id' => $product_id])->delete();
    }
}
