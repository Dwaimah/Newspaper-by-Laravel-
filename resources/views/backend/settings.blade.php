@extends('backend.master')
@section('content')

<div class="container-fluid">
	<div class="row">			
          

		<div class="col-sm-4 cat-form">		

			<h3> Setting Control</h3>
			@if (Session('add'))
			<div class="alert alert-success">
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
 
          @if($data == NULL)
			<form  accept-charset="UTF-8" enctype="multipart/form-data"  method="post"
			action="{{ route('admin.addsetting')}}">
		
				@csrf
				
				<div class="form-group">
					<input type="hidden" name="tbl" value="{{ encrypt('settings') }}" class="form-control">					
					<label for="image">Logo:</label>					
					
					<p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
					<p><label for="file" style="cursor: pointer;" class="btn btn-warning">Upload Image</label></p>
					<p><img id="output"  /></p>
				</div>

				<div class="form-group">
					<label>About</label>
					<textarea name="about"   class="form-control" rows="10" style="align-content:left" >						
					</textarea> 					
				</div>
				<div id="socialFieldGroup">
					<div class="form-group">
						<label>Social</label><br>
						<input type="url" name="social[]" class="form-control " required="" >
						<p class="text-muted">e.g: http:\\www.facebook.com\abd</p>						
					</div>	
				</div>
				<div class="form-group">
					<div class="alert alert-danger alert-dismissable noShow" id="socialAlert">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Sorry!!</strong> You've reatched the social feilds limit.
					</div>
				</div>

				<div class="text-right form-group">
					<span class="btn btn-warning " id="addsocialField"> <i class="fa fa-plus"></i> </span>
				</div>
				

				<div class="form-group">
					<button class="btn btn-primary">Add New Setting</button>
				</div>

			</form>	
			<script>
				
				$('#addsocialField').click(function(){
					var socialCounter=1;					
					socialCounter++;
					if(socialCounter > 5)
					{
						$('#socialAlert').removeClass('noShow');
						return;
					}
					newDiv=$(document.createElement('div')).attr("class","form-group");
					newDiv.after().html('<input type="url" name="social[]" class="form-control" ></div>');
					newDiv.appendTo('#socialFieldGroup');
				})
			</script>

			@else
			  <form  accept-charset="UTF-8" enctype="multipart/form-data"  method="post"
			   action="{{ route('admin.updatesetting')}}">
		
				@csrf
				
				<div class="form-group">
					<input type="hidden" name="tbl" value="{{ encrypt('settings') }}" class="form-control">	
					
					<input type="hidden" name="sid" value="{{ $data->sid }}">			
					 
					<label>Logo</label><br>
					@if(!empty($data->image))
					<p> <img src="{{url('public/settings')}}/{{ $data->image }}" width="200" id="output"></p>
					<p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
					<p><label for="file" style="cursor: pointer;" class="btn btn-warning">Replace Image</label></p>
					<p><img id="output"  /></p>
					@else					
 				    
 				    <p><input type="file"  accept="image/*" name="image" id="file" onchange="loadFile(event)" style="display: none; "></p>
					<p><label for="file" style="cursor: pointer;" class="btn btn-warning">Upload Image</label></p>
					<p><img id="output" width="200"  /></p>					
 				    @endif
					
				</div>

				<div class="form-group">
					<label>About</label>
					<textarea name="about" class="form-control" rows="10" style="align-content:left" >{{ $data->about }}					
					</textarea> 					
				</div>
				<div id="socialFieldGroup">
					<div class="form-group">
						<label>Social</label><br>
						@foreach($socials as $social)
						<input type="url" name="social[]" value="{{ $social}}" class="form-control socialCount"  >
						@endforeach
						<p class="text-muted">e.g: http:\\www.facebook.com\abd</p>						
					</div>	
				</div>
				<div class="form-group">
					<div class="alert alert-danger alert-dismissable noShow" id="socialAlert">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Sorry!!</strong> You've reatched the social feilds limit.
					</div>
				</div>

				<div class="text-right form-group">
					<span class="btn btn-warning " id="addsocialField"> <i class="fa fa-plus"></i> </span>
				</div>
				

				<div class="form-group">
					<button class="btn btn-primary">Edit Setting</button>  
				</div>
			</form>
<script>
	 var socialCounter=$('.socialCount').length;
	$('#addsocialField').click(function(){
		socialCounter++;
		if(socialCounter > 5)
		{
			$('#socialAlert').removeClass('noShow');
			return;
		}
		newDiv=$(document.createElement('div')).attr("class","form-group");
		newDiv.after().html('<input type="url" name="social[]" class="form-control" ></div>');
		newDiv.appendTo('#socialFieldGroup');
	})
</script>

			@endif			 


		</div>



	</div>
</div>
<style >
	.noShow{
		display: none;
	}
</style>
<script>
var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>

@stop