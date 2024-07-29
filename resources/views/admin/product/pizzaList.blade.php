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
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('product#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Product
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
                        <form action="{{route('product#list')}}" method="get">
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
                        <h4><i class="fa-solid fa-database"></i> ({{$pizzas->total()}})</h4>
                    </div>
                </div>
                 {{-- delete message alert --}}
                 @if (session('deleteSuccess'))
                 <div class="container mt-3">
                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
                @if(count($pizzas) != 0 )
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>View Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($pizzas as $p)
                                <tr class="tr-shadow">
                                    <td class="col-2">
                                        <img src="{{asset('storage/'.$p->image)}}" style="height: 120px" class="shadow-sm">
                                    </td>
                                    <td class="col-3">{{$p->name}}</td>
                                    <td class="col-2">{{$p->price}} kyats</td>
                                    <td class="col-2">{{$p->category_name}}</td>
                                    <td class="col-2"><i class="fa-solid fa-eye"></i> {{$p->view_count}}</td>
                                    <td class="col-2">
                                        <div class="table-data-feature">
                                            <a href="{{route('product#edit',$p->id)}}" class="mx-2">
                                              <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                  <i class="fa-solid fa-eye"></i>
                                              </button>
                                            </a>
                                            <a href="{{route('product#updatePage',$p->id)}}" class="mx-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('product#delete',$p->id)}}" class="mx-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                            {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </button> --}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div>
                    <h3 class="text-secondary text-center mt-5">There is no Product!</h3>
                </div>
                @endif
                <div class="mt-3">
                    {{$pizzas->links()}}
                </div>


                <!-- END DATA TABLE -->

            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->


@endsection

