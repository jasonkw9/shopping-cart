@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>{{ __('Shop') }}</h1>
        </div>
    </div>
    @if(Session::has('success-add-to-cart'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>
                {{ Session::get('success-add-to-cart') }}
            </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        @foreach ($items as $item)
            <div class="col-xl-3 col-md-4" style="margin-bottom:15px;">
                <div class="card">
                    <img class="card-img-top" src="{{$item->image}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->name}}</h5>
                        <p class="card-text">
                            {{$item->description}}
                        </p>
                        <div style="text-align:center;">
                            <a href="{{ url('add-to-cart/'.$item->id) }}" class="btn btn-primary">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
