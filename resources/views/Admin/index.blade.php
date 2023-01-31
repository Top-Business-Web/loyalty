@extends('Admin/layouts/master')
@section('title')
    {{($setting->title) ?? 'الصفحة الرئيسية'}} | لوحة التحكم
@endsection
@section('page_name')
    الرئـيسية
@endsection
@section('content')
    <div class="row">

        <div class="col-xl-12">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">

                            <div class="d-flex flex-wrap">
                                <div class="me-3">
                                    <p class="text-muted mb-2">{{__('admin.categories')}}</p>
                                    <h5 class="mb-0">{{ App\Models\Category::select('id')->get()->count()}}</h5>
                                </div>

                                <div class="avatar-sm ms-auto">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                        <i class="bx bxs-book-bookmark"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card blog-stats-wid">
                        <div class="card-body">

                            <div class="d-flex flex-wrap">
                                <div class="me-3">
                                    <p class="text-muted mb-2">{{__('admin.products')}}</p>
                                    <h5 class="mb-0">{{ App\Models\Product::select('id')->get()->count()}}</h5>
                                </div>

                                <div class="avatar-sm ms-auto">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                        <i class="bx bxs-note"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card blog-stats-wid">
                        <div class="card-body">
                            <div class="d-flex flex-wrap">
                                <div class="me-3">
                                    <p class="text-muted mb-2">{{__('admin.orders')}}</p>
                                    <h5 class="mb-0">{{ App\Models\Order::select('id')->get()->count()}}</h5>
                                </div>

                                <div class="avatar-sm ms-auto">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                        <i class="bx bxs-message-square-dots"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="d-flex flex-wrap align-items-start">--}}
{{--                        <h5 class="card-title me-2">Visitors</h5>--}}
{{--                        <div class="ms-auto">--}}
{{--                            <div class="toolbar d-flex flex-wrap gap-2 text-end">--}}
{{--                                <button type="button" class="btn btn-light btn-sm">--}}
{{--                                    ALL--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-light btn-sm">--}}
{{--                                    1M--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-light btn-sm">--}}
{{--                                    6M--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-light btn-sm active">--}}
{{--                                    1Y--}}
{{--                                </button>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row text-center">--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="mt-4">--}}
{{--                                <p class="text-muted mb-1">Today</p>--}}
{{--                                <h5>1024</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-4">--}}
{{--                            <div class="mt-4">--}}
{{--                                <p class="text-muted mb-1">This Month</p>--}}
{{--                                <h5>12356 <span class="text-success font-size-13">0.2 % <i class="mdi mdi-arrow-up ms-1"></i></span></h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-4">--}}
{{--                            <div class="mt-4">--}}
{{--                                <p class="text-muted mb-1">This Year</p>--}}
{{--                                <h5>102354 <span class="text-success font-size-13">0.1 % <i class="mdi mdi-arrow-up ms-1"></i></span></h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <hr class="mb-4">--}}

{{--                    <div class="apex-charts" id="area-chart" dir="ltr"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>

{{--    <div class="row">--}}
{{--        <div class="col-lg-4 col-md-4 col-sm-12 col-xl-4">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <h6 class="">المنتجات</h6>--}}
{{--                            <h3 class="mb-2 number-font">5</h3>--}}
{{--                            <p class="text-muted">--}}
{{--                                <span class="text-muted"><i class="fa fa-chevron-circle-up text-muted ml-1"></i> 3%</span>--}}
{{--                                last month--}}
{{--                            </p>--}}
{{--                            <div class="progress h-2">--}}
{{--                                <div class="progress-bar bg-orange w-50" role="progressbar"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4 col-md-4 col-sm-12 col-xl-4">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <h6 class="">Time On site(Avg)</h6>--}}
{{--                            <h3 class="mb-2 number-font">5m:45s</h3>--}}
{{--                            <p class="text-muted">--}}
{{--                                <span class="text-muted"><i class="fa fa-chevron-circle-down text-muted ml-1"></i> 0.15%</span>--}}
{{--                                last month--}}
{{--                            </p>--}}
{{--                            <div class="progress h-2">--}}
{{--                                <div class="progress-bar bg-secondary w-50" role="progressbar"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4 col-md-4 col-sm-12 col-xl-4">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <h6 class="">Page Views(Avg)</h6>--}}
{{--                            <h3 class="mb-2 number-font">8.14</h3>--}}
{{--                            <p class="text-muted">--}}
{{--                                <span class="text-muted"><i class="fa fa-chevron-circle-down text-muted ml-1"></i> 0.15%</span>--}}
{{--                                last month--}}
{{--                            </p>--}}
{{--                            <div class="progress h-2">--}}
{{--                                <div class="progress-bar bg-secondary1 w-50" role="progressbar"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row">--}}
{{--        <div class="col-lg-8 col-sm-12 col-xl-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h3 class="card-title">Countrywise Traffics</h3>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-bordered table-hover  mb-0 text-nowrap">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Country</th>--}}
{{--                                <th>Sessions</th>--}}
{{--                                <th>Bounce Rate</th>--}}
{{--                                <th>Time On site(Avg)</th>--}}
{{--                                <th>Status</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <td><img src="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/assets/images/flags/us.svg" class="w-5 h-5 ml-2" alt="">United State</td>--}}
{{--                                <td>13,786</td>--}}
{{--                                <td>56.8%</td>--}}
{{--                                <td>2m:56s</td>--}}
{{--                                <td>--}}
{{--                                    <div class="progress h-1 mt-2">--}}
{{--                                        <div class="progress-bar bg-primary w-50" role="progressbar"></div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td><img src="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/assets/images/flags/in.svg" class="w-5 h-5 ml-2" alt="">India</td>--}}
{{--                                <td>16,876</td>--}}
{{--                                <td>34.5%</td>--}}
{{--                                <td>1m:43s</td>--}}
{{--                                <td>--}}
{{--                                    <div class="progress h-1 mt-2">--}}
{{--                                        <div class="progress-bar bg-orange  w-20" role="progressbar"></div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td><img src="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/assets/images/flags/ru.svg" class="w-5 h-5 ml-2" alt="">Russia</td>--}}
{{--                                <td>45,863</td>--}}
{{--                                <td>93.76%</td>--}}
{{--                                <td>8m:16s</td>--}}
{{--                                <td>--}}
{{--                                    <div class="progress h-1 mt-2">--}}
{{--                                        <div class="progress-bar bg-secondary1 w-60" role="progressbar"></div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td><img src="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/assets/images/flags/ca.svg" class="w-5 h-5 ml-2" alt="">Canada</td>--}}
{{--                                <td>37,917</td>--}}
{{--                                <td>46.76%</td>--}}
{{--                                <td>5m:76s</td>--}}
{{--                                <td>--}}
{{--                                    <div class="progress h-1 mt-2">--}}
{{--                                        <div class="progress-bar bg-secondary w-40" role="progressbar"></div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td><img src="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/assets/images/flags/ge.svg" class="w-5 h-5 ml-2" alt="">Germany</td>--}}
{{--                                <td>67,967</td>--}}
{{--                                <td>34.876%</td>--}}
{{--                                <td>5m:34s</td>--}}
{{--                                <td>--}}
{{--                                    <div class="progress h-1 mt-2">--}}
{{--                                        <div class="progress-bar bg-warning w-30" role="progressbar"></div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div><!-- COL END -->--}}
{{--        <div class="col-lg-4 col-md-12 col-xl-4">--}}
{{--            <div class="card overflow-hidden">--}}
{{--                <div class="card-header">--}}
{{--                    <h3 class="card-title">Traffic by Site</h3>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-6">--}}
{{--                            <div class="card shadow-none">--}}
{{--                                <div class="card-body p-4">--}}
{{--                                    <div class="text-center">--}}
{{--                                        <i class="bx bxl-facebook fs-40 text-primary"></i>--}}
{{--                                        <h4 class="mt-3 mb-0 number-font fs-20">8,209</h4>--}}
{{--                                        <p class="text-muted mb-0">FaceBook</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <div class="card shadow-none">--}}
{{--                                <div class="card-body p-4">--}}
{{--                                    <div class="text-center">--}}
{{--                                        <i class="bx bxl-google-plus fs-40 text-danger"></i>--}}
{{--                                        <h4 class="mt-3 mb-0 number-font fs-20">7,210</h4>--}}
{{--                                        <p class="text-muted mb-0">Google</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <div class="card shadow-none mb-lg-0">--}}
{{--                                <div class="card-body p-4">--}}
{{--                                    <div class="text-center">--}}
{{--                                        <i class="bx bxl-youtube fs-40 text-orange"></i>--}}
{{--                                        <h4 class="mt-3 mb-0 number-font fs-20">6,234</h4>--}}
{{--                                        <p class="text-muted mb-0">Youtube</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <div class="card shadow-none mb-0">--}}
{{--                                <div class="card-body p-4">--}}
{{--                                    <div class="text-center">--}}
{{--                                        <i class="bx bxl-twitter fs-40 text-info"></i>--}}
{{--                                        <h4 class="mt-3 mb-0 number-font fs-20">4,567</h4>--}}
{{--                                        <p class="text-muted mb-0">Twitter</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}



@endsection
@section('js')

@endsection

