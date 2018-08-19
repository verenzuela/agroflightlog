@extends('layouts.home.master')
@section('title', 'Agro Fligth Log')

@section('content')
  
  <header>
    @include('layouts.home.navbar')
  </header>

  <form class="form-signin" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
    @csrf
    <img class="mb-4" src="{{ asset('img/agrodron-logo.png') }}" alt="" width="120" height="100">
    
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me">Remember me
      </label>
    </div>
    <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>

    <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
  </form>
  
  <footer>
    @include('layouts.home.footer')
  </footer>

@endsection