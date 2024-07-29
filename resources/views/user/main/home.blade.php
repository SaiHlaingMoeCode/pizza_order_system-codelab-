@extends('user.layouts.master')
@section('content')
         <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Filter by Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <div class="bg-dark text-white px-3 py-2 custom-control d-flex align-items-center justify-content-between mb-3">
                      <label class="mt-2" for="price-all">Categories</label>
                      <span class="badge border font-weight-normal">{{count($category)}}</span>
                 </div>
                 <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                    <a href="{{route('user#home')}}" class="text-dark"><label class="" for="price-1">All</label></a>
                 </div>
                 @foreach ($category as $c)
                 <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                        <a href="{{route('user#filter',$c->id)}}" class="text-dark"><label for="price-1">{{$c->name}}</label></a>
                 </div>
                 @endforeach
                </div>

                {{-- contact us  --}}
                    <a href="{{route('user#contactPage')}}">
                        <button class="btn btn btn-warning w-100 text-white fw-bold">Contact Us</button>
                    </a>
            </div>
            <!-- Shop Sidebar End -->
             <!-- Shop Product Start -->
         <div class="col-lg-9 col-md-8 mt-2">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a href="{{route('user#cartList')}}"class="text-decoration-none">
                                <button type="button" class="btn btn-dark position-relative">
                                    <i class="fa-solid fa-cart-plus fs-5 text-white"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                                      {{count($cart)}}
                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                  </button>
                            </a>
                            <a href="{{route('user#history')}}" class="text-decoration-none ms-3">
                                <button type="button" class="btn btn-dark position-relative">
                                    <i class="fa-solid fa-clock-rotate-left fs-5 me-2"></i> History
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                                      {{count($history)}}
                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                  </button>
                            </a>
                        </div>

                        <div class="ml-2">
                            <div class="btn-group">
                                <select name="sorting" id="sortingOption" class="form-control ">
                                    <option value="">Sorting</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="row" id="dataList">
                    @if (count($pizza)!=0)
                    @foreach ($pizza as $p)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4" id="myForm">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 210px" src="{{asset('storage/'.$p->image)}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetails',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$p->price}} kyats</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endforeach
                    @else
                        <h2 class="col-6 offset-3 bg-dark shadow-sm text-center p-5 text-warning">There is no Pizza <i class="fa-solid fa-pizza-slice ms-3"></i></h2>
                    @endif
                </span>

            </div>
        </div>
        <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){
    $('#sortingOption').change(function(){
        $eventOption =$('#sortingOption').val();
        // console.log($eventOption);
        if($eventOption=='asc'){
                $.ajax({
                type:'get',
                url: '/user/ajax/pizza/list',
                data:{'status':'asc'},
                dataType: 'json',
                success: function(response){
               $list='';
               for($i=0;$i<response.length;$i++){
                //  console.log(`${response[$i].id}`)
               $list+= `
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4" id="myForm">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 210px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} kyats</h5>
                                </div>
                            </div>
                        </div>

                    </div>

            `;
             }
            //    console.log($list);
            $('#dataList').html($list);
        }
       })}
       else if($eventOption=='desc'){
                $.ajax({
                type:'get',
                url: '/user/ajax/pizza/list',
                data:{'status':'desc'},
                dataType: 'json',
                success: function(response){
                // console.log(response)
                $list='';
               for($i=0;$i<response.length;$i++){
                 console.log(`${response[$i].id}`)
            $list+= `
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4" id="myForm">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 210px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} kyats</h5>
                                </div>
                            </div>
                        </div>

                    </div>

            `;
             }
            //    console.log($list);
            $('#dataList').html($list);
        }
    });
    }
    });
});
</script>
@endsection
