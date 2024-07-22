@extends('layouts.app')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-title"><h4>Create an Account</h4></div>
    <div class="card-body">
      @if(session('error'))
        <div class="text-danger">{{session('error')}}</div>
        @endif
      <form method="POST" action="{{route('auth.register')}}">
        @csrf
        <div class="form-group mt-2">
          
          <input type="text" class="form-control" id="name" name="name" placeholder="Username">
        </div>
         <div class="form-group mt-2">
          
          <input type="text" class="form-control" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group mt-2">
         
          <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
        </div>
        <div class="form-group mt-2">
         
          <input type="password" class="form-control" id="confrim_password" name="confrim_password" placeholder="New Password(Repeat)">
        </div>
        <div class="d-grid gap-2 col-12 mx-auto">
        <button type="submit" class="btn btn-success btn-block mt-5">CREATE AN ACCOUNT</button>
        </div>
        <div class="d-grid gap-2 col-12 mx-auto mt-5">
       <a href="{{route('home')}}" class="btn btn-block btn-info">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>    
@endsection