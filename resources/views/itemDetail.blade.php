@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col">
        <h1>Item Details</h1>
        <img src={{$details->image}} />
        <p>
            Name:  {{$details->name}}
        </p>
        <p>
            Description:  {{$details->description}}
        </p>
        <p>
            Price:  {{$details->price}}
        </p>

    </div>
</div>
</div>

@endsection
