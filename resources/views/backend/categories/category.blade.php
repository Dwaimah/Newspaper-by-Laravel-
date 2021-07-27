@extends('backend.master')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 title">
			<h1><i class="fa fa-bars"></i> Categories</h1>
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
          
			
			<h3>Add New Category</h3>
			<form method="post" action="{{ route('admin.addcategory')}}">
				@csrf
				<div class="form-group">
					<input type="hidden" name="tbl" value="{{ encrypt('Categories') }}" class="form-control">
					<label>Name</label>
					<input type="text" name="title" id="category_name" class="form-control">
					<p>The name is how it appears on your site.</p>
				</div>

				<div class="form-group">
					<label>Slug</label>
					<input type="text" name="slug" id="slug" class="form-control" readonly="">
					
				</div>

				<div class="form-group">
					<label>Status</label>
					<select name="status" class="form-control">
						<option>on</option>
						<option>off</option>
					</select>
				</div>	
				 <div class="form-group">
					<button class="btn btn-primary">Add New Category</button>
				</div>
			</form>	


		</div>


     <form method="post" action="{{ route('admin.deletecategory') }}">
     	{{csrf_field()}}
     	<input type="hidden" name="tbl" value="{{encrypt('categories')}}">		
     	<input type="hidden" name="tblid" value="{{encrypt('cid')}}">
			
     	<div class="col-sm-8 cat-view">
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
							
							<th>Slug</th>
							<th>status</th>
						</tr>
					</thead>
					<tbody>
						@if(count($data)==0)
						<td span=3>  Data not found</td> 
						@else
							@foreach($data as $cat)
							<tr> 
								
								<td>
									<input type="checkbox"  name="select-cat[]" value="{{ $cat->cid }}"> 
								    <a href="{{ route('admin.editcategory',$cat->cid) }}">{{ $cat->title }}</a>
								</td>
								
								<td>{{ $cat->slug }}</td>
								<td>{{ $cat->status }}</td>
							</tr>
							@endforeach
						@endif	
					</tbody>
				</table>
			</div>
			 						
		</div>
	</form>
 </div>
</div>

@stop