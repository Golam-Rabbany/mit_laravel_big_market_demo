<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\Product;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $products = Product::select(['id', 'product_name', 'sale_price', 'product_photo'])
            ->whereIn('id', array_column($cart, 'product_id'))->get()->keyBy('id');

        $carts = collect($cart)->map(function ($data) use ($products) {
            $data['product'] = $products[$data['product_id']];
            return $data;
        });

        return view('backend.cart.index',compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->session()->has('cart')){
            foreach(Session::get('cart') as $addcart){
                if($addcart['product_id'] == $request->product_id){
                    return back();
                }
            }
            Session::push('cart', [
                'product_id'=>$request->product_id,
                'product_name'=>$request->product_name,
                'price'=>$request->sale_price,
                'quantity'=>$request->quantity,
                'product_photo'=>$request->product_photo,
            ]);
            return back();

        }else{
            Session::push('cart', [
                'product_id'=>$request->product_id,
                'product_name'=>$request->product_name,
                'price'=>$request->sale_price,
                'quantity'=>$request->quantity,
                'product_photo'=>$request->product_photo,
            ]);
            return back();
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
         $item = Session::get('cart', []);
        foreach ($item as $key => $cart) {
            if ($cart['product_id'] == $id) {
                $item[$key]['quantity'] = $request->quantity;
            }
        }
        Session::put('cart', $item);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Session::put('cart', array_filter(Session::get('cart', []), function ($item) use ($id) {
            return $item['product_id'] != $id;
        }));

        return redirect()->back()->with('delete');
    }
}
