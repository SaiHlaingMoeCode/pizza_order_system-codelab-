@extends('user.layouts.master')
@section('content')
      <!-- Cart Start -->
      <div class="container-fluid" style="height: 700px">
        <div class="row px-xl-5">
            <div class="col-lg-9 offset-1 table-responsive mb-5">
                    <form action="{{route('user#contact')}}" method="post">
                        @csrf
                            <div class="row">
                                <div class="col-6 offset-3">
                                    @if (session('Message'))
                                    <div class="container my-3">
                                        <div class="row justify-content-end">
                                            <div class="">
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>{{session('Message')}}</div>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
                                    {{-- <div class="form-group">
                                        <label class="control-label mb-1">Subject</label>
                                        <input id="cc-pament" name="subject" type="text" class="form-control @error('subject') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                         @error('subject')
                                         <small class="text-danger">{{$message}}</small>
                                         @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <label class="control-label mb-1">Message</label>
                                        <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="" cols="30" rows="10"></textarea>
                                         @error('message')
                                         <small class="text-danger">{{$message}}</small>
                                          @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 offset-8 mt-3">
                                 <button type="submit" class="btn bg-info fw-bold">Send</button>
                            </div>
                        </form>


            </div>
        </div>
    </div>

    <!-- Cart End -->
@endsection
