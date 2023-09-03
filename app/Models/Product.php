<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $hidden = [
    //     'created_at',
    //     'updated_at'
    // ];
    
    
    // public function user() :BelongsTo
    // i change tis functions name to owner for get json with owner .
    // and i change   Product::select(['id','title','description','image','location','city','category','price','user_id as owner_id'])->with('owner:id,name')
    //user_id as owner_id and with method use owner. now i can show owner in response json    
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
