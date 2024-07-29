<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
      $this->passwordValidationCheck($request);

      $user=User::select('password')->where('id',Auth::user()->id)->first();
      $dbHashValue=$user->password; //hash value
      if(Hash::check($request->oldPassword,$dbHashValue)){
        $data=['password'=>Hash::make($request->newPassword)];
        User::where('id',Auth::user()->id)->update($data);
        return back()->with(['changeSuccess'=>'Password changed']);
      }
       return back()->with(['notMatch'=>'The old password does not match.Try again']);
    }

    //direct admin details page
    public function details(){
        return view('admin.account.details');
    }

    //direct admin profile page
    public function edit(){
        return view('admin.account.edit');
    }

    //update account
    public function update($id,Request $request){

        $this->accountValidationCheck($request);
        $data=$this->getUserData($request);

         //for image
         if($request->hasFile('image')){
            // $dbImage=User::where('id',$id)->value('image');
            $dbImage=User::where('id',$id)->first();
            $dbImage=$dbImage->image; //get old img

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName=uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;

         }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Account Updated..']);


    }

    //admin list
    public function list(){
        $admin=User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                  ->orWhere('gender','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','admin')
        ->paginate(3);
        return view('admin.account.list',compact('admin'));
    }

    //admin list delete
    public function delete($id){
       User::where('id',$id)->delete();
       return back()->with(['deleteSuccess'=>'Admin Account Deleted..']);
    }

    //admin change Role
    public function changeRole($id){
        $account=User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //admin change
    public function change($id,Request $request){
        $data=$this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

      //request user data
      private function requestUserData($request){
        return[
            'role'=>$request->role
        ];
    }

    //admin change with ajax select box
    public function ajaxChangeRole(Request $request){
        // logger($request->all());
        User::where('id',$request->user_id)->update([
            'role'=>$request->role,
        ]);
        return response()->json([
            'role'=>'user',
            'message'=>'change role complete'
        ],200);
    }



     //getUserData
     private function getUserData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'updated_at'=>Carbon::now(),
        ];
    }


    //password Validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:11',
            'newPassword'=>'required|min:6|max:11',
            'confirmPassword'=>'required|min:6|max:11|same:newPassword',
        ])->validate();
    }

    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'image'=>'mimes:jpg,png,jpeg,webp|file',
            'address'=>'required',
            // 'image'=>'required',
        ])->validate();
        }
}
