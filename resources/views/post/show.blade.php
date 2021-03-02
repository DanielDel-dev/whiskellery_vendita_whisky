@extends('layouts.app')

@section('content')

<div class="container my-5">
  
  
  
  <div class="row">
    <div class="col-md-6">
      {{-- carosello --}}
      <div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
        <ol class="carousel-indicators">
          @foreach ($post->images as $image)
          <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index -1}}" class="{{$loop->first ? 'active' : ''}} icona"></li>
          @endforeach
        </ol>
        <div class="carousel-inner">
          @foreach ($post->images as $image)      
          <div class="carousel-item {{$loop->first ? 'active' : ''}}">
            <img class="d-block mx-auto img-fluid" src="{{Storage::url($image->url)}}">
          </div>
          @endforeach
          
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev" aria-hidden="true"><i class="fas fa-chevron-left icona"></i></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next" aria-hidden="true"><i class="fas fa-chevron-right icona"></i></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div class="col-md-6">
      <h3 class="my-3">{{ $post->title }}</h3>
      <p>{{ $post->body }}</p>
      <p class="font-weight-bold"><i class="far fa-credit-card mr-1"></i>{{$post->price}}€</p>
      <h3 class="my-3">Project Details</h3>
      <ul class="list-unstyled">
        <li class="my-2"><i class="fas fa-glass-whiskey mr-1"></i><strong>Abv:</strong> 45%</li>
        <li class="my-2"><i class="fas fa-wine-bottle mr-1"></i><strong>Format:</strong> 0.7l</li>
        <li class="my-2"><i class="fas fa-temperature-high mr-1"></i><strong class="">Serving temperature:</strong>  16/18 °C</li>
        <li class="my-2"><i class="fas fa-clock mr-1"></i><strong>Moment to taste it:</strong> Special occasions</li>
        <li class="my-2"><i class="fas fa-tag mr-1"></i><strong>Typology:</strong> Distilled</li>
      </ul>
      <p class="my-4">
        <small> <strong>Category:</strong> {{ $post->category->name }}</small>
      </p>
      @foreach ($post->tags as $tag)
      <a href="#" class="badge badge-secondary font-weight-light">{{ $tag->name }}</a>
      @endforeach
      
    </div>
    <div class="col-12 my-5 p-3 border-top border-dark">
      <div class="row">
        <div class="col-6">
          <h5>TASTING NOTES</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis at, aperiam possimus libero vero placeat labore hic quo officia maiores explicabo eveniet corrupti numquam reiciendis quidem maxime quibusdam assumenda voluptatem.</p>
        </div>
        <div class="col-6">
          <h5>DISTILLERY</h5>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis maxime quidem temporibus. Repellendus quia iure maiores iste aperiam ut, molestias impedit cum facilis, esse mollitia. Voluptate quas vero numquam tempore.</p>
        </div>
      </div>
    </div>
    <div class="col-12">
      <h3 class="my-4">Related Whiskey</h3>
    </div>
    @foreach ($relatedPost as $post)
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

{{-- //commenti --}}
<div class="container p-0 py-4 my-4">
  <div class="row">
    <div class="col-6">
      <h4>Review Article</h4>
      <div class="row">
        
        @forelse($post->comments as $comment)
        <div class="col-10">
          
          <div class="d-flex flex-row comment-row m-t-0 my-3">
            <div class="p-2"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583336/AAA/4.jpg" alt="user" width="50" class="rounded-circle">
              <h6 class="font-medium my-1">{{ $comment->user->name }}</h6>
            </div>
            <div class="comment-text w-100 px-2 ">
              <small class="text-muted">{{ $post->created_at->format('d/m/y')}}</small>
              <form method="POST" action="{{route('comment.destroy',$comment)}}">
                @csrf
                @method('DELETE')
                <button class="float-right btn d-block bg-transparent"><i class="fas fa-times text-danger"></i></button>
              </form>
              <span class="m-b-15 d-block mt-2 mb-4">{{ $comment->comment }}</span>
              <div class="comment-footer my-3"> 
                
              </div>
            </div>
          </div> 
        </div>
        @empty
        <div class="col-10">
          <h6 class="text-second">There are no posts</h6>
        </div>
        @endforelse
        
        {{-- @foreach ($post->comments as $comment)
        
        @endforeach --}}
      </div>
    </div>
    @auth
    <div class="col-12 col-md-12 col-lg-6">
      <h3 class="text-left mb-4">Comment this Whiskey</h3>
      <form method="POST" action="{{ route('post.comments',$post->id) }}">
        @csrf
        <div class="form-group">
          <label for="comment">what do you think about: {{ $post->title }}</label>
          <textarea class="form-control" name="comment" rows="3"></textarea>
        </div>
        <button type="submit" class="btn button-edit">Submit</button>
      </form>
    </div>
    @endauth
  </div>
</div>
</div>
@endsection

