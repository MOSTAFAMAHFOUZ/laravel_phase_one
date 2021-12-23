@extends('layouts.app')

@section('content')


    <div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-primary btn-lg" href="{{route('admin.product.index')}}" role="button">View All Products </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  Edit Product  </h1>

    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto">
            <form class="p-4 m-3 border bg-gradient-info" enctype="multipart/form-data" action="{{route('admin.product.update',$product->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="cat">Category</label>
                        <select name="category_id" class="form-control"  id="cat">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{option($category->id,$product->category_id)}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cat">Product Name</label>
                        <input type="text" value="{{$product->name}}" name="name" class="form-control" id="cat" >
                    </div>


                    <div class="form-group">
                        <label for="cat">Product Price</label>
                        <input type="text" value="{{$product->price}}" name="price" class="form-control" id="cat" >
                    </div>
                    <div class="form-group">
                        <label for="cat">Product Quantity</label>
                        <input type="text" value="{{$product->qty}}" name="qty" class="form-control" id="cat" >
                    </div>

                    <div class="form-group">
                        <label for="cat">Product Image</label>
                        <input type="file" name="image" class="form-control"  >
                        <img src="{{asset('uploads/products/'.$product->image)}}" width="50" alt="">
                    </div>

                    <div class="form-group">
                        <label for="cat">Product Description</label>
                        <textarea name="description" class="form-control" rows="10">{{$product->description}}</textarea>
                    </div>



                    
        
                    <button type="submit" class="btn btn-success my-3">
                        <i class="bi bi-reply-all-fill"></i> Submit
                     </button>
                </form>
            </div>
        </div>
    </div>

@endsection