<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;


class UnionController extends Controller
{
    public function index(){
        $divisions = DB::table('divisions')->select("id", "name")->get();
        return view('unions.index', compact('divisions'));
    }
    public function getDistrictList(Request $request){
        $districts = DB::table('districts')
        ->where("division_id",$request->division_id)
        ->pluck("name","id");
        return response()->json($districts);
    }
    public function getThanaList(Request $request){
        $districts = DB::table("thanas")
        ->where("district_id",$request->district_id)
        ->pluck("name","id");
        return response()->json($districts);
    }
    public function getUnionList(Request $request){
        $unions = DB::table("unions")
        ->where("thana_id",$request->thana_id)
        ->pluck("name","id");
        return response()->json($unions);
    }
}