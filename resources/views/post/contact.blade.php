@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 my-5">
                <h1 class="my-3">Ask any info</h1>
                <form method="POST" action="{{route('post.send')}}">
                  @csrf
                  <div class="mb-3">
                    <label for="formGroupExampleInput">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" id="formGroupExampleInput">
                    @error('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="mail" class="form-control @error('mail') is-invalid @enderror" value="{{old('mail')}}">
                  @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  </div>
                  <div class="mb-3">
                    <label for="">Message</label>
                   <textarea name="message" class="form-control @error('message') is-invalid @enderror"  id="" cols="30" rows="10">{{old('message')}}</textarea>
                  @error('message')
                   <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
                  </div>
                  <button type="submit" class="btn button-edit">Submit</button>
                </form>
            </div>
            <div data-aos="fade-left" class="col-12 col-md-6 my-5 pl-4">
                <h1 class="my-3">For more info, contact us here</h1>
                <ul class="list-unstyled">
                  <li><i class="fab fa-facebook fa-2x my-2 mx-2"><a href="" class="text-decoration-none social ml-2">Whiskilleria</a></i></li>
                  <li><i class="fab fa-twitter fa-2x my-2 mx-2"><a href="" class="text-decoration-none social ml-2">#Whiskilleria</a></i></li>
                  <li><i class="fab fa-whatsapp fa-2x my-2 mx-2"><a href="tel:+" class="text-decoration-none social ml-2">1234567890</a></i></li>
                  <li><i class="fab fa-instagram fa-2x my-2 mx-2"><a href="" class="text-decoration-none social ml-2">@Whiskilleria</a></i></li>
                </ul>
            </div>
        </div>
    </div>
@endsection