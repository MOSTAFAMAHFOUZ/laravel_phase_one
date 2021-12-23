@extends('layouts.app')

@section('content')

<div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-success btn-lg" href="{{route('admin.product.create')}}" role="button">Add New Product </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  All Products  </h1>

    <div class="container">
        <div class="row">
            <div class="col-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>
                            @if($row->category)
                            {{$row->category->name}} 
                            @endif
                        </td>
                        <td> {{$row->name}} </td>
                        <td>{{$row->price}} </td>
                        <td>{{$row->qty}} </td>
                        <td>
                            <img src="{{asset('uploads/products/'.$row->image)}}" width="50" alt="">
                        </td>
                        <td>
                            <a href="{{route('admin.product.edit',$row->id)}}" class="btn btn-info">Edit <i class="bi bi-pencil-square"></i></a>
                        </td>
                        <td>
                            <form method="POST" action="{{route('admin.product.destroy',$row->id)}}">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete <i class="bi bi-x-square-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
                </table>

               
            </div>
            <div class="d-flex justify-content-center">
                {!! $data->links() !!}
            </div>
        </div>
    </div>

@endsection