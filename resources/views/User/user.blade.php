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
          <i class="fa fa-table"></i> User Records</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>UserType</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>UserType</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @if(!$userlist->isEmpty())
                @foreach($userlist as $user)
                   <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td class="text-center"><div class="btn-group"><a href="{{route('user.edit', ['user' => $user->id])}}"><button type="button" class="btn btn-info mr-2">Edit</button></a><form action="{{route('user.destroy', ['user' => $user->id])}}" method="POST"> @csrf
                     @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button></form></div></td>
                  </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4">No User Exist</td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div id="pagiation-div">{{ $userlist->links() }}</div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
 @endsection    