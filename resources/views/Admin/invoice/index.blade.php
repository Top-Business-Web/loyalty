<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/normalize.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Bebas+Neue&family=Cairo:wght@300;400;500;600;700;800;900&family=Dosis:wght@200;300;400;500;600;700;800&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,300;1,400&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Open+Sans:wght@300;400;500;600;700;800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');

        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            font-family: 'Tajawal', sans-serif;
        }
        h6 ,h5,h4{
            font-size: 16px;
            color: #5b5b5b;
        }
        h1,h2,h3{
            font-size: 25px;
            font-weight: 600;
        }
        body{
            background-color: #f7f7f7;
        }
        .mainButton{
            background-color: transparent !important;
            color: #92603f !important;
            font-size: 18px;
            border: 1px solid #92603f;
            transition: .2s all;
        }
        .mainButton:hover , .mainButton:focus{
            background-color: #92603f !important;
            color: #fff !important;

        }
        .invoice{
            width: 21.0cm;
            height: 120vh;
            margin-right: auto;
            margin-left: auto;

        }
        .invoiceBox{
            padding: 20px;
            overflow: hidden;
            box-shadow: 0 0px 10px 0px rgb(177 177 177 / 50%);
        }
        .titleLogo{
            padding-bottom: 30px;
            border-bottom: 1px solid #5b5b5b;
        }

        .title{
            color: #fff;
            text-align: center;
            position: relative;
            padding: 10px;
        }

        .img{
            height: 50px;
            width: 180px;
        }
        .img img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .title::before{
            content: "";
            position: absolute;
            clip-path: polygon(100% 0%, 100% 51%, 100% 100%, 25% 100%, 0% 50%, 25% 0%);
            background-color: #92603f;
            width: 220px;
            height: 65px;
            right: -25px;
            transform: translateY(-50%);
            top: 50%;
            z-index: -1;
        }
        .info{
            margin-top: 30px;
        }
        .addersSeller , .info2{
            margin-top: 15px;
        }
        table{
            width: 100%;
            background-color: #f7f7f7;
            border-spacing: 5px;
        }
        th{
            width: 20%;
            padding: .5rem .75rem;
            vertical-align: auto !important;
            background-color: #92603f;
            border: 1px solid #92603f;
        }

        th h4{
            color: #f7f7f7;
        }
        td{
            line-height: .8;
            padding-top: 10px;
            border: 1px solid #dcdcdc;
        }
        .bigTable{
            margin-top: 30px;
        }
        .smallTable table th{
            width: 70%;
        }
        .smallTable{
            width: 90%;
            margin-top: 5px;
        }

        .Qr-code img{
            width: 150px;
        }
        /*  الرقم الضريبي للمشتري  */
        .buy{
            display: none;
        }










    </style>
</head>

<body>

<div class="d-flex justify-content-center">
    <div class="text-center mt-4 mb-1">
        <a  href="{{route('adminHome')}}"   class="btn mainButton"  >الرئيسية</a>
    </div>
</div>

<section class="invoice pt-5 ">
    <div class="container">
        <div class="row">
            <!-- col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-sm-12 -->
            <div class="">
                <div class="invoiceBox">
                    <div class="titleLogo d-flex aling-items-center justify-content-between ">
                        <h2 class="Ar title">فاتورة</h2>
                        <div class="img">
                            <img src="{{asset('assets/uploads/logo.png')}}" alt="">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between aling-items-center">
                        <div>
                            <div class="info ">
                                <h4 class="Ar">الرقم التسلسلي للفاتورة :{{$order->id}} </h4>
                            </div>
                            <div class=" info2">
                                <h4 class="Ar">وقت و تاريخ اصدار الفاتورة  : {{$order->created_at}}</h4>
                            </div>
                            <div class="info2 ">
                                <h4 class="Ar"> عنوان الشركة : السعوديه </h4>
                            </div>
                            <div class=" info2">
                                <h4 class="Ar">  اسم الشركة : شركة أوشن العربية التجارية</h4>
                            </div>
                            <div class=" info2">
                                <h4 class="Ar">   الرقم الضريبي : ١٠١٠٦٩٩١٦٠</h4>
                            </div>
                            <!-- الرقم الضريبي للمشتري  -->
                            <div class=" info2 buy">
                                <h4 class="Ar">الرقم الضريبي للمشتري</h4>
                            </div>
                        </div>
                        <div class="Qr-code info">
                            <img src="{{asset('assets/admin/images/Qr-code-sign-on-transparent-background-PNG-1.png')}}" alt="">
                        </div>
                    </div>

                    <div class="bigTable">
                        <table class="text-center">
                            <tr>
                                <th>

                                    <h4>اسم المنتج</h4>
                                </th>
                                <th>
                                    <h4>سعر المنتج</h4>
                                </th>
                                <th>
                                    <h4>الكمية</h4>
                                </th>
                                <th>
                                    <h4>المجموع شامل ضريبة القيمة المضافة</h4>
                                </th>





                            </tr>
{{--                            @forelse($offer->offer_details as $detail)--}}
                            @forelse($order->details as $detail)
                            <tr>
                                <td>
                                    <p>
{{--                                        @if($offer->type!='other')--}}
                                        {{$detail->product->name_ar}} </p>
{{--                                    @else--}}
{{--                                        المنتج المطلوب غير موجود--}}
{{--                                        , تم عرض المنتج {{$detail->other->title_ar}} بدلا منه--}}


{{--                                        @endif--}}
                                </td>
                                <td>
                                    <p>  {{$detail->product->price}}</p>
                                </td>
                                <td>
                                    <p>
{{--                                        @if($detail->type == 'less')--}}
{{--                                            الكمية المطلوبة غير متوفرة المتاح حاليا {{$detail->available_qty}} صنف--}}
{{--                                        @else--}}
                                               {{$detail->qty}}
{{--                                        @endif--}}
                                    </p>
                                </td>
                                <td>
                                    <p>{{($detail->qty * $detail->product->price)}}</p>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4"> لايوجد منتجات</td>
                                </tr>
                                @endforelse
                        </table>

                    </div>
                    <div class="smallTable text-end ms-auto">
                        <table class="text-center">
                            <tr>
                                <th>
                                    <h4>إجمالي المبلغ (غير شامل ضريبة القيمة المضافة)</h4>
                                </th>
                                <td>
                                    <p>{{$order->total_price}}ريال</p>
                                </td>
                            </tr>
                            <tr>

                                <th>
                                    <h4>مجموع ضريبة القيمة المضافة </h4>
                                </th>
                                <td>
                                    <p>

                                        {{$order->total_price * .15}}
                                           ريال </p></bdo>
                                </td>

                            </tr>
                            <tr>

                                <th>
                                    <h4>إجمالي المبلغ</h4>
                                </th>
                                <td>
                                    <p>{{$order->total_price * 1.15}} ريال </p>
                                </td>

                            </tr>
                        </table>
                    </div>
                    <div class="text-center mt-4 mb-1">
                        <button type="button" class="btn mainButton" onclick="printer()" id="printer">طباعة</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- file js -->
<script src="js/popper.min.js"></script>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.min.js"></script>
<script src="js/main.js"></script>
<script>
  function printer() {
      window.print();
  }
</script>
</body>

</html>
