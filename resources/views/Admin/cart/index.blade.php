@extends('admin/layouts/master')
@section('content')


    <!-- profile -->
    <!--  Cart  -->

    <section class="cart">
        <div class="container">

            <div class="full_page">
                <div class="max_width991">
                    <div class="container">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-striped table-bordered text-nowrap w-100" id="dataTable">
                                <thead>
                                <tr class="fw-bolder text-muted bg-light">
                                    <th class="min-w-25px">#</th>
                                    <th class="min-w-50px">{{__('admin.image')}}</th>
                                    <th class="min-w-50px"> {{__('admin.name_ar')}}</th>

                                    <th class="min-w-50px rounded-end">{{__('admin.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($cartCollections as $cartCollection)
                                    <tr>
                                        <td>{{$cartCollection['id']}}</td>
                                        <td><img width="30 px" height="30" src="{{$cartCollection['attributes']['image']}}" alt=""></td>
                                        <td> {{$cartCollection['name']}}</td>
                                        <td>
                                            <div class="delete">
                                                <a class="btn trash"
                                                   href="{{ url('delete_cart?product_id='.$cartCollection['id']) }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"><div class="alert alert-info">لا يوجد منتجات مضافة</div></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        <div class="row">
                            @forelse($cartCollections as $cartCollection)
                                <div class="col-12">
                                    <div class="cartDerails">
                                        <!-- img -->
                                        <div class="img">
                                            <img src="{{$cartCollection['attributes']['image']}}" alt="">
                                        </div>
                                        <!-- cartInfo -->
                                        <div class="cartInfo">
                                            <p>
                                                {{$cartCollection['name']}}
                                            </p>
                                            <p>
                                            <div class="">
                                                <input style="max-width: 130px;height: 40px;"
                                                       product-id="{{ $cartCollection['id'] }}"
                                                       class="cart_update QtyItem" min="1"
                                                       id="{{ $cartCollection['id'] }}" max=""
                                                       value="{{ $cartCollection['quantity'] }}" type="number">
                                            </div>
                                            <span>x {{ $cartCollection['quantity'] }}</span>
                                            <span>{{ $cartCollection['quantity'] }} x {{ $cartCollection['price'] }}</span>
                                            <span>IQD</span>
                                            </p>
                                        </div>
                                        <!-- delete -->
                                        <div class="delete">
                                            <a class="btn trash"
                                               href="{{ url('delete_cart?product_id='.$cartCollection['id']) }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                                <hr>
                            @empty
                                <div class="alert alert-info">لا يوجد منتجات مضافة</div>
                            @endforelse



                        </div>
                        <!-- buttonBuy +price -->
                        <div class="buttonBuy">
                            <!-- buttonBuy -->
                            <button class="btn" type="button">
                                <a href="#!">اتمام الشراء</a>
                            </button>
                            <!-- price -->
                            <div class="price">
                                <p>المجموع</p>
                                <p>{{ cart_get_total() }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.general_components.ajax-code')

@endsection
@section('js')

    <script>


    </script>
@endsection

