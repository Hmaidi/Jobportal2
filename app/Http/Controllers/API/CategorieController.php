<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\categories;
use DB;
class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function index()
    {
        $categories=categories::latest()->paginate(8);
            return response()->json([
                "categorie"=>$categories
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
            'name' => 'required|string|min:3|max:20',   
             ]);
    
          return categories::create([
              'name' => $request->name,
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
        $categorie=categories::find($id);
        $this->validate($request,[
           'name' => 'string|min:3|max:20',
            ]);

         $data = $request->all();
    

           DB::table('categories')->where('id',$id)->update(['name'=>$data['name']]);
              
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        categories::find($id)->delete();
    }

    public function searchc(){

        if($search = \Request::get('s')){
            $categories = categories::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%")->Orwhere('id','LIKE',"%$search%")
                ;
 })->latest()->paginate(8);
          }
          return response()->json([
            "categorie"=>$categories
        ]);
    
     }
}
