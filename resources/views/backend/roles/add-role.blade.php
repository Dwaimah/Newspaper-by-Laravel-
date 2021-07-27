@extends('backend.master')
@section('content')


<div class="container-fluid">
	<div class="row">


		<div class="col-sm-10 title">
			<h1><i class="fa fa-bars"></i> Add New Role</h1>
		</div>



		<div class="col-sm-12">
			<div class="row">
       
     
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

       <form    method="post" action="{{ route('addrole') }}">
    
        @csrf       
			
          <input type="hidden" name="tbl" value="{{encrypt('roles')}}">

					<div class="col-sm-12">
						<div class="form-group">	

							<input type="text" name="name"  class="form-control" placeholder="Enter role name here" style="width: 500px;">				
						</div>	

						<div class="content">
				<table class="table table-striped">
					<thead>
						<tr>							
							<th colspan="3" style="text-align: center;text-transform: uppercase;">Please Choose PERMISSIONS </th>
							
						</tr>
					</thead>
					<tbody>
						
												 
							      @if($loginUser !='Superadmin')
							        @foreach($sections as $section) 
							         @if($section != 'page')							 
									    <tr> 	
										   <td style="text-transform: uppercase;font-weight: bold;" colspan="5" >{{$section}} : </td>
										   <td style="text-transform: uppercase;font-weight: bold;" > </td>
										   <td style="text-transform: uppercase;font-weight: bold;" > </td>
										   <td style="text-transform: uppercase;font-weight: bold;" > </td>
										   <td style="text-transform: uppercase;font-weight: bold;" > </td>	
										</tr>

										<tr>									
									     @foreach($originalpermissions as $permission)
										  @if($permission->partname == $section )
												
													<td>
														<input type="checkbox"  name="select-cat[]" value="{{$permission->id}}">
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
										   <td style="text-transform: uppercase;font-weight: bold;" > </td>
										   <td style="text-transform: uppercase;font-weight: bold;" > </td>
										   <td style="text-transform: uppercase;font-weight: bold;" > </td>
										   <td style="text-transform: uppercase;font-weight: bold;" > </td>		
										</tr>

										<tr>									
									     @foreach($originalpermissions as $permission)
										  @if($permission->partname == $section )
												
													<td>
														<input type="checkbox"  name="select-cat[]" value="{{$permission->id}}">
													     {{$permission->name}}
													</td>													
										
								           @endif
								          @endforeach
								        </tr>
								      
								     @endforeach 

					   	       @endif  
					   		
						
					</tbody>
				</table>
			</div>


						
						
						
						

						<div class="form-group">
							<button class="btn btn-primary">Add Role</button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.fa-bars').click(function(){
			$('.sidebar').toggle();
		})
	});
</script>
<script>
var loadFile = function(event) {
  var image = document.getElementById('output');
  image.src = URL.createObjectURL(event.target.files[0]);
};
</script>

@stop