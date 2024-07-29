<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //direct login page
    public function loginPage(){
        return view('login');
    }

    //direct register page
    public function RegisterPage(){
        return view('register');
    }

    //direct dashboard
    public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('category#list');
        }
        return redirect()->route('user#home');
    }

    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
      $this->passwordValidationCheck($request);

      $user=User::where('id',Auth::user()->id)->first();
      $dbHashValue=$user->password; //hash value
      if(Hash::check($request->oldPassword,$dbHashValue)){
        $data=['password'=>Hash::make($request->newPassword)];
        User::where('id',Auth::user()->id)->update($data);
        return back()->with(['changeSuccess'=>'Password changed']);
      }
       return back()->with(['notMatch'=>'The old password does not match.Try again']);
    }

    //password Validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:11',
            'newPassword'=>'required|min:6|max:11',
            'confirmPassword'=>'required|min:6|max:11|same:newPassword',
        ])->validate();
    }
}


