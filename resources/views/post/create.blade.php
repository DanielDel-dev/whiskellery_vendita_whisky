@extends('layouts.app')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-6">
            <h1 class="text-center mb-5">Create your post</h1>
            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" name="title" value="{{old('title')}}" class="form-control">
                  @error('title')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="categories">Category</label>
                  <select class="form-control" name="category_id" >
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                      @endforeach
                  </select>
                  @error('category_id')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="tag">Tag</label>
                  <select class="form-control" name="tags[]" multiple>
                  @foreach ($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="body">Description</label>
                  <textarea class="form-control" name="body" rows="3"></textarea>
                  @error('body')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" name="price" class="form-control w-25">
                  @error('price')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="img">Images</label>
                    <input type="file" class="form-control-file" name="images[]" multiple>
                  </div>
                <button type="submit" class="btn button-edit">Submit</button>
              </form>
            
        </div>
        <div class="col-12 col-md-12 col-lg-6 text-center">
          <img class="img-fluid rotate-img" src="/img/whiskey-vector.png" alt="">
        </div>
    </div>
</div>

@endsection