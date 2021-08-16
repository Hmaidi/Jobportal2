<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\jobs;
use DB;
use App\companies;
use App\categories;
use App\contracts;
use App\locations;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','index']]);
    }
    public function index()
    {
        $jobs=jobs::latest()->paginate(8);
            return response()->json([
                "jobs"=>$jobs
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator= $this->validate($request,[
            'title' => 'required|string|min:3|max:20',   
            'salary' => 'required',
            'company_id'=>'required',
            'location_id'=>'required',
            'contract_id' => 'required',
            'requirements'=>'required',
            'description'=>'required',
            'internal_reference'=> 'required',
            'expiry_date'=> 'required',
            'experience'=> 'required',
            
        
             ]);
    
          return jobs::create([
              'title' => $request->title,
              'salary' => $request->salary ,
              'experience'=> $request->experience ,
              'company_id'=>$request->company_id ,
              'location_id'=>$request->location_id ,
              'requirements'=>$request->requirements ,
              'description'=>$request->description ,
              'contract_id' =>$request->contract_id ,
              'expiry_date'=>$request->expiry_date ,
              'internal_reference'=>$request->internal_reference ,
              

              

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
        $jobs=jobs::find($id);
        $this->validate($request,[
           'title' => 'string|min:3|max:20',
            ]);

         $data = $request->all();
    

           DB::table('job')->where('id',$id)->update(['title' => $request->title,
           'salary' => $request->salary ,
           'experience'=> $request->experience ,
           'company_id'=>$request->company_id ,
           'location_id'=>$request->location_id ,
           'requirements'=>$request->requirements ,
           'description'=>$request->description ,
           'contract_id' =>$request->contract_id ,
           'expiry_date'=>$request->expiry_date ,
           'internal_reference'=>$request->internal_reference]);
              
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        jobs::find($id)->delete();
    }

    public function searchc(){

        if($search = \Request::get('s')){
            $jobs = jobs::where(function($query) use ($search){
                $query->where('title','LIKE',"%$search%")->Orwhere('id','LIKE',"%$search%")
                ->Orwhere('description','LIKE',"%$search%")->Orwhere('experience','LIKE',"%$search%")
                ->Orwhere('requirements','LIKE',"%$search%")->Orwhere('internal_reference','LIKE',"%$search%")
                ->Orwhere('status','LIKE',"%$search%")->Orwhere('salary','LIKE',"%$search%")->Orwhere('expiry_date','LIKE',"%$search%")
               
                ;
 })->latest()->paginate(8);
 return response()->json([
    "jobs"=>$jobs
]);
          }
          
    
     }
     public function getlocations(){
        $locations=locations::latest()->paginate(8);
        return response()->json([
            "location"=>$locations
        ]);
     }
     public function getcompanies(){
        $companies=companies::latest()->paginate(8);
        return response()->json([
            "companie"=>$companies
        ]);
     }
     public function getcategories(){
        $categories=categories::latest()->paginate(8);
        return response()->json([
            "categorie"=>$categories
        ]);
     }
     public function getcontract(){
        $contracts=contracts::latest()->paginate(8);
        return response()->json([
            "contract"=>$contracts
        ]);
     }
     public function getjob($id){
        $job=jobs::find($id);
        return response()->json([
            "job"=>$job
        ]);
        }

        public function locations($id){
            $locations=locations::latest()->paginate(8);
            return response()->json([
                "location"=>$locations
            ]);
         }
         public function companies($id){
            $companies=companies::latest()->paginate(8);
            return response()->json([
                "companie"=>$companies
            ]);
         }
         public function categories($id){
            $categories=categories::latest()->paginate(8);
            return response()->json([
                "categorie"=>$categories
            ]);
         }
         public function contract($id){
            $contracts=contracts::latest()->paginate(8);
            return response()->json([
                "contract"=>$contracts
            ]);
         }
         public function changestatus($id,$stat){
            //   $data=$request->all();
                  $job = jobs::where(['id'=>$id])->first();
                  $job->status = $stat;
                  $job->save();
             
           
               }
               public function getjobs(){
                $jobs=jobs::latest()->paginate(8);
                return response()->json([
                    "jobs"=>$jobs
                ]);
                }
}
