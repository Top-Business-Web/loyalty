@extends('Admin/layouts/master')
@section('title')
    {{ $setting->title ?? '' }} | مزود مطاعم
@endsection
@section('page_name')
    مزود مطاعم
@endsection
@section('content')
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <style>
        .checked {
            color: orange;
        }
    </style>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">قائمة المزودين</h3>
                    <p>المزودين المسجلين في الموقع</p>
                    <div class="">

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-striped table-bordered w-100" id="dataTable">
                            <thead>
                            <tr class="fw-bolder text-muted bg-light">
                                <th>#</th>
                                <th>الصورة</th>
                                <th>اسم المزود</th>
                                <th>الايميل</th>
                                <th>الرصيد</th>
                                <th>رقم هاتف مقدم الخدمه</th>
                                <th>التقيم</th>
                                <th class="rounded-end">العمليات</th>
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
        <div class="modal fade bd-example-modal-lg" id="editOrCreate" data-backdrop="static" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example-Modal3">بيانات المستخدم</h5>
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
    <script>

        var columns = [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'balance', name: 'balance'},
            {data: 'phone', name: 'phone'},
            {data: 'rate', name: 'rate'},
            {data: 'action', name: 'action', orderable: false, searchable: false},

            ];


        showData('{{ route('restaurantProvider') }}', columns);
        // Delete Using Ajax

        deleteScript('{{ route('usersDelete') }}');

        // Add Using Ajax
        showAddModal('{{ route('users.create') }}');
        addScript();



        // Edit Using Ajax
        showEditModal('{{ route('users.edit', ':id') }}');
        editScript();

        function updateRequestStatus(selectElement, id) {
            var selectedValue = $(selectElement).val();

            // Make an Ajax request to update the status
            $.ajax({
              url: '{{ route('RequestStatusDegree') }}',
              type: 'post',
              data: {
                id: id,
                status: selectedValue,
                "_token": "{{ csrf_token() }}",
              },
              success: function(data) {
                if (data.code === 200) {
                  if (data.status === 1) {
                    toastr.success('المزود في الخدمة');
                  } else if (data.status === 0) {
                    toastr.success('المزود ليس في الخدمة');
                  }
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                // Handle the error
                console.log(textStatus, errorThrown);
              }
            });
          }

    </script>
@endsection
