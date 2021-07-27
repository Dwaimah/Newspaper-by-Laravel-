<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMIN DASHBOARD | WEBSITE NAME</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="{{url('public/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('public/css/font-awesome.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('public/css/ionicons.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('public/css/menu.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('public/css/adminstyle.css')}}"> 
  <script type="text/javascript" src="{{url('public/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{url('public/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{url('public/js/app.min.js')}}"></script>
  <script type="text/javascript" src="{{url('public/js/script.js')}}"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>

<div class="sidebar">
  <ul class="sidebar-menu">
    <li><a href="{{ route('admin.index')}}" class="dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
    <li class="treeview">
            <a href="#">
              <i class="fa fa-bookmark"></i> <span>Posts</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('admin.all-posts')}}"><i class="fa fa-eye"></i>All Posts</a></li>

              @role('Superadmin|Admin|Writer|Validator') 
               <li><a href="{{ route('admin.add-post')}}"><i class="fa fa-plus-circle"></i>Add Posts</a></li>
              @endrole

              @role('Superadmin') 
             <li><a href="{{ route('admin.viewcategory')}}"><i class="fa fa-plus-circle"></i>Categories</a></li>
             @endrole
             <?php /* 
             */?>
            </ul>
        </li>
      
      @role('Superadmin')
        <li class="treeview">
            <a href="#">
              <i class="fa fa-file"></i> <span>Pages</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('admin.all-pages')}}"><i class="fa fa-eye"></i>All Pages</a></li>
              <li><a href="{{ route('admin.add-page')}}"><i class="fa fa-plus-circle"></i>Add Pages</a></li>
            </ul>
        </li>
      @endrole

       @role('Superadmin|Admin')
          <li class="treeview">
            <a href="{{ route('admin.messages')}}">
              <i class="fa fa-envelope"></i> <span>Messages</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>            
        </li>
      @endrole


        @role('Superadmin|Admin')
          <li class="treeview">
            <a href="#">
              <i class="fa fa-image"></i> <span>Avdertisements</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('admin.all-advs')}}"><i class="fa fa-eye"></i>All Avdertisements</a></li>
              <li><a href="{{ route('admin.add-adv')}}"><i class="fa fa-plus-circle"></i>Add Avdertisement</a></li>             
            </ul>
        </li>
        @endrole

       
      @role('Superadmin|Admin') 
       <li class="treeview">
            <a href="{{ route('admin.settings') }}">
              <i class="fa fa-gear"></i> <span>Settings</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
             </a>             
        </li>
      @endrole
       
       @role('Superadmin|Admin')
          <li class="treeview">
            <a href="#">
              <i class="fa fa-address-book"></i> <span>Administration</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('admin.users')}}"><i class="fa fa-users"></i>All Users</a></li>             
              <li><a href="{{route('admin.roles')}}"><i class="fas fa-users-cog"></i>&nbsp All Roles</a></li>             
            </ul>
        </li>   
      @endrole

        

       
        <li class="treeview">
            <a href="#">
              <i class="fa fa-address-book"></i> <span>{{Auth::user()->name}}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @role('Superadmin|Admin')
              <li><a href="{{url('register')}}"><i class="fa fa-user"></i>Add New User</a></li>
              @endrole
              <li><a href="{{route('logout')}}"><i class="fa fa-power-off"></i>Log Out</a></li>
            </ul>
        </li>   
  </ul>
</div>


@yield('content')


<footer>
  <div class="col-sm-6">
    Copyright &copy; 2020 <a href="http://www.webtrickshome.com">Webtrickshome.com</a> All rights reserved. 
  </div>
  <div class="col-sm-6">
    <span class="pull-right">Version 2.2.3</span>
  </div>
</footer>

</body>
</html>