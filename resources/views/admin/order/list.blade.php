@extends('admin.layouts.master')
@section('title','Order List Page')


@section('content')
  <!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">


                {{-- search box --}}
                <div class="row my-2">
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
                </div>

                <form action="{{route('order#changeStatus')}}" method="get">
                    @csrf
                  <div class=" d-flex">

                      <h4 class="mt-2 text-secondary" style="margin-right: 10px">Order Status:</h4>
                            <div class=" bg-white shadow-sm p-2 text-center mr-2">
                               <h4><i class="fa-solid fa-database"></i> {{count($order)}}</h4>
                            </div>
                            <select name="orderStatus" id="orderStatus" class="form-control col-2 text-center mr-2">
                                <option value="">All</option>
                                <option value="0" @if(request('orderStatus')=='0') selected @endif>Pending</option>
                                <option value="1" @if(request('orderStatus')=='1') selected @endif>Success</option>
                                <option value="2" @if(request('orderStatus')=='2') selected @endif>Reject</option>
                            </select>
                           <button type="submit" class="btn btn-sm btn-outline-dark">Search<i class="fa-solid fa-magnifying-glass ml-2"></i></button>
                   </div>
                </form>

                {{-- <div class="row my-1">
                    <div class="col-1 offset-10  bg-white shadow-sm p-2 text-center ">
                        <h4><i class="fa-solid fa-database"></i> {{count($order)}}</h4>
                    </div> --}}
                </div>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($order as $o)
                             <tr class="tr-shadow">
                                <input type="hidden" class="orderId" value="{{$o->id}}">
                                <td>{{$o->user_id}}</td>
                                <td>{{$o->user_name}}</td>
                                <td>{{$o->created_at->format('F-j-Y')}}</td>
                                <td>
                                    <a href="{{route('order#listInfo',$o->order_code)}}">{{$o->order_code}}</a>
                                </td>
                                <td>{{$o->total_price}} kyats</td>
                                <td>
                                    <select name="status" id="" class="form-control text-center statusChange">
                                        <option value="0" @if($o->status==0) selected @endif>Pending</option>
                                        <option value="1" @if($o->status==1) selected @endif>Success</option>
                                        <option value="2" @if($o->status==2) selected @endif>Reject</option>
                                    </select>
                                </td>
                             </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{-- {{$order->appends(request()->query())->links()}} --}}
                </div>


                <!-- END DATA TABLE -->

            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
@section('scriptSection')
    <script>
     $(document).ready(function(){
        // $('#orderStatus').change(function(){
        //    $status=$('#orderStatus').val();

        //    $.ajax({
        //     type: 'get',
        //     url: 'http://127.0.0.1:8000/order/ajax/status',
        //     data: {'status':$status},
        //     dataType:'json',
        //     success:function(response){
        //         $list='';
        //        for($i=0;$i<response.length;$i++){

        //         $months=['January','Feburary','March','April','May','June','July','August','September','October','November','December'];
        //         $dbDate=new Date(response[$i].created_at);
        //         $finalDate=$months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear();

        //         if(response[$i].status==0){
        //             $statusMessage=`
        //                 <select name="status" id="" class="form-control text-center statusChange">
        //                     <option value="0" selected>Pending</option>
        //                     <option value="1">Success</option>
        //                     <option value="2">Reject</option>
        //                 </select>
        //             `;
        //         }else if(response[$i].status==1){
        //             $statusMessage=`
        //                 <select name="status" id="" class="form-control text-center statusChange">
        //                     <option value="0">Pending</option>
        //                     <option value="1"selected>Success</option>
        //                     <option value="2">Reject</option>
        //                 </select>
        //             `;
        //         }else if(response[$i].status==2){
        //             $statusMessage=`
        //                 <select name="status" id="" class="form-control text-center statusChange">
        //                     <option value="0">Pending</option>
        //                     <option value="1">Success</option>
        //                     <option value="2"selected>Reject</option>
        //                 </select>
        //             `;
        //         };

        //         $list+= `
        //           <tr class="tr-shadow">
        //                 <input type="hidden" class="orderId" value="${response[$i].id}">
        //                 <td>${response[$i].user_id}</td>
        //                 <td>${response[$i].user_name}</td>
        //                 <td>${$finalDate}</td>
        //                 <td>${response[$i].order_code}</td>
        //                 <td>${response[$i].total_price} kyats</td>
        //                 <td>${$statusMessage}</td>
        //           </tr> `;
        //      }
        //      $('#dataList').html($list);
        //     }
        //    })
        // })

        $('.statusChange').change(function(){
            $currentStatus=$(this).val();
            $parentNode=$(this).parents('tr');
            $orderId=$parentNode.find('.orderId').val();

            $data={
                'status':$currentStatus,
                'orderId':$orderId
            };

            $.ajax({
            type: 'get',
            url: '/order/ajax/change/status',
            data: $data,
            dataType:'json',
            success:function(response){}
        })
     })
    })
    </script>
@endsection

