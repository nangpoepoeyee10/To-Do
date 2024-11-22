@extends('master')
@section('content')

   <div class="container">
    <div class="row mt-5">
        <div class="col-5">
           <div class="p-3">
           @if (session('insertSuccess'))
           <div class="alert-message">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('insertSuccess')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        </div>

           @endif

           @if (session('updateSuccess'))
           <div class="alert-message">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{session('updateSuccess')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        </div>

           @endif


            <form action="{{route('post#create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="text-group  mb-3">
                    <label for="">Post Title</label>
                    <input type="text" name="postTitle" class="form-control @error ('postTitle') is-invalid @enderror" value="{{old('postTitle')}}" placeholder="Enter Post Title" >
                    @error('postTitle')
                     <div class="invalid-feedback">
                        {{$message}}
                     </div>
                    @enderror
                </div>
                <div class="text-group mb-3">
                    <label for="">Post Description</label>
                    <input type="text" name="postDescription" class="form-control  @error ('postDescription') is-invalid @enderror" value="{{old('postDescription')}}" placeholder="Enter Post description" >
                    @error('postDescription')
                    {{-- <small class="text-danger">Post Description is requirdd</small> --}}
                    <div class="invalid-feedback">
                        {{$message}}
                     </div>

                    @enderror
                </div>
                <div class="text-group  mb-3">
                    <label for="">Image</label>
                    <input type="file" name="postImage" class="form-control @error ('postImage') is-invalid @enderror" value="{{old('postImage')}}" >
                    @error('postImage')
                    <div class="invalid-feedback">
                       {{$message}}
                    </div>
                   @enderror
                </div>
                <div class="text-group  mb-3">
                    <label for="">Fees</label>
                    <input type="number" name="postFee" class="form-control @error ('postFee') is-invalid @enderror" value="{{old('postFee')}}" placeholder="Enter Fees" >
                    @error('postFee')
                    <div class="invalid-feedback">
                       {{$message}}
                    </div>
                   @enderror
                </div>
                <div class="text-group  mb-3">
                    <label for="">Address</label>
                    <input type="text" name="postAddress" class="form-control  @error ('postAddress') is-invalid @enderror" value="{{old('postAddress')}}" placeholder="Enter Address" >
                    @error('postAddress')
                    <div class="invalid-feedback">
                       {{$message}}
                    </div>
                   @enderror
                </div>
                 <div class="text-group  mb-3">
                    <label for="">Rating</label>
                    <input type="number" name="postRating" min="0" max="5" class="form-control  @error ('postRating') is-invalid @enderror" value="{{old('postRating')}}"  placeholder="Enter post Rating" >
                    @error('postRating')
                    <div class="invalid-feedback">
                       {{$message}}
                    </div>
                   @enderror
                </div>
                <div class=" mb-3">
                    <input type="submit" value="Create" class="btn btn-danger">
                </div>
             </form>
           </div>
        </div>

        <div class="col-7">
                <div class="d-flex justify-content-around">
                    <div class="">Total = {{$posts->total()}}</div>
                    <form action="{{ route('post#createPage')}}" method="get">
                        <div class="d-flex">
                        <input type="text" class="form-control offset-2 " name="searchKey" value="{{ request('searchKey')}}" placeholder="Enter search key">
                        <button class="btn btn-outline-danger" type="submit">Search</button>
                    </div>
                    </form>
                </div>

            <div class="data-container">
            @if (count($posts)!=0)
            @foreach ($posts as $items )

            <div class="post p-3 shadow-sm mb-2">
                <div class="row">
                    <h5 class="col-6">{{$items->title}}</h5>
                    <span class="col">{{$items['created_at']}}</span>
                </div>

                {{-- <p class="text-muted">{{substr($items['description'],0,10)}}</p> --}}
                <p class="text-muted">{{Str::words($items['description'],10,'...')}}</p>

               <span>
                <i class="fa-solid fa-money-check-dollar text-primary"></i> {{$items->price}} kyats
               </span> |
               <span><i class="fa-solid fa-location-dot text-danger"></i>{{$items->address}}</span> |
               <span>{{$items->rating}} <i class="fa-solid fa-star text-warning"></i></span>


                <div class="text-end d-flex mt-2">
                   {{-- <a href="{{route('post#delete', $items['id']) }}">
                    <button class="btn btn-danger"><i class="fa-solid fa-trash">ဖျက်ရန်</i></button>
                   </a> --}}

                   <form action="{{route('post#delete',$items['id'])}}" method="post">

                    @csrf
                    @method('delete')
                    <button class="btn btn-danger"><i class="fa-solid fa-trash">ဖျက်ရန်</i></button>
                   </form>
                   <a href="{{ route('post#update',$items['id'])}}">
                    <button class="btn btn-primary">အပြည့်အစုံဖတ်ရန်</button>
                   </a>
                </div>
            </div>
            @endforeach
            @else
            <h3 class="text-danger text-center mt-5">There is no data</h3>

            @endif

            {{ $posts->appends(request()->query())->links()}}

            {{-- @for ($i=0; $i<count($posts); $i++)

                <div class="post p-3 shadow-sm mb-2">
                <h5>{{$posts[$i]['title']}}</h5>
                <p class="text-muted">{{$posts[$i]['description']}}</p>
                <div class="text-end">
                    <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                    <button class="btn btn-primary"><i class="fa-solid fa-angles-right"></i></button>
                </div>
            </div>

            @endfor --}}


            </div>
        </div>
    </div>
   </div>
@endsection
