
<div class="cart-totals">
    <h3>{{ trans('web_lang.Total cart') }}</h3>
    <ul>
        <li>{{ trans('web_lang.Subtotal') }} <span class="sub-total-price">{{ cart_get_total() }}</span></li>
        <li>{{ trans('web_lang.Shipping') }}<span>{{cart_get_total()}}</span></li>
        <li>{{ trans('web_lang.Total') }} <span class="total-price">{{ cart_get_total() }}</span></li>
{{--        @php--}}

{{--            $totalWithShipingCost= cart_get_total()+cart_get_total()*(int)\App\Models\Setting::first()->shiping_cost/100;--}}

{{--        @endphp--}}
        <li>{{ trans('web_lang.total payments') }} <span class="total-payments">{{ cart_get_total() }}</span></li>
    </ul>

    @if(isset($type) && $type == 'checkout')
        <div class="my-3">
            <button type="submit"  name="submit" value="cash" class="default-btn">{{ trans('web_lang.Confirmation') }}<span></span></button>
        </div>
    @else
        <a href="{{ url('checkout') }}" class="default-btn">{{ trans('web_lang.go to pay') }}<span></span></a>
    @endif

</div>
