@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center text-center mb-5">
    @if (session('message'))
    <div class="alert msg alert-success">
        {{ session('message') }}
    </div>
@endif
      <div class="col-12 my-5">
          <h1>Bentornato Admin!</h1>
      </div>
  </div>
</div>

<div class="container my-5">
  <div class="row my-5">
    <div class="col-12 col-md-6">
      <div>
        <img class="img-fluid img-admin" src="/img/foto.png" alt="">
    </div>
    </div>
    <div class="col-12 col-md-6">
      <h1 class="mb-5">Mario Rossi</h1>
      <h3 class="mt-5">Info:</h3>
      <ul class="list-unstyled">
        <li><i class="fas fa-at fa-2x my-2"><a href="" class="text-decoration-none social mx-2">mario@rossi.it</a></i></li>
        <li><i class="fas fa-phone fa-2x my-2"><a href="" class="text-decoration-none social mx-1"></a>123456789</i></li>
        <li><i class="fas fa-map-marker-alt fa-2x my-2"><a href="" class="text-decoration-none social mx-3">Via lorem,123</a></i></li>
      </ul>
    </div>
  </div>
@if (count($posts)== 0)
  <div class="container">
      <div class="row">
          <div class="col-12">
              <h1 class="text-center">There is no post!</h1>
          </div>
      </div>
  </div>
@else
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Manage your ads</h1>

            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Whiskey</th>
                    <th scope="col">Category</th>
                    <th scope="col">Published</th>
                    <th scope="col">manage</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td><a href="{{route('post.show',$post)}}" class="text-decoration-none text-second">{{ $post->title }}</a></td>
                        <td><a href="{{route('post.category',$post->category)}}" class="text-decoration-none text-second">{{ $post->category->name}}</a></td>
                        <td>{{ $post->created_at->format('d/m/y')}}</td>
                        <td class="w-25"><a href="{{ route('post.edit',$post) }}" class="btn button btn-sm float-left">Edit ads</a>
                           <form action="{{route('post.destroy',$post)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button  class="btn-sm btn ml-2 text-danger button text-decoration-none">Delete</button>
                           </form>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>

        </div>
    </div>
</div>
@endif
    
@endsection