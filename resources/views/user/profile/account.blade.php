@extends('user.layouts.master')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                         {{-- update account alert  --}}
                         @if (session('updateSuccess'))
                         <div class="container mt-3">
                             <div class="row justify-content-end">
                                 <div class="col-3 offseet-8">
                                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                                         <div class="d-flex justify-content-between align-items-center">
                                             <div>{{session('updateSuccess')}}</div>
                                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                             </button>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         @endif
                        <hr>
                        <form action="{{route('user#changeAccount',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-4 offest-1 text-center">
                                @if (Auth::user()->image==null)
                                    @if (Auth::user()->gender=='male')
                                        <img src="{{asset('image/default_user.jpg')}}" class="img-thumbnail"/>
                                    @else
                                         <img src="{{asset('image/female_default.jpg')}}" class="img-thumbnail"/>
                                    @endif
                                @else
                                    <img src="{{asset('storage/'.Auth::user()->image)}}" class="img-thumbnail" />
                                @endif
                                    <div class="mt-3">
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                        @error('image')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn bg-dark text-white col-12" type="submit"><i class="fa-solid fa-circle-chevron-right"></i> Update</button>
                                    </div>
                                </div>
                                <div class="col-6 ">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" value="{{old('name',Auth::user()->name)}}" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                        @error('name')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" value="{{old('email',Auth::user()->email)}}" type="email" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                         @error('email')
                                          <small class="text-danger">{{$message}}</small>
                                         @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" value="{{old('phone',Auth::user()->phone)}}" type="number" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                         @error('phone')
                                         <small class="text-danger">{{$message}}</small>
                                         @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if (Auth::user()->gender=='male') selected @endif>Male</option>
                                            <option value="female" @if (Auth::user()->gender=='female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="" cols="30" rows="10">{{old('address',Auth::user()->address)}}</textarea>
                                         @error('adddress')
                                         <small class="text-danger">{{$message}}</small>
                                          @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                        <input id="cc-pament" name="role" value="{{old('role',Auth::user()->role)}}" type="text" class="form-control @error('role') is-invalid @enderror" aria-required="true" aria-invalid="false" disabled>
                                         @error('role')
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
@endsection
