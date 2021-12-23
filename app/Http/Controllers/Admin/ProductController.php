<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
// use App\Http\Controllers\Admin\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();
        return view('admin.products.index', ['products' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        try{
            $dbImagePath = null;

            if($request->hasFile('image')){
                $imageName = $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/products/' ,$imageName);
                $dbImagePath = 'storage/products/' .$imageName;

            }
            Product::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'category_id' =>$request->category_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $dbImagePath,
                'status' => $request->status,
            
                
            ]);

            return redirect()->back()->with('success', 'Product created successfully!');
        }catch(\Exception $e){
            Log::error("Product Store: ".$e->getMessage());
            return redirect()->back()->with('error', 'Opps! Something went wrong');


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));

                                     // ['product' => $product])
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([

            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);


        try{

            if($request->hasFile('image')){
                $imageName = $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/products/',$imageName);
                $dbImagePath = 'storage/products/'.$imageName;
                $deleteImagePath = $product->image;
                $deleteImagePath = str_replace('storage','public',$deleteImagePath);
                
                Storage::delete($deleteImagePath);

            }
            $product->name = $request->name;
            $product->slug = Str::slug($request->slug);
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->description = $request->description;
            $product->status = $request->status;
            if (isset($dbImagePath)) {
                $product->image = $dbImagePath;
            }
            $product->update();
            return redirect()->back()->with('success','Product updated successfully!');
        }catch(Exception $e){
            Log::error("product update: ".$e->getMessage());
            return redirect()->back()->with('error','Something went wrong! Please try again!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product){
        try{
                $product->delete();
                return redirect()->back()->with('success','Product deleted successfully');

        }catch(Exception $e){
                Log::error("product delete: ".$e->getMessage());
                return redirect()->back()->with('error','Something went wrong! Please try again!');
    
        }
    }
}
