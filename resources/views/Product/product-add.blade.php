@extends('inner-layout/app') 
@section('content')
   <!-- Page Title -->
  <div class="row">
    <div class="col-12">
      <h1>Add Product</h1>
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
      <form action="{{route('product.store')}}" Method="POST">
        @csrf
        <div class="form-group">
          <button type="button" class="btn btn-primary btn-sm">Save</button>
          <button type="button" class="btn btn-secondary btn-sm">Reset</button>
        </div>
        <div class="form-group">
          <label for="fName">Name</label>
          <input type="text" class="form-control"  name="title" value="{{old('title')}}">
        </div>
         <div class="form-group">
          <label for="fName">Price</label>
          <input type="number" id="price" name="price" min="1" max="60" value="{{old('price')}}">
        </div>
        <div class="form-group">
          <label for="fName">Quantity</label>
          <input type="number" id="quantity" name="quantity" min="1" max="100" value="{{old('quantity')}}">
        </div>
        <div class="form-group">
          <label for="Select">Category</label>
          <select class="form-control" id="category_id" name="category_id">
            <option value="0" >Select Category</option>
            @if(isset($category_data) && !$category_data->isEmpty())
              @foreach($category_data as $category)
                <option {{(old('category_id')==$category->id) ? 'selected=selected' : '' }} value="{{$category->id}}" >{{$category->name}}</option>
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