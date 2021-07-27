<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Model_Has_Roles;




class crudController extends Controller
{

    //Insert Data Function

     public function insertdata(Request $request)
    {
        $tbl= $request->input('tbl');
        $tbl=decrypt($tbl);

         $inputData = Arr::except($_POST, ['_token', 'tbl']);

       
        
         $inputData['created_at']=date('Y-m-d H:i:s');

         $socialArray[]=NULL;

         if($request->has('social'))
         {
           if($inputData['social'])
             {
                foreach ($inputData['social'] as $key => $social)
              {
                if($social!= "")
                {
                    $socialArray[$key]=$social;
                }
              }//enf foreach
         
            $inputData['social']=implode(',', $socialArray);         
       
             }//end inner if
          else
         {
             $inputData['social']= "";
         }
        }//end outer if
        // 
         if($request->has('image'))
         {
             $fileobject = $request->image;
             $inputData['image']= $this->uploadimage($tbl,$fileobject);
         }

         if($tbl == 'posts')
         {
           
              if (empty($inputData['category_id']))
             {
                
                $request->session()->flash('faildChecked-delete','Please Select your choice/ies');
                return redirect()->back();
    
             }
         
              $inputData['category_id']=implode(',', $inputData['category_id']);          
       
          }  

          if($tbl == 'roles') 
          {

             $isroleexist=DB::table($tbl)->where('name',$inputData['name'])->first();

            //$validatedData = $request->validate([
            //       'name' => [ 'unique:roles', 'max:255'],
                     
          //  ]);

           if($isroleexist != "") // there is role as  your new name
             {
               $request->session()->flash('faildChecked-delete','The role is already exist ');
                return redirect()->back();
              
             }else
            {
              //DB::table($tbl)->insert($inputData['name']);
              DB::table($tbl)->insert([
                    'name' => $inputData['name'],
                    'created_at' => $inputData['created_at']
                ]);
              //$role=DB::table($tbl)->where('name',$inputData['name'])->first();
              $role = DB::table($tbl)
             ->select('id')->where('name',$inputData['name'])->first();
              //$role_id=$role['id'];
            // print_r($role_id);
            // exit();

             foreach ($inputData['select-cat'] as $key => $permission) 
             {
               DB::table('role_has_permissions')->insert([
                    'permission_id' => $permission,
                     'role_id' => $role->id
                   ]);                   
               
             }
            
              $request->session()->flash('message','Data Inserted Succesfully!!');
              $request->session()->flash('add','success'); 
               return redirect()->back();
             // print_r($inputData);
             // exit();
            }
             
            /*

             
            */

          }

           
    	
          DB::table($tbl)->insert($inputData);   

          if($tbl == "messages") 	
          {   
            $request->session()->flash('message','Thank you for messiging us. We will get back shortly. Please keep pacience!');
            $request->session()->flash('add','success'); 

          }else
          {
            $request->session()->flash('message','Data Inserted Succesfully!');
            $request->session()->flash('add','success');  
          }
    	  

          return redirect()->back();
 
          
    }
   

     public function uploadimage($location,$fileobject)
    {
         
       $imagename = date('ymdgis').$fileobject->getClientOriginalName(); 
       //  print_r($imagename);
       $fileobject->move(public_path().'/'.$location,date('ymdgis').$imagename);
      //
 
//exit();
   
      return date('ymdgis').$imagename;
         
    }    
    
  

     public function updateData(Request $request)
    {
    	//$data= DB::select('select * from categories');
    //	$singlerecord = DB::table('categories')->where('cid', $id)->first();
    	
       // $data = $request->except('_token');
        $tbl= $request->input('tbl');
        $tbl=decrypt($tbl);
         
       // $cid=$request->input('cid');
      //  $cid=decrypt($cid);
    
              
        // $data = $data->execlude('tbl');
        $inputData = Arr::except($_POST, ['_token', 'tbl']);
        $inputData['updated_at']=date('Y-m-d H:i:s');
      //  print_r($inputData);
       // exit();
        
          $socialArray[]=NULL;
         if($request->has('social'))
         {
            foreach ($request->social as $key => $social)
             {
                if($social!= "")
                {
                    $socialArray[$key]=$social;
                }
            }
            //$socialArray[]=$inputData['social'];
            $inputData['social']=implode(',', $socialArray);
           //  print_r($inputData['social']);
           //  exit();

       
         }
         

         if($request->image)
         {
             $fileobject = $request->image;
             $inputData['image']= $this->uploadimage($tbl,$fileobject);
         }

          if($request->has('category_id'))
         {
             
         
            $inputData['category_id']=implode(',', $inputData['category_id']);          
       
         }

          if($request->has('userrole'))
         {
                          
               $inputData = Arr::except($_POST, ['_token', 'tbl','userrole']);
               $user = User::where('id', $request['id'])->first();

                //print_r($inputData);
               // exit();

               $oldrole=$user->getRoleNames()->first();
               if($oldrole != NULL)
               {
                 $user->removeRole($oldrole);
               }
              
               $user->assignRole($request['userrole']);
       
         }

           if($tbl == 'role_has_permissions')
           {
             // print_r($inputData);
            //  exit();
               DB::table($tbl)->where('role_id', '=', $inputData['id'])->delete();
                foreach ($inputData['select-cat'] as $key => $permission) {
                  DB::table($tbl)
                    ->Insert(
                        ['permission_id' => $permission, 'role_id' => $inputData['id']]
                    );

                }
               
                 DB::table('roles')
                 ->where('id', $inputData['id'])
                 ->update(['updated_at' => $inputData['updated_at']]);

                 $request->session()->flash('message',' Updated Succesfully!');
                 $request->session()->flash('update','success');
        
                 return redirect()->back();
           }
         

        //DB::table($tbl)->where('sid', $cid)->update($inputData);  
        DB::table($tbl)->where(key($inputData), reset($inputData))->update($inputData);  
        $request->session()->flash('message',' Updated Succesfully!');
        $request->session()->flash('update','success');
        
         return redirect()->back();
    	
    }



     
}
