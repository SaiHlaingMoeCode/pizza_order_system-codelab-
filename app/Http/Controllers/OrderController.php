<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //direct order list page
    public function orderList(){
        $order=Order::select('orders.*','users.name as user_name')
            ->when(request('key'),function($query){
            $query->orWhere('user_id','like','%'.request('key').'%')
                 ->orWhere('users.name','like','%'.request('key').'%');
        })
        ->leftJoin('users','orders.user_id','users.id')
        ->orderBy('created_at','desc')
        ->get();
        return view('admin.order.list',compact('order'));
    }

    //sort with ajax status
    public function changeStatus(Request $request){
        $order=Order::select('orders.*','users.name as user_name')
            ->when(request('key'),function($query){
            $query->orWhere('user_id','like','%'.request('key').'%')
                 ->orWhere('users.name','like','%'.request('key').'%');
        })
        ->leftJoin('users','orders.user_id','users.id')
        ->orderBy('created_at','desc');

        if($request->orderStatus==null){
            $order= $order->get();
        }else{
            $order=$order->where('orders.status',$request->orderStatus)->get();
        }
        return view('admin.order.list',compact('order'));
    }

    //ajax change status
    public function ajaxChangeStatus(Request $request){
        Order::where('id',$request->orderId)->update([
            'status'=>$request->status,
        ]);

        $order=Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','orders.user_id','users.id')
        ->orderBy('created_at','desc')
        ->get();

        return response()->json($order,200);
    }

    //list info ordercode
    public function listInfo($orderCode){
       $order = Order::where('order_code',$orderCode)->first();
       $orderlist=Orderlist::select('orderlists.*','users.name as user_name','products.name as product_name','products.image as product_image')
       ->leftJoin('users','users.id','orderlists.user_id')
       ->leftJoin('products','products.id','orderlists.product_id')
       ->where('order_code',$orderCode)->get();
       return view('admin.order.productList',compact('orderlist','order'));
    }

}
