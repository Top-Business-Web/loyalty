
<div class="sliderWithThumb">
    <div class="swiper-container product-details-top">
        <div class="swiper-wrapper">
            {{-- big image --}}

            @foreach($product->data()['images'] as $product_image)
                <div class="swiper-slide">
                    <a data-fancybox="product-Details" href="{{ $product_image }}" data-caption="">
                        <img src="{{ $product_image }}" alt="">
                    </a>
                </div>
            @endforeach
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next swiper-button-white"></div>
        <div class="swiper-button-prev swiper-button-white"></div>
    </div>
    <div class="swiper-container product-details-thumbs">
        <div class="swiper-wrapper">
            {{-- small image --}}
{{--            <div class="swiper-slide"><img src="{{ GetImg($product->main_image) }}" alt=""></div>--}}
            @foreach($product->data()['images'] as $product_image)
                <div class="swiper-slide"><img src="{{$product_image->image }}" alt=""></div>
            @endforeach
        </div>
    </div>
</div>
