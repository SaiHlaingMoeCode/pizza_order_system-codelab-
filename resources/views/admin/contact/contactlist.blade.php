@extends('admin.layouts.master')
@section('title','Contact List Page')


@section('content')
  <!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-2 offset-10">
                <div class=" bg-white shadow-sm p-2 text-center mr-2">
                    <h4>Total ({{$list->total()}})</h4>
                 </div>
            </div>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 ">
                        <thead>
                            <tr>
                                <th></th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($list as $l)
                             <tr class="tr-shadow">
                                <td></td>
                                <td>{{$l->name}}</td>
                                <td>{{$l->email}}</td>
                                <td>{{$l->message}}</td>
                                <td>
                                    <td>
                                        <a href="{{route('user#contactDelete',$l->id)}}">
                                            <button class=" bg-danger rounded-circle" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa-solid fa-trash-can p-2 text-white"></i>
                                            </button>
                                        </a>
                                    </td>
                                </td>
                             </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{$list->links()}}
                </div>


                <!-- END DATA TABLE -->

            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection


