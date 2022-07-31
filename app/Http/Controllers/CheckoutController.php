<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

use lemonpatwari\bangladeshgeocode\Models\Division;
use lemonpatwari\bangladeshgeocode\Models\District;
use lemonpatwari\bangladeshgeocode\Models\Thana;
use lemonpatwari\bangladeshgeocode\Models\Union;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Session::get('cart', []);

        $products = Product::select(['id','product_name','sale_price','product_photo'])
            ->whereIn('id', array_column($cart, 'product_id'))->get()->keyBy('id');

        $carts= collect($cart)->map(function ($data) use ($products) {
            $data['product'] = $products[$data['product_id']];
            return $data;
        });


        //division, district, thana
        $divisions = Division::all();
        $districts = District::all();
        $thanas = Thana::all();
        $union = Union::all();

        $divisions = Division::with('districts')->get(); // districts hasMany
        $districts = District::with('division','thanas')->get(); //division belongsTo and thanas hasMany
        $thanas = Thana::with('district','unions')->get(); //district belongsTo and unions hasMany;
        $union = Union::all();

        $district = District::find(1);
        $thanas = $district->thanas;


        return view('backend.checkout.index',compact('carts','divisions','districts','thanas','union'));
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
        //
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
