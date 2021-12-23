@extends('layouts.app')

@section('content')
    <div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-primary btn-lg" href="{{route('admin.category.index')}}" role="button">View All Categories </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  Add New Categoery  </h1>

    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto">
                <form class="p-4 m-3 border bg-gradient-info" action="{{route('admin.category.store')}}" method="POST">
                    @csrf
                    <div class="form-group my-2">
                        <label for="cat">Category Name</label>
                        <input type="text" name="name" class="form-control" id="cat" >
                    </div>
        
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-reply-all-fill"></i> Submit
                     </button>
                </form>
            </div>
        </div>
    </div>

@endsection