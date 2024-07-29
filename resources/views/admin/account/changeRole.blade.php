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
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>
                            <hr>
                            <form action="{{route('admin#change',$account->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="col-4 offest-1 text-center">
                                    @if ($account->image==null)
                                        @if ($account->gender=='male')
                                            <img src="{{asset('image/default_user.jpg')}}"/>
                                        @else
                                             <img src="{{asset('image/female_default.jpg')}}"/>
                                        @endif
                                    @else
                                        <img src="{{asset('storage/'.$account->image)}}" />
                                    @endif
                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white col-12" type="submit"><i class="fa-solid fa-circle-chevron-right"></i> Change</button>
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" disabled name="name" value="{{old('name',$account->name)}}" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                            @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="" disabled>Choose Role</option>
                                                <option value="admin" @if ($account->role=='admin') selected @endif>Admin</option>
                                                <option value="user" @if ($account->role=='user') selected @endif>User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input id="cc-pament" disabled name="email" value="{{old('email',$account->email)}}" type="email" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                             @error('email')
                                              <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" disabled name="phone" value="{{old('phone',$account->phone)}}" type="number" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                             @error('phone')
                                             <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" disabled class="form-control">
                                                <option value="">Choose Gender</option>
                                                <option value="male" @if ($account->gender=='male') selected @endif>Male</option>
                                                <option value="female" @if ($account->gender=='female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" disabled class="form-control @error('address') is-invalid @enderror" id="" cols="30" rows="10">{{old('address',$account->address)}}</textarea>
                                             @error('adddress')
                                             <small class="text-danger">{{$message}}</small>
                                              @enderror
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
