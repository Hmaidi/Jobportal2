<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Notifications\UpdateData;
use Illuminate\Support\Facades\Notification;
use DB;
class UserController extends Controller
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
        return User::where('role','<>','admin')->latest()->paginate(100);
       // return User::where('role','<>','admin')->latest()->paginate(100);
       /* $user = User::where('role','<>','chef de projet')->where('role','<>','admin')->where('role','<>','client')->latest()->paginate(8);
        return response()->json([
        "user" => $user
        ]);*/
    }
    
    public function userconnecté()
    {
        $user= Auth()->user();
    return response([
        "user"=>$user
    ]);
    }
 
    public function users()
    {
        \Log::info('This is some useful information.');
        $users= User::latest()->paginate(8);
        return response()->json([
            "users"=> $users
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
 
        }
 


   
    public function destroy($id)
    {
       User::find($id)->delete();
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
 
       if($request->email != null){
        $this->validate($request,[
            'email' =>'string|email|unique:users',
        ]);
       }
        if($request->password != null){
            $this->validate($request,[
                'password' => 'min:6',
            ]);
        }
            if($request->address != null){
                $this->validate($request,[
                    'location' => 'string|min:6|max:191',
                ]);
            }
                if($request->education != null){
                    $this->validate($request,[
                        'education' => 'string|min:3|max:191',
                    ]);
                    }
                    if($request->skills != null){
                    $this->validate($request,[
                        'skills' => 'string|min:6|max:191',
                    ]);
                    }
                    if($request->phone != null){
                     $this->validate($request,[
                         'phone' => 'integer',
                     ]);
                     }
 
          if($request->photo !=null){
 
 
        $currentPhoto = $user->photo;
 
 
        if($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
 
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);
            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
           
            }
 }
 
   if($request->email != null){
   $user->email=$request->email;
   $user->save();
  }
  if($request->password != null){
    $user->password=bcrypt($request->password);
    $user->save();
   }
   if($request->education != null){
    $user->education=$request->education;
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
   if($request->photo != null){
    $user->photo=$request->photo;
    $user->save();
   }
   if($request->phone != null){
     $user->phone=$request->phone;
     $user->save();
    }
 
        return ['message' => "Success"];
    }
 else {
 
    if($request->email != null){
        $user->email=$request->email;
        $user->save();
       }
       if($request->password != null){
         $user->password=bcrypt($request->password);
         $user->save();
        }
        if($request->education != null){
         $user->education=$request->education;
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
        if($request->photo != null){
         $user->photo=$request->photo;
         $user->save();
        }
        if($request->phone != null){
            $user->phone=$request->phone;
            $user->save();
           }
 }
 
 }
public function Membrechefprojet()
    {
        return User::where('role','<>','admin')->latest()->paginate(100);
    }
    public function userprofile($id){
        $user = User::find($id);
        return response()->json([
        "user" => $user
        ]);
    }
 public function search(){

    if($search = \Request::get('s')){
        $chef = User::where('role','chef de projet')->where(function($query) use ($search){
            $query->where('role','chef de projet')->where('name','LIKE',"%$search%")->Orwhere('phone','LIKE',"%$search%")->Orwhere('email','LIKE',"%$search%")
            ;
        })->latest()->paginate(8);
      }
      return response()->json([
        "Chef"=>$chef
    ]);
 }
 public function searchc(){

   if($search = \Request::get('s')){
       $client = User::where('role','client')->where(function($query) use ($search){
           $query->where('name','LIKE',"%$search%")->Orwhere('phone','LIKE',"%$search%")->Orwhere('email','LIKE',"%$search%")
           ;
       })->latest()->paginate(8);
     }
     return response()->json([
       "client"=>$client
   ]);

}
public function searchm(){

    if($search = \Request::get('s')){
        $user = User::where('role','<>','chef de projet')->where('role','<>','admin')->where('role','<>','client')->where(function($query) use ($search){
            $query->where('name','LIKE',"%$search%")->Orwhere('phone','LIKE',"%$search%")->Orwhere('email','LIKE',"%$search%")
            ;
        })->latest()->paginate(8);
      }
      return response()->json([
        "user"=>$user
    ]);

 }

 public function searcht(){

    if($search = \Request::get('s')){
        $task = Task::where(function($query) use ($search){
            $query->where('text','LIKE',"%$search%")
            ;
        })->latest()->paginate(8);
      }
      return response()->json([
        "Tasks"=>$task
    ]);

 }
 public function resetpass(Request $request){
    $data = $request->all();
          $emailcount =User::where('email',$data['email'])->count();
        if($emailcount == '0'){
            return response()->json([
               "action" => "email Invalid"
            ]);
        }
        $userdetails= User::where('email',$data['email'])->first();
        $random_password=Str::random(8);
        $new_password= bcrypt($random_password);
        User::where('email',$data['email'])->update(['password'=>$new_password]);
        $email=$data['email'];
        $name=$userdetails->name;
        $message=[
            'email'=>$data['email'],
            'password'=>$random_password,
            'name'=>$name
        ];
        Mail::send('emails.forgetpassword', $message, function ($message)use($email) {
            $message->to($email)->subject('New Password - Project Managment');

        });
        return response()->json([
           "action" => "email send successfully"
        ]);
        
    }
    
 }
