<?php

namespace App\Observers;

use App\Models\FavoriteProducts;
use Illuminate\Support\Facades\Cache;

class FavoriteProductsObserver
{
    // public function __invoke()
    // {
    //     $this->clear_cache();
    // }
    /**
     * Handle the FavoriteProducts "created" event.
     */
    public function created(FavoriteProducts $favoriteProducts): void
    {
        //
        $this->clear_cache();
    }
    
    /**
     * Handle the FavoriteProducts "updated" event.
     */
    public function updated(FavoriteProducts $favoriteProducts): void
    {
        //
        $this->clear_cache();
    }
    
    /**
     * Handle the FavoriteProducts "deleted" event.
     */
    public function deleted(FavoriteProducts $favoriteProducts): void
    {
        //
        $this->clear_cache();
    }
    
    /**
     * Handle the FavoriteProducts "restored" event.
     */
    public function restored(FavoriteProducts $favoriteProducts): void
    {
        //
    }
    
    /**
     * Handle the FavoriteProducts "force deleted" event.
     */
    public function forceDeleted(FavoriteProducts $favoriteProducts): void
    {
        //
    }

    public function clear_cache(){
        Cache::forget('favorite_products');
    }
}
