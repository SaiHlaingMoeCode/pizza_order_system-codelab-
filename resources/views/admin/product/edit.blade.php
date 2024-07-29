@extends('admin.layouts.master')
@section('title','Category List Page')

@section('content')
    <!-- MAIN CONTENT-->

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div> --}}

                {{-- update account profile  --}}
                {{-- <div class="row">
                    <div class="col-4 offset-7">
                        @if (session('updateSuccess'))
                        <div class="container mt-3">
                            <div class="row justify-content-end">
                                <div class="">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="margin-right: 15px">{{session('updateSuccess')}}</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                <i class="fa-solid fa-x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div> --}}
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div> --}}
                            {{-- <hr> --}}
                            <div style="margin-left: 30px" class="mb-2">
                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                            </div>
                            <div class="row">
                                <div class="col-3 offset-1">
                                    <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm" style="height: 200px" />
                                </div>
                                <div class="col-7">
                                    <div class="my-3 btn bg-danger text-white d-block w-75" style="font-size:20px"><i class="fa-regular fa-note-sticky"></i> {{$pizza->name}}</div>
                                    <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-money-bill-1-wave"></i> {{$pizza->price}} kyats</span>
                                    <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-clock"></i> {{$pizza->waiting_time}} mins</span>
                                    <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-eye"></i> {{$pizza->view_count}}</span>
                                    <span class="my-3 btn btn-dark text-white"><i class="fa-regular fa-clone"></i> {{$pizza->category_name}}</span>
                                    <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-calendar me-2" style="margin-right: 10px"></i> {{$pizza->created_at->format('j-F-Y')}}</span>
                                    <div class="mt-3"><i class="fa-solid fs-4 fa-file-lines"></i> Details</div>
                                    <div class="">{{$pizza->description}}</div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-4 offset-1 mt-3">
                                    <a href="" class="btn bg-dark text-white">
                                        <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
