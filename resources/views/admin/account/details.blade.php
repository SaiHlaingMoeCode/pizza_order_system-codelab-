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
                <div class="row">
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
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image==null)
                                    @if (Auth::user()->gender=='male')
                                        <img src="{{asset('image/default_user.jpg')}}"/>
                                    @else
                                         <img src="{{asset('image/female_default.jpg')}}"/>
                                    @endif
                                @else
                                    <img src="{{asset('storage/'.Auth::user()->image)}}" />
                                @endif
                                </div>
                                <div class="col-5 offset-1">
                                    <h4 class="my-2"><i class="fa-solid fa-user-pen me-2" style="margin-right: 20px"></i>  {{Auth::user()->name}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-envelope me-2" style="margin-right: 20px"></i>  {{Auth::user()->email}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-phone me-2" style="margin-right: 20px"></i> {{Auth::user()->phone}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-location-dot me-2" style="margin-right: 20px"></i> {{Auth::user()->address}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-mars-and-venus me-2" style="margin-right: 20px"></i> {{Auth::user()->gender}}</h4>
                                    <h4 class=""><i class="fa-solid fa-calendar me-2" style="margin-right: 20px"></i> {{Auth::user()->created_at->format('j-F-Y')}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-2 mt-3">
                                    <a href="{{route('admin#edit')}}" class="btn bg-dark text-white">
                                        <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
