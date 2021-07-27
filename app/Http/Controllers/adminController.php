<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Arr;
use Session;
//se App\Http\Models\Post;
use App\Models\Post;
use App\Models\Page;
use App\Models\User;
use Auth;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Model_Has_Roles;




class adminController extends Controller
{
    
   //You need authenticaton to access any admin page
    
    public function __construct(){
         $this->middleware('auth');

    }

    public function index()
    {
       // $role = Role::create(['name' => 'writer']);
        //$permission = Permission::create(['name' => 'edit articles']);
         //auth()->user()->assignRole('Writer');
    	return view ('backend.index');
        ////return"Hello, This is a snippet.";
       // return redirect(route('admin.index'));
    	
    }

    /*
   // Working 100% with join technology 

  public function users()
    {

      $users_has_roles = DB::table('users')
         ->Join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
         ->Join('roles', 'model_has_roles.role_id', '=', 'roles.id')
         ->select(DB::raw('users.id as user_id,roles.id as role_id,users.name as user_name,users.email as user_email,roles.name as user_role')) 
                ->get();

          

           
             $users_hasNot_roles = DB::table('users')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('model_has_roles.model_id', '=', NULL)
             ->select(DB::raw('users.id as user_id,users.name as user_name,users.email as user_email')) 
            ->get();

           // print_r($users_hasNot_roles);

           
        return view ('backend.users.all-users',[
            'users_has_roles'=> $users_has_roles,
            'users_hasNot_roles'=>$users_hasNot_roles
        ]);

         //  print_r($loginUser);
        //exit();

/*

         $users = json_decode(json_encode($users_obj), true);
         $roles[]="";
         //$users_array
        
        
      
     

        
    }

 */

    /////////////////////////////////Users////////////////////////////

    public function users()

    {
          $users = User::get();
          $loginUser=auth()->user()->getRoleNames()->first();        
         
     
          return view ('backend.users.all-users',[
          'users'=>$users,
          'loginUser' => $loginUser
          ]);    
        
    }

 public function edituser($id)
    {
        
      //  $user = DB::table('users')->where('id', $id)->first();
        $user = User::where('id', $id)->first();

        $userRole=$user->getRoleNames()->first();

        if($user==null)
            return view ('backend.users.all-users');      
       
       
      //print_r($userRole);
      //exit();
        return view ('backend.users.edituser',[            
            'user' => $user,
            'userRole' => $userRole            
        ]);
    }

///////////////////////////////////////Roles//////////////////////////////////

    
 public function allroles()

    {
          $roles = Role::get();
          $loginUser=auth()->user()->getRoleNames()->first();        
         
     
          return view ('backend.roles.all-roles',[
          'roles'=>$roles,
          'loginUser' => $loginUser
          ]);    
        
    }



public function addrole()
{
     $originalpermissions= Permission::get();
    
    $loginUser=auth()->user()->getRoleNames()->first();
         $sections[0]='category';
                            $sections[1]='page';
                            $sections[2]='post';
                            $sections[3]='message';
                            $sections[4]='adv'; 


   return view ('backend.roles.add-role',[            
             
             'originalpermissions' => $originalpermissions,            
             'loginUser' => $loginUser,             
              'sections' => $sections
              
        ]);
}

public function editrole($id)
    {
        
      //  $user = DB::table('users')->where('id', $id)->first();
         $role = Role::where('id', $id)->first();
         $originalpermissions= Permission::get();

       

         $permissions = DB::table('roles')
            ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            //->select('role_has_permissions.permission_id')->where('roles.id','=',$id)
             ->select('permissions.id','permissions.name','permissions.partname')->where('roles.id','=',$id)
            ->get();
  
         $permissions_ids[]="";
         foreach ($permissions as $key => $per) {
            $permissions_ids[$key]=$per->id;
         }

         //print_r($permissions_ids);
         //exit();
        $roles = Role::get();
         $loginUser=auth()->user()->getRoleNames()->first();
         $sections[0]='category';
                            $sections[1]='page';
                            $sections[2]='post';
                            $sections[3]='message';
                            $sections[4]='adv'; 

        return view ('backend.roles.editrole',[            
             'role' => $role,
             'originalpermissions' => $originalpermissions,
             'permissions'=>$permissions,
             'loginUser' => $loginUser,
              'roles' => $roles ,
              'sections' => $sections,
              'permissions_ids' => $permissions_ids          
        ]);
    }


    /////////////////////////////////////////////////////////////////////////

    public function viewcategory()
    {
    	$data= DB::select('select * from categories');

    	//print_r($data);
        return view ('backend.categories.category',[
        	'data'=> $data
        ]);
    }

    
     public function editcategory($id)
    {
    	$data= DB::select('select * from categories');
    	$singlerecord = DB::table('categories')->where('cid', $id)->first();
    	if($singlerecord==null)
            return view ('backend.categories.category',[
            'data'=> $data
        ]);

    	//print_r($singlerecord);
        return view ('backend.categories.editcategory',[
        	'data' => $data,
        	'singlerecord' => $singlerecord
        ]);
    }
     public function deletedata(Request $request)
     {
        $tbl= $request->input('tbl');
        $tbl=decrypt($tbl);
        $tblid= $request->input('tblid');
        $tblid=decrypt($tblid);
        $inputData = Arr::except($_POST, ['_token', 'tbl']);
         
        if($inputData['bulk-action'] == '0')
        {
             $request->session()->flash('faildAction-delete','Please Select the Action');
            //  $request->session()->flash('message','Please Select the Action');
            return redirect()->back();
        }
       
             if (empty($inputData['select-cat']))
         {
             $request->session()->flash('faildChecked-delete','Please Select your choice/ies');
             return redirect()->back();
     // list is empty.
          }

          

            if($tbl=='users')
            {
                foreach ($inputData['select-cat'] as $id)
                {
                     $user = User::where('id', $id)->first();
                     $userrole=$user->getRoleNames()->first();
                     if($userrole != NULL)
                       {
                         $user->removeRole($userrole);
                       }

                }             
               
            }

            if($tbl == 'roles')

            {
                
                 foreach ($inputData['select-cat'] as $id)
                 {
                     //$role=Role::where('id', $id)->first();
                      DB::table('role_has_permissions')->where('role_id', '=', $id)->delete();                   
                  

                 }
              
            }

            foreach ($inputData['select-cat'] as $id)
           {
             
             DB::table($tbl)->where($tblid, $id)->delete();  
            
            }        
         $request->session()->flash('success-delete','Your Data has been deleted Successfuly');
          return redirect()->back();
       
     }


 public function settings()
    {
     // $dataarray=DB::select('select * from settings');
       //$data= $dataarray->first();
      $data= DB::table('settings')->first();
    
       //print_r($dataarray);
      /*  if($data==NULL)
          echo "sssssss";
        print_r($data);
        */
        $socials[]="";
        if($data)
        {
         $socials = explode(',', $data->social);
        }
        return view ('backend.settings',[
          //  'dataarray'=> $dataarray,
            'data'=> $data,
            'socials'=>$socials
        ]);
    }

    public function addPost()
    {
         $data= DB::table('categories')->get();
         $loginUser=auth()->user()->getRoleNames()->first();  
         //print_r($loginUser);
        //$data= DB::select('select * from categories');

       // print_r($data);
        
        return view ('backend.posts.add-post',[
            'data'=> $data,
             'loginUser'=> $loginUser
        ]);
       
    }

      public function allposts()
    {
        
        //print_r($loginUser);
         $posts= Post::orderBy('created_at','desc')->paginate(10);
        
         $data= DB::table('categories')->get();
        
        $totals = DB::table('posts')
        ->selectRaw('count(*) as total')
        ->selectRaw("count(case when status = 'draft' then 1 end) as draft")
        ->selectRaw("count(case when status = 'published' then 1 end) as published")
        ->first();
        //print_r($totals);
       // exit();

/*
         $published_count=DB::row('SELECT
             COUNT(*),  --total
    SUM(CASE WHEN status = 'published' THEN 1 ELSE 0 END) --conditional
      FROM
       posts');
*/

       // print_r($data);
        
        return view ('backend.posts.all-posts',[
            'data'=> $data,
            'posts'=>$posts,
            'totals' =>$totals
        ]);
       
    }

     
     public function editpost($id)
    {
        $posts= DB::table('posts')->paginate(10);
        $categories= DB::table('categories')->get();
        $post = DB::table('posts')->where('pid', $id)->first();
        if($post==null)
            return view ('backend.posts.all-posts',[
            'posts'=> $posts
        ]);
        $categories_id=explode(',', $post->category_id);

       // print_r($categories_id);
       // exit();
        return view ('backend.posts.editpost',[            
            'post' => $post,
            'categories' => $categories,
            'categories_id' => $categories_id
        ]);
    }
///////////////////////////////////////////Page Section////////////////////

     public function addPage()
    {
        // $data= DB::table('pages')->get();
        //$data= DB::select('select * from categories');

       // print_r($data);
        
        return view ('backend.pages.add-page');
       
    }

      public function allpages()
    {
         $pages= Page::orderBy('created_at','desc')->paginate(10);
        
         $data= DB::table('pages')->get();
        
        $totals = DB::table('posts')
        ->selectRaw('count(*) as total')
        ->selectRaw("count(case when status = 'draft' then 1 end) as draft")
        ->selectRaw("count(case when status = 'published' then 1 end) as published")
        ->first();
        //print_r($totals);
       // exit();

/*
         $published_count=DB::row('SELECT
             COUNT(*),  --total
    SUM(CASE WHEN status = 'published' THEN 1 ELSE 0 END) --conditional
      FROM
       posts');
*/

       // print_r($data);
        
        return view ('backend.pages.all-pages',[
            'data'=> $data,
            'pages'=>$pages,
            'totals' =>$totals
        ]);
       
    }

     
     public function editpage($id)
    {
        $pages= DB::table('pages')->paginate(10);
       
        $page = DB::table('pages')->where('pageid', $id)->first();
        if($page==null)
            return view ('backend.pages.all-pages',[
            'pages'=> $pages
        ]);
       

       // print_r($categories_id);
       // exit();
        return view ('backend.pages.editpage',[            
            'page' => $page   
            
        ]);
    }

    public function page($pageid){

         $latest=DB::table('posts')->where('status','published')->orderby('pid','DESC')-> first();
        $page=DB::table('pages')->where('pageid', $pageid)->first();
       // print_r($page);
        //exit();
         return view ('backend.pages.page',[  
          //  'latest' => $latest,          
            'page' => $page   
        ]);
    }


public function messages(){

         
        $messages=DB::table('messages')->orderby('mid','DESC')->paginate(10);
        $totals = count($messages);
        

       // print_r($page);
        //exit();
         return view ('backend.messages.all-messages',[          
            'messages' => $messages,
            'totals' => $totals 
        ]);
     }

         public function addAdv(){
             return view ('backend.advertisements.add-adv');      
         }

         public function alladvs(){
            $totalalladvs=DB::table('advertisements')->count(DB::raw('DISTINCT aid'));
            
            $advs=DB::table('advertisements')->orderby('aid','DESC')->paginate(4);
            $totals = count($advs);
             return view ('backend.advertisements.all-advs',[
                'advs' => $advs,
                 'totals' => $totals,
                 'totalalladvs'=> $totalalladvs
             ]);      
         }
    
     public function editadv($id)
    {
      
       
        $advs=DB::table('advertisements')->orderby('aid','DESC')->paginate(4);
        $adv = DB::table('advertisements')->where('aid', $id)->first();
        if($adv==null)
            return view ('backend.advertisements.all-advs',[
            'advs'=> $advs,
            'totalalladvs'=> $totalalladvs
        ]);
       

       // print_r($categories_id);
       // exit();
        return view ('backend.advertisements.editadv',[            
            'adv' => $adv           
        ]);
    }
}
