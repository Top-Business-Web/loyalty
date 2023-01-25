@extends('Admin/layouts/master')


@section('title')
    {{($setting->title) ?? ''}} | التصنيفات
@endsection
@section('page_name') التصنيفات @endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> السلة </h3>
                    <div class="">
{{--                        <button class="btn btn-secondary btn-icon text-white addBtn">--}}
{{--									<span>--}}
{{--										<i class="fe fe-plus"></i>--}}
{{--									</span> اضافة جديد--}}
{{--                        </button>--}}
                    </div>
                </div>
                <div class="card-body">
                   <div class="row">
                       <div class="table-responsive col-md-7 col-lg-7">
                           <!--begin::Table-->
                           <table class="table table-striped table-bordered text-nowrap w-100" id="dataTable">
                               <thead>
                               <tr class="fw-bolder text-muted bg-light">
                                   <th class="">#</th>
                                   <th class="">{{__('admin.image')}}</th>
                                   <th class=""> {{__('admin.name_ar')}}</th>
                                   <th class="">{{__('admin.name_en')}}</th>
                                   <th class="min-w-50px rounded-end">{{__('admin.actions')}}</th>
                               </tr>
                               </thead>
                           </table>
                       </div>
                       <div class="table-responsive col-md-5 col-lg-5" id="cart_table_div">
                           <!--begin::Table-->
                           <table class="table table-striped table-bordered text-nowrap "  >
                               <thead>
                               <tr class="fw-bolder text-muted bg-light">
{{--                                   <th class="min-w-20px">#</th>--}}
                                   <th >{{__('admin.image')}}</th>
                                   <th > {{__('admin.name_ar')}}</th>
                                   <th > {{__('admin.price')}}</th>
                                   <th > الكمية</th>

                                   <th class="rounded-end">{{__('admin.actions')}}</th>
                               </tr>
                               </thead>
                               <tbody>
                               @forelse($cartCollections as $cartCollection)
                                   <tr>
{{--                                       <td>{{$cartCollection['id']}}</td>--}}
                                       <td><img width="20 px" height="30" src="{{$cartCollection['attributes']['image']}}" alt=""></td>
                                       <td> {{$cartCollection['name']}}</td>
                                       <td> {{$cartCollection['price']}}</td>
                                       <td>   <input style="max-width: 130px;height: 40px;"
                                                     product-id="{{ $cartCollection['id'] }}"
                                                     class="cart_update QtyItem" min="1"
                                                     id="{{ $cartCollection['id'] }}" max=""
                                                     value="{{ $cartCollection['quantity'] }}" type="number"></td>
                                       <td>
                                           <div class="delete">
                                               <a class="btn btn-pill btn-danger-light trash"  href="{{ url('delete_cart?product_id='.$cartCollection['id']) }}"
                                               >
                                                   <i class="fas fa-trash"></i>
                                               </a>
                                               {{--                                                <a class="btn trash"--}}
                                               {{--                                               href="{{ url('delete_cart?product_id='.$cartCollection['id']) }}">--}}
                                               {{--                                                <i class="fa-solid fa-trash"></i>--}}
                                               {{--                                            </a>--}}
                                           </div>
                                       </td>
                                   </tr>
                               @empty
                                   <tr>
                                       <td colspan="5"><div class="alert alert-info">لا يوجد منتجات مضافة</div></td>
                                   </tr>
                               @endforelse
                               </tbody>
                           </table>

                           <!-- buttonBuy +price -->
                           <div class="buttonBuy">
                               <!-- buttonBuy -->

                           <!-- price -->
                               <div class="price">
                                   <p>المجموع</p>
                                   <p class="alert alert-success total-payments">{{ cart_get_total() }}</p>
                                   <form action="{{url('admin/add_order')}}">
                                       <button class="btn btn-info" type="submit">
                                           اتمام العمليه
                                       </button>
                                   </form>
                               </div>

                           </div>
                       </div>

                   </div>
                </div>
            </div>
        </div>


    </div>
    @include('Admin/layouts/myAjaxHelper')
{{--    @include('admin.general_components.ajax-code')--}}
    @include('Admin.general_components.ajax-code')

@endsection


@section('ajaxCalls')
    <script>
        var columns = [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'name_ar', name: 'name_ar'},
            {data: 'name_en', name: 'name_en'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        showData('{{route('products.index')}}', columns);


    </script>
@endsection

