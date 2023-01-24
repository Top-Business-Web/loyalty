<div class="table-responsive">
    <!--begin::Table-->
    <table class="table table-striped table-bordered w-100">
        <thead>
        <tr class="fw-bolder text-muted bg-light">
            <th class="min-w-25px">المنتج</th>
{{--            <th class="min-w-20px">التصنيف</th>--}}
{{--            <th class="min-w-20px">التصنيف الفرعي</th>--}}
            <th class="min-w-20px">الكمية</th>
            <th class="min-w-20px">حالة الدفع</th>
            <th class="min-w-20px"> المجموع</th>


        </tr>
        </thead>
        <tbody>
        @foreach($order->details as $detail)
        <tr>
            <td>{{$detail->product->name_ar}}</td>
{{--            <td>{{ @$detail->product->category->name_ar}}</td>--}}
{{--            <td>{{ @$detail->product->subCategory->name_ar}}</td>--}}
            <td>{{$detail->qty}}</td>
            <td>
                @if($order->status=='delivered')
                    تم الدفع
                @else
                لم يتم الدفع
                @endif
            </td>
            <td>{{$detail->qty* $detail->product->price ??'0'}}</td>
        </tr>

        @endforeach
        <tr>
            <td colspan="5"> المجموع الكلي {{$order->total_price}}</td>
        </tr>
        </tbody>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
</div>






