@extends('layouts.app')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title text-center">Login</h5>
      <form method="POST" action="{{route('auth.login')}}">
        @csrf
        <div class="form-group mt-2">
          
          <input type="email" class="form-control" id="email" name="email" placeholder="Username">
        </div>
        <div class="form-group mt-2">
         
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="d-grid gap-2 col-12 mx-auto mt-4" >
        <button type="submit" class="btn btn-primary btn-block mt-2">Login</button>
        </div>
        <div class="d-grid gap-2 col-12 mx-auto mt-2">
       <small>Not a Member?<a href="{{route('auth.register')}}">Signup</a></small>
        </div>
      </form>
    </div>
  </div>
</div>    
@endsection
