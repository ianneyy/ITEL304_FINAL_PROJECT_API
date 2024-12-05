@extends('layout.admin_design')

@section('content')
<style>
    #nav-content-highlight {
        position: absolute;
        left: 10px;
        right: 10px;
        top: 74px;
        width: calc(100% - 16px);
        height: 54px;
        background-color: #636363;
        background-attachment: fixed;
        border-radius: 10px 10px 10px 10px;
        transition: top 0.2s;
        border: 1px solid #7b7b7b;
    }

    .container {
        position: absolute;
        background-color: var(--navbar-dark-secondary);
        top: 20px;
        left: var(--navbar-width);
        height: auto;

        /* Adjust left based on sidebar width */
        transition: width 0.3s ease, left 0.3s ease;
        /* Smooth transition */
        margin-left: 50px;
        font-family: "Signika", sans-serif;
    }

    .container.navbar-closed {
        width: 88vw;
        /* Adjusted width when navbar is closed */
        left: 0;
        /* Align left to the edge */
    }

    button {
        padding-left: 30px;
        padding-right: 30px;
        padding-top: 10px;
        padding-bottom: 10px;


    }

    .invent {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    td,
    th {
        border: none;

        text-align: center;
    }

    .container table th {
        text-align: center;

        /* Horizontally center the content */
        vertical-align: middle;

        /* Vertically center the content */
    }

    .container table {
        border-collapse: collapse;

        margin-bottom: 20px;
    }

    .container table th {
        background-color: var(--navbar-dark-primary);

        color: var(--navbar-light-secondary);
    }

    .action {
        display: flex;
        justify-content: space-between;


    }

    td:last-child {
        width: 190px;
    }

    a {
        text-decoration: none;
    }

    .container table tbody td {
        background-color: var(--navbar-dark-secondary);
        color: var(--navbar-light-primary);

    }



    .ed {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px 5px 10px;
        background-color: #ececec;
        border-radius: 5px;
    }

    .edit {
        margin-right: 5px;
    }

    .add {
        padding: 5px 25px 5px 25px;
        text-align: center;
        margin-bottom: 20px;
        margin-top: 20px;
        background-color: #ffbd2e;
        color: #fefefe;
        border-radius: 5px;
    }

    .invent h5 {
        color: var(--navbar-light-primary);
    }

    #pendingReservations_length {
        color: var(--navbar-light-secondary);
        margin-bottom: 20px;
    }

    #pendingReservations_length select option {
        background-color: var(--navbar-dark-secondary);
        color: var(--navbar-light-primary);
    }

    #pendingReservations_length select {
        background-color: var(--navbar-dark-secondary);
        color: var(--navbar-light-primary);
    }

    #pendingReservations_filter {
        color: var(--navbar-light-secondary);
    }

    #pendingReservations_info {
        color: var(--navbar-light-secondary);
    }

    #pendingReservations_paginate {
        color: #fefefe;
    }



    #completedReservations_length {
        color: var(--navbar-light-secondary);
    }

    #completedReservations_length select option {
        background-color: var(--navbar-dark-secondary);
        color: var(--navbar-light-primary);

    }

    #completedReservations_length select {
        background-color: var(--navbar-dark-secondary);
        color: var(--navbar-light-primary);
    }

    #completedReservations_filter {
        color: var(--navbar-light-secondary);
    }

    #completedReservations_info {
        color: var(--navbar-light-secondary);
    }

    #completedReservations_paginate {
        color: #fefefe;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<!-- <link href="../DataTables/datatables.min.css" rel="stylesheet"> -->
<div id="nav-bar">
    <input id="nav-toggle" type="checkbox" />
    <div id="nav-header"><a id="nav-title" target="_blank">ADMIN</a>
        <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
        <hr />
    </div>
    <div id="nav-content">
        <div class="nav-button">
            <a href="{{ url('dashboard') }}" style="text-decoration: none; color: inherit;">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="none" stroke="#ffbd2e" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1m0 12h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1m10-4h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-6a1 1 0 0 1 1-1m0-8h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1" />
                </svg><span>Dashboard</span></a>
        </div>

        <div class="nav-button">
            <a href="{{ url('admin_reservation') }}" style="text-decoration: none; color: inherit;">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.5 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6M16 3v4M8 3v4m-4 4h16m-5 8l2 2l4-4" />
                </svg></i><span style="color: #FFBD2E;">Reservations</span><span id="reservation-badge" class="badge bg-warning text-dark" style="display: none;">New</span>
            </a>
        </div>

        <div class="nav-button"><a href="{{ url('inventory') }}" style="text-decoration: none; color: inherit;">

                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="#ffbd2e" d="M20 2H4c-1 0-2 .9-2 2v3.01c0 .72.43 1.34 1 1.69V20c0 1.1 1.1 2 2 2h14c.9 0 2-.9 2-2V8.7c.57-.35 1-.97 1-1.69V4c0-1.1-1-2-2-2m-1 18H5V9h14zm1-13H4V4h16z" />
                    <path fill="#ffbd2e" d="M9 12h6v2H9z" />
                </svg><span>Inventory</span></a>
        </div>
        <div class="nav-button"><a href="{{ url('wishlist') }}" style="text-decoration: none; color: inherit;">

                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="none" stroke="#ffbd2e" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.071 13.142L13.414 18.8a2 2 0 0 1-2.828 0l-5.657-5.657A5 5 0 1 1 12 6.072a5 5 0 0 1 7.071 7.07" />
                </svg>
                </svg><span>Wishlist</span></a>
        </div>
        <div class="nav-button"><a href="{{ url('announcement') }}" style="text-decoration: none; color: inherit;">

                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <g fill="none" fill-rule="evenodd">
                        <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                        <path fill="#FFBD2E" d="M19 4.741V8a3 3 0 1 1 0 6v3c0 1.648-1.881 2.589-3.2 1.6l-2.06-1.546A8.66 8.66 0 0 0 10 15.446v2.844a2.71 2.71 0 0 1-5.316.744l-1.57-5.496a4.7 4.7 0 0 1 3.326-7.73l3.018-.168a9.34 9.34 0 0 0 4.19-1.259l2.344-1.368C17.326 2.236 19 3.197 19 4.741M5.634 15.078l.973 3.407A.71.71 0 0 0 8 18.29v-3.01l-1.56-.087a5 5 0 0 1-.806-.115M17 4.741L14.655 6.11A11.3 11.3 0 0 1 10 7.604v5.819c1.787.246 3.488.943 4.94 2.031L17 17zM8 7.724l-1.45.08a2.7 2.7 0 0 0-.17 5.377l.17.015l1.45.08zM19 10v2a1 1 0 0 0 .117-1.993z" />
                    </g>
                </svg><span>Announcement</span></a>
        </div>
        <div class="nav-button"><a href="{{ url('messages') }}" style="text-decoration: none; color: inherit;">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 512 512">
                    <path fill="#ffbd2e" d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16v288c0 8.8 7.2 16 16 16zm48 124l-.2.2l-5.1 3.8l-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3v-80H64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0h384c35.3 0 64 28.7 64 64v288c0 35.3-28.7 64-64 64H309.3z" />
                </svg><span>Messages</span></a>
        </div>


        <div class="nav-button"><a href="{{  url('qrcode-scanner') }}" style="text-decoration: none; color: inherit;">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="#ffbd2e" d="M4 4h4.01V2H2v6h2zm0 12H2v6h6.01v-2H4zm16 4h-4v2h6v-6h-2zM16 4h4v4h2V2h-6z" />
                    <path fill="#ffbd2e" d="M5 11h6V5H5zm2-4h2v2H7zM5 19h6v-6H5zm2-4h2v2H7zM19 5h-6v6h6zm-2 4h-2V7h2zm-3.99 4h2v2h-2zm2 2h2v2h-2zm2 2h2v2h-2zm0-4h2v2h-2z" />
                </svg><span>QR Scanner</span></a>
        </div>

        <div id="nav-content-highlight"></div>
    </div>
    <div class="nav-button" style="position: absolute; bottom: 1px; width: 100%; text-align: center; display: flex; align-items: center; justify-content: center;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background: none; border: none; color: #FFBD2E; cursor: pointer; font-size: 16px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="#d39817" d="M5 11h8v2H5v3l-5-4l5-4zm-1 7h2.708a8 8 0 1 0 0-12H4a9.99 9.99 0 0 1 8-4c5.523 0 10 4.477 10 10s-4.477 10-10 10a9.99 9.99 0 0 1-8-4" />
                </svg><span>Logout</span>

            </button>
        </form>
    </div>

</div>
</div>
<div class="container p-5 col-xl-9">
    <div class="invent">
        <h5 class="mb-5" style="color:#FFBD2E">Pending Reservation</h5>


    </div>
    <table class="table" id="pendingReservations">
        <thead>
            <tr>
                <th style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">#</th>
                <th>Student Name</th>
                <th>Email</th>
                <th>Uniform Type</th>
                <th>Variation</th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Reservation Date</th>
                <th>Status</th>
                <th style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $d)
            <tr>
                <td>{{ $d->id }}</td>
                <td>{{ $d->full_name }}</td>
                <td>{{ $d->email }}</td>
                <td>{{ $d->name }}</td>
                <td>{{ $d->department }}</td>
                <td>{{ $d->size }}</td>
                <td>{{ $d->total_price }}</td>
                <td>{{ $d->qty }}</td>
                <td>{{ $d->reservation_date}}</td>
                <td>{{ $d->status}}</td>
                <td style=" width:80px;">
                    <div class="action" style=" width:60px;">
                        <div class="ed px-3" style="background-color: #ffd37b"><a href="{{ url('paid-reservation/' .$d->id)}}" style="color: #936d1b;">Paid</a></div>
                    </div>
                </td>
            </tr>
            @empty
            <table class="no-data" style="display: flex; justify-content: center; align-items: center;">
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                        <img src="../img/no_data.svg" alt="No Data" class="nodata-image" style="max-width: 100px; height: auto; margin-top: 50px;">
                        <p style="margin-top: 10px; color: #888;">No pending reservation.</p>
                    </td>
                </tr>
            </table>

            @endforelse
        </tbody>
    </table>
    <div class="invent">
        <h5 class="my-4" style="color:#FFBD2E">Completed Reservation</h5>


    </div>
    <table class="table my-8" id="completedReservations">
        <thead>
            <tr>
                <th style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">Student Name</th>
                <th>Email</th>
                <th>Uniform Type</th>
                <th>Variation</th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Reservation Date</th>
                <th style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($completedData as $completed)
            <tr>
                <td>{{ $completed->full_name }}</td>
                <td>{{ $completed->email }}</td>
                <td>{{ $completed->name }}</td>
                <td>{{ $completed->department }}</td>
                <td>{{ $completed->size }}</td>
                <td>{{ $completed->total_price }}</td>
                <td>{{ $completed->qty }}</td>
                <td>{{ $completed->reservation_date}}</td>
                <td style=" width:80px;">{{ $completed->status }}</td>
            </tr>
            @empty
            <table class="no-data" style="display: flex; justify-content: center; align-items: center;">
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                        <img src="../img/no_data.svg" alt="No Data" class="nodata-image" style="max-width: 100px; height: auto;  margin-top: 50px;">
                        <p style="margin-top: 10px; color: #888;">Empty.</p>
                    </td>
                </tr>
            </table>

            @endforelse
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pendingReservations').DataTable();
        $('#completedReservations').DataTable();
    });
</script>
<script>
    // Get the checkbox and container elements
    const navToggle = document.getElementById('nav-toggle');
    const container = document.querySelector('.container');

    // Add an event listener to detect checkbox state changes
    navToggle.addEventListener('change', () => {
        if (navToggle.checked) {
            // Apply styles when the checkbox is checked
            container.style.position = 'absolute';
            container.style.maxWidth = '100vw';
            container.style.left = 'var(--navbar-width-min)';
            container.classList.add('navbar-closed');

        } else {
            // Reset styles when the checkbox is unchecked
            container.style.position = '';
            container.style.maxWidth = '';
            container.style.left = '';
            container.classList.remove('navbar-closed');
        }
    });
</script>
@endsection