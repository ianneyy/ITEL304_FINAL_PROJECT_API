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



    @yield('content')
<script>
         
     var pusher = new Pusher('d4c2a81ab1c73989e152', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('reservation');
    channel.bind('student-reservation', function(data) {
        
    document.getElementById('reservation-badge').style.display = 'inline-block';
    localStorage.setItem('reservationBadgeVisible', 'true');
     
    });
    if (localStorage.getItem('reservationBadgeVisible') === 'true') {
    document.getElementById('reservation-badge').style.display = 'inline-block';
    } else {
        document.getElementById('reservation-badge').style.display = 'none';
    }

    // Reset badge on click
    document.getElementById('reservations-link').addEventListener('click', () => {
        document.getElementById('reservation-badge').style.display = 'none';
        localStorage.setItem('reservationBadgeVisible', 'false');
    });
    </script>
</body>

</html>