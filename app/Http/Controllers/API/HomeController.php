<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use  App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\jobs;
use App\locations;
use App\categories;
use App\contracts;
use App\companies;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
   //$this->middleware('jwt.auth',['expect'=>['index']]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        return view('home');
    }

    public function getjobs(){
        $jobs=jobs::latest()->paginate(8);
        return response()->json([
            "jobs"=>$jobs
        ]);
        }
        public function getlocations(){
            $locations=locations::latest()->paginate(8);
            return response()->json([
                "locations"=>$locations
            ]);
            }
            public function getcompanies(){
                $companies=companies::latest()->paginate(8);
                return response()->json([
                    "companies"=>$companies
                ]);
                }
                public function getcategories(){
                    $categories=categories::latest()->paginate(8);
                    return response()->json([
                        "categories"=>$categories
                    ]);
                    }
                    public function getcontracts(){
                        $contracts=contracts::latest()->paginate(8);
                        return response()->json([
                            "contracts"=>$contracts
                        ]);
                        }
                        public function searchjob(){

                            if($search = \Request::get('s')){
                                $jobs = jobs::where(function($query) use ($search){
                                    $query->where('title','LIKE',"%$search%")->Orwhere('id','LIKE',"%$search%")
                                    ->Orwhere('description','LIKE',"%$search%")->Orwhere('experience','LIKE',"%$search%")
                                    ->Orwhere('requirements','LIKE',"%$search%")->Orwhere('internal_reference','LIKE',"%$search%")
                                    ->Orwhere('status','LIKE',"%$search%")->Orwhere('salary','LIKE',"%$search%")->Orwhere('expiry_date','LIKE',"%$search%")->Orwhere('location_id','LIKE',"%$search%")
                                    ->Orwhere('contract_id','LIKE',"%$search%")
                                   
                                    ;
                     })->latest()->paginate(8);
                     return response()->json([
                        "jobs"=>$jobs
                    ]);
                              }
                              
                        
                         }
                       public function getjobswithlocation($id){
                        $job = jobs::where('location_id','=',$id)->latest()->paginate(8);
                        return response()->json([
                        "jobs" => $job
                        ]);
                      

                       }
                       public function getjobswithcontract($id){
                           
                        $job = jobs::where('contract_id','=',$id)->latest()->paginate(8);
                        return response()->json([
                        "jobs" => $job
                        ]);
                           

                       }
                       public function getjobswithcategorie($id){
                           
                        $categorie = categories::where('id','=',$id)->latest()->paginate(8);
                        return response()->json([
                        "jobs" => $categorie->jobs()
                        ]);
                           

                       }
                       public function getjob($id){
                        $job=jobs::find($id);
                        return response()->json([
                            "jobs"=>$job
                        ]);
                        }
                
}
