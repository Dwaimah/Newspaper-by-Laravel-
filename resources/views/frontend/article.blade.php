@extends('frontend.master')

@section('title')
<title>{{ $post->title }} </title>
@stop


@section('content')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0" nonce="TyVd7BYW"></script>

<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>




	<div class="wrapper">

		<div class="row" style="margin-top:30px;">
			<div class="col-md-8">
				<div class="col-md-12" style="padding:15px 15px 30px 0px;">				
					<div class="col-md-12">

						<div class="text-right view-count"> 
						   
      					    <h3> 
      					    	<i class="fa fa-eye"></i>
      					    	{{$post->views + 1}}
      					    	@if($post->views != 0)
      					    	Views
      					    	@else
      					    	View
      					    	@endif  
      					     </h3> 
      					      
      					   
    					 </div>

						<h1 style="color: #333;">{{ $post->title }}</h1>
						<img src="{{url('public/posts')}}/{{$post->image}}" width="100%" style="margin-bottom:15px;" />
						
						 <p style="font-size: 20px;">{!! substr($post->description,0,500) !!}</p>
					</div>	
					
					 <div class="col-sm-12 share-this">
							 	<h3 style="font-weight: bold; padding: 10px;" >share this.....</h3>
							 	<div class=" col-md-12">
								 	<div class="fb-share-button" data-href="{{url('article')}}/{{$post->slug}}" data-layout="button"    data-size="small">
								 		
								 	</div>

								    <span class="tweet-btn">
									 	<a class="twitter-share-button"
										  href="{{url('public/posts')}}/{{$post->image}}"
										  data-size="small">
									      m</a>
								    </span>

									<script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
									<script type="IN/Share" data-url="{{url('public/posts')}}/{{$post->image}}"></script>
								</div>
					 </div>

						<div class="col-md-12 also like">
							<h3 style="color: #333;">You May Also Like</h3>
						</div>	
						 @foreach($related->take(3) as $r)
            			
		
						<div class="col-md-4">
							 <a href="{{ url('article')}}/{{$r->slug}}">
							<img src="{{url('public/posts')}}/{{ $r->image }}" width="100%" style="margin-bottom:15px;" />
							 </a>
							 <p style="font-size: 15px;">{!! substr($r->description,0,100) !!}</p>
							
							
						</div>
						@endforeach
					
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
			

			
			</div>
		</div> 
	</div>

@stop