@extends('layout')

@section('content')
  <div class="container">
      <form action="/login" method="POST">
          @csrf
          <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input
                  name="email"
                  type="email"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                  placeholder="Enter email"
                  required
              />
              <small id="emailHelp" class="form-text text-muted">
                  We'll never share your email with anyone else.
              </small>
          </div>
          <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input
                  name="password"
                  type="password"
                  class="form-control"
                  id="exampleInputPassword1"
                  placeholder="Password"
                  required
              />
          </div>
          <div class="form-group form-check">
              <input
                  name="remember"
                  type="checkbox"
                  class="form-check-input"
                  id="exampleCheck1"
              />
              <label class="form-check-label" for="exampleCheck1">
                  Remember me
              </label>
          </div>
          <div id="errs">
              @if (isset($errors) && $errors->any())
                  @foreach($errors->all() as $err)
                      <div class="text-danger mb-3">{{ $err }}</div>
                  @endforeach
              @endif
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
          <a class="btn btn-secondary" href="/signup">Signup</a>
      </form>
  </div>
@stop
