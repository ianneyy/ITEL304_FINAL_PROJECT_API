@extends('layout.admin_design')

@section('content')
    <style>
        #nav-content-highlight {
            position: absolute;
            left: 10px;
            right: 10px;
            top: 20px;
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
            height: auto;
            width: 79vw;
            top: 20px;
            left: var(--navbar-width);
            /* Adjust left based on sidebar width */
            transition: width 0.3s ease, left 0.3s ease;
            /* Smooth transition */
            margin-left: 20px;
            padding: 20px 20px 70px 20px;

            font-family: "Signika", sans-serif;
        }

        .container.navbar-closed {
            width: 88vw;
            /* Adjusted width when navbar is closed */
            left: 0;
            /* Align left to the edge */
        }

        @media (max-width: 768px) {

            .container {

                top: 70px;
                left: 10px;
                width: 93%;

                margin-left: 0;

            }

            .stat-card {
                padding: 12px;
            }

            .icon-stat {
                height: 35px;
                width: auto;
            }

            .icon-stat svg {
                width: 1.7em;
                height: auto;
            }

            .rsv {
                margin-left: 10px;
            }

            .rsv h4 {
                font-size: .8rem;
            }

            .rsv p {
                font-size: 1rem;
            }

            #daychart {
                height: 100px;
            }

            .chart-box {
                height: 250px;
            }

            .chart-box h5 {
                font-size: .8rem;
            }

            .chart-box h6 {
                font-size: .5rem;
            }

            .recent-activity h5 {
                font-size: 1rem;
            }

            .recent-activity table th,
            .recent-activity table td {
                font-size: .6rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                left: 5px;
                width: 98%;
                padding: 5px;
                margin-left: 0;

            }

            .stat-card {
                border-radius: 6px;
                padding: 10px;
            }

            .icon-stat {
                height: 25px;
                width: auto;
                border-radius: 5px;
            }

            .icon-stat svg {
                width: 1.2em;
                height: auto;
            }

            .rsv {
                margin-left: 5px;
            }

            .rsv h4 {
                font-size: .6rem;
            }

            .rsv p {
                font-size: .8rem;
            }

            .chart-box {
                border-radius: 6px;
                height: 210px;

            }

            .chart-box h5 {
                font-size: .7rem;
            }

            .chart-box h6 {
                font-size: .4.5rem;
            }

            .recent-activity {
                border-radius: 6px;
            }

            .recent-activity h5 {
                font-size: .7rem;
            }

            .recent-activity table th,
            .recent-activity table td {
                font-size: .5.5rem;
            }
        }

        .bot-dashboard {
            border-top: 2px solid #ffbd2e;

        }
    </style>


    <div id="nav-bar">
        <input id="nav-toggle" type="checkbox" />
        <div id="nav-header"><a id="nav-title" target="_blank">ADMIN</a>
            <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
            <hr />
        </div>
        <div id="nav-content">
            <div class="nav-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="none" stroke="#ffbd2e" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1m0 12h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1m10-4h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-6a1 1 0 0 1 1-1m0-8h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1" />
                </svg><span style="color: #FFBD2E;">Dashboard</span>
            </div>

            <div class="nav-button">
                <a href="{{ url('admin-reservation') }}" style="text-decoration: none; color: inherit;"
                    id="reservations-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                        <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M11.5 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6M16 3v4M8 3v4m-4 4h16m-5 8l2 2l4-4" />
                    </svg></i><span>Reservations</span><span id="admin-reservation-badge" class="badge bg-warning text-dark"
                        style="display: none; border-radius: 50%;">0</span>
                </a>
            </div>

            <div class="nav-button"><a href="{{ url('inventory') }}" style="text-decoration: none; color: inherit;">

                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                        <path fill="#ffbd2e"
                            d="M20 2H4c-1 0-2 .9-2 2v3.01c0 .72.43 1.34 1 1.69V20c0 1.1 1.1 2 2 2h14c.9 0 2-.9 2-2V8.7c.57-.35 1-.97 1-1.69V4c0-1.1-1-2-2-2m-1 18H5V9h14zm1-13H4V4h16z" />
                        <path fill="#ffbd2e" d="M9 12h6v2H9z" />
                    </svg><span>Inventory</span></a>
            </div>

            <div class="nav-button"><a href="{{ url('sales') }}" style="text-decoration: none; color: inherit;">

                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 48 48">
                        <g fill="none" stroke="#FFBD2E" stroke-linejoin="round" stroke-width="4">
                            <path d="M41 14L24 4L7 14v20l17 10l17-10z" />
                            <path stroke-linecap="round" d="M24 22v8m8-12v12m-16-4v4" />
                        </g>
                    </svg><span>Sales</span></a>
            </div>
            <div class="nav-button"><a href="{{ url('wishlist') }}" style="text-decoration: none; color: inherit;">

                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                        <path fill="none" stroke="#ffbd2e" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2.5"
                            d="M19.071 13.142L13.414 18.8a2 2 0 0 1-2.828 0l-5.657-5.657A5 5 0 1 1 12 6.072a5 5 0 0 1 7.071 7.07" />
                    </svg>
                    </svg><span>Wishlist</span></a>
            </div>
            <div class="nav-button"><a href="{{ url('announcement') }}" style="text-decoration: none; color: inherit;">

                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                        <g fill="none" fill-rule="evenodd">
                            <path
                                d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                            <path fill="#FFBD2E"
                                d="M19 4.741V8a3 3 0 1 1 0 6v3c0 1.648-1.881 2.589-3.2 1.6l-2.06-1.546A8.66 8.66 0 0 0 10 15.446v2.844a2.71 2.71 0 0 1-5.316.744l-1.57-5.496a4.7 4.7 0 0 1 3.326-7.73l3.018-.168a9.34 9.34 0 0 0 4.19-1.259l2.344-1.368C17.326 2.236 19 3.197 19 4.741M5.634 15.078l.973 3.407A.71.71 0 0 0 8 18.29v-3.01l-1.56-.087a5 5 0 0 1-.806-.115M17 4.741L14.655 6.11A11.3 11.3 0 0 1 10 7.604v5.819c1.787.246 3.488.943 4.94 2.031L17 17zM8 7.724l-1.45.08a2.7 2.7 0 0 0-.17 5.377l.17.015l1.45.08zM19 10v2a1 1 0 0 0 .117-1.993z" />
                        </g>
                    </svg><span>Announcement</span></a>
            </div>

            <div class="nav-button"><a href="{{ url('messages') }}" style="text-decoration: none; color: inherit;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 512 512">
                        <path fill="#ffbd2e"
                            d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16v288c0 8.8 7.2 16 16 16zm48 124l-.2.2l-5.1 3.8l-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3v-80H64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0h384c35.3 0 64 28.7 64 64v288c0 35.3-28.7 64-64 64H309.3z" />
                    </svg><span>Messages</span></a>
            </div>


            <div class="nav-button"><a href="{{ url('qrcode-scanner') }}" style="text-decoration: none; color: inherit;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                        <path fill="#ffbd2e"
                            d="M4 4h4.01V2H2v6h2zm0 12H2v6h6.01v-2H4zm16 4h-4v2h6v-6h-2zM16 4h4v4h2V2h-6z" />
                        <path fill="#ffbd2e"
                            d="M5 11h6V5H5zm2-4h2v2H7zM5 19h6v-6H5zm2-4h2v2H7zM19 5h-6v6h6zm-2 4h-2V7h2zm-3.99 4h2v2h-2zm2 2h2v2h-2zm2 2h2v2h-2zm0-4h2v2h-2z" />
                    </svg><span>QR Scanner</span></a>
            </div>
            <div id="nav-content-highlight"></div>
            <div class="nav-button"
                style="position: absolute; bottom: 20px; width: 100%;  text-align: center; display: flex; align-items: center; justify-content: center;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        style="background: none; border: none; color: #FFBD2E; cursor: pointer; font-size: 16px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                            <path fill="#d39817"
                                d="M5 11h8v2H5v3l-5-4l5-4zm-1 7h2.708a8 8 0 1 0 0-12H4a9.99 9.99 0 0 1 8-4c5.523 0 10 4.477 10 10s-4.477 10-10 10a9.99 9.99 0 0 1-8-4" />
                        </svg><span id="footer-logout">Logout</span>

                    </button>
                </form>
            </div>

        </div>

    </div>
    </div>
    <div class="container">

        <header>
            <div class="stats">

                <div class="stat-card">
                    <div class="icon-stat">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                            <path fill="none" stroke="#ffbd2e" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9.615 20H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8m-3 5l2 2l4-4M9 8h4m-4 4h2" />
                        </svg>
                    </div>
                    <div class="rsv">
                        <h4>Total Reservations</h4>
                        <p>{{ $data['dataCount'] }}</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon-stat">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                            <path fill="#ffbd2e"
                                d="M17 12c-2.76 0-5 2.24-5 5s2.24 5 5 5s5-2.24 5-5s-2.24-5-5-5m1.65 7.35L16.5 17.2V14h1v2.79l1.85 1.85zM18 3h-3.18C14.4 1.84 13.3 1 12 1s-2.4.84-2.82 2H6c-1.1 0-2 .9-2 2v15c0 1.1.9 2 2 2h6.11a6.7 6.7 0 0 1-1.42-2H6V5h2v3h8V5h2v5.08c.71.1 1.38.31 2 .6V5c0-1.1-.9-2-2-2m-6 2c-.55 0-1-.45-1-1s.45-1 1-1s1 .45 1 1s-.45 1-1 1" />
                        </svg>
                    </div>
                    <div class="rsv">
                        <h4>Pending Reservations</h4>
                        <p>{{ $data['pendingDataCount'] }}</p>

                    </div>
                </div>
                <div class="stat-card">
                    <div class="icon-stat">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                            <g fill="none" stroke="#ffbd2e" stroke-width="1.5">
                                <path
                                    d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m7 10l2.293 2.293a1 1 0 0 0 1.414 0l1.586-1.586a1 1 0 0 1 1.414 0L17 14m0 0v-2.5m0 2.5h-2.5" />
                            </g>
                        </svg>
                    </div>
                    <div class="rsv">
                        @if ($lowestStock ?? '')
                            @if ($lowestStock !== '')
                                <h4>Low Stock: {{ $lowestStockVariation->variation_type }} - {{ $lowestStockSize ?? '' }}
                                </h4>
                                <p>{{ $data['lowestStock'] }} </p>
                            @else
                                <p>...</p>
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </header>

        <section class="content">
            <div class="chart">

                <!-- This would be a chart (e.g., using Chart.js or other JS library) -->
                <div class="chart-box">

                    <h5>Daily Reservation</h5>

                    <canvas id="reservationChart"></canvas>
                </div>
                <div class="chart-box">
                    <div class="chart-title">
                        <h5>Payment By Day</h5>

                        @if ($data['startOfWeek'])
                            <h6 id="dateRange" style="color: var(--navbar-light-secondary);">
                                As of {{ \Carbon\Carbon::parse($data['startOfWeek'])->format('M j, Y') }} -
                                {{ \Carbon\Carbon::parse($data['today'])->format('M j, Y') }}
                            </h6>
                        @endif
                    </div>
                    <canvas id="dayChart" style=" margin-top: 30px; padding:10px"></canvas>

                </div>
                <div class="chart-box">

                    <h5>Payment By Month</h5>
                    <canvas id="monthChart" style=" margin-top: 30px; padding:10px""></canvas>

                </div>
            </div>

            <div class="recent-activity">
                <h5>Recent Reservations</h5>

                <table>
                    <thead>
                        <tr>
                            <th style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">STUDENT</th>
                            <th>UNIFORM</th>
                            <th>DATE</th>
                            <th style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data['recentData'])
                            @forelse($data['recentData'] as $recent)
                                <tr>

                                    <td>{{ $recent['full_name'] }}</td>
                                    <td>{{ $recent['name'] }}</td>
                                    <td>{{ $recent['reservation_date'] }}</td>
                                    <td>{{ $recent['status'] }}</td>


                                </tr>
                                <tr>
                                @empty
                                    <td style=" background-color: var(--navbar-dark-secondary); color: var(--navbar-light-primary);"
                                        colspan='7'>No Results Found</td>
                                </tr>
                            @endforelse
                            <!-- More rows -->
                        @endif
                    </tbody>
                </table>
            </div>
        </section>

    </div>
    <div class="bottom-nav">
        <div class="floating-nav">

            <a class="bot-dashboard" href="{{ url('dashboard') }}" style="text-decoration: none; color: inherit;">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="none" stroke="#ffbd2e" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1m0 12h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1m10-4h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-6a1 1 0 0 1 1-1m0-8h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1" />
                </svg>

            </a>


            <a class="bot-reservation" href="{{ url('admin-reservation') }}"
                style="text-decoration: none; color: inherit;" id="bot-reservations-link">
                <div style="position: relative; display: inline-block;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                        <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M11.5 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6M16 3v4M8 3v4m-4 4h16m-5 8l2 2l4-4" />
                    </svg>
                    <span id="bot-admin-reservation-badge" class="badge bg-warning text-dark"
                        style="position: absolute; top: -5px; right: -5px; border-radius: 50%; font-size: 9px; display: none;">0</span>
                </div>
            </a>


            <a class="bot-inventory" href="{{ url('inventory') }}" style="text-decoration: none; color: inherit;">

                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="#ffbd2e"
                        d="M20 2H4c-1 0-2 .9-2 2v3.01c0 .72.43 1.34 1 1.69V20c0 1.1 1.1 2 2 2h14c.9 0 2-.9 2-2V8.7c.57-.35 1-.97 1-1.69V4c0-1.1-1-2-2-2m-1 18H5V9h14zm1-13H4V4h16z" />
                    <path fill="#ffbd2e" d="M9 12h6v2H9z" />
                </svg></a>


            <a class="bot-sales" href="{{ url('sales') }}" style="text-decoration: none; color: inherit;">

                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 48 48">
                    <g fill="none" stroke="#FFBD2E" stroke-linejoin="round" stroke-width="4">
                        <path d="M41 14L24 4L7 14v20l17 10l17-10z" />
                        <path stroke-linecap="round" d="M24 22v8m8-12v12m-16-4v4" />
                    </g>
                </svg></a>

            <a class="bot-wishlist" href="{{ url('wishlist') }}" style="text-decoration: none; color: inherit;">

                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="none" stroke="#ffbd2e" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2.5"
                        d="M19.071 13.142L13.414 18.8a2 2 0 0 1-2.828 0l-5.657-5.657A5 5 0 1 1 12 6.072a5 5 0 0 1 7.071 7.07" />
                </svg>
            </a>


        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        var pendingCount = @json($data['pendingDataCountToday']);
        var completedCount = @json($data['completedDataCountToday']);

        var labels = ['Pending', 'Completed'];
        var dataValues = [pendingCount, completedCount];
        // Use `reservationData` for the chart
        const reservationCtx = document.getElementById('reservationChart').getContext('2d');
        const reservationConfig = {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Reservation Status',
                    data: dataValues,
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 189, 46, 1)'],
                    backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 189, 46, 0.2)'],

                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#ffffff'
                        }
                    }
                }
            }
        };

        // Initialize the Chart.js instance
        new Chart(reservationCtx, reservationConfig);
    </script>

    <script>
        var dayChartctx = document.getElementById('dayChart').getContext('2d');



        var paymentsByDayData = @json($data['paymentsByDay']);
        var payments = new Array(7).fill(0);



        // Fill the payments array with the corresponding total_payment for each month
        paymentsByDayData.forEach(function(payment) {
            payments[payment.day_of_week - 1] = payment.total_payment;


        });



        var dayChart = new Chart(dayChartctx, {
            type: 'bar',
            data: {
                labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday',
                    'Saturday'
                ], // Days of the week
                datasets: [{
                    label: 'Total Payment by Day',
                    data: payments, // Dynamically insert the total payments for each day
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱ ' + value
                                    .toLocaleString(); // Add peso sign and format the number with commas
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        var monthChartctx = document.getElementById('monthChart').getContext('2d');

        var paymentsByMonthData = @json($data['paymentsByMonth']);
        var payments = new Array(12).fill(0); // Initialize an array with 12 zeros (for 12 months)

        // Fill the payments array with the corresponding total_payment for each month
        paymentsByMonthData.forEach(function(payment) {
            payments[payment.month - 1] = payment
                .total_payment; // months are 1-indexed, so subtract 1 for zero-indexed array
        });
        var monthChart = new Chart(monthChartctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                    'Dec'
                ], // Months
                datasets: [{
                    label: 'Total Payment by Month',
                    data: payments, // Dynamically insert the total payments for each month
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱ ' + value
                                    .toLocaleString(); // Add peso sign and format the number with commas
                            }
                        }

                    }
                }
            }
        });
    </script>
    <script>
        // Declare `reservationData` only once


        // Get the checkbox and container elements



        const navToggle = document.getElementById('nav-toggle');
        const container = document.querySelector('.container');

        // Add an event listener to detect checkbox state changes
        navToggle.addEventListener('change', () => {
            if (navToggle.checked) {
                // Apply styles when the checkbox is checked
                container.style.position = 'absolute';
                container.style.width = '90%';
                container.style.left = 'var(--navbar-width-min)';
            } else {
                // Reset styles when the checkbox is unchecked
                container.style.position = '';
                container.style.width = '75%';
                container.style.left = '';
            }
        });
    </script>
@endsection
