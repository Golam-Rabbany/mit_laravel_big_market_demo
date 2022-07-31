@extends('backend.dashboard_main')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Product Form</h3>

            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mt-3">
                    <label for="" class="label-control mb-2">Category Name</label><br>
                    <select class="form-control" name="category_id">
                        <option>---select---</option>
                        @foreach($category as $categorys)
                        <option value="{{$categorys->id}}">{{$categorys->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="" class="label-control mb-2">Product Name</label><br>
                    <input type="text" class="form-control" name="product_name">
                </div>
                <div class="mt-3">
                    <label for="" class="label-control mb-2">Productt Photo</label><br>
                    <input type="file" class="form-control" name="product_photo">
                </div>
                 <div class="mt-3">
                    <label for="" class="label-control mb-2">Product Main Price</label><br>
                    <input type="number" class="form-control" name="main_price">
                </div>
                <div class="mt-3">
                    <label for="" class="label-control mb-2">Product Sale Price</label><br>
                    <input type="number" class="form-control" name="sale_price">
                </div>
                <div class="mt-3">
                    <label for="" class="label-control mb-2">Product Short Desc</label><br>
                    <textarea class="form-control" rows="2" cols="40" name="short_desc"></textarea>
                </div>
                <div class="mt-3">
                    <label for="" class="label-control mb-2">Product Long Desc</label><br>
                    <textarea class="form-control" name="long_desc"></textarea>
                </div>
                <div class="mt-3">
                    <label for="" class="label-control mb-2">Product Quantity</label><br>
                    <input type="number" class="form-control" name="quantity">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                </div>
            
            </form>
        </div>
    </div>
    
@endsection