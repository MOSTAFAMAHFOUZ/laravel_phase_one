@extends('layouts.app')

@section('content')
<div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-primary btn-lg" href="{{route('admin.user.index')}}" role="button">View All Users </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  Add New User  </h1>

    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto">
            <form class="p-4 m-3 border bg-gradient-info" enctype="multipart/form-data" action="{{route('admin.user.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name"> Name</label>
                        <input type="text" name="name" class="form-control" id="name" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" >
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" name="password" class="form-control" id="pass" >
                    </div>
                    <div class="form-group">
                        <label for="cat">Type</label>
                        <select name="type" class="form-control"  id="">
                            <option value="admin">admin</option>
                            <option value="editor">editor</option>
                            <option value="super_admin">super_admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cat">Product Image</label>
                        <input type="file" name="image" class="form-control"  >
                    </div>
        
                    <button type="submit" class="btn btn-success my-2">
                        <i class="bi bi-reply-all-fill"></i> Submit
                     </button>
                </form>
            </div>
        </div>
    </div>


@endsection