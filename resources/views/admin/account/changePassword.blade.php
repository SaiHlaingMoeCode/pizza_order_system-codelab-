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
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>
                            <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                    @error('oldPassword')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                    @error('newPassword')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                    @error('confirmPassword')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount"><i class="fa-solid fa-key"></i> Change Password</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        {{-- <i class="fa-solid fa-circle-right"></i> --}}
                                    </button>
                                    @if (session('notMatch'))
                                    <div class="container mt-3">
                                        <div class="row justify-content-end">
                                            <div class="col-12">
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>{{session('notMatch')}}</div>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                            <i class="fa-solid fa-x"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if (session('changeSuccess'))
                                    <div class="container mt-3">
                                        <div class="row justify-content-end">
                                            <div class="col-12">
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>{{session('changeSuccess')}}</div>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
