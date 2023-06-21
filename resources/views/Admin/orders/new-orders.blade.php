@extends('Admin/layouts/master')
@section('title')
    {{($setting->title) ?? ''}} | الطلبات الجديدة
@endsection
@section('page_name') الطلبات الجديدة @endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">طلبات العملاء الجديدة</h3>
                    <div class="text-gray">طلبات جديدة في انتظار عروض مقدمي الخدمة</div>
                    <div class="">

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-striped table-bordered w-100" id="dataTable">
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th class="min-w-25px">رقم الطلب</th>
                                <th class="min-w-20px">العميل</th>
                                <th class="min-w-20px">مزود الخدمة</th>
                                <th class="min-w-20px">التصنيف</th>
                                <th class="min-w-20px">الهاتف</th>
                                <th class="min-w-20px">وقت الطلب</th>
{{--                                @if(checkPermission(53))--}}
                                <th class="min-w-20px">التفاصيل</th>
{{--                                @endif(checkPermission(53))--}}

                                    <th class="min-w-20px">المجموع</th>
                                <th class="min-w-20px">فاتورة</th>

{{--                                <th class="min-w-20px">العنوان</th>--}}

                                <th class="min-w-20px">العمليات</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--Delete MODAL -->
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف بيانات</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="delete_id" name="id" type="hidden">
                        <p>هل انت متأكد من حذف البيانات التالية <span id="title" class="text-danger"></span>؟</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="dismiss_delete_modal">
                            الغاء
                        </button>
                        <button type="button" class="btn btn-danger" id="delete_btn">حذف !</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL CLOSED -->

        <!-- Edit MODAL -->
        <div class="modal fade" id="editOrCreate" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example-Modal3">تفاصيل الطلب</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">

                    </div>
                </div>
            </div>
        </div>
        <!-- Edit MODAL CLOSED -->

    </div>
    @include('Admin/layouts/myAjaxHelper')
@endsection
@section('ajaxCalls')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var columns = [
            {data: 'id', name: 'id'},
            {data: 'user_id', name: 'user_id'},
            {data: 'provider_id', name: 'provider_id'},
            {data: 'category_id', name: 'category_id'},
            {data: 'phone', name: 'phone'},
            {data: 'created_at', name: 'created_at'},
{{--                @if(checkPermission(53))--}}
            {data: 'details', name: 'details'},
{{--                @endif--}}
            {data: 'total_price', name: 'total_price'},
            {data: 'invoice', name: 'invoice'},

            // {data: 'address', name: 'address',orderable: false, searchable: false},

            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]
        showData('{{route('newOrders')}}', columns);
        // Delete Using Ajax
        deleteScript('{{route('orders.delete')}}');

        // Show Details Modal
        $(document).on('click', '.detailsBtn', function () {
            var id = $(this).data('id')
            var url = "{{route('orderDetails',':id')}}";
            url = url.replace(':id', id)
            $('#modal-body').html(loader)
            $('#editOrCreate').modal('show')

            setTimeout(function () {
                $('#modal-body').load(url)
            }, 500)
        })
    </script>
    <script>

        function cancel(id){

            $.ajax({
                type: 'get',
                enctype: 'multipart/form-data',
                url: "{{route('admin.cancelneworder')}}",
                data: {
                    id:id
                },

                success: function (data){
                    if(data['status']==true)
                    {
                        $('#dataTable').DataTable().ajax.reload();
                        toastr.success('تم تحديث الحالة بنجاح')

                    }
                    else
                        location.reload();

                }, error: function (reject){
                    swal("  ","رجاء المحاوله لاحقا","warning",{button:"حسنآ",});

                }
            });

        }


    </script>
    <script>
        function invoice(id)
        {
            var url = "{{route('admin.get.invoice.order',':id')}}";
            url = url.replace(':id', id)
            window.location=url;
        }

    </script>
@endsection


