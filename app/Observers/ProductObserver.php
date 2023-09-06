<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    public function __invoke()
    {
        $this->clear_cache();
    }
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
        $this->clear_cache();
    }
    
    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
        $this->clear_cache();
    }
    
    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
        $this->clear_cache();
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
    
    public function clear_cache() :void
    {
        Cache::forget('products');
    }
}
