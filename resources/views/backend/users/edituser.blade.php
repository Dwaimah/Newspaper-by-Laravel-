@extends('backend.master')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 title">
			<h1><i class="fa fa-bars"></i> Edit User</h1>
		</div>
		
		
		
		
		<div class="col-sm-4 cat-form">
			@if (Session('add'))
			<div class="alert alert-success alert-dismissable fade in">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			   {{ Session('message') }}
			 </div>
            @elseif ( Session('update'))
           <div class="alert alert-success">
             {{ Session('message') }}
           </div>
           @elseif (Session('faildAction-delete'))
           <div class="alert alert-danger">
             {{ Session('faildAction-delete') }}
           </div>           
           @elseif (Session('faildChecked-delete'))
           <div class="alert alert-danger">
             {{ Session('faildChecked-delete') }}
           </div>
            @elseif (Session('success-delete'))
           <div class="alert alert-success">
             {{ Session('success-delete') }}
           </div>
          
           @endif

			<form method="post" action="{{ route('admin.updateuser') }}">
				{{csrf_field()}}
			<input type="hidden" name="tbl" value="{{encrypt('users')}}">
			<input type="hidden" name="id" value="{{$user->id}}">
				<div class="form-group">
					<label> Name </label>
					<input type="text" name="name" id="user_name" value="{{$user->name}}" class="form-control">
					<p>The name is how it appears on your site.</p>
				</div>

				<div class="form-group">
					<label>Email</label>
					<input type="Email" name="email" id="user_email" value="{{$user->email}}" class="form-control" >
					
				</div>

								
				<div class="form-group">
					<label>User Role</label>
					<select class="form-control" name="userrole">
						<option>{{$userRole}}</option>	
						@if($userRole =='')
						
						<option>Admin</option>
						<option>Writer</option>
						<option>Validator</option>
						<option>Publisher</option>
						@endif
						@if($userRole =='Superadmin')
						
						<option>Admin</option>
						<option>Writer</option>
						<option>Validator</option>
						<option>Publisher</option>
						@endif

						@if($userRole =='Admin')						
						
						<option>Writer</option>
						<option>Validator</option>
						<option>Publisher</option>
						@endif

						@if($userRole =='Writer')
						
						<option>Admin</option>						
						<option>Validator</option>
						<option>Publisher</option>
						@endif

						@if($userRole =='Validator')
						
						<option>Admin</option>
						<option>Writer</option>						
						<option>Publisher</option>
						@endif

						@if($userRole =='Publisher')						
						<option>Admin</option>
						<option>Writer</option>
						<option>Validator</option>						
						@endif						
							
					 </select>
				</div>

				<div class="form-group">
					<button class="btn btn-primary">Update User</button>
				</div>
			</form>	


		</div>

	
	</div>
</div>

@stop