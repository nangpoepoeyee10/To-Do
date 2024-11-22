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
           <a href="{{ route('post#update',$post[0]['id'])}}" class="text-decoration-none text-black"> <i class="fa-solid fa-backward" ></i> &nbsp; Back</a>
        </div>
        {{-- <h3>{{$post[0]['title']}}</h3>
        <p class="text-muted">{{$post[0]['description']}}</p> --}}
        <form action="{{route('post#updatePage')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label>Post Title</label>
            <input type="hidden" name="postId" value="{{ $post[0]['id']}}">
            <input type="text" name="postTitle" placeholder="Enter Post Title" class="form-control my-3  @error ('postTitle') is-invalid @enderror " value="{{ old('postTitle' ,$post[0]['title'])}} ">
            @error('postTitle')
                     <div class="invalid-feedback">
                        {{$message}}
                     </div>
                    @enderror
                    <label for="">Image</label>
            <div class="">
             @if ($post[0]['image']== null)
                <img src="{{asset('/storage/404image.jpeg')}}" class="img-thumbnail my-2 shadow-sm">
             @else
                <img src="{{asset('storage/'.$post[0]['image'])}}" class="img-thumbnail my-2 shadow-sm">
             @endif

            </div>

            <input type="file" name="postImage" class="form-control my-2 @error ('postImage') is-invalid @enderror" value="{{old('postImage')}}" >

            <label>Post description</label>
            <textarea name="postDescription" placeholder="Enter post description" cols="20" rows="10" class="form-control  @error ('postDescription') is-invalid @enderror" >
                {{  old('postDescription' ,$post[0]['description'])}}
            </textarea>
            @error('postDescription')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror



            <label>Post Fee</label>
            <input type="text" name="postFee" placeholder="Enter Post Fee" class="form-control my-3  " value="{{ old('postFee' ,$post[0]['price'])}} ">
            <label>Post Address</label>
            <input type="text" name="postAddress" placeholder="Enter Post Address" class="form-control my-3   " value="{{ old('postAddress' ,$post[0]['address'])}} ">
            <label>Post Rating</label>
            <input type="text" name="postRating" placeholder="Enter Post Rating" class="form-control my-3   " value="{{ old('postRating' ,$post[0]['rating'])}} ">


            <input type="submit" value="Update" class="btn btn-dark my-3 text-white float-end">
        </form>

    </div>

 </div>
</body>
</html>
