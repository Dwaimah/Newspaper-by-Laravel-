@extends('backend.master')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 title">
			<h1><i class="fa fa-bars"></i> {{$role->name}} Role</h1>
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
       </div>
	<form method="post" action="{{ route('updaterole') }}">
				{{csrf_field()}}
			<input type="hidden" name="tbl" value="{{encrypt('role_has_permissions')}}">
			<input type="hidden" name="id" value="{{$role->id}}">
				
			<div class="content">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>LARANEWS SECTION </th>
							<th colspan="3" style="text-align: center;text-transform: uppercase;">PERMISSIONS </th>				
							
						</tr>
					</thead>
					<tbody>
						
						@if(count($permissions) == 0)
						<tr>
						  <td span=4>  Data not found</td> 
					   </tr>
						@else							 
							      @if($loginUser !='Superadmin')
							        @foreach($sections as $section) 
							         @if($section != 'page')							 
									    <tr> 	
										   <td style="text-transform: uppercase;font-weight: bold;" >{{$section}} : </td>	
										</tr>

										<tr>									
									     @foreach($originalpermissions as $permission)
										  @if($permission->partname == $section )
												
													<td>
														<input type="checkbox"  name="select-cat[]" value="{{$permission->id}}"
														@if(in_array($permission->id, $permissions_ids))checked="checked" @endif>

													    {{$permission->name}}
													</td>
													
										
								           @endif
								          @endforeach
								        </tr>
								       @endif
								     @endforeach 
								       <!-- the user is superadmin -->
								 @else 

								     @foreach($sections as $section) 
							        
									    <tr> 	
										   <td style="text-transform: uppercase;font-weight: bold;" >{{$section}} : </td>	
										</tr>

										<tr>									
									     @foreach($originalpermissions as $permission)
										  @if($permission->partname == $section )
												
													<td>
														<input type="checkbox"  name="select-cat[]" value="{{$permission->id}}"
														@if(in_array($permission->id, $permissions_ids))checked="checked" @endif>

													     {{$permission->name}}
													</td>
													
										
								           @endif
								          @endforeach
								        </tr>
								      
								     @endforeach 

					   	       @endif  
					   		@endif
						
					</tbody>
				</table>
			</div>

		<div class="form-group">
	    	<button class="btn btn-primary">Update Role</button>
		</div>
	</form>	


</div>
</div>

@stop