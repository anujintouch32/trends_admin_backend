@extends('inner-layout/app') 
@section('content')
   <!-- Page Title -->
  <div class="row">
    <div class="col-12">
      <h1>Add Category</h1>
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
      <form action="{{route('category.store')}}" Method="POST">
        @csrf
        <div class="form-group">
          <button type="button" class="btn btn-primary btn-sm">Save</button>
          <button type="button" class="btn btn-secondary btn-sm">Reset</button>
        </div>
        <div class="form-group">
          <label for="fName">Name</label>
          <input type="text" class="form-control" id="fName" name="name" placeholder="John" value="{{old('name')}}">
        </div>
        <div class="form-group">
          <label for="Select">Parent Category</label>
          <select class="form-control" id="parent_id" name="parent_id">
            <option value="0" >No Parent</option>
            @if(isset($category_data) && !$category_data->isEmpty())
              @foreach($category_data as $category)
                <option {{(old('parent_id')==$category->id) ? 'selected=selected' : '' }} value="{{$category->id}}" >{{$category->name}}</option>
              @endforeach
            @endif
          </select>
        </div>
        <div class="form-group">
          <label for="Select">Status</label>
          <select class="form-control" id="Select" name="status">
            <option value="A" >Active</option>
            <option value="D">De-active</option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
 @endsection    