<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //all(['id','title','image','city']);
        //  $products = Product::select(['id','title','image','city','price'])->paginate();
        $products = Cache::remember('products',120,fn () => Product::select(['id','title','image','city','price'])->paginate());
        return response()->json(['products'=>$products],Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if(!Auth::user())
        {
            return response()->json(['err'=>'unOuth'],Response::HTTP_UNAUTHORIZED);
        }
        $validate = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'city' => ['required'],
            'count' => ['required'],
            'category' => ['required'],
            'image' => ['required','max:2048','image'],
            'location' => ['required'],
        ]);

        try {
            $imageFile = $request->file('image');    
            $path = Storage::putFileAs('public/productImages',$imageFile,$imageFile->hashName(),[]);
            $path = Storage::url($path);
            $product = Product::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'price'=>$request->price,
                'city'=>$request->city,
                'count'=>$request->count,
                'category'=>$request->category,
                'image'=>$path,
                'location'=>$request->location,
                'user_id'=>$request->user_id,
            ]);
        } catch (\Throwable $th) {

           throw $th;
        }
       

        return response()->json(["message"=>"Data added","ext"=>$imageFile->hashName(),"prod"=>$product],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $productId,Request $request)
    {
        // /** 
        //  *@var object $product
        // */
        
        // $product = Product::select(['id','title','description','image','location','city','category','price','count','user_id as owner_id'])->with('owner:id,name')->findOrFail($productId);
        // $product = Product::select(['id','title','description','image','location','city','category','price','count','user_id'])->with('user:id,name')->findOrFail($productId);
        // return response()->json($product,Response::HTTP_OK);
        $product = Cache::remember('product_by_'.$productId,30*30,fn () =>Product::select(['id','title','description',
        'image','location','city','category','price','count','user_id'])->with('user:id,name,contact')->findOrFail($productId));
        return response()->json($product,Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

 /**   
  * @param string $categoryId
  * @return array
 */
    public function productByCategory(int $categoryId)
    { 
        $products = Cache::remember('product_category_'.$categoryId,30*30,fn () =>Product::where('category',$categoryId)->paginate());
        return response()->json($products,Response::HTTP_OK);
    }
}
