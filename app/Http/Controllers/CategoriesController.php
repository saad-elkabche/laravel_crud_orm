<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("categories.categories",["categories"=>Category::all()]);   //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categories.create");
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
            "categoryName"=>"required|string|max:100",
            "img"=>"required|image|mimes:jpeg,png,jpg"
        ]);
        $name=$request->input("categoryName");
        $imgFileExtenssion='.'. $request->file('img')->getClientOriginalExtension();

        $fileName=str_replace(' ','',$name) .time().$imgFileExtenssion;

        $request->file("img")->storeAs('public/categories_images',$fileName);
        
        $category=new Category();
        $category->name=$name;
        $category->img=$fileName;

        $category->save();

        return redirect()->route("categories.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products=Category::find($id)->products;
        //dump($category->img);
        return view("categories.show",compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $category=Category::find($id);
        return view("categories.edit",compact("category"));
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
       
       
        $category= Category::find($id);


        $request->validate(
            [
                "categoryName"=>"required|string|max:50",
                "img"=>"image|mimes:png,jpeg,jpg"
            ]
            );
        
        $newName=$request->input("categoryName");
        if($request->hasFile('img')){
            //return "hello world";
            $newfileName=$newName . time() . ".". $request->file("img")->getClientOriginalExtension();
            $request->file('img')->storeAs('public/categories_images',$newfileName);
            $this->deleteImg($category->img);
            $category->img=$newfileName;
        }

        $category->name=$newName;
        $category->save();
        

       
        
       return redirect()->route('categories.index');
    }


    private function deleteImg($filename){
        
        if(Storage::disk('public')->exists("categories_images/".$filename)){
            Storage::disk('public')->delete("categories_images/".$filename);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $category= Category::find($id);
        $this->deleteImg($category->img);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
