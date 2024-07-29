<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\Orderlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $pizza=Product::orderBy('id','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //change password page
    public function changePasswordPage(){
        return view('user.password.changePassword');
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

    //change account page
    public function changeAccountPage(){
        return view('user.profile.account');
    }

    //change account
    public function changeAccount($id,Request $request){
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
        return back()->with(['updateSuccess'=>'Admin Account Updated..']);
    }

    //user list page
    public function userList(){
        $userlist=User::orderBy('id','desc')->where('role','user')->paginate(3);
        return view('admin.user.userlist',compact('userlist'));
    }

    //user change role
   public function userChangeRole(Request $request){
      User::where('id',$request->userId)->update([
        'role'=>$request->role
      ]);
   }

   //user delete
   public function userDelete($id){
    User::where('id',$id)->delete();
    Order::where('user_id',$id)->delete();
    Orderlist::where('user_id',$id)->delete();
    return redirect()->route('user#userList');
   }

   //contact page
   public function contactPage(){
    return view('user.contact.contact');
   }

   //contact
   public function contact(Request $request){
    $this->contactValidationCheck($request);
    $data=$this->getContactData($request);
    Contact::create($data);
    return back()->with(['Message'=>'You sent message']);
   }

   //contact list
   public function contactList(Request $request){
    $list=Contact::orderBy('created_at','desc')
    ->paginate(4);
    return view('admin.contact.contactlist',compact('list'));
   }

   //contact delete
   public function contactDelete($id){
      Contact::where('id',$id)->delete();
      return redirect()->route('user#contactList');
   }

    //filter categories
    public function filter($id){
        $pizza=Product::where('category_id',$id)->orderBy('id','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //pizza Details page
    public function pizzaDetails($id){
        $pizza=Product::where('id',$id)->first();
        $pizzaList=Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    //cart list
    public function cartList(){
        $cartList= Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
        ->leftJoin('products','carts.product_id','products.id')
        ->where('carts.user_id',Auth::user()->id)
        ->get();
        $totalPrice=0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price*$c->qty;
        }
        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    //history
    public function history(){
        $order=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('user.main.history',compact('order'));
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:11',
            'newPassword'=>'required|min:6|max:11',
            'confirmPassword'=>'required|min:6|max:11|same:newPassword',
        ])->validate();
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

    //getContactData
    private function getContactData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message
        ];
    }

    //contact validation check
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
           'name'=>'required',
           'email'=>'required',
           'message'=>'required'
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
