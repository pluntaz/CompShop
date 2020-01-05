<?php

namespace App\Http\Controllers;

use App\Cart_model;
use App\User;
use App\Orders_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $menu_active=1;
        $i=0;
        $orders=Orders_model::orderBy('created_at','desc')->get();
        return view('backEnd.index',compact('menu_active','orders','i'));
    }
    public function settings(){
        $menu_active=0;
        return view('backEnd.setting',compact('menu_active'));
    }
    public function chkPassword(Request $request){
        $data=$request->all();
        $current_password=$data['pwd_current'];
        $email_login=Auth::user()->email;
        $check_pwd=User::where(['email'=>$email_login])->first();
        if(Hash::check($current_password,$check_pwd->password)){
            echo "true"; die();
        }else {
            echo "false"; die();
        }
    }
    public function updatAdminPwd(Request $request){
        $data=$request->all();
        $current_password=$data['pwd_current'];
        $email_login=Auth::user()->email;
        $check_password=User::where(['email'=>$email_login])->first();
        if(Hash::check($current_password,$check_password->password)){
            $password=bcrypt($data['pwd_new']);
            User::where('email',$email_login)->update(['password'=>$password]);
            return redirect('/admin/settings')->with('message','Password Update Successfully');
        }else{
            return redirect('/admin/settings')->with('message','InCorrect Current Password');
        }
    }

    public function FinishOrder($id)
    {
        $update_model=Orders_model::findOrFail($id);
               
            
        $update_model->update(array('order_status'=>'Order Finish'));
        return redirect('/admin')->with('message','Order Finish!');
    }

    public function detailorder($id)
    {
                     
        $menu_active=10;
        $i=0;
        $s=Orders_model::findOrFail($id);
        $orders=Orders_model::where('id',$id)->get();
        $cart_datas=Cart_model::where('session_id',$s->session_id)->get();
        
         return view('backEnd.detailoreder',compact('menu_active','cart_datas','orders','i'));
    }
    /*public function login(Request $request){s
        if($request->isMethod('post')){
            $data=$request->input();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                echo 'success'; die();
            }else{
                return redirect('admin')->with('message','Account is Incorrect!');
            }
        }else{
            return view('backEnd.login');
        }
    }*/
}
