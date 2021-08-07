<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\jobs;
use App\formsjob;

use DB;
class FormsJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }
    public function index()
    {
        //
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
            'field'=> 'required',
            'type'=> 'required',
             ]);
          
          return formsjob::create([
              'job_id' => $id,
              'field' => $request->field,
              'type'=> $request->type,  
               'position' => $request->position,
         ]);
    }
public function formsfield(Request $request) {
    $validator= $this->validate($request,[
        'field'=> 'required',
        'type'=> 'required',
         ]);
      
      return formsjob::create([
          'job_id' => $id,
          'field' => $request->field,
          'type'=> $request->type,  
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
