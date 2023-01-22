

<div class="col-lg-6 col-md-6 ">
    @include('admin.pages.product.components.slider', ['product' => $product])
</div>

<div class="col-lg-6 col-md-6">




    <div class="product-content">
        <h3>{{ $product->data()['name'] }}</h3>
        <div class="price">
{{--            @if($product->old_price > $product->price)--}}
{{--                <span class="old-price">{{ $product->old_price }} {{trans('web_lang.IQD')}}</span>--}}
{{--            @endif--}}
            <span class="new-price">{{ $product->data()['price'] }} {{$product->data()['priceCurrency']}}</span>
        </div>
{{--        <p>{{ $product->details }} </p>--}}

    </div>
</div>
