@extends('layouts.app')

@section('content')

    <div class="jumbotron p-2 m-4">
        <h3 class=""> 
            <a class="btn btn-success btn-lg" href="{{route('admin.category.create')}}" role="button">Add New Category </a>
        </h3>
    </div>
    <h1 class=" p-3 border display-4">  All Categories  </h1>

    <div class="container">
        <div class="row">
            <div class="col-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$row->name}} </td>
                        <td>
                            <a href="{{route('admin.category.edit',$row->id)}}" class="btn btn-info">Edit <i class="bi bi-pencil-square"></i></a>
                        </td>
                        <td>
                            <form method="POST" action="{{route('admin.category.destroy',$row->id)}}">
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
        </div>
    </div>


@endsection