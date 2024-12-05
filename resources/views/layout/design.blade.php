<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uniforms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/size_guide.css') }}">
    <link rel="stylesheet" href="{{ asset('css/announcement.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/help.css') }}">
    <link rel="stylesheet" href="{{ asset('../css/view_details.css') }}">
    <link rel="stylesheet" href="{{ asset('../css/message.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300..700&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="p-4">
        <div class="logo-title">
            <img src="../img/lspu_logo.png" alt="">
            <h3>Business Affair Office</h3>
        </div>
        <ul>

            
            <li>

                <div id="wishlist">
                    <svg class="wishlist-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                        <path fill="#000" fill-rule="evenodd" d="M8.753 2.247L8 3l-.753-.753A4.243 4.243 0 0 0 1.25 8.25l5.69 5.69L8 15l1.06-1.06l5.69-5.69a4.243 4.243 0 0 0-5.997-6.003M8 12.879l5.69-5.69a2.743 2.743 0 0 0-3.877-3.881l-.752.753L8 5.12L6.94 4.06l-.753-.752v-.001A2.743 2.743 0 0 0 2.31 7.189L8 12.88Z" clip-rule="evenodd" />
                    </svg>
                </div>

            </li>
            <li>

                <div id="cart">
                    <svg class="cart-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4a2 2 0 0 0 0-4m8 0a2 2 0 1 0 0 4a2 2 0 0 0 0-4m-8.5-3h9.25L19 7H7.312" />
                    </svg>
                </div>

            </li>

            <li>
                @if(auth('student')->check())
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <form method="POST" action="{{ route('student.logout') }}">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ route('student.user-login') }}" class="btn">Login</a>
                @endif
            </li>

        </ul>
    </nav>
    <form action="{{ url('continue-fill-up')}}" method="post">
        @csrf
        <div class="cart-popup">
            <div class="cart-items">
                <h5 class="cart-head mb-2 mt-2">Cart</h5>
                <hr>

                @forelse($cartData as $cart)

                <div class="item-container mb-3">
                    <div class="item-card">

                        <div class="cbx-img">
                            <div class="checkbox-wrapper-4">
                                <input class="inp-cbx" id="morning{{$cart->id}}" type="checkbox" data-price="{{$cart->price}}" data-name="{{$cart->name}}" data-id="{{$cart->id}}" data-image="{{$cart->image_url}}" data-variation="{{$cart->variation_type}}" data-size="{{$cart->size}}" />
                                <label class="cbx" for="morning{{$cart->id}}"><span>
                                        <svg width="12px" height="10px">
                                            <use xlink:href="#check-4"></use>
                                        </svg></span>
                                </label>
                                <svg class="inline-svg">
                                    <symbol id="check-4" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </symbol>
                                </svg>
                            </div>
                            <div class="cart-img">
                                <img src="../{{$cart->image_url}}" alt="">
                            </div>
                        </div>
                        <div class="prdct-info">
                            <h5>{{$cart->name}}</h5>
                            <p>{{$cart->size}} - {{$cart->variation_type}}</p>
                            <p class="p">P{{$cart->price}}</p>
                        </div>
                        <div class="qty-edit">
                            <div class="edit">
                                <p class="edit-btn">Edit</p>
                            </div>
                            <div class="qty">
                                <span class="minus1">-</span>
                                <!-- <span class="num" name="qty">01</span> -->
                                <input type="number" id="qty{{$cart->id}}" name="qty" class="num1" value="{{$cart->qty}}">
                                <span class="plus1">+</span>

                            </div>
                        </div>
                    </div>

                    <div class="delete-btn">
                        <a href="{{url('delete-cart/' . $cart->id)}}" style="text-decoration:none; display:flex; flex-direction: column; align-items:center;">
                            <i class="fa-solid fa-trash"></i>
                            <p>Delete</p>
                        </a>
                    </div>
                </div>
                @empty
                <div class="empty-state" style="width: 400px; display:flex; flex-direction:column; align-items: center; justify-content: center;">
                    <img src="../img/empty_cart.svg" alt="" style="height: 100px;">
                    <p style="color: #555;">Your cart is empty.</p>
                </div>
                @endforelse

            </div>


            <div class="cart-bottom">

                <hr class="hr-bottom">
                <div class="amount">
                    <p>Total Amount</p>
                    <h5 id="totalAmount"></h5>
                    <input type="hidden" name="total_price" id="total_price" value="">
                    <input type="hidden" name="selected_items" id="selected_items" value="">
                </div>
                <div class="cart-btn">
                    <a href="" class="btn btn-link text-muted">
                        <i class="mdi mdi-arrow-left me-1"></i> Go Back </a>
                    <button class="cart-rsv" name="action" value="reserve_now">CHECKOUT</button>
                </div>
            </div>

        </div>
    </form>
    <div class="wishlist-popup">
        <div class="wishlist-items">
            <h5 class="cart-head mb-2 mt-2">Wishlist</h5>
            <hr>
            @forelse($wishlistData as $wishlist)
            <div class="wishlist-item-container mb-3">
                <div class="wishlist-item-card">
                    <div class="cbx-img">

                        <div class="cart-img">
                            <img src="../{{$wishlist->image_url}}" alt="">
                        </div>
                    </div>
                    <div class="prdct-info">
                        <h5>{{$wishlist->name}}</h5>
                        <p>{{$wishlist->size}} - {{$wishlist->variation_type}}</p>

                    </div>

                    <div class="edit">
                        <p class="wishlist-edit-btn">Edit</p>
                    </div>


                </div>
                <div class="wishlist-delete-btn">
                    <a href="{{url('delete-wishlist/' . $wishlist->id)}}" style="text-decoration:none; display:flex; flex-direction: column; align-items:center;">
                        <i class="fa-solid fa-trash"></i>
                        <p>Delete</p>
                    </a>
                </div>
            </div>
            @empty
            <div class="empty-state" style="width: 400px; display:flex; flex-direction:column; align-items: center; justify-content: center;">
                <img src="../img/empty_cart.svg" alt="" style="height: 100px;">
                <p style="color: #555;">Your wishlist is empty.</p>
            </div>
            @endforelse
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.1/echo.iife.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
         
    const echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ env('PUSHER_APP_KEY') }}',
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        forceTLS: true,
    });

    // Listen for new reservations
    echo.channel('reservations')
        .listen('NewPendingReservation', (data) => {
            document.getElementById('reservation-badge').style.display = 'inline-block';
        });

    // Reset badge on click
    document.getElementById('reservations-link').addEventListener('click', () => {
        document.getElementById('reservation-badge').style.display = 'none';
    });
    </script>
    @yield('content')


    <script>
        // function changeCartBorderColor() {
        //     const cart = document.getElementById('cart');

        //     cart.classList.toggle('border-bottom-active');
        // }
        document.getElementById("cart").addEventListener("click", function() {
            var cartPopup = document.querySelector(".cart-popup");
            cartPopup.classList.toggle("show");
            const cart = document.getElementById('cart');

            cart.classList.toggle('border-bottom-active');
        });

        document.getElementById("wishlist").addEventListener("click", function() {
            var wishlistPopup = document.querySelector(".wishlist-popup");
            wishlistPopup.classList.toggle("show");
            const wishlist = document.getElementById('wishlist');

            wishlist.classList.toggle('border-bottom-active');
        });
        const cartEditButtons = document.querySelectorAll('.edit-btn'); // Select all "Edit" buttons
        const wishlistEditButtons = document.querySelectorAll('.wishlist-edit-btn');
        // Loop through each button and add a click event listener

        cartEditButtons.forEach((btn) => {
            btn.addEventListener('click', function() {
                const container = this.closest('.item-container'); // Find the closest cart item container
                container.classList.toggle('edit-mode'); // Toggle the 'edit-mode' class
            });
        });

        // Add event listeners for wishlist edit buttons
        wishlistEditButtons.forEach((btn) => {
            btn.addEventListener('click', function() {
                const wishlistContainer = this.closest('.wishlist-item-container'); // Find the closest wishlist item container
                wishlistContainer.classList.toggle('wishlist-edit-mode'); // Toggle the 'wishlist-edit-mode' class
            });
        });
        window.addEventListener("click", function(e) {
            if (!document.querySelector(".cart-popup").contains(e.target) && !document.getElementById("cart").contains(e.target)) {
                const cart = document.getElementById('cart');

                // Only remove the border if it's currently applied
                if (cart.classList.contains('border-bottom-active')) {
                    cart.classList.remove('border-bottom-active');
                }
                document.querySelector(".cart-popup").classList.remove("show");
            }
            if (
                !document.querySelector(".wishlist-popup").contains(e.target) &&
                !document.getElementById("wishlist").contains(e.target)
            ) {
                const wishlist = document.getElementById("wishlist");

                // Only remove the border if it's currently applied
                if (wishlist.classList.contains("border-bottom-active")) {
                    wishlist.classList.remove("border-bottom-active");
                }
                document.querySelector(".wishlist-popup").classList.remove("show");
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const plus = document.querySelector(".plus1"),
                minus = document.querySelector(".minus1"),
                num = document.querySelector(".num1");
            let a = 1;
            plus.addEventListener("click", () => {
                a++;
                a = a < 10 ? "0" + a : a;
                num.value = a;
            });

            minus.addEventListener("click", () => {
                if (a > 1) {
                    a--;
                    a = a < 10 ? "0" + a : a;
                    num.value = a;
                }
            });



            // const wishlistEditButtons = document.querySelectorAll('.wishlist-item-container .wishlist-edit-btn');

            // // Loop through each button and add a click event listener
            // wishlistEditButtons.forEach((btn, index) => {
            //     btn.addEventListener('click', function() {
            //         console.log('tite');
            //         const container = this.closest('.wishlist-item-container');
            //         container.classList.toggle('wishlist-edit-mode');
            //     });
            // });



            // Optionally, you can add an event to close the popup when clicking outside of it

            document.querySelectorAll('.inp-cbx').forEach(checkbox => {
                checkbox.addEventListener('change', updateTotalAmount);
            });


            function updateTotalAmount() {
                let totalAmount = 0;
                let selectedItems = [];

                // Loop through all checkboxes and add the price of the selected ones
                document.querySelectorAll('.inp-cbx:checked').forEach(checkbox => {

                    const price = parseFloat(checkbox.getAttribute('data-price')); // Get the price
                    const id = checkbox.getAttribute('data-id'); // Get the item ID


                    // Fetch the correct quantity input for each item
                    const qtyElement = document.querySelector(`#qty${id}`);

                    const qty = qtyElement ? parseInt(qtyElement.value) : 1; // Get quantity, default to 1 if not found
                    const subTotal = price * qty;
                    totalAmount += price * qty;


                    const item = {
                        id: id,
                        name: checkbox.getAttribute('data-name'),
                        price: price,
                        subTotal: subTotal,
                        image_url: checkbox.getAttribute('data-image'),
                        variation_type: checkbox.getAttribute('data-variation'),
                        size: checkbox.getAttribute('data-size'),
                        qty: qty
                    };
                    selectedItems.push(item);
                });

                console.log("Total Amount:", totalAmount);
                // Update the total amount on the page
                document.getElementById('totalAmount').textContent = 'P ' + totalAmount.toFixed(2);
                document.getElementById('total_price').value = totalAmount.toFixed(2);

                document.getElementById('selected_items').value = JSON.stringify(selectedItems);
            }

        });
    </script>
</body>


</html>