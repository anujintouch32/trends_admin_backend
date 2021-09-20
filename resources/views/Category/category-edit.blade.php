@extends('inner-layout/app') 
@section('content')
   <!-- Page Title -->
  <div class="row">
    <div class="col-12">
      <h1>Edit Category</h1>
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
      <form action="{{route('category.update',['category' => $updated_category[0]->id])}}" Method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="fName">Name</label>
          <input type="text" class="form-control" id="fName" name="name" placeholder="John" value="{{old('name') ? old('name') : $updated_category[0]->name; }}">
        </div>
        <div class="form-group">
          <label for="Select">Parent Category</label>
          <select class="form-control" id="parent_id" name="parent_id">
            <option value="0" >No Parent</option>
            @if(isset($category_data) && !$category_data->isEmpty())
              @foreach($category_data as $category)
                <option {{(old('parent_id')==$category->id || $updated_category[0]->parent_id == $category->id ) ? 'selected=selected' : '' }} value="{{$category->id}}" >{{$category->name}}</option>
              @endforeach
            @endif
          </select>
        </div>
        <div class="form-group">
          <label for="Select">Status</label>
          <select class="form-control" id="Select" name="status">
            <option {{(old('status')=='A' || $updated_category[0]->status == 'A') ? 'selected=selected' : ''; }} value="A" >Active</option>
            <option {{(old('status')=='A' || $updated_category[0]->status == 'D') ? 'selected=selected' : ''; }} value="D">De-active</option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
 @endsection    