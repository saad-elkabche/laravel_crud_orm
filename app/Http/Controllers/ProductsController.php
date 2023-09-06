<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= DB::table("products")
        ->join("categories" ,"products.category_id","=","categories.id")
        ->select("products.*","categories.name as category_name","categories.img as category_img")
        ->get();
        //dump($products);
      
        return view("products.products",compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view("products.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dump($request->all());
        $request->validate(
            [
              "name"=>"required|max:70",
              "description"=>"required",
              "price"=>"required",
              "img"=>"required|image|mimes:jpg,png,jpeg"  
            ]
            );
        $name=$request->input('name');
        $description=$request->input('description');
        $price=$request->input('price');
        $category_id=$request->input('category');
        
        //image
        $imageFileName=str_replace(' ','',$name) . time() . "." . $request->file('img')->getClientOriginalExtension();

        $request->file('img')->storeAs('/public/products_images',$imageFileName);

        //store record
            $product=new Product();
            $product->name=$name;
            $product->description=$description;
            $product->price=$price;
            $product->category_id=$category_id;
            $product->img=$imageFileName;

            $product->save();

            return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $categories=Category::all();
        return view("products.edit",compact("product","categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dump($request->all());
        $request->validate(
            [
                "name"=>"required|max:50",
                "description"=>"required",
                "price"=>"required",
                "category"=>"required"
            ]
        );
        //retrieve inputs
        $name=$request->input('name');
        $description=$request->input('description');
        $price=$request->input('price');
        $category_id=$request->input('category');

        $product=Product::find($id);
        
        if($request->hasFile("img")){
            $imgNewFileName=str_replace(' ','',$name) . time() . '.' .$request->file("img")->getClientOriginalExtension();
            $request->file('img')->storeAs("/public/products_images",$imgNewFileName);
            $this->deleteImg($product->img);
            $product->img=$imgNewFileName;
        }

        $product->name=$name;
        $product->price=$price;
        $product->description=$description;
        $product->category_id=$category_id;

        $product->save();

        return redirect()->route('products.index');

    }

    private function deleteImg($fileName){
        $fileSystem=Storage::disk("public");
        $path='products_images/'.$fileName;

        if($fileSystem->exists($path)){
            $fileSystem->delete($path);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $this->deleteImg($product->img);
        $product->delete();
        return redirect()->route("products.index");
    }
}
