<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

@yield('title')
<title>NEWSPAPER - LARAVEL PORTAL</title>


<link href="{{url('public/css/font-awesome.min.css')}}" rel="stylesheet" />
<link href="{{url('public/css/bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{url('public/css/bootstrap-theme.min.css')}}" rel="stylesheet" />
<link href="{{url('public/css/style4.css')}}" rel="stylesheet" />
<script src="{{url('public/js/jquery.min.js')}}"></script>
<script src="{{url('public/js/bootstrap.min.js')}}"></script>
</head>

<body>
<div class="col-md-12 top" id="top">
	<div class="col-md-9 top-left">
    	<div class="col-md-3">
    		<span class="day">{{ date('l,m d yy') }}</span> 
        </div>
        <div class="col-md-9">
        	<span class="latest">Latest: </span>
            <a href="{{url('article')}}/{{$latestSlug}}">{{ $latestTitle }}</a>
        </div>
    </div>
    <div class="col-md-3 top-social">
        @foreach($icons as $key=>$icon)
    	<a href="{{ $socials[$key] }}" class="socia-icons"><i class="fa fa-{{ $icon }}"></i></a>
        @endforeach
    	
    </div>
</div>

<div class="col-md-12 brand">
	<div class="col-md-2 name">
    	<img src="{{url('public/settings')}}/{{ $settings->image }}" width="120" style=" margin-top: 0px;" />
    </div>
    <div class="col-md-10">
        @if($leaderRecord)
        <a href="{{$leaderRecord->url}}">
    	<img src="{{url('public/advertisements')}}/{{$leaderRecord->image}}" width="100%" style=" margin-top: 17px;" alt="{{$leaderRecord->title}}" />
        </a>
        @endif
    </div>
</div>

<div class="col-md-12 main-menu">
	<div class="col-md-10 menu">
		<nav class="navbar">
			<div class="navbar-header">
    			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar"> 
					<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
        		</button>
        		<span class="navbar-brand"><font color="#555555">COLOR</font><font color="#2ca0c9">MAG</font></span>
    		</div>
    		<div class="collapse navbar-collapse" id="mynavbar">
    			<ul class="nav nav-justified">
    				<li><a href="{{ url('/') }}" class="active"><span class="glyphicon glyphicon-home"></span></a></li>
                   
                 
                    @foreach($categories as $cat)
    				<li><a href="{{ url('category') }}/{{ $cat->cid }}" class="text-uppercase">{{ $cat->title}}</a></li>
    				@endforeach
             
			</div>
		</nav>
	</div>
	<div class="col-md-2">
        <div class="search">
            <input type="search" class="form-control" id="search_content" />
           <i><span class="glyphicon glyphicon-search search-btn"></span></i> 
           <div id="search-output" style="  position: absolute; display: none; color: #333; font-size: 12px; width: 100%; height: auto; box-sizing: border-box; background: #fff; padding: 10px; top: 100%; left: 0; margin-top: 10px; z-index: 2; border: 3px solid #249bc6; " ></div>

        </div>    	
    </div>
</div> 

<!--End of header -->

@yield('content')

<!--Start of footer -->



<div class="col-md-12 bottom">
        <div class="col-md-4">
            <h3 style="border-bottom:2px solid #ccc;"><span style="border-bottom:2px solid #f00;">About Us</span></h3>
           <img src="{{url('public/settings')}}/{{ $settings->image }}" width="120" style=" margin-top: 0px;" />
         <p align="justify">{{ $settings->about }}</p>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <h3 style="border-bottom:2px solid #ccc;"><span style="border-bottom:2px solid #f00;">Quick Links</span></h3>
            </div>    
            <div class="col-md-12">
                <div class="row">
                <ul class="nav">
                    @foreach($pages as  $page)
                      
                       <li><a href="{{route('frontend.page',$page->pageid)}}" class="text-uppercase">{{ $page->title}}</a></li>
                     
                     @endforeach

                     <li><a href="{{route('frontend.contact')}}" class="text-uppercase">contact</a></li> 
                </ul> 

                </div>
            </div>
            </div>
        <div class="col-md-4">
            <h3 style="border-bottom:2px solid #ccc;"><span style="border-bottom:2px solid #f00;">Contact Us</span></h3>
           <img src="{{url('public/settings')}}/{{ $settings->image }}" width="120" style=" margin-top: 0px;" /><br>
            Follow us at:<br />
               @foreach($icons as $key=>$icon)
                <a href="{{ $socials[$key] }}" class="socia-icons"><i class="fa fa-{{ $icon }}"></i></a>
                @endforeach
            <a href="#top" class=" goto"><span class="glyphicon glyphicon-chevron-up"></span></a>
        </div>
</div>

<div class="col-md-12 text-center copyright">
    Copyright &copy; {{ date('Y') }} <a href="#">COLORMAG</a> Powered by: <a href="#">Dwaimah News</a>
</div>



<script>            
   $(document).ready(function() {
        var duration = 500;
        $(window).scroll(function() {
            if ($(this).scrollTop() > 500) {
                $('.goto').fadeIn(duration);
            } else {
                $('.goto').fadeOut(duration);
            }
        });

        $('.goto').click(function(event) {
            event.preventDefault();
            $('html').animate({scrollTop: 0}, duration);
            return false;
        })

        $('#search_content').keyup(function(){

            var text=$('#search_content').val();
            if(text.length < 1){
                $('#search-output').hide();
                return false;
            }else{
                $.ajax({
                    type: "get",
                    url: "{{url('search-content')}}",
                    data: {text:text},
                    success:function(res){
                        $('#search-output').show();
                        $('#search-output').html(res);
                    }

                })
            }
        })
    });
</script>   

</body>
</html>
