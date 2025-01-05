<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/inventory.css')}}">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="icon" href="{{ asset('img/logo.png') }}" sizes="16x16" type="image/png">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.1/echo.iife.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css')}}"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300..700&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="top-nav p-4">
        <div class="logo-title">
            <div class="logo-img">
                <img src="{{asset('../img/lspu_logo.png')}}" alt="">
            </div>
            <div>Admin</div>
        </div>
       
               
                <label class="popup">
                <input type="checkbox">
                <div class="burger" tabindex="0">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <nav class="popup-window">
                    
                    <ul>
                    <li>
                        
                         <a href="{{ url('announcement') }}" style="text-decoration: none; color: inherit;">

                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                                <g fill="none" fill-rule="evenodd">
                                    <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                    <path fill="#FFBD2E" d="M19 4.741V8a3 3 0 1 1 0 6v3c0 1.648-1.881 2.589-3.2 1.6l-2.06-1.546A8.66 8.66 0 0 0 10 15.446v2.844a2.71 2.71 0 0 1-5.316.744l-1.57-5.496a4.7 4.7 0 0 1 3.326-7.73l3.018-.168a9.34 9.34 0 0 0 4.19-1.259l2.344-1.368C17.326 2.236 19 3.197 19 4.741M5.634 15.078l.973 3.407A.71.71 0 0 0 8 18.29v-3.01l-1.56-.087a5 5 0 0 1-.806-.115M17 4.741L14.655 6.11A11.3 11.3 0 0 1 10 7.604v5.819c1.787.246 3.488.943 4.94 2.031L17 17zM8 7.724l-1.45.08a2.7 2.7 0 0 0-.17 5.377l.17.015l1.45.08zM19 10v2a1 1 0 0 0 .117-1.993z" />
                                </g>
                            </svg>
                        <span>Announcement</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('messages') }}" style="text-decoration: none; color: inherit;">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 512 512">
                    <path fill="#ffbd2e" d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16v288c0 8.8 7.2 16 16 16zm48 124l-.2.2l-5.1 3.8l-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3v-80H64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0h384c35.3 0 64 28.7 64 64v288c0 35.3-28.7 64-64 64H309.3z" />
                </svg> <span>Messages</span></a>
       
                    </li>
                   
                    <li>
                         <a href="{{  url('qrcode-scanner') }}" style="text-decoration: none; color: inherit;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                            <path fill="#ffbd2e" d="M4 4h4.01V2H2v6h2zm0 12H2v6h6.01v-2H4zm16 4h-4v2h6v-6h-2zM16 4h4v4h2V2h-6z" />
                            <path fill="#ffbd2e" d="M5 11h6V5H5zm2-4h2v2H7zM5 19h6v-6H5zm2-4h2v2H7zM19 5h-6v6h6zm-2 4h-2V7h2zm-3.99 4h2v2h-2zm2 2h2v2h-2zm2 2h2v2h-2zm0-4h2v2h-2z" />
                        </svg><span>Qr Code Scanner</span></a>
                    </li>
                     <hr>
                    <li>
                        
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" style="background: none; border: none; color: #FFBD2E; cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                        <path fill="#d39817" d="M5 11h8v2H5v3l-5-4l5-4zm-1 7h2.708a8 8 0 1 0 0-12H4a9.99 9.99 0 0 1 8-4c5.523 0 10 4.477 10 10s-4.477 10-10 10a9.99 9.99 0 0 1-8-4"/>
                                    </svg><span id="footer-logout">Logout</span>

                                </button>
                            </form>
                        
                    </li>
                    </ul>
                </nav>
                </label>
          
    </nav>


    @yield('content')
<script>
         
     var pusher = new Pusher('d4c2a81ab1c73989e152', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('reservation');
    channel.bind('student-reservation', function(data) {
    let badge = document.getElementById('admin-reservation-badge');
    let botbadge = document.getElementById('bot-admin-reservation-badge');

     let currentCount = parseInt(badge.textContent) || 0;
     currentCount++;
      badge.textContent = currentCount; 
      botbadge.textContent = currentCount; 

    badge.style.display = 'inline-block';
    botbadge.style.display = 'inline-block';
    localStorage.setItem('reservationBadgeCount', currentCount);
     
    });

    let storedCount = parseInt(localStorage.getItem('reservationBadgeCount')) || 0;

   if (storedCount > 0) {
    let badge = document.getElementById('admin-reservation-badge');
    let botbadge = document.getElementById('bot-admin-reservation-badge');
     badge.textContent = storedCount;
     botbadge.textContent = storedCount;
   badge.style.display = 'inline-block';
   botbadge.style.display = 'inline-block';

    } 

    // Reset badge on click
   document.getElementById('reservations-link').addEventListener('click', () => {
    document.getElementById('admin-reservation-badge').style.display = 'none';
    document.getElementById('admin-reservation-badge').textContent = 0; 
    localStorage.setItem('reservationBadgeCount', 0); 
});
 document.getElementById('bot-reservations-link').addEventListener('click', () => {
    document.getElementById('bot-admin-reservation-badge').style.display = 'none';
    document.getElementById('bot-admin-reservation-badge').textContent = 0; 
    localStorage.setItem('reservationBadgeCount', 0); 
});
    </script>
</body>

</html>