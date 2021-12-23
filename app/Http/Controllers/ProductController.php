<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::with('category')->paginate(30);
        return view('products.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->doValidate($request);

        $imageName = 'product'.time().'.'.$request->image->extension();  
        $request->image->move(Product::PRODUCT_PATH, $imageName);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->description = $request->description;
        $product->image = $imageName;
        $product->save();

        return back()->with("success","data added successfully");

    }

  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->doValidate($request);

        if($request->has('image')){
            // delete file if exist 
            $this->removeImage(Product::PRODUCT_PATH.$product->image);
            $imageName = 'product'.time().'.'.$request->image->extension();  
            $request->image->move(Product::PRODUCT_PATH, $imageName);
            $product->image = $imageName;

        }
        

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->description = $request->description;
        $product->save();

        return back()->with("success","data updated successfully");
    }



    private function doValidate($request){
        if($request->method == "POST"){
            $request->validate([
                'category_id'=>'required|integer|exists:categories,id',
                'name'=>'required|string|min:3|max:150',
                'price'=>'required|integer',
                'qty'=>'required|integer',
                'image'=>'required|image|mimes:png,jpg,jpeg,gif,webp|max:11000',
            ]);
        }else{
            $request->validate([
                'category_id'=>'required|integer|exists:categories,id',
                'name'=>'required|string|min:3|max:150',
                'price'=>'required|integer',
                'qty'=>'required|integer',
                'image'=>'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:11000',
            ]);
        }
        
    }

    // remove file if exist 
    private function removeImage($imagePath){
        if(\File::exists(public_path($imagePath))){
            \File::delete(public_path($imagePath));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->removeImage(Product::PRODUCT_PATH.$product->image);
        $product->destroy($product->id);
        return back()->with("success","data deleted successfully");
        
    }
}
