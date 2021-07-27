@extends('backend.master')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 title">
			<h1><i class="fa fa-bars"></i> USERS</h1>
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
          
			
			<h3>Users Page</h3>
			

		</div>


     <form method="post" action="{{ route('admin.deleteusers') }}">
     	{{csrf_field()}}
     	<input type="hidden" name="tbl" value="{{encrypt('users')}}">		
     	<input type="hidden" name="tblid" value="{{encrypt('id')}}">
			
     	<div class="col-sm-12 cat-view">
			<div class="row">
				<div class="col-sm-3">
					<select name="bulk-action" class="form-control">
						<option value="0">Bulk Action</option>
						<option value="1">Move to Trash</option>
					</select>
				</div>


				<div class="col-sm-2">
					<button class="btn btn-default">Apply</button>
				</div>
				<div class="col-sm-3 col-sm-offset-4">
					<input type="text" id="search" class="form-control" placeholder="Search Category">
				</div>	
			</div>    


			<div class="content">
				<table class="table table-striped">
					<thead>
						<tr>
							<th><input type="checkbox" id="select-all"> Name</th>
							
							<th>Email</th>
							<th>User-Role</th>
						</tr>
					</thead>
					<tbody>
						
						@if(count($users) == 0)
						<tr>
						  <td span=3>  Data not found</td> 
					   </tr>
						@else
					
							@foreach($users as $user)
							 @if($loginUser != 'Superadmin')
								  @if($user->getRoleNames()->first() != 'Superadmin' )
										<tr> 
											
											<td>
												<input type="checkbox"  name="select-cat[]" value="$user->id"> 
											    <a href="{{ route('admin.edituser',$user->id) }}">{{$user->name}}</a>
											</td>
											
											<td>{{$user->email}}</td>
											@if($user->getRoleNames()->first() == "")
												<td style="color: #f50f0f">Not Defined</td>
												@else
												<td>{{ $user->getRoleNames()->first()}}</td>
											@endif							  
								   @endif

							 @else 

							   		<tr> 									
									<td>
										<input type="checkbox"  name="select-cat[]" value="{{$user->id}}"> 
									    <a href="{{ route('admin.edituser',$user->id) }}">{{$user->name}}</a>
									</td>
									
									<td>{{$user->email}}</td>
									@if($user->getRoleNames()->first() == "")
										<td style="color: #f50f0f">Not Defined</td>
										@else
										<td>{{ $user->getRoleNames()->first()}}</td>
									@endif

							 @endif	

							@endforeach	
							</tr>

						@endif	
							

							
							
							
						
					</tbody>
				</table>
			</div>
			 						
		</div>
	</form>
 </div>
</div>

@stop