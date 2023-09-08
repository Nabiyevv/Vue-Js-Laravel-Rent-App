<?php

namespace App\Observers;

use App\Models\FavoriteProduct;
use Illuminate\Support\Facades\Cache;

class FavoriteProductObserver
{
    // public function __invoke()
    // {
    //     $this->clear_cache();
    // }
    /**
     * Handle the FavoriteProduct "created" event.
     */
    public function created(FavoriteProduct $FavoriteProduct): void
    {
        //
        $this->clear_cache();
    }
    
    /**
     * Handle the FavoriteProduct "updated" event.
     */
    public function updated(FavoriteProduct $FavoriteProduct): void
    {
        //
        $this->clear_cache();
    }
    
    /**
     * Handle the FavoriteProduct "deleted" event.
     */
    public function deleted(FavoriteProduct $FavoriteProduct): void
    {
        //
        $this->clear_cache();
    }
    
    /**
     * Handle the FavoriteProduct "restored" event.
     */
    public function restored(FavoriteProduct $FavoriteProduct): void
    {
        //
    }
    
    /**
     * Handle the FavoriteProduct "force deleted" event.
     */
    public function forceDeleted(FavoriteProduct $FavoriteProduct): void
    {
        //
    }

    public function clear_cache(){
        Cache::forget('favorite_products');
    }
}
