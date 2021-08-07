<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Files;
use Illuminate\Support\Facades\File;
use DB;
class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['resetpass']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        //
    }
    public function files($id){
        $files= Files::where('user_id',$id)->get();
       return response()->json([
           'files'=>$files
           ]);
    }
  public function formSubmitDiploma(Request $request,$id)
  {
      $this->validate($request,[
        'file' => 'required|mimes:doc,png,jpg,docx,pdf,txt|max:2048'
      ]);
      $extention= time().'.'.$request->file->getClientOriginalExtension();
      $fileName =$request->resume.'.'.$extention;
     
      $request->file->move(public_path('upload'), $fileName);
        $filetable=new Files;
        $filetable->ref= $fileName;
        $filetable->type="diploma";
        $filetable->user_id=auth()->id();
        $filetable->save();
      return response()->json(['success'=>'You have successfully upload file.']);
  }
  public function formSubmitResume(Request $request,$id)
  {
      $this->validate($request,[
        'file' => 'required|mimes:doc,png,jpg,docx,pdf,txt|max:2048'
      ]);
      $extention= time().'.'.$request->file->getClientOriginalExtension();
      $fileName =$request->resume.'.'.$extention;
     
      $request->file->move(public_path('upload'), $fileName);
        $filetable=new Files;
        $filetable->ref= $fileName;
        $filetable->type="resume";
        $filetable->user_id=auth()->id();
        $filetable->save();
      return response()->json(['success'=>'You have successfully upload file.']);
  }
  public function addfilename(Request $request,$id){
    $this->validate($request,[
        'resume' => 'required',
          ]);
      $data = $request->all();
      $file = Files::latest()->orderBy('created_at','DESC')->first();
      $file->name = $request->resume;
      $file->save();
  }
  public function addfilenamediploma(Request $request,$id){
    $this->validate($request,[
        'diploma' => 'required',
          ]);
      $data = $request->all();
      $file = Files::latest()->orderBy('created_at','DESC')->first();
      $file->name = $request->diploma;
      $file->save();
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
        $file=Files::find($id);
        $file->delete();
        File::delete(public_path("upload/".$file->ref));
        return response()->json([
            "action"=> "resume deleted"
        ]);
    }
}
