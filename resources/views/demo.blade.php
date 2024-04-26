<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

body {
    background-color: #ffe8d2;
    font-family: 'Montserrat', sans-serif
}

.card {
    border: none
}

.logo {
    background-color: #eeeeeea8
}

.totals tr td {
    font-size: 13px
}

.footer {
    background-color: #eeeeeea8
}

.footer span {
    font-size: 12px
}

.product-qty span {
    font-size: 12px;
    color: #dedbdb
}
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-left logo p-2 px-5"> <img src="http://127.0.0.1:8200/client/dest/images/logo-cake.png" width="50"> </div>
                    <div class="invoice p-5">
                        <h5>Xác thực đơn đặt hàng của bạn!</h5> <span class="font-weight-bold d-block mt-4">Hello, {{ $name }}</span> <span>Đơn đặt hàng của bạn đã được xác nhận và sẽ được giao trong hai ngày tới!</span>
                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Order Date</span> <span>{{ $date_order }}</span> </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Order No</span> <span>%Bankey{{ $phone }}</span> </div>
                                        </td>
                                        <td>
                                            @if($payment=="ATM")
                                            <div class="py-2"> <span class="d-block text-muted">Payment</span> <span><img src="https://img.icons8.com/color/48/000000/mastercard.png" width="20" /></span> </div>
                                            @else
                                            <div class="py-2"> <span class="d-block text-muted">Payment</span> <span><img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/cod-1803616-1530881.png" width="20" /></span> </div>

                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">địa chỉ</span> <span>{{ $address }}</span> </div>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    @foreach ( $carts as $cart )
                                    <tr>
                                        <td width="20%"> <img src="{{asset('/storage/images/'.$cart->options->image)}}" width="90"> </td>
                                        <td width="60%"> <span class="font-weight-bold">{{ $cart->name }}</span>
                                            <div class="product-qty"> <span class="d-block">Quantity:{{ $cart->qty }}</span> </div>
                                        </td>
                                        <td width="20%">
                                            <div class="text-right"> <span class="font-weight-bold">{{ $cart->price }}</span> </div>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <tbody class="totals">
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">tổng tiền </span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>{{ $total }} vnd</span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Shipping Fee</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>0 vnd</span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Tax Fee</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>0 vnd</span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Discount</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span class="text-success">0 vnd</span> </div>
                                            </td>
                                        </tr>
                                        <tr class="border-top border-bottom">
                                            <td>
                                                <div class="text-left"> <span class="font-weight-bold">Subtotal</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span class="font-weight-bold">{{ $total }}</span> </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <p>Chúng tôi sẽ gửi email xác nhận vận chuyển khi hàng được vận chuyển thành công!</p>
                        <p class="font-weight-bold mb-0">Cảm ơn đã đi mua sắm cùng chúng tôi!</p> <span>amato Team</span>
                    </div>
                    <div class="d-flex justify-content-between footer p-3"> <span>Cần giúp đỡ?ghé thăm của chúng tôi <a href="#"> Trung tâm trợ giúp</a></span> <span>12 June, 2020</span> </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>
