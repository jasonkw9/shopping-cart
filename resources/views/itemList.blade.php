@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
            <tr>
                <th scope="row">{{$item->name}}</th>
                <td>{{$item->description}}</td>
                <td>{{$item->price}}</td>
                <td>
                    <a href="/items/{{$item->id}}">
                        View
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection
