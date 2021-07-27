@extends('backend.master')
@section('content')


<div class="container-fluid">
	<div class="row">


		<div class="col-sm-10 title">
			<h1><i class="fa fa-bars"></i> Add New Post</h1>
		</div>



		<div class="col-sm-12">
			<div class="row">
       
     
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

       <form  accept-charset="UTF-8" enctype="multipart/form-data"  method="post"
        action="{{ route('admin.addpost') }}">
    
        @csrf       
			
          <input type="hidden" name="tbl" value="{{encrypt('posts')}}">

					<div class="col-sm-9">
						<div class="form-group">	

							<input type="text" name="title" id="post_title" class="form-control" placeholder="Enter title here">				
						</div>						
            <div class="form-group">  
              <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter slug here">        
            </div>

						<div class="form-group">		
							<textarea class="form-control" name="description" rows="15"></textarea>
							<div class="col-sm-12 word-count">Word count: 0</div>
						</div>	
					</div>

					<div class="col-sm-3">
						<div class="content publish-box">
							<h4>Publish  <span class="pull-right"><i class="fa fa-chevron-down"></i></span></h4><hr>	
							
							@role('Superadmin|Admin|Writer|Publisher') 
							<div class="form-group">
								<button class="btn btn-default" value="draft" name="status">Save Draft</button>
							</div>
							@endrole
							<p><strong>Status</strong>:  </p>
							<p><strong>Current Validation</strong> : Invalid
							  
							 
								  <button class="btn btn-success btn-sm" value="1" name="validate" style="margin: 4px 40px;">Save Valid</button></p>
								
							 


							
							@role('Superadmin|Admin|Publisher') 
							<div class="row">
								<div class="col-sm-12 main-button">
									<button class="btn btn-primary pull-right" value="published" name="status">Publish</button>
								</div>
							</div>	
							@endrole
						</div>
						
						
						<div class="content cat-content">
							<h4>Category  <span class="pull-right"><i class="fa fa-chevron-down"></i></span></h4><hr>	
                            @foreach($data as $cat)
							   <p><label for="cat1"><input type="checkbox" value="{{ $cat->cid }}" name="category_id[]" id="cat1" > {{ $cat->title }}</label></p>
                            @endforeach
							
						</div>
						<div class="content featured-image">
							<h4>Featured Image <span class="pull-right"><i class="fa fa-chevron-down"></i></span></h4><hr>
              <p><img id="output" style="max-width: 100%"  /></p>             
              <p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
              <p><label for="file" style="cursor: pointer;">Set Featured Image</label></p>
              
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	$(document).ready(function(){
		$('.fa-bars').click(function(){
			$('.sidebar').toggle();
		})
	});
</script>
<script src="{{url('public/ckeditor/ckeditor.js')}}"></script>
<script>
	CKEDITOR.replace('description', { "filebrowserBrowseUrl": "ckfinder\/ckfinder.html", "filebrowserImageBrowseUrl": "ckfinder\/ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "ckfinder\/ckfinder.html?type=Flash", "filebrowserUploadUrl": "ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" });	
</script>
<script>
var loadFile = function(event) {
  var image = document.getElementById('output');
  image.src = URL.createObjectURL(event.target.files[0]);
};
</script>

@stop