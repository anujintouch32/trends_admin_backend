@extends('inner-layout/app') 
@section('content')
      <!-- Example DataTables Card-->
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
      @endif

      @if($message_error = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message_error }}</strong>
        </div>
      @endif
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Product Records</div>
        <div class="card-body">
          <div class="btn-group float-right"><a href="{{route('product.create')}}"><button type="button" class="btn btn-primary btn-lg float-right mb-3">Add Product</button></a></div>
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Sr No.</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Sr No.</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!$productlist->isEmpty())
                @php 
                $i = $productlist->perPage() * ($productlist->currentPage() - 1);
                @endphp
                @foreach($productlist as $product)
                   <tr>
                    <td>{{++$i}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{isset($product->category->name) ? $product->category->name : '' }}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->status}}</td>
                    <td class="text-center"><div class="btn-group"><a href="{{route('product.edit', ['product' => $product->id])}}"><button type="button" class="btn btn-info mr-2">Edit</button></a><form action="{{route('product.destroy', ['product' => $product->id])}}" method="POST"> @csrf
                     @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button></form></div></td>
                  </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4">No Product Exist</td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div id="pagiation-div">{{ $productlist->links() }}</div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
 @endsection    