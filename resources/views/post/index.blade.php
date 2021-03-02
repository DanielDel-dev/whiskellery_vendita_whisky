@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row">
    
    @foreach ($posts as $post)
    <div class="col-12 col-md-3 my-3">
            <div data-aos="zoom-in" class="card bg-transparent border-0 mx-2">
                <img src="{{Storage::url($post->images()->first()->url)}}" class="card-img-top img-fluid img-cardSize" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text text-truncate">{{$post->body}}</p>
                    <p class="font-weight-bold"><i class="far fa-credit-card mr-1"></i>{{$post->price}}€</p>
                    <small class="d-block"> <strong>Category:</strong>{{ $post->category->name }}</small>
                    @foreach ($post->tags as $tag)
                    <a href="#" class="badge badge-secondary font-weight-light">{{ $tag->name }}</a>
                    @endforeach
                    <hr>
                    <a href="{{route('post.show',$post)}}" class="btn button-edit">Go somewhere</a>
                </div>
            </div>
        </div>
    @endforeach
    
  </div>        
</div>

@endsection