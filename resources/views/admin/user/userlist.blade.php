@extends('admin.layouts.master')
@section('title','User List Page')


@section('content')
  <!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row my-1">
                    <div class="col-1 offset-10  bg-white shadow-sm p-2 text-center ">
                        <h4>Total- {{$userlist->total()}}</h4>
                    </div>
                </div>

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
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($userlist as $u)
                             <tr class="tr-shadow">
                                <input type="hidden" class="userId" value="{{$u->id}}">
                                <td class="col-2">
                                    @if ($u->image==null)
                                    @if ($u->gender=='male')
                                        <img src="{{asset('image/default_user.jpg')}}" style="height: 100px; width:100px" class="img-thumbnail shadow-sm"/>
                                    @else
                                         <img src="{{asset('image/female_default.jpg')}}" style="height: 100px; width:100px" class="img-thumbnail shadow-sm"/>
                                    @endif
                                    @else
                                    <img src="{{asset('storage/'.$u->image)}}"  style="height: 100px; width:100px" class="img-thumbnail shadow-sm"/>
                                    @endif
                                </td>
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                <td>{{$u->gender}}</td>
                                <td>{{$u->phone}}</td>
                                <td>{{$u->address}}</td>
                                <td>
                                    <select class="form-control statusChange">
                                        <option value="admin" @if($u->role=='admin') selected @endif>Admin</option>
                                        <option value="user" @if($u->role=='user') selected @endif>User</option>
                                    </select>
                                </td>
                                <td>
                                    <a href="{{route('user#userDelete',$u->id)}}">
                                        <button class=" bg-danger rounded-circle" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="fa-solid fa-trash-can p-2 text-white"></i>
                                        </button>
                                    </a>
                                </td>
                             </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{$userlist->appends(request()->query())->links()}}
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
        $('.statusChange').change(function(){
            $currentStatus=$(this).val();
            $parentNode=$(this).parents('tr');
            $userId=$parentNode.find('.userId').val();

            $data={
                'role':$currentStatus,
                'userId':$userId
            };

            $.ajax({
            type: 'get',
            url: '/user/change/role',
            data: $data,
            dataType:'json',
        });
          location.reload();
     })
    })
    </script>
@endsection

