<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use DB;
use App\jobs;
use App\User;
use App\files;
use App\extrafieldapplication;
use App\Applications;
use App\Notifications\Application;
use Carbon\Carbon;
class ApplicationController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications=Applications::latest()->paginate(8);
        return response()->json([
            "applications"=>$applications
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $validator= $this->validate($request,[  
            'name'=> 'required',
            'address'=> 'required',
            'skills'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'resume'=> 'required',
            'experience'=> 'required',
           
            
        
             ]);
    $user = User::find(Auth()->id());
    $job = jobs::find($id);
    if($request->email != null){
        $user->email=$request->email;
        $user->save();
       }
        if($request->education != null){
         $user->education=$request->education;
         $user->save();
        }
        if($request->experience != null){
            $user->experience=$request->experience;
            $user->save();
           }
        if($request->address != null){
         $user->address=$request->address;
         $user->save();
        }
        if($request->skills != null){
         $user->skills=$request->skills;
         $user->save();
        }
       
        if($request->phone != null){
            $user->phone=$request->phone;
            $user->save();
           }

          
           $application = new Applications;
           $application->user_id=  Auth()->id();
           $application->job_id= $id;
           $application->file_id= $request->resume;
           $application->save();
        
       
    }
public function storeextrafields ($id , Request $request ){
    $this->validate($request,[
        'value' => 'required',
          ]);
          $user = User::find(Auth()->id());
    $application = Applications::latest()->orderBy('created_at','DESC')->first();
    $job = jobs::find($application->job_id);
    $extrafieldapplication = new extrafieldapplication ;
    $extrafieldapplication->value = $request->value;
    $extrafieldapplication->user_id = $application->user_id;
    $extrafieldapplication->job_id = $application->job_id; 
    $extrafieldapplication->application_id= $application->id;
    $extrafieldapplication->formsjob_id = $id;
    $extrafieldapplication->save();
    $data = array(
        'name' => $user->name,
        'job' => $job->title,
      
       );
    $when = now()->addSeconds(10);
    Notification::send( $user,(new Application ($data))->delay($when));
    return response()->json([
     "action"=>"Application done"
   ]);
    
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
