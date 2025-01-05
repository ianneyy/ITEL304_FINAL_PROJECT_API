<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/fill_up_form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</head>

<body>


    <div class="container">
        <form action="{{ route('reservation.add')}}" method="post">
            @csrf
            @foreach ( $getCartId as $cart )
            <input type="hidden" name="cart_id" value="{{$cart->cart_id}}">

            @endforeach
            <div class="row">
                @forelse($data as $d)
                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body">
                            <ol class="activity-checkout mb-0 px-4 mt-3">
                                <li class="checkout-item">
                                    <div class="avatar checkout-icon p-1">
                                        <div class="avatar-title rounded-circle">
                                            <i class="bx bxs-receipt text-white font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="feed-item-list">
                                        <div>
                                            <h5 class="font-size-16 mb-1">Personal Info</h5>
                                            <p class="text-muted text-truncate mb-4">Please enter your personal details</p>
                                            <div class="mb-3">
                                                <form>
                                                    <div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="billing-name">Name</label>
                                                                    <input type="text" name="full_name" class="form-control" id="billing-name" placeholder="Enter name" value="{{ $d->full_name}} " required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">

                                                                    <label class="form-label" for="billing-email-address">Email Address</label>
                                                                    <input type="email" name="email" class="form-control" id="billing-email-address" placeholder="Enter email" value="{{ $d->email}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="billing-phone">Phone <span style="color: #5b5b5b">(Optional)</span></label>
                                                                    <input type="text" name="contact_number" class="form-control" id="billing-phone" placeholder="Enter Phone no." value="{{ $d->contact_number}}">
                                                                </div>
                                                            </div>
                                                        </div>




                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="checkout-item">
                                    <div class="avatar checkout-icon p-1">
                                        <div class="avatar-title rounded-circle">
                                            <i class="fa-regular fa-calendar text-white font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="feed-item-list">
                                        <div>
                                            <h5 class="font-size-16 mb-1">Schedule pick-up</h5>
                                            <p class="text-muted text-truncate mb-4">Please select a date</p>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-6">

                                                        <input type="date"
                                                            id="start"
                                                            class="form-control"
                                                            name="reservation_date"
                                                            placeholder="MM/DD/YYYY"
                                                            onfocus="(this.type='date')"
                                                            min="{{$minDateFormatted}}"
                                                            max="{{$maxDateFormatted}}"
                                                            required>
                                                        


                                                    </div>

                                                    <div class="col-lg-4 col-sm-6">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="checkout-item">
                                    <div class="avatar checkout-icon p-1">
                                        <div class="avatar-title rounded-circle">
                                            <i class="fa-regular fa-calendar text-white font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="feed-item-list">
                                        <div>
                                            <h5 class="font-size-16 mb-1">Payment Info</h5>
                                           
                                        </div>
                                        <div>
                                          
                                            <div class="row">


                                            

                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <label class="card-radio-label">
                                                            <input type="radio" name="pay_method" value="Over the counter" id="pay-methodoption3" class="card-radio-input" checked="">

                                                            <span class="card-radio py-3 text-center text-truncate">
                                                                <i class="fa-solid fa-cash-register d-block h2 mb-3"></i>
                                                                <span>Over the counter</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col go-back">
                            <a href="{{url('continue-shopping/' . $d->id )}}" class="btn btn-link text-muted">
                                <i class="mdi mdi-arrow-left me-1"></i> Go Back </a>
                        </div> <!-- end col -->
                        <div class="col">
                            <div class="text-end mt-2 mt-sm-0">
                                <!-- <a href="#" class="proceed-btn" style="background-color: #FFBD2E">
                                <i class="mdi mdi-cart-outline me-1"></i> Proceed </a> -->
                                <button onclick="proceedPayment()" class="proceed-btn" style="">Proceed</button>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div>
                @empty
                <p>No products available.</p>

                <!-- end row -->
                @endforelse
                <div class="col-xl-4">
                    <div class="card checkout-order-summary">
                        <div class="card-body">
                            <div class="p-3 bg-light mb-3">
                                <h5 class="font-size-16 mb-0">Order Summary</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-centered mb-0 table-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0" style="width: 110px;" scope="col">Product</th>
                                            <th class="border-top-0" scope="col">Product Desc</th>
                                            <th class="border-top-0" scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($getOrderId as $index => $order)
                                        <tr>
                                            <th scope="row"><img src="{{$order->image_url}}" alt="product-img" title="product-img" class="avatar-lg rounded"></th>
                                            <td>
                                                <h5 class="font-size-16 text-truncate"><a href="#" class="text-dark">{{$order->name}}</a></h5>
                                                <p class="font-size-16 text-truncate">{{$order->size}} - {{$order->variation_type}}</p>

                                                <input type="hidden" name="orders[{{ $index }}][name]" value="{{$order->name}}">
                                                <p class="text-muted mb-0 mt-1">&#8369;{{$order->price}} x {{$order->qty}}</p>


                                                <input type="hidden" name="orders[{{ $index }}][qty]" value="{{$order->qty}}">
                                                <input type="hidden" name="order_id" value="{{$order->order_id}}">
                                                <input type="hidden" name="orders[{{ $index }}][department]" value="{{$order->variation_type}}">
                                                <input type="hidden" name="orders[{{ $index }}][size]" value="{{$order->size}}">


                                            </td>
                                            <td>&#8369;{{$order->subTotal}}</td>
                                            <input type="hidden" name=" orders[{{ $index }}][subTotal]" value="{{$order->subTotal}}">

                                        </tr>
                                        @empty
                                        <p>No products available.</p>

                                        <!-- end row -->
                                        @endforelse





                                        <tr class="bg-light">
                                            <td colspan="2">
                                                <h5 class="font-size-14 m-0">Total:</h5>

                                            </td>
                                            <td>
                                                &#8369;{{$order->total_price}}
                                                <input type="hidden" name="total_price" value="{{$order->total_price}}">

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </div>
    <div id="pop">
        <div class="payment-loader" id="payment-loader">
            <div class="pad">
                <div class="chip"></div>
                <div class="line line1"></div>
                <div class="line line2"></div>
            </div>
            <div class="loader-text">Please wait while processing</div>
        </div>
    </div>
</body>
<script>
    function proceedPayment() {
        // Show the loading overlay

        document.getElementById("pop").style.display = "block";

    }
</script>

</html>