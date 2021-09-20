@extends('inner-layout/app') 
@section('content')
   <!-- Page Title -->
  <div class="row">
    <div class="col-12">
      <h1>Edit User</h1>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-12 col-sm-6 col-md-4">
      
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
      @endif
      <form action="{{route('user.update', ['user' => $user_data[0]->id])}}" Method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
          <button type="button" class="btn btn-primary btn-sm">Save</button>
          <button type="button" class="btn btn-secondary btn-sm">Reset</button>
        </div>
        <div class="form-group">
          <label for="fName">Name</label>
          <input type="text" class="form-control" id="fName" name="name" placeholder="John" value="{{$user_data[0]->name}}">
        </div>
        <div class="form-group">
          <label for="LName">Email</label>
          <input type="text" class="form-control" id="LName" name="email" placeholder="Doe" value="{{$user_data[0]->email}}">
        </div>
        <div class="form-group">
          <label for="Select">Role</label>
          <select class="form-control" id="Select" name="role">
            <option value="user" {{(isset($user_data[0]->role) && $user_data[0]->role =='user') ? 'selected="selected"' : '' }}>User</option>
            <option value="admin" {{(isset($user_data[0]->role) && $user_data[0]->role =='admin') ? 'selected="selected"' : '' }}>Admin</option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
 @endsection    