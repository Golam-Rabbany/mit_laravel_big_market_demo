@extends('frontend.frontend_main')


@section('content')

<span class="float-end mr-5 mb-3"><a class="btn btn-info" href="{{route('cart.index')}}"><span class="fs-4">Cart</span> <br> <span class="text-warning fs-5">@if(Session::has('cart')){{count(Session::get('cart'))}}@else 0 @endif</span></a></span>


  
  <section id="category">
    <h4 class="mb-2" style="text-align: center;">Top Categories</h4>
    <div class="container">
      <div class="row justify-content-center">
       @foreach(App\Models\Category::all() as $categorys)
        <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2 p-2">
          <div class="category-body category-col ">
            <h6 class="text-center text-align-center">{{$categorys->category_name}}</h6>
            <div class="w-100 d-flex justify-content-center">
              <a href="{{route('product.category_product',$categorys->id)}}" style="text-decoration: none;">
                <img class="mx-auto" src="{{asset('uploads/category/'.$categorys->category_photo)}}" alt="">
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>


    <section id="product">
    <h4 class="mb-2" style="text-align: center;">Featured Products</h4>
    <div class="container">
      <div class="row">
        @foreach(App\Models\Product::all() as $products)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 mt-4">
          <div class="card product-card" style="width: 15rem;">
            <a href="{{route('product.singleproduct',$products->id)}}" style="text-decoration: none">
            <img src="{{asset('uploads/product/'.$products->product_photo)}}" class="card-img-top" alt="...">
          </a>
            <div class="card-body product-body" >
              <div class="d-flex mb-2 justify-between" style="margin-bottom: -2rem;">
                <span>{{$products->product_name}}</span>
                <div class="float-end ml-3">
                  <span style="color:red"><s>$ {{$products->main_price}}</s></span><span  style="color:red"><s></s></span>
                  <span class="ml-1">$ {{$products->sale_price}}</span><span></span>
                </div> 
              </div>
              <div class="product-selece mb-2">
                <select name="" class="form-control" id="">
                  <option value="">----Please Select-----</option>
                  <option value="">1kg</option>
                  <option value="">4kg</option>
                  <option value="">9kg</option>
                </select>

                <span>Under Category : </span><span>{{App\Models\Category::find($products->category_id)->category_name  }}</span>
              </div>
              <form action="{{route('cart.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" name="product_id" value="{{$products->id}}">
                  <input type="hidden" name="product_name" value="{{$products->product_name}}">
                  <input type="hidden" name="price" value="{{$products->sale_price}}">
                  <input type="hidden" name="product_photo" value="{{$products->product_photo}}">

                <div class="d-flex justify-content-between">
                  <div>
                    <input type="number" name="quantity" value="1" min="1" class="product-input pl-2 mt-2">
                  </div>
                  <div class="">
                    <button type="submit" class="btn-sm product-button mt-2">Add</button>
                  </div>

                </div>
              </form>
            </div>
            
          </div>
        </div> 
        @endforeach
      </div>
    </div>
  </section>




@endsection

