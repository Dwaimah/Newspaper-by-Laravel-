<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;

class frontController extends Controller
{
    public function __construct()
{
  $latest=DB::table('posts')->where('status','published')->orderby('pid','DESC')-> first();
  $pages=DB::table('pages')->where('status','published')->orderby('pageid','DESC')-> get();
  $latestTitle=$latest->title;
  $latestSlug=$latest->slug;
  $categories = DB::table('categories')->where('status','on')->get();
  $settings = DB::table('settings')->first();
  $leaderRecord=NULL;
  $sidebartopRecord=NULL;
  $sidebarbottomRecord=NULL;
 

   $leaderboard = DB::table('advertisements')  
  ->where('location','Leaderboard')
  ->orderby('aid','DESC')
  ->get();

  foreach ($leaderboard as  $l) 
  {
   
    if($l->status == 'display')
    {
      $leaderRecord=$l;    
      break;
    }
   }

    $sidebartop = DB::table('advertisements')  
  ->where('location','Sidebar-top')
  ->orderby('aid','DESC')
  ->get();

  foreach ($sidebartop as  $l) 
  {
    
    if($l->status == 'display')
    {
      $sidebartopRecord=$l;      
      break;
    }
   }

    $sidebarbottom = DB::table('advertisements')  
  ->where('location','Sidebar-bottom')
  ->orderby('aid','DESC')
  ->get();

  foreach ($sidebarbottom as  $l) 
  {
    
    if($l->status == 'display')
    {
      $sidebarbottomRecord=$l;    
      break;
    }
   }
/*
  print_r($leaderRecord);
   print_r($sidebartopRecord);
    print_r($sidebarbottomRecord);
  exit();
*/
  // $leaderboard=DB::table('advertisements')->where('status','=','display')->where('location', '=', 'Leaderboard')->get(); 


 // $sidebartop=DB::table('advertisements')->where('status','display')->where('location','Sidebar-top')->orderby('aid','DESC')-> first();
  //$sidebarbottom=DB::table('advertisements')->where('status','display')->where('location','Sidebar-bottom')->orderby('aid','DESC')->first();

   
   $socials[]="";
        if($settings)
        {
         $socials = explode(',', $settings->social);
        //print_r($socials);
         //exit();
        }


    $icons=[];
    foreach ($socials as  $social)
     {
         $icon = explode('.', $social);
         $icons[]=$icon[1];  
        
      }
    //print_r($latestSlug);    

  view()->share([
     'latestTitle' => $latestTitle,
  'latestSlug' => $latestSlug,
  'categories' => $categories,
  'settings' => $settings,
  'socials' => $socials,
  'icons' => $icons,
   'pages' => $pages,
   'leaderRecord'=>$leaderRecord,
    'sidebartopRecord'=>$sidebartopRecord,
    'sidebarbottomRecord'=>$sidebarbottomRecord

   ]);
}

    public function index()
    {
      $featured=DB::table('posts')->where('category_id','LIKE','%9%')->orderby('pid','DESC')->get();
      $general=DB::table('posts')->where('category_id','LIKE','%10%')->orderby('pid','DESC')->get();
      $business=DB::table('posts')->where('category_id','LIKE','%2%')->orderby('pid','DESC')->get();
      $sports=DB::table('posts')->where('category_id','LIKE','%5%')->orderby('pid','DESC')->get();
      $technology=DB::table('posts')->where('category_id','LIKE','%4%')->orderby('pid','DESC')->get();
      $health=DB::table('posts')->where('category_id','LIKE','%8%')->orderby('pid','DESC')->get();
      $travel=DB::table('posts')->where('category_id','LIKE','%6%')->orderby('pid','DESC')->get();
      $entertainment=DB::table('posts')->where('category_id','LIKE','%3%')->orderby('pid','DESC')->get();
      
      $politics=DB::table('posts')->where('category_id','LIKE','%1%')->orderby('pid','DESC')->get();


      

     

    	return view ('frontend.index',[
        'featured'=>$featured,
         'general'=>$general,
         'business'=>$business,
         'sports'=>$sports,
         'technology'=>$technology,
         'health'=>$health,
         'travel'=>$travel,
         'entertainment'=>$entertainment,
         'politics'=>$politics
      ]);
    }

    public function article($slug)
    {
      $post=DB::table('posts')->where('slug','LIKE',$slug)->first();
      $newViewCounter=$post->views + 1;
     
     DB::table('posts')->where('slug',$slug)->update(['views'=>$newViewCounter]);
      $categories=explode(',', $post->category_id);
      $category_id=$categories[0];
      $related=DB::table('posts')->where('category_id','LIKE','%'.$category_id.'%')->get();
      $latest=DB::table('posts')->where('status','published')->orderby('pid','DESC')-> get();
     // print_r($latest);
    	return view ('frontend.article',[
        'post'=>$post,
        'related'=>$related,
        'latest'=>$latest
      ]);
     // return view ('frontend.article');
    }

    public function category($cid)
    { 
      $cat=DB::table('categories')->where('cid',$cid)->first();
      $posts=DB::table('posts')->where('category_id','LIKE','%'.$cid.'%')->orderby('pid','DESC')-> get();
      $latest=DB::table('posts')->where('status','published')->orderby('pid','DESC')-> get();
     // print_r($posts);
    	return view ('frontend.category',[
        'cat'=>$cat,
        'posts'=>$posts,       
        'latest'=>$latest
      ]);
    }

    public function searchContent(){
      $url='http://localhost/newspaper2/article';
      $data=$_GET['text'];
     // print_r($data);

      $output="AAAAA";
    
      $result=DB::table('posts')->where('title','LIKE','%'.$data.'%')->orwhere('description','LIKE','%'.$data.'%')->get();
       //  $latest=DB::table('posts')->where('status','published')->orderby('pid','DESC')-> first();

     //print_r($result->title);
      echo '<ul class="search-result">';    

      if(count($result)>0) {
         foreach ($result as $r) {
         echo '<li><a href="'.$url.'/'.$r->slug.'">'.$r->title.'</a></li>';
          }
      
      }else{
        echo '<li><a href="#"></a>Sorry! No Results Found.</li>';
       }
     echo '</ul>';     
     
    }

 public function page($pageid){

         $latest=DB::table('posts')->where('status','published')->orderby('pid','DESC')-> get();
        $page=DB::table('pages')->where('pageid', $pageid)->first();
      
         return view ('frontend.page',[  
            'latest' => $latest,          
            'page' => $page   
        ]);
    }


 public function contact(){

         $latest=DB::table('posts')->where('status','published')->orderby('pid','DESC')-> get();
       
      
         return view ('frontend.contact',[  
            'latest' => $latest        
            
        ]);
    }

}
