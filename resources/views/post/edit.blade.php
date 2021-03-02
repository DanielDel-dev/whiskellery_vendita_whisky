@extends('layouts.app')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-6">
            <h1 class="text-center mb-5">Edit your post</h1>
            <form method="POST" action="{{ route('post.update',$post) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" name="title" value="{{ $post->title }}" class="form-control">
                </div>
                <div class="form-group">
                  <label for="categories">Category</label>
                  <select class="form-control" name="category_id">
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}"
                            {{ $category->id == $post->category->id ? 'selected' : '' }}
                            >{{$category->name}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="tag">Tag</label>
                  <select class="form-control" name="tags[]" multiple>
                  @foreach ($tags as $tag)
                    <option value="{{$tag->id}}" {{$tagsId->contains($tag->id)? 'selected':''}}>{{$tag->name}}</option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="body">Description</label>
                  <textarea class="form-control" name="body" rows="3">{{$post->body}}</textarea>
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" name="price" value="{{ $post->price }}" class="form-control w-25">
                </div>
                <div class="form-group">
                    <label for="img">Images</label>
                    <input type="file" class="form-control-file" name="images[]" multiple>
                  </div>
                <button type="submit" class="btn button-edit">Submit</button>
              </form>
            
        </div>
    </div>
</div>
<div class="container">
  <div class="row">
      @foreach ($post->images as $image)
      <div class="col-12 col-md-3 my-2">
          <form method="POST" action="{{route('image.destroy',$image)}}">
            @csrf
            @method('DELETE')
            <img  src="{{Storage::url($image->url)}}" class="img-fluid w-50" alt="">
            <button class="btn button-edit d-block my-3 mx-4">Delete</button>
          </form>
        </div>
      @endforeach
      
    </div>
  </div>
</div>

@endsection