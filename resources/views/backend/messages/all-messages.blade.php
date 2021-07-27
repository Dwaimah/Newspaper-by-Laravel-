@extends('backend.master')
@section('content')


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 title">
      <h1><i class="fa fa-bars"></i> All Messages </h1>
    </div>
    <div class="search-div">
      <div class="col-sm-9">
        All({{$totals}}) 
      </div>

      <div class="col-sm-3">
        <input type="text" id="search" name="search" class="form-control" placeholder="Search Posts">
      </div>
    </div>  

    <div class="clearfix"></div>

    <div class="filter-div">


      
      @if (Session('add'))
      <<div class="alert alert-success alert-dismissable fade in">
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
      <form method="post" action="{{route('admin.deletemessages')}}">
        {{csrf_field()}}
        <input type="hidden" name="tbl" value="{{encrypt('messages')}}">
        <input type="hidden" name="tblid" value="{{encrypt('mid')}}">
       
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
     
    
     
      </div> 

 
    
    <div class="col-sm-12">
      <div class="content">
        <table class="table table-striped" id="myTable">
          <thead>
            <tr>
              <th ><input type="checkbox" id="select-all"> Sender</th>            
              <th>Email</th>
               <th>Phone</th>              
               <th >Message</th>
               <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @if(count($messages) > 0)
            @foreach($messages as $msg)
              <tr>                 
                <td>
                  <input type="checkbox"  name="select-cat[]" value="{{ $msg->mid }}"> 
                    <a href="#">{{ $msg->name }}</a>
                </td>               
               
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->phone }}</td>
                <td>{{ substr($msg->message,0,100) }}<a href="#expand{{$msg->mid}}" data-toggle="modal">&nbsp; &nbsp; &nbsp; &nbsp; Expand</a></td>
                <td>{{ $msg->created_at }}</td>
                
              <!-- Modal -->
              <div  class="modal" id="expand{{$msg->mid}}">
                <div class="modal-dialog">

                 <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <a href="#" class="close" data-dismiss="modal">&times;</a>
                        <h4 class="modal-title">Message Sent by: {{ $msg->name }} </h4>
                      </div>
                      <div class="modal-body">
                        <p>{{$msg->message}}</p>
                      </div>
                      <div class="modal-footer" style="text-align: left;">
                        <p>Sent on: {{$msg->created_at}}</p>
                        <p>Phone: {{$msg->phone}}</p>
                        <p>Email: {{$msg->email}}</p>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

              </tr>
              @endforeach
            @else
            <tr>
              <td colspan="=4">Messages Not Found </td>
            </tr>
            @endif       
          </tbody>
        </table>
      </div>
    </div>
 </form>


    <div class="filter-div"></div>        
      
        
        
      </div>
    </div>
  </div>
</div>

@stop