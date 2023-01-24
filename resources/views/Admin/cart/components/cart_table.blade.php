
<table class="table table-striped table-bordered text-nowrap w-25 "  >
    <thead>
    <tr class="fw-bolder text-muted bg-light">
        {{--                                   <th class="min-w-20px">#</th>--}}
        <th class="min-w-10px">{{__('admin.image')}}</th>
        <th class="min-w-10px"> {{__('admin.name_ar')}}</th>
        <th class="min-w-10px"> {{__('admin.price')}}</th>
        <th class="min-w-10px"> الكمية</th>

        <th class="min-w-30px rounded-end">{{__('admin.actions')}}</th>
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
