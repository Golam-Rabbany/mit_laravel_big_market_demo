<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('backend.product.index',compact('category'));
    }

    public function singleproduct($id){
       $products = Product::where('id', $id)->firstOrFail();
       $related_products = Product::where('category_id', $products->category_id)->where('id', '!=', $products->id)->get();
        
        return view('backend.product.singleproduct',compact('products','related_products'));
    }

    public function category_product($id){
        $category_products = Category::where('id', $id)->with('product')->first();
        return view('backend.product.category_product',compact('category_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('product_photo')){
            $uploaded = $request->file('product_photo');
            $extention=$uploaded->getClientOriginalName();
            $filename=time().rand(0,9999).'.'.$extention;
            $uploaded->move('uploads/product/',$filename);

            Product::insert($request->except('_token','product_photo') + [
            'slug' => Str::slug($request->product_name)."_".Str::random(4).rand(0,1000),
            'product_photo'=> $filename,
            'created_at' => Carbon::now(),
        ]);
        }else{
            return 'amr bal chera gelo';
        }

        
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
