@extends('frontend.master')

@section('title')
<title>{{ $page->title }} </title>
@stop


@section('content')



	<div class="wrapper">

		<div class="row" style="margin-top:30px;">
			<div class="col-md-8">
				<div class="col-md-12" style="padding:15px 15px 30px 0px;">				
					
					<h1 class="text-uppercase" >{{$page->title}}</h1>
					{!! $page->description !!}
					 

						</div>        
			</div>


<!-- right section -->
			<div class="col-md-4">
				<div class="col-md-12" style="padding:15px;">
					<h3 style="border-bottom:3px solid #2b99ca; padding-bottom:5px;"><span style="padding:6px 12px; background:#2b99ca;">Last NEWS</span></h3>

					 @foreach($latest->take(10) as $l)

					<div class="col-md-12" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-bottom:10px;">
						<div class="col-md-4">
							<div class="row">
								 <a href="{{ url('article')}}/{{$l->slug}}">
								<img src="{{url('public/posts')}}/{{ $l->image }}" width="100%" style="margin-left:-15px;" />
							     </a>
							</div>
						</div>
						<div class="col-md-8">
							<div class="row" style="padding-left:10px;">
								 <a href="{{ url('article')}}/{{$l->slug}}">
								<h4>{{ $l->title}}</h4>
							     </a>
							</div>
						</div>
					</div>

					@endforeach
					
				</div>			

			@if($sidebartopRecord)
          <div class="col-sm-12 sidebar-adv-article" >
            <a href="{{$sidebartopRecord->url}}">
           <img src="{{url('public/advertisements')}}/{{$sidebartopRecord->image}}" width="100%" height="300" />
           </a>
          </div>
          @endif
			
          @if($sidebarbottomRecord)
          <div class="col-sm-12 sidebar-adv">
          <a href="{{$sidebarbottomRecord->url}}">
          <img src="{{url('public/advertisements')}}/{{$sidebarbottomRecord->image}}" width="100%" height="400" />
          </a>
          </div>
          @endif

			
			</div>
		</div> 
	</div>

@stop