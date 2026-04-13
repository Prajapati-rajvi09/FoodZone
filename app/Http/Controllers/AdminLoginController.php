<?php

namespace App\Http\Controllers;

use App\Models\AdminLoginModel;
use App\Models\CustomerRegModel;

use Illuminate\Http\Request;
use Session;

class AdminLoginController extends Controller

{
    public function login()
    {
        return view('login');
    }
    public function check(Request $request)
    {
        if($request->user=="admin"){
        $data = AdminLoginModel::where(['username'=>$request->username,'password'=>$request->password])->first();
        if($data)
        {
            $request->session()->put('AdminLogginId', $data);
            return redirect('/adminindex');
        }
        else
        {
        return back()->with('fail','Invalid Username or Password');
        }
      }

     else if($request->user=="customer"){
        $data = CustomerRegModel::where(['emailid'=>$request->username,'password'=>$request->password])->first();
        if($data)
        {
            $request->session()->put('CustomerLogginId', $data);
            return redirect('/customerindex');
        }
        else
        {
        return back()->with('fail','Invalid Username or Password');
        }
      }
    }

public function Adminlogout(Request $request)
{
$request->session()->flush();
Session::forget('AdminLogginId');
return redirect('login');
}

public function register()
{
    return view('register');
}


public function insertregister(Request $request)

{
  // $validate = $request->validate(['name'=> 'required|max:50','address'=>'required|max:50','city'=>'required|max:50','gender'=>'required','mobileno'=>'required|max:10','dob'=>'required','emailid'=>'required|max:50','password'=>'required|max:50','status'=>'required|max:50']);

    $reg=new CustomerRegModel;
    $reg->name=$request->input('name');
    $reg->address=$request->input('address');
    $reg->city=$request->input('city');
    $reg->gender=$request->input('gender');
    $reg->mobileno=$request->input('mobileno');
    $reg->dob=$request->input('dob');
    $reg->emailid=$request->input('emailid');
    $reg->password=$request->input('password'); 
    $reg->save();
    return redirect ('/register')->with('status','Register Succesfully');
}




}

