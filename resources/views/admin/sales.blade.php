@extends('layout.admin_design')

@section('content')
<style>
  #nav-content-highlight {
    position: absolute;
    left: 10px;
    right: 10px;
    top: 182px;
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
    background-color: transparent;
    top: 20px;
    height: auto;
    left: var(--navbar-width);
    /* Adjust left based on sidebar width */
    transition: width 0.3s ease, left 0.3s ease;
    /* Smooth transition */
    margin-left: 50px;
    font-family: "Signika", sans-serif;
  }

  .container.navbar-closed {
    width: 88vw;
    left: 0;

  }
 @media  (max-width: 768px) {
   .container {
            
            top: 70px;
            left: 10px;
            width: 93%;
         
            margin-left: 0;
            
        }
         .stat-card{
            padding: 12px;
        }
        .icon-stat{
            height: 30px;
            width: auto;  
            border-radius: 5px ;  
        }
        .icon-stat svg{
            width: 1.7em;
            height: auto;
        }
        .rsv{
            margin-left: 10px;
        }
        .rsv h4{
            font-size: .8rem;
        }
        .rsv p{
            font-size: 1rem;
        }
 }
  @media  (max-width: 480px) {
        .stat-card{
            border-radius: 6px;
            padding: 10px;
            width: 130px;
        }
        .icon-stat{
            height: 25px;
            width: auto; 
            border-radius: 5px;   
        }
        .icon-stat svg{
            width: 1.2em;
            height: auto;
        }
        .rsv{
            margin-left: 10px;
            padding: 10px 0;
      
            
        }
        .rsv h4{
            font-size: .6rem;
        }
        .rsv p{
            font-size: .8rem;
            padding-bottom: 0 !important;
        }
        .recent-activity h5{
          font-size: 1rem;
        }
        
         .recent-activity table th, .recent-activity table td{
            font-size: .6rem;
        }
  }
  .bot-sales{
        border-top: 2px solid #ffbd2e;

  }
</style>
<link rel="stylesheet" href="../css/sales.css">
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
            <a href="{{ url('admin-reservation') }}" style="text-decoration: none; color: inherit;" id="reservations-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.5 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6M16 3v4M8 3v4m-4 4h16m-5 8l2 2l4-4" />
                </svg></i><span>Reservations</span><span id="admin-reservation-badge" class="badge bg-warning text-dark" style="display: none; border-radius: 50%;">0</span>
            </a>
        </div>

    <div class="nav-button"><a href="{{ url('inventory') }}" style="text-decoration: none; color: inherit;">

        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
          <path fill="#ffbd2e" d="M20 2H4c-1 0-2 .9-2 2v3.01c0 .72.43 1.34 1 1.69V20c0 1.1 1.1 2 2 2h14c.9 0 2-.9 2-2V8.7c.57-.35 1-.97 1-1.69V4c0-1.1-1-2-2-2m-1 18H5V9h14zm1-13H4V4h16z" />
          <path fill="#ffbd2e" d="M9 12h6v2H9z" />
        </svg><span>Inventory</span></a>
    </div>
    
    <div class="nav-button"><a href="{{ url('sales') }}" style="text-decoration: none; color: inherit;">

        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 48 48"><g fill="none" stroke="#FFBD2E" stroke-linejoin="round" stroke-width="4"><path d="M41 14L24 4L7 14v20l17 10l17-10z"/><path stroke-linecap="round" d="M24 22v8m8-12v12m-16-4v4"/></g></svg><span style="color: #FFBD2E;">Sales</span></a>
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
        <svg xmlns="http://www.w3.org/2000/svg" width="1.1em" height="1.1em" viewBox="0 0 512 512">
          <path fill="#ffbd2e" d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16v288c0 8.8 7.2 16 16 16zm48 124l-.2.2l-5.1 3.8l-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3v-80H64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0h384c35.3 0 64 28.7 64 64v288c0 35.3-28.7 64-64 64H309.3z" />
        </svg><span>Messages</span></a>
    </div>


    <div class="nav-button"><a href="{{  url('qrcode-scanner') }}" style="text-decoration: none; color: inherit;">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
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
        </svg><span id="footer-logout">Logout</span>

      </button>
    </form>
  </div>

</div>
</div>
<div class="container p-4 col-xl-9">


<div class="d-flex justify-content-between align-items-centerpage-title mb-4">
      <h1 class="h3" style="color: #FFBD2E">Sales</h1>
    </div>
   
     <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <button id="btn-all" class="btn btn-outline-warning btn-sm me-2 active">All</button>
        <button id="btn-today" class="btn btn-outline-warning btn-sm me-2">Today</button>
        <button id="btn-yesterday" class="btn btn-outline-warning btn-sm me-2">Yesterday</button>
        <button id="btn-last-week" class="btn btn-outline-warning btn-sm me-2">Last Week</button>
        <button id="btn-last-month" class="btn btn-outline-warning btn-sm me-2">Last Month</button>
 
      </div>
     
    </div>

    <div class="container-wrapper-all">

 

    <div class="sales-stats mb-5">
              <div class="stat-card">
                <div class="icon-stat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="#FFBD2E" d="M8.4 21q-2.275 0-3.838-1.562T3 15.6q0-.95.325-1.85t.925-1.625L7.8 7.85L5.375 3h13.25L16.2 7.85l3.55 4.275q.6.725.925 1.625T21 15.6q0 2.275-1.575 3.838T15.6 21zm3.6-5q-.825 0-1.412-.587T10 14t.588-1.412T12 12t1.413.588T14 14t-.587 1.413T12 16M9.625 7h4.75l1-2h-6.75zM8.4 19h7.2q1.425 0 2.413-.987T19 15.6q0-.6-.213-1.162t-.587-1.013L14.525 9H9.5l-3.7 4.4q-.375.45-.587 1.025T5 15.6q0 1.425.988 2.413T8.4 19"/></svg>
                </div>
                <div class="rsv">
                    <h4>Total Sales</h4>
                    <p class="text-success" >₱{{$totalSalesFormatted}}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="icon-stat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="#FFBD2E" d="M7 13.5q.625 0 1.063-.437T8.5 12t-.437-1.062T7 10.5t-1.062.438T5.5 12t.438 1.063T7 13.5m5 0q.625 0 1.063-.437T13.5 12t-.437-1.062T12 10.5t-1.062.438T10.5 12t.438 1.063T12 13.5m5 0q.625 0 1.063-.437T18.5 12t-.437-1.062T17 10.5t-1.062.438T15.5 12t.438 1.063T17 13.5M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8"/></svg>
                </div>
                <div class="rsv">
                    <h4>Pending Payment</h4>
                    <p class="text-danger">₱{{$pendingTotalSalesFormatted}}</p>
                </div>
            </div>
        </div>
<div class="recent-activity">
   <h5 style="color: var(--secondary-color);">Total Sales Per Item</h5>
         <table class="table" id="salesPerItem">
        <thead>
            <tr>
               <th style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">#</th>
                <th>Item Name</th>
                <th>Variation</th>
                <th>Size</th>
                <th>Units Sold</th>
                <th style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">Total Sales (₱)</th>
            </tr>
        </thead>
        <tbody>
           

             @foreach ($sales as $sale)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$sale->name}}</td>
                <td>{{$sale->department ??  'No Variation'}}</td>
                <td>{{$sale->size ??  'No Size'}}</td>
                <td>{{$sale->total_quantity}}</td>
                <td>₱{{$sale->total_sales}}</td>
            </tr>
          @endforeach
                  
        </tbody>
    </table>
    </div>

    
    </div>
    <div class="container-wrapper-today" style="display: none;">

    
       <h5 class="mb-4" style="color: var(--navbar-light-secondary)">{{$formattedDate}}</h5>

    <div class="sales-stats mb-5">
              <div class="stat-card">
                <div class="icon-stat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="#FFBD2E" d="M8.4 21q-2.275 0-3.838-1.562T3 15.6q0-.95.325-1.85t.925-1.625L7.8 7.85L5.375 3h13.25L16.2 7.85l3.55 4.275q.6.725.925 1.625T21 15.6q0 2.275-1.575 3.838T15.6 21zm3.6-5q-.825 0-1.412-.587T10 14t.588-1.412T12 12t1.413.588T14 14t-.587 1.413T12 16M9.625 7h4.75l1-2h-6.75zM8.4 19h7.2q1.425 0 2.413-.987T19 15.6q0-.6-.213-1.162t-.587-1.013L14.525 9H9.5l-3.7 4.4q-.375.45-.587 1.025T5 15.6q0 1.425.988 2.413T8.4 19"/></svg>
                </div>
                <div class="rsv">
                    <h4>Total Sales</h4>
                    <p class="text-success" >₱{{$totalSalesTodayFormatted}}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="icon-stat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="#FFBD2E" d="M7 13.5q.625 0 1.063-.437T8.5 12t-.437-1.062T7 10.5t-1.062.438T5.5 12t.438 1.063T7 13.5m5 0q.625 0 1.063-.437T13.5 12t-.437-1.062T12 10.5t-1.062.438T10.5 12t.438 1.063T12 13.5m5 0q.625 0 1.063-.437T18.5 12t-.437-1.062T17 10.5t-1.062.438T15.5 12t.438 1.063T17 13.5M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8"/></svg>
                </div>
                <div class="rsv">
                    <h4>Pending Payment</h4>
                    <p class="text-danger">₱{{$pendingTotalSalesTodayFormatted}}</p>
                </div>
            </div>
        </div>
<div class="recent-activity">
   <h5 style="color: var(--secondary-color);">Total Sales Per Item</h5>
         <table class="table" id="salesPerItem">
        <thead>
            <tr>
               <th style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">#</th>
                <th>Item Name</th>
                <th>Variation</th>
                <th>Size</th>
                <th>Units Sold</th>
                <th style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">Total Sales (₱)</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($salesToday as $sale)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$sale->name}}</td>
                <td>{{$sale->department ??  'No Variation'}}</td>
                <td>{{$sale->size ??  'No Size'}}</td>
                <td>{{$sale->total_quantity}}</td>
                <td>₱{{$sale->total_sales}}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
    </div>

    
    </div>
     <div class="container-wrapper-yesterday" style="display: none;">
       <h5 class="mb-4" style="color: var(--navbar-light-secondary)">{{$formattedDateYesterday}}</h5>

        <div class="sales-stats mb-5">
              <div class="stat-card">
                <div class="icon-stat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="#FFBD2E" d="M8.4 21q-2.275 0-3.838-1.562T3 15.6q0-.95.325-1.85t.925-1.625L7.8 7.85L5.375 3h13.25L16.2 7.85l3.55 4.275q.6.725.925 1.625T21 15.6q0 2.275-1.575 3.838T15.6 21zm3.6-5q-.825 0-1.412-.587T10 14t.588-1.412T12 12t1.413.588T14 14t-.587 1.413T12 16M9.625 7h4.75l1-2h-6.75zM8.4 19h7.2q1.425 0 2.413-.987T19 15.6q0-.6-.213-1.162t-.587-1.013L14.525 9H9.5l-3.7 4.4q-.375.45-.587 1.025T5 15.6q0 1.425.988 2.413T8.4 19"/></svg>
                </div>
                <div class="rsv">
                    <h4>Total Sales</h4>
                    <p class="text-success" >₱{{$totalSalesYesterdayFormatted}}</p>
                </div>
            </div>
            
        </div>
<div class="recent-activity">
   <h5 style="color: var(--secondary-color);">Total Sales Per Item</h5>
         <table class="table" id="salesPerItem">
        <thead>
            <tr>
               <th style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">#</th>
                <th>Item Name</th>
                <th>Variation</th>
                <th>Size</th>
                <th>Units Sold</th>
                <th style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">Total Sales (₱)</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($salesYesterday as $yesterday)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$yesterday->name}}</td>
                <td>{{$yesterday->department}}</td>
                <td>{{$yesterday->size ??  'No Size'}}</td>
                <td>{{$yesterday->total_quantity}}</td>
                <td>₱{{$yesterday->total_sales}}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
    </div>

    
    </div>
     <div class="container-wrapper-last-week" style="display: none;">

    
       <h5 class="mb-4" style="color: var(--navbar-light-secondary)">{{$lastWeekRange}}</h5>

    <div class="sales-stats mb-5">
              <div class="stat-card">
                <div class="icon-stat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="#FFBD2E" d="M8.4 21q-2.275 0-3.838-1.562T3 15.6q0-.95.325-1.85t.925-1.625L7.8 7.85L5.375 3h13.25L16.2 7.85l3.55 4.275q.6.725.925 1.625T21 15.6q0 2.275-1.575 3.838T15.6 21zm3.6-5q-.825 0-1.412-.587T10 14t.588-1.412T12 12t1.413.588T14 14t-.587 1.413T12 16M9.625 7h4.75l1-2h-6.75zM8.4 19h7.2q1.425 0 2.413-.987T19 15.6q0-.6-.213-1.162t-.587-1.013L14.525 9H9.5l-3.7 4.4q-.375.45-.587 1.025T5 15.6q0 1.425.988 2.413T8.4 19"/></svg>
                </div>
                <div class="rsv">
                    <h4>Total Sales</h4>
                    <p class="text-success" >₱{{$totalSalesLastWeekFormatted}}</p>
                </div>
            </div>
           
        </div>
<div class="recent-activity">
   <h5 style="color: var(--secondary-color);">Total Sales Per Item</h5>
         <table class="table" id="salesPerItem">
        <thead>
            <tr>
               <th style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">#</th>
                <th>Item Name</th>
                <th>Variation</th>
                <th>Size</th>
                <th>Units Sold</th>
                <th style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">Total Sales (₱)</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($salesLastWeek as $week)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$week->name}}</td>
                <td>{{$week->department ??  'No Variation'}}</td>
                <td>{{$week->size ??  'No Size'}}</td>
                <td>{{$week->total_quantity}}</td>
                <td>₱{{$week->total_sales}}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
    </div>

    
    </div>
     <div class="container-wrapper-last-month" style="display: none;">

    
       <h5 class="mb-4" style="color: var(--navbar-light-secondary)">{{$lastMonthName}}</h5>

    <div class="sales-stats mb-5">
              <div class="stat-card">
                <div class="icon-stat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="#FFBD2E" d="M8.4 21q-2.275 0-3.838-1.562T3 15.6q0-.95.325-1.85t.925-1.625L7.8 7.85L5.375 3h13.25L16.2 7.85l3.55 4.275q.6.725.925 1.625T21 15.6q0 2.275-1.575 3.838T15.6 21zm3.6-5q-.825 0-1.412-.587T10 14t.588-1.412T12 12t1.413.588T14 14t-.587 1.413T12 16M9.625 7h4.75l1-2h-6.75zM8.4 19h7.2q1.425 0 2.413-.987T19 15.6q0-.6-.213-1.162t-.587-1.013L14.525 9H9.5l-3.7 4.4q-.375.45-.587 1.025T5 15.6q0 1.425.988 2.413T8.4 19"/></svg>
                </div>
                <div class="rsv">
                    <h4>Total Sales</h4>
                    <p class="text-success" >₱{{$totalSalesLastMonthFormatted}}</p>
                </div>
            </div>
            
        </div>
<div class="recent-activity">
   <h5 style="color: var(--secondary-color);">Total Sales Per Item</h5>
         <table class="table" id="salesPerItem">
        <thead>
            <tr>
               <th style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">#</th>
                <th>Item Name</th>
                <th>Variation</th>
                <th>Size</th>
                <th>Units Sold</th>
                <th style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">Total Sales (₱)</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($salesLastMonth as $month)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$month->name}}</td>
                <td>{{$month->department ??  'No Variation'}}</td>
                <td>{{$month->size ??  'No Size'}}</td>
                <td>{{$month->total_quantity}}</td>
                <td>₱{{$month->total_sales}}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
    </div>

    
    </div>
</div>





<div class="bottom-nav">
    <div class="floating-nav">
     <a class="bot-dashboard" href="{{ url('dashboard') }}" style="text-decoration: none; color: inherit;">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                <path fill="none" stroke="#ffbd2e" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1m0 12h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1m10-4h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-6a1 1 0 0 1 1-1m0-8h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1" />
            </svg>
      </a>

     
            <a class="bot-reservation" href="{{ url('admin-reservation') }}" style="text-decoration: none; color: inherit;" id="bot-reservations-link">
                <div style="position: relative; display: inline-block;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                        <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.5 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6M16 3v4M8 3v4m-4 4h16m-5 8l2 2l4-4" />
                    </svg>
                    <span id="bot-admin-reservation-badge" class="badge bg-warning text-dark" style="position: absolute; top: -5px; right: -5px; border-radius: 50%; font-size: 9px; display: none;">0</span>
                </div>
            </a>

       <a class="bot-inventory" href="{{ url('inventory') }}" style="text-decoration: none; color: inherit;">

                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="#ffbd2e" d="M20 2H4c-1 0-2 .9-2 2v3.01c0 .72.43 1.34 1 1.69V20c0 1.1 1.1 2 2 2h14c.9 0 2-.9 2-2V8.7c.57-.35 1-.97 1-1.69V4c0-1.1-1-2-2-2m-1 18H5V9h14zm1-13H4V4h16z" />
                    <path fill="#ffbd2e" d="M9 12h6v2H9z" />
                </svg></a>
       
        
       <a class="bot-sales" href="{{ url('sales') }}" style="text-decoration: none; color: inherit;">

        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 48 48"><g fill="none" stroke="#FFBD2E" stroke-linejoin="round" stroke-width="4"><path d="M41 14L24 4L7 14v20l17 10l17-10z"/><path stroke-linecap="round" d="M24 22v8m8-12v12m-16-4v4"/></g></svg></a>
    
       <a class="bot-wishlist" href="{{ url('wishlist') }}" style="text-decoration: none; color: inherit;">

                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="none" stroke="#ffbd2e" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.071 13.142L13.414 18.8a2 2 0 0 1-2.828 0l-5.657-5.657A5 5 0 1 1 12 6.072a5 5 0 0 1 7.071 7.07" />
                </svg>
                </a>
        
       
        </div>
</div>
<script>

  document.addEventListener('DOMContentLoaded', () => {
    const btnAll = document.getElementById('btn-all');
    const btnToday = document.getElementById('btn-today');
     const btnYesterday = document.getElementById('btn-yesterday');
    const btnLastWeek = document.getElementById('btn-last-week');
    const btnLastMonth = document.getElementById('btn-last-month');
    const wrapperAll = document.querySelector('.container-wrapper-all');
    const wrapperToday = document.querySelector('.container-wrapper-today');
    const wrapperYesterday = document.querySelector('.container-wrapper-yesterday');
    const wrapperLastWeek = document.querySelector('.container-wrapper-last-week');
    const wrapperLastMonth = document.querySelector('.container-wrapper-last-month');
    const buttons = document.querySelectorAll('.btn');

    function toggleVisibility(activeWrapper) {
        // Hide all wrappers
        wrapperAll.style.display = 'none';
        wrapperToday.style.display = 'none';
          wrapperYesterday.style.display = 'none';
        wrapperLastWeek.style.display = 'none';
        wrapperLastMonth.style.display = 'none';

        // Show the active wrapper
        activeWrapper.style.display = 'block';
    }

    function setActiveClass(activeButton) {
        // Remove 'active' class from all buttons
        buttons.forEach(button => button.classList.remove('active'));

        // Add 'active' class to the clicked button
        activeButton.classList.add('active');
    }

    // Event listeners for buttons
    btnAll.addEventListener('click', () => {
        toggleVisibility(wrapperAll);
        setActiveClass(btnAll);
    });

    btnToday.addEventListener('click', () => {
        toggleVisibility(wrapperToday);
        setActiveClass(btnToday);
    });
    btnYesterday.addEventListener('click', () => {
        toggleVisibility(wrapperYesterday);
        setActiveClass(btnYesterday);
    });

    btnLastWeek.addEventListener('click', () => {
        toggleVisibility(wrapperLastWeek);
        setActiveClass(btnLastWeek);
    });
     btnLastMonth.addEventListener('click', () => {
        toggleVisibility(wrapperLastMonth);
        setActiveClass(btnLastMonth);
    });


    // Add similar event listeners for the other buttons as needed
});

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