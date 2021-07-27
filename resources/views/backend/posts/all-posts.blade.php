@extends('backend.master')
@section('content')


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 title">
      <h1><i class="fa fa-bars"></i> All Posts <button class="btn btn-sm btn-default"><a href="{{ route('admin.add-post')}}"> Add New </a></button></h1>
    </div>
   
    

    <div class="search-div">
      <div class="col-sm-9">
        All({{$totals->total}}) | <a href="#">Published ({{$totals->published}})</a>| <a href="#">Draft ({{$totals->draft}})</a>
      </div>

      <div class="col-sm-3">
        <input type="text" id="search" name="search" class="form-control" placeholder="Search Posts">
      </div>
    </div>  



      <div class="clearfix"></div>

      <div class="filter-div">

        


      
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

         </div>



      <form method="post" action="{{ route('admin.deleteposts') }}">
        {{csrf_field()}}
        <input type="hidden" name="tbl" value="{{encrypt('posts')}}">
        <input type="hidden" name="tblid" value="{{encrypt('pid')}}">
       
        <div class="col-sm-2">
          <select name="bulk-action" class="form-control">
            <option value="0">Bulk Action</option>
            <option value="1">Move to Trash</option>
          </select>
        </div>

        <div class="col-sm-1">
          <div class="row">
            <button class="btn btn-default">Apply</button>

          </div>  
        </div>
         <div class="col-sm-8" style="text-align: right">
        <i class="fa fa-power-off" aria-hidden="true" style="font-size:15px">  Invalidated</i>
         </div>
      <div class="col-sm-8" style="text-align: right">
        <i class="fa fa-power-off" aria-hidden="true" style="font-size:15px; color: green">Validated</i>
         </div>
    
     
      </div> 

 
    
    <div class="col-sm-12">
      <div class="content">
        <table class="table table-striped" id="myTable">
          <thead>
            <tr>
              <th width="50%"><input type="checkbox" id="select-all"> Title</th>
              <th width="15%">Categories</th>
              <th width="15%">Validate</th>
              <th width="15%">Status</th>
              <th width="10%">Date</th>
            </tr>
          </thead>
          <tbody>
            @if(count($posts) > 0)
            @foreach($posts as $post)
              <tr>                 
                <td>
                  <input type="checkbox"  name="select-cat[]" value="{{ $post->pid }}"> 
                    <a href="{{ route('admin.editpost',$post->pid) }}">{{ $post->title }}</a>
                </td>
                
                <td>{{ $post->category_id }}</td>
                <td >@if($post->validate == '1') <a href="{{ route('admin.editpost',$post->pid) }}"><i class="fa fa-power-off" aria-hidden="true" style="font-size:25px;color:green" title="Press to invalidate the post"></i></a> @else <a href="{{ route('admin.editpost',$post->pid) }}"><i class="fa fa-power-off" aria-hidden="true" style="font-size:25px;color:black" title="Press to validate the post"></i></a>  @endif</td>
                <td>{{ $post->status }}</td>
                <td>{{ $post->created_at }}</td>
              </tr>
              @endforeach
            @else
            <tr>
              <td colspan="=4">Posts Not Found </td>
            </tr>
            @endif       
          </tbody>
        </table>
      </div>
    </div>
 </form>


    <div class="filter-div"></div>   
  

      <div class="col-sm-6 col-sm-offset-6 text-right">
        
        {{ $posts->links('backend.posts.default') }}
        

      </div>

     
        
      
        
        
      </div>
    </div>
  </div>
</div>

@stop