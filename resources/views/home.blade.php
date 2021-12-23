@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>

        <div class="col-md-4 my-5">
            <div class="card">
                <div class="card-header bg-info">Categories</div>

                <div class="card-body">
                    <h3 class="display-3">50</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 my-5">
            <div class="card ">
                <div class="card-header bg-success">Products</div>

                <div class="card-body">
                    <h3 class="display-3">50</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 my-5">
            <div class="card">
                <div class="card-header bg-primary">Users</div>

                <div class="card-body">
                    <h3 class="display-3">50</h3>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
