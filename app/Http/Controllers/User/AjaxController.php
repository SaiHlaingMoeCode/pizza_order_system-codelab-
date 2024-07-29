<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Orderlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
        // logger($request->status);
        if($request->status=='asc'){
            $data=Product::orderBy('created_at','asc')->get();
        }else{
            $data=Product::orderBy('created_at','desc')->get();
        }

        return $data;
    }

    //return pizza list
    public function addToCart(Request $request){
    $data=$this->getOrderData($request);
    Cart::create($data);
        $response= [
            'message'=>'Add to Cart Completed',
            'status'=>'success'
         ];
         return response()->json($response,200);
    }

    //order
    public function order(Request $request){
      $total=0;
      foreach($request->all() as $item){
    //    $data=Orderlist::create([
    //         'user_id'=>$item['user_id'],
    //         'product_id'=>$item['product_id'],
    //         'qty'=>$item['qty'],
    //         'total'=>$item['total'],
    //         'order_code'=>$item['order_code'],
    //     ]);
        $data=Orderlist::create($item);
        $total+=$data->total;
    }
    Cart::where('user_id',Auth::user()->id)->delete();

    // logger($total);
    Order::create([
        'user_id'=>Auth::user()->id,
        'order_code'=>$data->order_code,
        'total_price'=>$total+3000,
    ]);

    return response()->json([
        'status'=>'true',
        'message' => 'order complete'
    ],200);
}

    //get order data
    private function getOrderData($request){
        return[
            'user_id'=>$request->userId,
            'product_id'=>$request->pizzaId,
            'qty'=>$request->count,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
    }

    //clearcart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //clearCurrentProduct
    public function clearCurrentProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
             ->where('id',$request->order_id)
             ->where('product_id',$request->product_id)
            ->delete();
    }

    //increase view count
    public function increaseViewCount(Request $request){
       $pizza=Product::where('id',$request->pizzaId)->first();

       $viewCount=[
        'view_count'=>$pizza->view_count + 1
       ];
       Product::where('id',$request->pizzaId)->update($viewCount);
    }
}
