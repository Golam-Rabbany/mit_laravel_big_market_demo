@extends('frontend.frontend_main')

@section('content')
<section class="my-5">
    <div class="container">
        <div class="row">
            <table class="table">
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
                <tbody class="bg-wheate">
@php 
    $sub_total = 0;
 @endphp
                	@foreach($carts as $cart)
                    <tr>
                        <td></td>
                        <td>{{$loop->iteration}}</td>
                      <th>{{$cart['product_name']}}</th>
                        <td>
                            <img src="{{asset('uploads/product/'.$cart['product_photo'])}}" height="50px" width="50px" alt="">
                        </td>
                      <td>{{$cart['product']->sale_price}}</td>
                      <td>{{$cart['quantity']}}</td>
                      <td>&#2547; {{$unit_price = $cart['quantity']*$cart['product']->sale_price}}</td>
                    </tr>
                    @php
                        $sub_total = $sub_total + $unit_price
                    @endphp
                    @endforeach
                </tbody>
            </table>

            <div class="">
                <span class="float-end" style="margin-right: 7.4rem;"><span class="fs-4">Sub Total : </span><span class="fs-4">&#2547; {{$sub_total}}</span></span>
            </div>

            <div class="mb-3 mt-3" style="border-bottom:0.5px solid #555">
                <span class="float-end fs-5" style="margin-right: 9.4rem;"><span>Delivary Charge : </span><span>&#2547; 60</span></span>
            </div>

            <div class="">
                <span class="float-end" style="margin-right: 7.4rem;"><span class="fs-4">Total : </span><span class="fs-4">&#2547; {{$sub_total + 60}}</span></span>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
    <div class="col-lg-8">
        <div class="row">
        <div class="col-lg-6 mb-3">
            <label>Division</label><br>
            <select id="division" class="form-control">

              <option value="volvo">----selete---</option>
              @foreach($divisions as $divi)
              <option value="{{$divi->id}}">{{$divi->name}}</option>
              @endforeach

            </select>
        </div>
        <div class="col-lg-6 mb-3">
            <label>District</label><br>
            <select id="district" class="form-control">

              <option value="district">----selete---</option>

            </select>

        </div>
        <div class="col-lg-6 mb-3">
            <label>Thana</label><br>
            <select id="thana" class="form-control">

              <option value="thana">----selete---</option>


            </select>

        </div>
        <div class="col-lg-6 mb-3">
            <label>Union</label><br>
            <select id="union" class="form-control">

              <option value="union">----selete---</option>


            </select>

        </div>
        
        </div>
    </div>
    </div>
    </div>
    <div class=""> 
        <button class="btn btn-primary ">Place Order</button>
    </div>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type=text/javascript>
  
      $('#division').change(function(){
      var division_id = $(this).val();
      if(division_id){
        $.ajax({
          type:"GET",
          url:"{{url('get-district-list')}}?division_id="+division_id,

          success:function(res){
            console.log(res)
          if(res){
            $("#district").empty();
            $("#thana").html('<option selected disabled>Please select Thana*</option>');
            $("#district").append('<option selected disabled>Please select District*</option>');
            $.each(res,function(key,value){
              $("#district").append('<option value="'+key+'">'+value+'</option>');
            });
  
          }else{
            $("#district").empty();
          }
          }
        });
      }else{
        $("#district").empty();
        $("#thana").empty();
      }
      });

      $('#district').on('change',function(){
      var district_id = $(this).val();
      if(district_id){
        $.ajax({
          type:"GET",
          url:"{{url('get-thana-list')}}?district_id="+district_id,
          success:function(res){
            console.log(res)
          if(res){
            $("#thana").empty();
            $("#thana").append('<option selected disabled>Please select Thana*</option>');
            $.each(res,function(key,value){
              $("#thana").append('<option value="'+key+'">'+value+'</option>');
            });
  
          }else{
            $("#thana").empty();
          }
          }
        });
      }else{
        $("#thana").empty();
      }
  
      });


      $('#thana').on('change',function(){
      var thana_id = $(this).val();
      console.log(thana_id);
      if(thana_id){
        $.ajax({
          type:"GET",
          url:"{{url('get-union-list')}}?thana_id="+thana_id,
          success:function(res){
            console.log(res)
          if(res){
            $("#union").empty();
            $("#union").append('<option selected disabled>Please select union*</option>');
            $.each(res,function(key,value){
              $("#union").append('<option value="'+key+'">'+value+'</option>');
            });
  
          }else{
            $("#union").empty();
          }
          }
        });
      }else{
        $("#union").empty();
      }
  
      });


      
    </script>

@endsection