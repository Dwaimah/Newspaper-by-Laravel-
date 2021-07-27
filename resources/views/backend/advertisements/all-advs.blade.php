@extends('backend.master')
@section('content')


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-9 title">
      <h1> All Advertisements. </h1>
      <h4>Total of advs. ({{$totalalladvs}})</h4>
    </div>   
  </div>
  <div class="row">         

      <div class="filter-div">


      
      @if (Session('add'))
      <div class="alert alert-success alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
         {{ Session('message') }}
       </div>
            @elseif ( Session('update'))
           <div class="alert alert-success alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
             {{ Session('message') }}
           </div>
           @elseif (Session('faildAction-delete'))
           <div class="alert alert-danger alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
             {{ Session('faildAction-delete') }}
           </div>           
           @elseif (Session('faildChecked-delete'))
           <div class="alert alert-danger alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
             {{ Session('faildChecked-delete') }}
           </div>
            @elseif (Session('success-delete'))
           <div class="alert alert-success alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
             {{ Session('success-delete') }}
           </div>
          
           @endif

         </div>

      <form method="post" action="{{ route('admin.deleteadvs') }}">
        {{csrf_field()}}
        <input type="hidden" name="tbl" value="{{encrypt('advertisements')}}">
        <input type="hidden" name="tblid" value="{{encrypt('aid')}}">
       
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

        <div class="col-sm-3">
        <input type="text" id="search" name="search" class="form-control" placeholder="Search Posts">
      </div>
     
      
      </div> 

     
  <div>
         

        <div class="col-sm-6 col-sm-offset-6 text-right">        
        {{ $advs->links('backend.advertisements.default') }}    

      </div>
</div>    
 
    
    <div class="col-sm-12">
      <div class="content" style="padding: 0; margin-top: 10px;">
        <table class="table table-striped" id="myTable">
          <thead>
            <tr>
              <th ><input type="checkbox" id="select-all"> Title</th>
              <th >URL</th>
              <th >Image</th>
              <th >Location</th>
              <th >Status  </th>
              <th >Date  </th>
          </thead>
          <tbody>
            @if(count($advs) > 0)
            @foreach($advs as $adv)
              <tr>                 
                <td>
                  <input type="checkbox"  name="select-cat[]" value="{{ $adv->aid }}"> 
                    <a href="{{ route('admin.editadv',$adv->aid) }}">{{ $adv->title }}</a>
                </td>
                
                <td><a href="{{$adv->url}}" >{{ $adv->url }}</a></td>
                <td><img src="{{url('public/advertisements')}}/{{$adv->image}}" width="100"></td>
                <td>{{ $adv->location }}</td>
                <td>{{ $adv->status }}</td>
                <td>{{ $adv->created_at }}</td>
              </tr>
              @endforeach
            @else
            <tr>
              <td colspan="=4">Advertisements Not Found </td>
            </tr>
            @endif       
          </tbody>
        </table>
      </div>
    </div>
 </form>


   
     
        
      
        
        
      </div>
    </div>
  </div>
</div>

@stop