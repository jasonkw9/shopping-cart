@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col">
        <h1>User Details</h1>
        <p>
            Name:  {{$details->name}}
        </p>
        <p>
            Email:  {{$details->email}}
        </p>
        <p>
            User Type:  {{$details->type}}
        </p>
        <p>
            Created at:  {{$details->created_at}}
        </p>
    </div>
</div>
</div>

@endsection
