@extends('backend.master')
@section('content')


<div class="container-fluid">
	<div class="row">


		<div class="col-sm-10 title">
			<h1><i class="fa fa-bars"></i> Add New Adv</h1>
		</div>



		<div class="col-sm-12">
			<div class="row">
       
     
        @if (Session('add'))
        <div class="col-sm-9 alert alert-success alert-dismissable fade in">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			   {{ Session('message') }}
		 </div>
       @elseif ( Session('update'))
       <div class="col-sm-9 alert alert-success alert-dismissable fade in">
       	<a href="#" class="close" data-dismiss="alert">&times;</a>
         {{ Session('message') }}
       </div>
       @elseif (Session('faildAction-delete'))
       <div class="col-sm-9 alert alert-danger alert-dismissable fade in class=">
       	<a href="#" class="close" data-dismiss="alert">&times;</a>
         {{ Session('faildAction-delete') }}
       </div>           
       @elseif (Session('faildChecked-delete'))
       <div  class="col-sm-9 alert alert-danger alert-dismissable fade in class=">
       	<a href="#" class="close" data-dismiss="alert">&times;</a>
         {{ Session('faildChecked-delete') }}
       </div>
       @elseif (Session('success-delete'))
      <div class="col-sm-9 alert alert-success alert-dismissable fade in">
      	<a href="#" class="close" data-dismiss="alert">&times;</a>
         {{ Session('success-delete') }}
       </div>
       @endif

       <form  accept-charset="UTF-8" enctype="multipart/form-data"  method="post"
        action="{{ route('admin.addadv') }}">
    
        @csrf       
			
          <input type="hidden" name="tbl" value="{{encrypt('advertisements')}}">

					<div class="col-sm-9">
						<div class="form-group">	

							<input type="text" name="title"  class="form-control" placeholder="Enter title here">				
						</div>						
            <div class="form-group">  
              <input type="url" name="url" id="slug" class="form-control" placeholder="Enter url here">        
            </div>

						
						
						<div class="form-group">
							<h4>Adverisement Image </h4><hr>
				              <p><img id="output" style="max-width: 100%"  /></p>             
				              <p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
				              <p><label for="file" style="cursor: pointer;">Upload Image</label></p>              
						</div>

						<div class="form-group">
							<label>Location</label>
							<select name="location" class="form-control">
								<option>Leaderboard</option>
								<option>Sidebar-top</option>
								<option>Sidebar-bottom</option>
							</select>
						</div>

						<div class="form-group">
							<label>Status</label>
							<select name="Status" class="form-control">
								<option>display</option>
								<option>hide</option>								
							</select>
						</div>

						<div class="form-group">
							<button class="btn btn-primary">Add Adverisements</button>
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