@extends('backend.master')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 title">
			<h1><i class="fa fa-bars"></i> Categories</h1>
		</div>
		
		<div class="col-sm-4 cat-form">


			@if (Session::has('message'))
			<div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{Session('message')}}!</strong>
            </div>

            @elseif(Session::has('message2'))
            <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> {{Session('message2')}}! </strong>
            </div>

            @elseif(Session::has('message3'))
            <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> {{Session('message3')}}! </strong>
            </div>
			
			@endif

			<h3>Edit Category</h3>

			<form method="post" action="{{ route('admin.updatecategory') }}">
				{{csrf_field()}}
				<input type="hidden" name="tbl" value="{{encrypt('categories')}}">
				
				<input type="hidden" name="cid" value="{{$singledata->cid}}">

				<div class="form-group">

					<label> Name </label>
					<input type="text" name="title" id="category_name" value="{{$singledata->title}}" class="form-control">
					<p>The name is how it appears on your site.</p>
				</div>

				<div class="form-group">
					<label>Slug</label>
					<input type="text" name="slug" id="slug" value="{{$singledata->slug}}" class="form-control" readonly="">
					
				</div>

								
				<div class="form-group">
					<label>Status</label>
					<select class="form-control" name="status">
						<option>{{$singledata->status}}</option>	
						@if($singledata->status =='on')
						<option>off</option>
						@else
						<option>on</option>	
						@endif
							
					 </select>
				</div>

				<div class="form-group">
					<button class="btn btn-primary">Edit Category</button>
				</div>
			</form>	


		</div>

		<div class="col-sm-8 cat-view">
			<div class="row">
				<div class="col-sm-3">
					<form method="post" action=" {{ route('admin.deletecategory')}}">
						{{csrf_field()}}
				<input type="hidden" name="tbl" value="{{encrypt('categories')}}">
				<input type="hidden" name="tblid" value="{{encrypt('cid')}}">
				
					<select name="bulk-action"  class="form-control">
						<option value="0">Bulk Action</option>
						<option value="1">Move to Trash</option>
					</select>
				</div>
				<div class="col-sm-2">
					<button class="btn btn-default">Apply</button>
				</div>
				<div class="col-sm-3 col-sm-offset-4">
					<input type="text" id="search"  class="form-control" placeholder="Search Category">
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
						@if(count($data) > 0)
						@foreach($data as $category)
						<tr>
							<td>
								
								<input type="checkbox" name="select-data[]" value="{{$category->cid}}">
								
								<a href="{{ route('admin.editcategory',$category->cid) }}">{{$category->title}}</a>
							</td>
							  <td>{{$category->slug}}</td>
							  <td>{{$category->status}}</td>
						   </tr>
						@endforeach
						@else
						  <td colspan="3">No Data Found </td>
						@endif  
					</tbody>
				</table>
			</div>
</form>				
		</div>
	</div>
</div>
@stop