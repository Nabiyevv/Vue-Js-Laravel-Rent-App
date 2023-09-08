<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FavoriteProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
    ];



    public function user() : BelongsToMany
    {

        return $this->belongsToMany(User::class);
    }
}
