<div>

    @php
    $settings = App\Models\Setting::first(); // Truy vấn model Settings
    @endphp





    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Thanh toán hoá đơn</title>
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="/pay/public/faces/javax.faces.resource/material/css/bootstrap.min.css" />
        <!-- Google fonts - Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700" />
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="/pay/public/faces/javax.faces.resource/material/css/style.default.css"
            id="theme-stylesheet" />
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="/pay/public/faces/javax.faces.resource/material/css/style-version=1.0.css" />
        <link rel="stylesheet" href="/pay/public/faces/javax.faces.resource/material/css/qr-code.css" />
        <link rel="stylesheet" href="/pay/public/faces/javax.faces.resource/material/css/qr-code-tablet.css" />
        <!-- Font Awesome CDN-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Cute Alert -->
        <link class="main-stylesheet" href="/pay/public/cute-alert/style.css" rel="stylesheet" type="text/css">
        <script src="/pay/public/cute-alert/cute-alert.js"></script>
        <!-- jQuery -->
        <script src="/pay/public/js/jquery-3.6.0.js"></script>
        <style type="text/css">
            .container-fluid {
                width: 40% !important;
                min-width: 750px !important;
            }

            .info-box {
                min-height: 600px;
            }

            .entry {
                border-bottom: 1px solid #424242;
            }

            .left {
                background-color: #262626;
            }

            .receipt {
                border-bottom: 1px solid #424242
            }
        </style>
    </head>

    <body>

        <div id="page">
            <nav class="navbar navbar-default hidden-xs">
                <div class="container-fluid" style="padding: 1px;padding: 1px;width: 45%;min-width: 800px;">
                    <div class="navbar-header" style="position: relative">

                    </div>
                </div>

            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 left">
                        <div class="info-box">
                            <div class="receipt">
                                <img src="{{ Storage::url($settings->logo)}}" width="100%" />
                            </div>
                            <div class="entry">
                                <p><i class="fa fa-university" aria-hidden="true"></i>
                                    <span style="padding-left: 5px;">Ngân hàng</span>
                                    <br />
                                    <span style="padding-left: 25px;word-break: keep-all;">MBBANK</span>
                                </p>
                            </div>
                            <div class="entry">
                                <p><i class="fa fa-credit-card" aria-hidden="true"></i>
                                    <span style="padding-left: 5px;">Số tài khoản</span>
                                    <br />
                                    <b id="copyStk"
                                        style="padding-left: 25px;word-break: keep-all;color:greenyellow;">0355198659</b>
                                    <i onclick="copy()" data-clipboard-target="#copyStk" class="fas fa-copy copy"></i>
                                </p>
                            </div>
                            <div class="entry">
                                <p><i class="fa fa-user" aria-hidden="true"></i>
                                    <span style="padding-left: 5px;">Chủ tài khoản</span>
                                    <br />
                                    <span style="padding-left: 25px;word-break: keep-all;">BUI QUANG HUY</span>
                                </p>
                            </div>
                            <div class="entry">
                                <p><i class="fa fa-money" aria-hidden="true"></i>
                                    <span style="padding-left: 5px;">Số tiền cần thanh toán</span>
                                    <br />
                                    @if($order->payment_method == 'bank')
                                    <b style="padding-left: 25px;color:aqua;"> {{
                                        number_format($order->grand_total + $order->shipping_amount, 0, ',', '.')
                                        }}đ</b>
                                    @else
                                    <b style="padding-left: 25px;color:aqua;"> {{
                                        number_format($order->deposit_amount, 0, ',', '.')
                                        }}đ</b>
                                    @endif
                                </p>
                            </div>
                            <div class="entry">
                                <p><i class="fa fa-comment" aria-hidden="true"></i>
                                    <span style="padding-left: 5px;">Nội dung chuyển khoản</span>
                                    <br />
                                    <b id="copyNoiDung" style="padding-left: 25px;word-break: keep-all;color:yellow;">{{
                                        $order->order_code }}</b>
                                    <i onclick="copy()" data-clipboard-target="#copyNoiDung"
                                        class="fas fa-copy copy"></i>
                                </p>
                            </div>
                            @if ($order->payment_method == 'cod')
                            <div class="entry">
                                <p>
                                    <i class="fa fa-barcode" aria-hidden="true"></i>
                                    <span style="padding-left: 5px;">Trạng thái</span>
                                    <br />
                                    @if($order->deposit_status === 'pending')
                                    <i class="fa fa-spinner fa-spin"></i>
                                    <span id="status_payment" style="padding-left: 25px; word-break: break-all;">Đang
                                        chờ thanh toán...</span>
                                    @elseif($order->deposit_status === 'paid')
                                    <i class="fa fa-check-circle" style="color: green;"></i>
                                    <span id="status_payment" style="padding-left: 25px; word-break: break-all;">Đã
                                        thanh toán</span>
                                    @elseif($order->deposit_status === 'failed')
                                    <i class="fa fa-times-circle" style="color: red;"></i>
                                    <span id="status_payment" style="padding-left: 25px; word-break: break-all;">Thanh
                                        toán thất bại</span>
                                    @else
                                    <span id="status_payment" style="padding-left: 25px; word-break: break-all;">Trạng
                                        thái không xác định</span>
                                    @endif
                                </p>
                            </div>
                            @else
                            <div class="entry">
                                <p>
                                    <i class="fa fa-barcode" aria-hidden="true"></i>
                                    <span style="padding-left: 5px;">Trạng thái</span>
                                    <br />
                                    @if($order->payment_status === 'pending')
                                    <i class="fa fa-spinner fa-spin"></i>
                                    <span id="status_payment" style="padding-left: 25px; word-break: break-all;">Đang
                                        chờ thanh toán...</span>
                                    @elseif($order->payment_status === 'paid')
                                    <i class="fa fa-check-circle" style="color: green;"></i>
                                    <span id="status_payment" style="padding-left: 25px; word-break: break-all;">Đã
                                        thanh toán</span>
                                    @elseif($order->payment_status === 'failed')
                                    <i class="fa fa-times-circle" style="color: red;"></i>
                                    <span id="status_payment" style="padding-left: 25px; word-break: break-all;">Thanh
                                        toán thất bại</span>
                                    @else
                                    <span id="status_payment" style="padding-left: 25px; word-break: break-all;">Trạng
                                        thái không xác định</span>
                                    @endif
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 right">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="message" id="loginForm">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="qr-code">


                                                    <div class="payment-cta">
                                                        <div>
                                                            <h1>Quét mã QR để thanh toán</h1>
                                                        </div>
                                                        <a>Sử dụng <b> App Internet Banking </b> hoặc ứng dụng camera hỗ
                                                            trợ QR code để quét mã</a>
                                                    </div>
                                                    @if($order->payment_method == 'bank')
                                                    <img src="https://api.vietqr.io/MB/0355198659/{{number_format($order->grand_total + $order->shipping_amount, 0, ',', '')}}/{{ $order->order_code }}/vietqr_net_2.jpg?accountName=BUI QUANG HUY"
                                                        width="100%" />
                                                    @else
                                                    <img src="https://api.vietqr.io/MB/0355198659/{{number_format($order->deposit_amount, 0, ',', '')}}/{{ $order->order_code }}/vietqr_net_2.jpg?accountName=BUI QUANG HUY"
                                                        width="100%" />
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid hidden-xs">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="copyrights text-center">
                            <p style="color: #737373;   font-size: 11pt; font-weight: bold;">
                                <br />
                                Vui lòng thanh toán vào thông tin tài khoản trên để hệ thống xử lý hoá đơn tự động.
                            </p>
                            <a href="/pay/client/invoices">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                <span>Quay lại</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript">
            new ClipboardJS(".copy");

    function copy() {
        cuteToast({
            type: "success",
            message: "Đã sao chép vào bộ nhớ tạm",
            timer: 5000
        });
    }
        </script>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script src="https://fastly.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            //             // Enable pusher logging - don't include this in production
//    Pusher.logToConsole = true;

//    var pusher = new Pusher('827c74b29880dbe97c43', {
//      cluster: 'ap1'
//    });

//    var channel = pusher.subscribe('notification');
//    channel.bind('notification.' + {{ Auth::user()->id }}, function(data) {
//     var content = data.invitation_code; // Adjust this field according to the actual structure of data.bank
//     Swal.fire({
//                 icon: 'success', // Change the icon type based on your needs (e.g., 'info', 'warning', 'error')
//                 title: 'Thông báo',
//                 text: 'Thanh toán thành công đơn hàng ' + content + '!',
//                 confirmButtonText: 'OK'
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     window.location.href = '/thanks/{{$order->order_code}}';
//                 }
//             });
//    });
   // Function to make the HTTP request
   function fetchCronData() {
    fetch('/checkpayment/{{$order->order_code}}', {
        method: 'GET', // HTTP method
        headers: {
            'Content-Type': 'application/json' // Optional, depending on your backend requirements
        }
    })
    .then(response => response.json()) // Assuming the response is JSON
    .then(data => {
        // console.log('Data from cron endpoint:', data);
        if(data.payment_status == 'paid'){
            Swal.fire({
                icon: 'success', // Change the icon type based on your needs (e.g., 'info', 'warning', 'error')
                title: 'Thông báo',
                text: 'Thanh toán thành công đơn hàng ' + data.invitation_code + '!',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/thanks/{{$order->order_code}}';
                }
            });
        }else{
            fetchCronData();
        }

    })
    .catch(error => {
        console.error('Error fetching data:', error);

        // Handle errors if needed, continue fetching in case of failure
        fetchCronData();
    });
}

// Call fetchCronData once to start the process
fetchCronData();


function fetchCronTransactions() {
    fetch('/transactions', {
        method: 'GET', // HTTP method
        headers: {
            'Content-Type': 'application/json' // Optional, depending on your backend requirements
        }
    })
    .then(response => response.json()) // Assuming the response is JSON
    .then(data => {
        fetchCronTransactions();

    })
    .catch(error => {
        fetchCronTransactions();
    });
}

// Call fetchCronData once to start the process
fetchCronTransactions();

        </script>
    </body>


</div>
