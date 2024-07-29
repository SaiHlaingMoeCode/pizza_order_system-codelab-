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
                            <div style="margin-left: 30px" class="mb-2">
                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="col-4 offest-1 text-center">
                                        <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                        <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm" />
                                    <div class="mt-3">
                                            <input type="file" class="form-control @error('pizzaImage') is-invalid @enderror" name="pizzaImage">
                                            @error('pizzaImage')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn bg-dark text-white col-12" type="submit"><i class="fa-solid fa-circle-chevron-right"></i> Update</button>
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Pizza Name</label>
                                            <input id="cc-pament" name="pizzaName" value="{{old('pizzaName',$pizza->name)}}" type="text" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                            @error('pizzaName')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Pizza Description</label>
                                            <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30" rows="10">{{old('pizzaDescription',$pizza->description)}}</textarea>
                                             @error('pizzaDescription')
                                              <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Pizza Category</label>
                                            <select name="pizzaCategory" class="form-control">
                                                <option value="">Choose Category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{$c->id}}" @if ($pizza->category_id==$c->id)
                                                        selected
                                                    @endif>{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Pizza Price</label>
                                            <input id="cc-pament" name="pizzaPrice" value="{{old('pizzaPrice',$pizza->price)}}" type="text" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                            @error('pizzaPrice')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" value="{{old('pizzaWaitingTime',$pizza->waiting_time)}}" type="text" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                            @error('pizzaWaitingTime')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">View Count</label>
                                            <input id="cc-pament" name="viewCount" value="{{old('viewCount',$pizza->view_count)}}" type="text" class="form-control" aria-required="true" aria-invalid="false" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Created Date</label>
                                            <input id="cc-pament" name="date" value="{{old('date',$pizza->created_at->format('j-F-L'))}}" type="text" class="form-control" aria-required="true" aria-invalid="false" disabled>
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
