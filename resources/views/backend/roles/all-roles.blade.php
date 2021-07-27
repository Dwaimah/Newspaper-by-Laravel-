@extends('backend.master')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 title">
			<h1><i class="fa fa-bars"></i> ROLES</h1>
			<a href="{{ route('add-role') }}"><button class="btn btn-default"> Add New </a></button></h1>
		</div>
		
		

		<div class="col-sm-12 cat-form">
		   @if (Session('add'))
        <div class="col-sm-12 alert alert-success alert-dismissable fade in">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			   {{ Session('message') }}
		 </div>
       @elseif ( Session('update'))
       <div class="col-sm-12 alert alert-success alert-dismissable fade in">
       	<a href="#" class="close" data-dismiss="alert">&times;</a>
         {{ Session('message') }}
       </div>
       @elseif (Session('faildAction-delete'))
       <div class="col-sm-12 alert alert-danger alert-dismissable fade in class=">
       	<a href="#" class="close" data-dismiss="alert">&times;</a>
         {{ Session('faildAction-delete') }}
       </div>           
       @elseif (Session('faildChecked-delete'))
       <div  class="col-sm-12 alert alert-danger alert-dismissable fade in class=">
       	<a href="#" class="close" data-dismiss="alert">&times;</a>
         {{ Session('faildChecked-delete') }}
       </div>
       @elseif (Session('success-delete'))
      <div class="col-sm-12 alert alert-success alert-dismissable fade in">
      	<a href="#" class="close" data-dismiss="alert">&times;</a>
         {{ Session('success-delete') }}
       </div>
       @endif
          
			
			<h3>Roles Page</h3>
			

		</div>


     <form method="post" action="{{ route('deleteroles') }}">
     	{{csrf_field()}}
     	<input type="hidden" name="tbl" value="{{encrypt('roles')}}">		
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
							<th><input type="checkbox" id="select-all"> Role Name</th>
							
							<th>Updated At</th>
							
						</tr>
					</thead>
					<tbody>
						
						@if(count($roles) == 0)
						<tr>
						  <td span=2>  Data not found</td> 
					   </tr>
						@else					
							@foreach($roles as $role)
							 @if($loginUser != 'Superadmin')
								  @if($role->name != 'Superadmin' )
										<tr> 											
											<td>
												<input type="checkbox"  name="select-cat[]" value="{{$role->id}}"> 
											    <a href="{{ route('admin.editrole',$role->id) }}">{{$role->name}}</a>
											</td>											
											<td>{{$role->updated_at}}</td>
										</tr>						  
								   @endif

							 @else 

							   		<tr> 
							   			<td>
											<input type="checkbox"  name="select-cat[]" value="{{$role->id}}"> 
											 <a href="{{ route('admin.editrole',$role->id) }}">{{$role->name}}</a>
										</td>
											
											<td>{{$role->updated_at}}</td>
										</tr>	

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