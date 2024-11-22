@extends('master')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
 <div class="container">
    <div class="row mt-5">
        <div class="col-6 offset-3"></div>
        <div class="my-3 ">
           <a href="{{ route('post#home')}}" class="text-decoration-none text-black"> <i class="fa-solid fa-backward" ></i> &nbsp; Back</a>
        </div>

        <h3>{{$post[0]['title']}}</h3>
        <div class="d-flex">
            <div class="btn btn-sm bg-dark text-white m-1">  <i class="fa-solid fa-money-check-dollar text-primary"></i> &nbsp;{{ $post[0]['price']}} Kyats</div>
            <div class="btn btn-sm bg-dark text-white m-1"><i class="fa-solid fa-location-dot text-danger"></i>&nbsp;{{ $post[0]['address']}}</div>
            <div class="btn btn-sm bg-dark text-white m-1">{{ $post[0]['rating']}}&nbsp; <i class="fa-solid fa-star text-warning"></i>
            </div>
        </div>
        <div class="">
            @if ($post[0]['image']== null)
            <img src="{{asset('/storage/404image.jpeg')}}" class="img-thumbnail my-2 shadow-sm">
            @else
            <img src="{{asset('/storage/'.$post[0]['image'])}}" class="img-thumbnail my-2 shadow-sm">
            @endif
        </div>

        <p class="text-muted">{{$post[0]['description']}}</p>


    </div>
    <div class="row my-3">
        <div class="col-3 offset-7">
            <a href="{{ route('post#editPage',$post[0]['id'])}}"><button class="btn btn-dark">Edit</button></a>
        </div>
    </div>
 </div>
</body>
</html>
