<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //loginform
    public function login()
    {
        return view('admin.adminlogin');
    }

      //signupform
  public function register()
  {
      return view('admin.adminreg');
  }
    //signup data
    public function registered(Request $request)
    {

        $admin= new Admin();
        $admin->email=$request->email;
        $admin->username=$request->name;
        $admin->password=bcrypt($request->password);
        $res= $admin->save();
        if($res)
        {
            return back()->with('success','You have registered');
        }
        else{
            return back()->with('fail','Something went wrong');

        }
        return redirect()->route('adm.log');
    }
     //login validation
   private function validator(Request $request)
   {
       //validation rules.
       $rules = [
   
           'email'    => 'required|email|exists:admins|min:5|max:191',
           'password' => 'required|string|min:4|max:255',
       ];
       //validate the request.
       $request->validate($rules);
   }
    public function loginAdmin(Request $request)
    {
  
        $this->validator($request);
    
        if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
            //Authentication passed...
            return redirect('customer');
        }
    
        //Authentication failed...
        return $this->login();
    }
    public function dashboard()
    {
        return view('layouts.admindash');
    }
        //logout
        public function logout(Request $request)
        {
           session()->flush();
           return redirect()->route('adm.log');
        }
}
