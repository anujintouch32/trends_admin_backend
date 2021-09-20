<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
  </li>
 <!--  Home layout breadcurms  -->
  @if(request()->is('admin') || request()->is('admin/home*'))
  <li class="breadcrumb-item active">My Dashboard</li>
  <!--  User layout breadcurms  -->
  @elseif (request()->is('admin/user*'))  
    @if (request()->is('admin/user'))  
      <li class="breadcrumb-item active">Users</li> 
      <!--  User add layout breadcurms  -->
    @elseif (request()->is('admin/user/add'))
      <li class="breadcrumb-item active">Users/Add</li> 
    @endif
  <!--  Category layout breadcurms  -->
  @elseif(request()->is('admin/category*'))
      <li class="breadcrumb-item active">Category</li>  

  @else
    <!--No route found-->
  @endif
</ol>