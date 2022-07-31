@extends('frontend.frontend_main')


@section('content')


@section('content')
<style>
    .single_button button:hover{
        background: gray;
    }
    .pro-details-social-info i:hover{
        color: orangered;
    }
    .pricing-meta ul li a{
        text-decoration: none;
    }
    .btn-information:hover{
        background-color: #ef4444;
        color: #fff;
    }
</style>

    

<section class="my-6">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px flex justify-center items-center bg-slate-50">
                <img src="{{asset('uploads/product/'.$products->product_photo)}}" class="w-3/5"  alt="">
            </div>
            <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                <div class="product-details-content quickview-content">
                    <div class="mt-3">
                        <h2 class="text-3xl font-bold mt-3">{{$products->product_name}}</h2>
                    </div>
                    <div class="mt-3 pricing-meta">
                        <ul class="flex">
                            <li class="main-price "><del><a class="text-2xl text-red-500 font-bold" href="">$ {{$products->main_price}}</a></del></li>
                            <li class="sale-price ml-5 "><a class="text-2xl text-red-500 font-bold" href="">$ {{$products->sale_price}}</a> </li>
                        </ul>
                    </div>
                    <div class="mt-3 pro-details-rating-wrap flex">
                        <div class="rating-product text-amber-500">
                            <i class="fa-solid fa-star text-xl"></i>
                            <i class="fa-solid fa-star text-xl"></i>
                            <i class="fa-solid fa-star text-xl"></i>
                            <i class="fa-solid fa-star text-xl"></i>
                            <i class="fa-solid fa-star text-xl"></i>
                        </div>
                        <span class="read-review ml-4 text-xl text-amber-500"><a class="reviews" href="#">( 5 Customer Review )</a></span>
                    </div>
                    <div class="mt-3">
                        <p class=" text-gray-500 text-xl"></p>
                    </div>
                    <div class="mt-3 flex single_button  items-center">
                        <form action="{{route('cart.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$products->id}}">
                              <input type="hidden" name="product_name" value="{{$products->product_name}}">
                              <input type="hidden" name="price" value="{{$products->sale_price}}">
                              <input type="hidden" name="product_photo" value="{{$products->product_photo}}">

                            <div class="d-flex justify-content-between">
                              <div>
                                <input type="number" name="quantity" style="width: 40px!important;" class="mr-4 pl-2 text-xl mt-2" value="{{$products->quantity}}">
                              </div>
                              <div class="">
                                <button type="submit" class="bg-red-500 text-gray-100 px-10 uppercase rounded py-2.5">Add to Card</button>
                              </div>

                            </div>
                          </form>
                        <i class="fa-solid fa-heart px-6 py-2.5 text-xl ml-4 bg-gray-900 text-white rounded cursor-pointer  hover:bg-red-500 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300"></i>
                        <i class="fa-solid fa-rotate px-6 py-2.5 text-xl ml-4 bg-gray-900 text-white rounded cursor-pointer  hover:bg-red-500 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300"></i>
                    </div>
                    <div class="mt-3">
                        <span class="text-xl font-bold ">SKU : </span><span class="text-xl text-gray-700"></span>
                    </div>
                    <div class="mt-3">
                        <span class="text-xl font-bold">Categories : </span>{{App\Models\Category::find($products->category_id)->category_name}}<span class="text-xl text-gray-700"></span>
                    </div>
                    <div class="mt-3 pro-details-social-info pro-details-same-style d-flex">
                        <span class="text-xl">Share: </span>
                        <ul class="d-flex">
                            <li class="pl-3 text-xl">
                                <a href="#"><i class="fa-brands fa-facebook text-slate-600"></i></a>
                            </li>
                            <li class="pl-3 text-xl">
                                <a href="#"><i class="fa-brands fa-twitter text-slate-600"></i></a>
                            </li>
                            <li class="pl-3 text-xl">
                                <a href="#"><i class="fa-brands fa-github text-slate-600"></i></a>
                            </li>
                            <li class="pl-3 text-xl">
                                <a href="#"><i class="fa-brands fa-youtube text-slate-600"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="container mt-5">
    <div class="text-center">
        <ul class="nav nav-pills mb-3 py-3 justify-center bg-slate-50 " id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Information</button>
            </li>
            <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Description</button>
            </li>
            <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Review</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
               
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">Suna ki jasse</div>
        </div>
    </div>
</section>

<section id="category">
    <h4 class="mb-2 fs-3" style="text-align: center;">Related Product</h4>
    <div class="container">
      <div class="row justify-content-center">
        @foreach($related_products as $related_product)
        <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2 p-2">
          <div class="category-body category-col ">
            <h6 class="text-center text-align-center">{{$related_product->product_name}}</h6>
            <div class="w-100 d-flex justify-content-center">
              <img class="mx-auto" src="{{asset('uploads/product/'.$related_product->product_photo)}}" alt="">
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
</section>


@endsection