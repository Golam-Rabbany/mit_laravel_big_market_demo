@extends('frontend.frontend_main')

<style>
    .cart-delete-btn:hover{
        background-color: green;
    }
</style>

@section('content')
<section class="my-5">
    <div class="container">
        <div class="row">
            <table class="table table-striped">
                <thead class=" bg-success ">
                  <tr>
                    <th scope="col">Action</th>
                    <th scope="col">Id</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Photo</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                  </tr>
                </thead>

                <tbody>
                    @php
                        $sub_total = 0;
                    @endphp

                    @if(Session::get('cart'))
                @foreach($carts as $cart_data)
                  <tr>
                    
                    <td>
                        <form action="{{route('cart.destroy',$cart_data['product_id'])}}" method="post">
                            @csrf 
                            @method('delete')
                            <button type="submit" onclick="return confirm('Do you Want to Delete')"> 
                                <i class="fa-solid fa-trash p-2 fs-3 cart-delete-btn" style="color:rgb(155, 2, 2); cursor: pointer;"></i>
                            </button>
                        </form>
                    
                    </td>
                    
                    <td>{{$loop -> iteration}}</td>
                    <td>{{$cart_data['product']->product_name}}</td>

                    <td>
                        <img src="{{asset('uploads/product/'.$cart_data['product']->product_photo)}}" width="100px" height="100px" alt="">
                    </td>
                    <td>{{$cart_data['product']->sale_price}}</td>
                    <td>
                        <form action="{{route('cart.update',$cart_data['product_id'])}}" method="POST" id="form">
                          @csrf()
                          @method('put')
                        <input name="quantity" type="number" onclick="form.submit()" min="1" class="border pl-2" style="height: 70px; width:70px;" value="{{$cart_data['quantity']}}" style="width: 50px!important">
                    </form>
                    </td>
                    <td>{{$total_price = $cart_data['product']->sale_price * $cart_data['quantity']}}</td>
                  </tr>
                  @php
                    $sub_total = $sub_total + $total_price;
                  @endphp
                  @endforeach

                  <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th class="fs-4">Sub Total :</th>
                      <th class="fs-4">{{$sub_total}}</th>
                  </tr>
                  @else
                  <div>
                      <tr>
                          <td colspan="50" class="text-center text-danger">Empty</td>
                      </tr>
                  </div>
                  @endif
                </tbody>
            </table>

            @if(Session::get('cart'))
                <div>
                <a href="{{route('checkout.index')}}" type="submit" class="btn bg-info text-white float-end">Checkout</a>
            </div>
            
            @else
            
            @endif

            

        </div>
    </div>
</section>

@endsection