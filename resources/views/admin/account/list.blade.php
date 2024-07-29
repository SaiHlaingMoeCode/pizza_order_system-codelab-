@extends('admin.layouts.master')
@section('title','Category List Page')


@section('content')
  <!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Admin
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>

                {{-- search box --}}
                <div class="row my-2">
                    <div class="col-5">
                        <h4 class="text-secondary">Search Key: <span class="text-danger">{{request('key')}}</span></h4>
                    </div>
                    <div class="col-3 offset-4">
                        <form action="{{route('admin#list')}}" method="get">
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
                <div class="row my-1">
                    <div class="col-1 offset-10  bg-white shadow-sm p-2 text-center ">
                        <h4><i class="fa-solid fa-database"></i> {{$admin->total()}}</h4>
                    </div>
                </div>
                {{-- delete message alert --}}
                 @if (session('deleteSuccess'))
                 <div class="container mt-3">
                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>{{session('deleteSuccess')}}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa-solid fa-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $a)
                            <tr class="tr-shadow">
                                <td class="col-2">
                                    @if ($a->image==null)
                                        @if ($a->gender=='male')
                                            <img src="{{asset('image/default_user.jpg')}}"/>
                                        @else
                                             <img src="{{asset('image/female_default.jpg')}}"/>
                                        @endif
                                    @else
                                        <img src="{{asset('storage/'.$a->image)}}" />
                                    @endif
                                </td>
                                <input type="hidden" id="userId" value="{{$a->id}}">
                                <td>{{$a->name}}</td>
                                <td>{{$a->email}}</td>
                                <td>{{$a->gender}}</td>
                                <td>{{$a->phone}}</td>
                                <td>{{$a->address}}</td>
                                <td></td>
                                <td>
                                    <div class="table-data-feature">
                                        {{-- <a href="{{route('admin#changeRole',$a->id)}}" class="mx-2"> --}}
                                            @if($a->id==Auth::user()->id)
                                            @else
                                            <div  class="col-12 mr-4">
                                                <select id="changeRole" class="form-control">
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                                </select>
                                            </div>
                                            @endif
                                        {{-- </a> --}}
                                        <a href="{{route('admin#delete',$a->id)}}" class="mx-2">
                                            @if ($a->id==Auth::user()->id)
                                            @else
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                            @endif
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <!-- END DATA TABLE -->
                <div class="mt-2">
                  {{$admin->appends(request()->query())->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
@section('scriptSection')
    <script>
        $(document).ready(function(){
        $('#changeRole').change(function(){
            $changeVal=$(this).val();
            $parentNode=$(this).parents('tr');
            $userId=$parentNode.find('#userId').val();

            $data={
                'role':$changeVal,
                'user_id':$userId
            };

        $.ajax({
            type : 'get',
            url : '/admin/ajax/change/role',
            data: $data,
            dataType: 'json',
            success: function(response){
                if(response.role=='user'){
                    window.location.href='/admin/list';
                }

            }
        })
        })
         })
    </script>
@endsection

