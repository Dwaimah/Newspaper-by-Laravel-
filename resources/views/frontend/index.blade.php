@extends('frontend.master')
@section('content')

<div class="wrapper">
    <div class="row">

        @foreach($featured as $key=>$f)
        @if($key == 0)
        <div class="col-md-6 first-div">
            <div class="relative">
            <a href="#"><img src="{{url('public/posts')}}/{{$f->image}}" width="100%" />
            <span class="caption">{{$f->title}}</span>
            </a>
            </div>
        </div>
        @endif
        @endforeach
        <div class="col-md-6 first-div">
            <div class="row">
                @foreach($featured as $key=>$f)
                @if($key>0 && $key<3)
                <div class="col-md-6">
                    <div class="relative">
                    <a href="#"><img src="{{url('public/posts')}}/{{$f->image}}" width="100%" height="182" />
                    <span class="caption">{{$f->title}}</span>
                    </a>
                    </div>  
                </div>
                @endif
                @endforeach
               
            </div>
            <div class="row" style="margin-top:30px;">
                @foreach($featured as $key=>$f)
                @if($key>2 && $key<5)
                <div class="col-md-6 first-div">
                    <div class="relative">
                    <a href="#"><img src="{{url('public/posts')}}/{{$f->image}}" width="100%" height="180" />
                    <span class="caption">{{$f->title}}</span>
                    </a>
                    </div>
                </div>
                @endif
                @endforeach
               
            </div>        
        </div>
    </div>
 


    

  <div class="row" style="margin-top:30px;">
        <div class="col-md-8">
        <div class="col-md-12" style="border:1px solid #ccc; padding:15px 15px 30px 0px;">
            <div class="col-md-12">
                <h3 style="border-bottom:3px solid #81d742; padding-bottom:5px;"><span style="padding:6px 12px; background:#81d742;">NEWS</span></h3>
            </div>
             @foreach($general as $key=>$g)
             @if($key == 0)
            <div class="col-md-6">
                <a href="{{ url('article')}}/{{$g->slug}}">
                <img src="{{url('public/posts')}}/{{$g->image}}" width="100%" style="margin-bottom:15px;" />
                </a>
                <a href="{{ url('article')}}/{{$g->slug}}">
                <h3 style="color: #333; font-size: 20px; font-weight: bold;">{{$g->title}}</h3>
                </a>
             
                <p style="font-size: 10px;">{!! substr($g->description,0,500) !!}</p>
                     <a href="{{ url('article')}}/{{$g->slug}}">Read More &raquo;</a>

            </div>

             @endif            
             @endforeach

            
            <div class="col-md-6">
                
                    @foreach($general as $key=>$g)
                    @if($key > 0 && $key <5)
                    <div class="row" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-bottom:10px;">
                        <div class="col-md-4">
                            <div class="row">
                                <a href="{{ url('article')}}/{{$g->slug}}">
                                <img src="{{url('public/posts')}}/{{$g->image}}" width="100%" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                 <a href="{{ url('article')}}/{{$g->slug}}">
                                 <h4>{{$g->title}}</h4>
                                 </a>
                            </div>

                        </div>  
                    </div>              

                    @endif
                   @endforeach
        
        </div>
    </div>


        
            <div class="col-md-12 image-gallery" style="border:1px solid #ccc; padding:15px 15px 30px 15px; margin-top:30px; margin-bottom:30px;">
                <h3 style="border-bottom:3px solid #81d742; padding-bottom:5px;"><span style="padding:6px 12px; background:#81d742;">BUSINESS</span></h3>
            <div class="flex" >
                @foreach($business->take(5) as $b)
                <div>
                     <a href="{{ url('article')}}/{{$b->slug}}">
                    <img src="{{url('public/posts')}}/{{$b->image}}" />
                     </a>
                </div>
                
                @endforeach
            </div>
            </div>
        
        <div class="row">
            <div class="col-md-6">
            <div class="col-md-12" style="border:1px solid #ccc; padding-bottom:30px;">
            

                <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:20px 10px; margin-bottom:10px; height: 450px;">
                <h3 style="border-bottom:3px solid #b952c8; padding-bottom:5px;"><span style="padding:6px 12px; background:#b952c8;">TECHNOLOGY</span></h3>

                     @foreach($technology as $key=>$t)
                     @if($key == 0)
                        
                
                    <a href="{{ url('article')}}/{{$t->slug}}">
                    <img src="{{url('public/posts')}}/{{$t->image}}" width="100%" style="margin-bottom:15px;" />
                    </a>
                    <a href="{{ url('article')}}/{{$t->slug}}">
                    <h3 style="color: #333; font-size: 20px; font-weight: bold;">{{$t->title}}</h3>
                    </a>
                 
                    <p style="font-size: 10px;">{!! substr($t->description,0,500) !!}</p>
                    <a href="{{ url('article')}}/{{$t->slug}}">Read More &raquo;</a>

               </div>

             @endif            
             @endforeach

              @foreach($technology as $key=>$t)
              @if($key > 0 && $key < 6)      
                <div class="col-md-12" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-bottom:10px;">
                    <div class="col-md-4">
                        <div class="row fashion">
                            <a href="{{ url('article')}}/{{$t->slug}}">
                            <img src="{{url('public/posts')}}/{{$t->image}}" width="100%" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <a href="{{ url('article')}}/{{$t->slug}}">
                            <h4>{{$t->title}}</h4>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach                
                
            </div></div>


            <div class="col-md-6">
            <div class="col-md-12" style="border:1px solid #ccc; padding-bottom:30px;">
            

                 <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:20px 10px; margin-bottom:10px; height: 450px;">
                <h3 style="border-bottom:3px solid #b952c8; padding-bottom:5px;"><span style="padding:6px 12px; background:#b952c8;">SPORTS</span></h3>

                     @foreach($sports as $key=>$s)
                     @if($key == 0)
                        
                
                    <a href="{{ url('article')}}/{{$s->slug}}">
                    <img src="{{url('public/posts')}}/{{$s->image}}" width="100%" style="margin-bottom:15px;" />
                    </a>
                    <a href="{{ url('article')}}/{{$s->slug}}">
                    <h3 style="color: #333; font-size: 20px; font-weight: bold;">{{$s->title}}</h3>
                    </a>
                 
                    <p style="font-size: 10px;">{!! substr($s->description,0,500) !!}</p>
                    <a href="{{ url('article')}}/{{$s->slug}}">Read More &raquo;</a>

               </div>

             @endif            
             @endforeach

              @foreach($sports as $key=>$s)
              @if($key > 0 && $key < 6)      
                <div class="col-md-12" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-bottom:10px;">
                    <div class="col-md-4">
                        <div class="row fashion">
                            <a href="{{ url('article')}}/{{$s->slug}}">
                            <img src="{{url('public/posts')}}/{{$s->image}}" width="100%" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <a href="{{ url('article')}}/{{$s->slug}}">
                            <h4>{{$s->title}}</h4>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach                
                
            </div></div>

        
        <div class="col-md-12">
            <div class="col-md-12" style="border:1px solid #ccc; padding:15px 15px 30px 0px; margin-top:30px;">
            <div class="col-md-12">
            <h3 style="border-bottom:3px solid #81d742; padding-bottom:5px;"><span style="padding:6px 12px; background:#81d742;">HEALTH</span></h3>
            </div>

             @foreach($health as $key=>$h)
             @if($key == 0)
            <div class="col-md-6">
                <a href="{{ url('article')}}/{{$g->slug}}">
                <img src="{{url('public/posts')}}/{{$h->image}}" width="100%" style="margin-bottom:15px;" />
                </a>
                <a href="{{ url('article')}}/{{$g->slug}}">
                <h3 style="color: #333; font-size: 20px; font-weight: bold;">{{$h->title}}</h3>
                </a>
             
                <p style="font-size: 10px;">{!! substr($h->description,0,500) !!}</p>
                     <a href="{{ url('article')}}/{{$g->slug}}">Read More &raquo;</a>

            </div>

             @endif            
             @endforeach

            <div class="col-md-6">
                 
                
                    @foreach($health as $key=>$h)
                    @if($key > 0 && $key <5)
                    <div class="row" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-bottom:10px;">
                        <div class="col-md-4">
                            <div class="row">
                                <a href="{{ url('article')}}/{{$h->slug}}">
                                <img src="{{url('public/posts')}}/{{$h->image}}" width="100%" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                 <a href="{{ url('article')}}/{{$h->slug}}">
                                 <h4>{{$h->title}}</h4>
                                 </a>
                            </div>

                        </div>  
                    </div>              

                    @endif
                   @endforeach
        
            </div>
                  
           
        </div>
        </div>
        
        <div class="col-md-12 image-gallery" style="border:1px solid #ccc; padding:15px 15px 30px 15px; margin-top:30px; margin-bottom:30px;">
                <h3 style="border-bottom:3px solid #81d742; padding-bottom:5px;"><span style="padding:6px 12px; background:#81d742;">TRAVEL</span></h3>
            <div class="flex" >
                @foreach($travel->take(5) as $t)
                <div>
                     <a href="{{ url('article')}}/{{$t->slug}}">
                    <img src="{{url('public/posts')}}/{{$t->image}}" />
                     </a>
                </div>
                
                @endforeach
            </div>
            </div>
        <div class="col-md-12">
            <div class="col-md-12" style="border:1px solid #ccc; padding:15px 15px 30px 0px; margin-top:30px;">
            <div class="col-md-12">
            <h3 style="border-bottom:3px solid #81d742; padding-bottom:5px;"><span style="padding:6px 12px; background:#81d742;">ENTERTAINMENT</span></h3>
            </div>

             @foreach($entertainment as $key=>$e)
             @if($key == 0)

            <div class="col-md-6">
                <a href="{{ url('article')}}/{{ $e->slug }}">
                <img src="{{url('public/posts')}}/{{$e->image}}" width="100%" style="margin-bottom:15px;" />
                </a>
                <a href="{{ url('article')}}/{{$e->slug}}">
                <h3 style="color: #333; font-size: 20px; font-weight: bold;">{{$e->title}}</h3>
                </a>
             
                <p style="font-size: 10px;">{!! substr($e->description,0,500) !!}</p>
                     <a href="{{ url('article')}}/{{$e->slug}}">Read More &raquo;</a>

            </div>

             @endif            
             @endforeach

            <div class="col-md-6">
                 
                
                    @foreach($entertainment as $key=>$e)
                    @if($key > 0 && $key <5)
                    <div class="row" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-bottom:10px;">
                        <div class="col-md-4">
                            <div class="row">
                                <a href="{{ url('article')}}/{{$e->slug}}">
                                <img src="{{url('public/posts')}}/{{$e->image}}" width="100%" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                 <a href="{{ url('article')}}/{{$e->slug}}">
                                 <h4>{{$e->title}}</h4>
                                 </a>
                            </div>

                        </div>  
                    </div>              

                    @endif
                   @endforeach
        
            </div>
                  
           
        </div>
        </div>
    </div>
</div>

        <div class="col-md-4">
        <div class="col-md-12" style="border:1px solid #ccc; padding:15px;">
            <h3 style="border-bottom:3px solid #2b99ca; padding-bottom:5px;"><span style="padding:6px 12px; background:#2b99ca;">POLITICS</span></h3>
            @foreach($politics->take(10) as $p)
            <div class="col-md-12" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-bottom:10px;">
                <div class="col-md-4">
                    <div class="row">
                        <a href="{{ url('article')}}/{{$p->slug}}">
                        <img src="{{url('public/posts')}}/{{$p->image}}" width="100%" style="margin-left:-15px;" />
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row" style="padding-left:10px;">
                        <a href="{{ url('article')}}/{{$e->slug}}">
                        <h4>{{ $p->title }}</h4>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        

         @if($sidebartopRecord)
          <div class="col-sm-12 sidebar-adv">
            <a href="{{$sidebartopRecord->url}}">
           <img src="{{url('public/advertisements')}}/{{$sidebartopRecord->image}}" width="100%" height="400" />
           </a>
          </div>
          @endif

          <div class="col-md-12" style="border:1px solid #ccc; padding:15px 15px 60px 15px; margin-top:30px;">
            <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:0px 10px 20px 10px; margin-bottom:10px;">
                <h3 style="border-bottom:3px solid #2b99ca; padding-bottom:5px;"><span style="padding:6px 12px; background:#2b99ca;">STYLE</span></h3>

  
                     @foreach($sports as $key=>$s)
                     @if($key == 0)
                        
                
                    <a href="{{ url('article')}}/{{$s->slug}}">
                    <img src="{{url('public/posts')}}/{{$s->image}}" width="100%" style="margin-bottom:15px;" />
                    </a>
                    <a href="{{ url('article')}}/{{$s->slug}}">
                    <h3 style="color: #333; font-size: 20px; font-weight: bold;">{{$s->title}}</h3>
                    </a>
                 
                    <p style="font-size: 10px;">{!! substr($s->description,0,500) !!}</p>
                    <a href="{{ url('article')}}/{{$s->slug}}">Read More &raquo;</a>

               </div>

             @endif            
             @endforeach

             


                    
               @foreach($entertainment as $key=>$e)
                    @if($key > 0 && $key <5)
                    <div class="row" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-left:10px;">
                        <div class="col-md-4">
                            <div class="row">
                                <a href="{{ url('article')}}/{{$e->slug}}">
                                <img src="{{url('public/posts')}}/{{$e->image}}" width="100%" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                 <a href="{{ url('article')}}/{{$e->slug}}">
                                 <h4>{{$e->title}}</h4>
                                 </a>
                            </div>

                        </div>  
                    </div>              

                    @endif
                   @endforeach

                
          </div>
          
          
         @if($sidebarbottomRecord)
          <div class="col-sm-12 sidebar-adv">
          <a href="{{$sidebarbottomRecord->url}}">
          <img src="{{url('public/advertisements')}}/{{$sidebarbottomRecord->image}}" width="100%" height="400" />
          </a>
          </div>
          @endif
          
         <div class="col-md-12" style="border:1px solid #ccc; padding:15px 15px 7px 15px; margin-top:30px;">
            <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:0px 10px 20px 10px; margin-bottom:10px;">
            <h3 style="border-bottom:3px solid #2b99ca; padding-bottom:5px;"><span style="padding:6px 12px; background:#2b99ca;">MORE NEWS</span></h3>
                    <img src="{{url('public/images/coffee-563797_1280-390x205.jpg')}}" width="100%" style="margin-bottom:15px;" />
                    <p align="justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>Read more <a href="#"><span class="glyphicon glyphicon-chevron-right"></span><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
                <div class="col-md-12" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-bottom:10px;">
                    <div class="col-md-4">
                        <div class="row">
                            <img src="{{url('public/images/relaxed-498245_1280-392x272.jpg')}}" width="100%" style="margin-left:-15px;" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row" style="padding-left:0px;">
                            <h4>Lorem ipsum dolor sit amet</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-bottom:10px;">
                    <div class="col-md-4">
                        <div class="row">
                            <img src="{{url('public/images/relaxed-498245_1280-392x272.jpg')}}" width="100%" style="margin-left:-15px;" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row" style="padding-left:0px;">
                            <h4>Lorem ipsum dolor sit amet</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-bottom:10px;">
                    <div class="col-md-4">
                        <div class="row">
                            <img src="{{url('public/images/relaxed-498245_1280-392x272.jpg')}}" width="100%" style="margin-left:-15px;" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row" style="padding-left:0px;">
                            <h4>Lorem ipsum dolor sit amet</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="border-bottom:1px solid #ccc; padding-bottom:10px; margin-bottom:10px;">
                    <div class="col-md-4">
                        <div class="row">
                            <img src="{{url('public/images/relaxed-498245_1280-392x272.jpg')}}" width="100%" style="margin-left:-15px;" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row" style="padding-left:0px;">
                            <h4>Lorem ipsum dolor sit amet</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="padding-bottom:10px;">
                    <div class="col-md-4">
                        <div class="row">
                            <img src="{{url('public/images/relaxed-498245_1280-392x272.jpg')}}" width="100%" style="margin-left:-15px;" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row" style="padding-left:0px;">
                            <h4>Lorem ipsum dolor sit amet</h4>
                        </div>
                    </div>
                </div>
          </div> 
          
        </div>
    </div> 
</div>

@stop
