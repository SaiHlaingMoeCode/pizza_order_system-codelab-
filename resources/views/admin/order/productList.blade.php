@extends('admin.layouts.master')
@section('title','Order List Page')


@section('content')
  <!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                {{-- search box --}}
                {{-- <div class="row my-2">
                    <div class="col-5">
                        <h4 class="text-secondary">Search Key: <span class="text-danger">{{request('key')}}</span></h4>
                    </div>
                    <div class="col-3 offset-4">
                        <form action="" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="search" name="key" class="form-control" placeholder="search.." value="{{request('key')}}">
                                <button class="btn btn-dark text-white">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <button class="btn btn-sm bg-dark">
                    <a href="{{route('order#orderList')}}">
                        <i class="fa-solid fa-arrow-left text-white "> Back</i>
                    </a>
                </button>
                <div class="table-responsive table-responsive-data2">
                    <div class="row">
                        <div class="card mt-4 col-5">
                            <div class="card-body">
                                <h4><i class="fa-solid fa-clipboard-list mr-2"></i>Order Info</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"><i class="fa-regular fa-user mr-2"></i>Name</div>
                                    <div class="col">{{$orderlist[0]->user_name}}</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"><i class="fa-solid fa-barcode mr-2"></i>Order Code</div>
                                    <div class="col">{{$orderlist[0]->order_code}}</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"><i class="fa-regular fa-clock mr-2"></i>Order Date</div>
                                    <div class="col">{{$orderlist[0]->created_at->format('F-j-Y')}}</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"><i class="fa-solid fa-money-bill-1-wave mr-2"></i>Total Price</div>
                                    <div class="col">{{$order->total_price}} kyats</div>
                                </div>
                                <small class="text-primary">[ Include delivery fee 3000ks ]</small>
                            </div>
                        </div>
                    </div>
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Order Id</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderlist as $o)
                             <tr class="tr-shadow">
                                <td></td>
                                <td>{{$o->id}}</td>
                                <td>
                                    <img src="{{asset('storage/'.$o->product_image)}}" class="img-thumbnail" style="height: 100px" alt="">
                                </td>
                                <td>{{$o->product_name}}</td>
                                <td>{{$o->qty}}</td>
                                <td>{{$o->total}} kyats</td>
                             </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->

            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection


