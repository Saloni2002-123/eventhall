<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login()
    {
        return view('user.userlogin');
    }

      //signupform
  public function register()
  {
      return view('user.userreg');
  }
    //signup data
    public function registered(Request $request)
    {
        //dd($request);
        //
        $request->validate([
            'first_name'=>"required",
            'last_name'=>"required",
            'email'=>"required|email|unique:users",
            'name'=>"required",
            'password'=>"required|min:5|max:12",
            'phone_no'=>"required",
        ]);
        $user= new User();
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user-> email=$request->email;
        $user->name=$request->name;
        $user->password=bcrypt($request->password);
        $user->phone_no =$request->phone_no;
        $res= $user->save();
        if($res)
        {
            return back()->with('success','Registered successfully');
        }
        else{
            return back()->with('fail','Register Unsuccessfull');

        }
        return redirect()->route('');
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'email'=>"required|email",
            'password'=>"required|min:5|max:12"
        ]);
        $user = User::where('email','=',$request->email)->first();
        if($user)
        {
            if(Hash::check($request->password,$user->password))
            {
                $request->session()->put('loginId',$user->id);
                return view('user.userhome');
            }else{
                return back()->with('fail','Password not matched.');

            }
        }else{
            return back()->with('fail','This email is not registered');
        }
        if($request)
        {
            return back()->with('success','Login successfully');
        }
        else{
            return back()->with('fail','Username or Password error');

        }
    }
    public function dashboardUser()
    {
        $data=array();
        if(Session::has('loginId'))
        {
        $data=User::where('id','=', Session::get('loginId'))->first();
        $result=DB::table('users')
        -> select ('users.id','users.first_name','users.last_name','users.name','users.email','users.phone_no')
        ->where('users.id',Session::get('loginId'))
        ->get();
        $data['result']=$result;
        return view('user.userdash',$data);
        }
    }
    public function myprofile(Request $request)
    {
        $data=array();
        
        $data=User::where('id','=', Session::get('loginId'))->first();
        $result=DB::table('users')
        -> select ('users.id','users.first_name','users.last_name','users.name','users.email','users.phone_no')
        ->where('users.id',Session::get('loginId'))
        ->get();
        $data['result']=$result;
        return view('myprofile',$data);
    }
    
    public function edit($id)
    {
        // $data=User::find($req->id);
        // $data->name=$req->name;
        // $data->first_name=$req->first_name;
        // $data->last_name=$req->last_name;
        // $data->phone_no=$req->phone_no;
        // $data->email=$req->email;
        // $data->password=bcrypt($request->password);
        // $data->save();
        // return redirect('profile');
        $data=User::find($id);
        return view('updateuserpro',['data'=>$data]);
    }
 public function update(Request $request)
 {
    $data=User::find($request->id);
    $data->first_name=$request->first_name;
    $data->last_name=$request->last_name;
    if(!empty($request->name)) {
        $data->name=$request->name;
    }
    $data->email=$request->email;
    $data->phone_no=$request->phone_no;
    $res=$data->save();
    if($res)
    {
        return back()->with('success','Updated successfull');
    }
    else{
        return back()->with('fail','Updated Unsuccessfull');

    }
    return redirect('profile');
    // return $request->input();
 }
    public function logoutUser()
    {
            return redirect()->route('user.log');
    }
    function useraboutus()
    {
        return view('user.userabout');
    }
    public function getHalls()
    {
        $halls = DB::table('hall_lists')->select('name', 'description')->get();
        return $halls;
    }
    public function viewHalls()
    {
        $imagePath = public_path('img');
    $halls = $this->getHalls();
    return view('user.userevent',compact('halls', 'imagePath'));
    }
    public function getServices()
    {
        $services = DB::table('services')->select('name', 'description')->get();
        return $services;
    }
    public function viewServices()
{
    $services = $this->getServices();
    return view('user.userservice',compact('services'));
}
}
