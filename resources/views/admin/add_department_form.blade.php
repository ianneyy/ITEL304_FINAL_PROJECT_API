@extends('layout.admin_design')

@section('content')
<style>
  #nav-content-highlight {
    position: absolute;
    left: 10px;
    right: 10px;
    top: 128px;
    width: calc(100% - 16px);
    height: 54px;
    background-color: #efefef;
    background-attachment: fixed;
    border-radius: 10px 10px 10px 10px;
    transition: top 0.2s;
    border: 1px solid #bcbaba;
  }

  .container {
    position: absolute;
    background-color: #fefefe;
    width: 79vw;
    top: 20px;
    left: var(--navbar-width);
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
  }

  .container table th {
    background-color: #ececec;
    color: #9e9e9e;
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
</style>
<div id="nav-bar">
  <input id="nav-toggle" type="checkbox" />
  <div id="nav-header"><a id="nav-title" target="_blank">ADMIN</a>
    <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
    <hr />
  </div>
  <div id="nav-content">
    <div class="nav-button">
      <a href="{{ url('dashboard') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
          <path fill="none" stroke="#ffbd2e" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1m0 12h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1m10-4h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-6a1 1 0 0 1 1-1m0-8h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1" />
        </svg><span>Dashboard</span></a>
    </div>

     <div class="nav-button">
            <a href="{{ url('admin-reservation') }}" style="text-decoration: none; color: inherit;" id="reservations-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
                    <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.5 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6M16 3v4M8 3v4m-4 4h16m-5 8l2 2l4-4" />
                </svg></i><span>Reservations</span><span id="reservation-badge" class="badge bg-warning text-dark" style="display: none;">New</span>
            </a>
        </div>

    <div class="nav-button"><a href="{{ url('inventory') }}" style="text-decoration: none; color: inherit;">

        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
          <path fill="#ffbd2e" d="M20 2H4c-1 0-2 .9-2 2v3.01c0 .72.43 1.34 1 1.69V20c0 1.1 1.1 2 2 2h14c.9 0 2-.9 2-2V8.7c.57-.35 1-.97 1-1.69V4c0-1.1-1-2-2-2m-1 18H5V9h14zm1-13H4V4h16z" />
          <path fill="#ffbd2e" d="M9 12h6v2H9z" />
        </svg><span style="color: #FFBD2E;">Inventory</span></a>
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
        </svg><span>Notifications</span></a>
    </div>

    <div class="nav-button"><a href="{{ url('help') }}" style="text-decoration: none; color: inherit;">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
          <path fill="#FFBD2E" d="M11.95 18q.525 0 .888-.363t.362-.887t-.362-.888t-.888-.362t-.887.363t-.363.887t.363.888t.887.362m-.9-3.85h1.85q0-.825.188-1.3t1.062-1.3q.65-.65 1.025-1.238T15.55 8.9q0-1.4-1.025-2.15T12.1 6q-1.425 0-2.312.75T8.55 8.55l1.65.65q.125-.45.563-.975T12.1 7.7q.8 0 1.2.438t.4.962q0 .5-.3.938t-.75.812q-1.1.975-1.35 1.475t-.25 1.825M12 22q-2.075 0-3.9-.787t-3.175-2.138T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8" />
        </svg><span>Help/FAQs</span></a>
    </div>

    <div class="nav-button"><a href="{{  url('qrcode-scanner') }}" style="text-decoration: none; color: inherit;">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
          <path fill="#d39817" d="M4 4h4.01V2H2v6h2zm0 12H2v6h6.01v-2H4zm16 4h-4v2h6v-6h-2zM16 4h4v4h2V2h-6z" />
          <path fill="#d39817" d="M5 11h6V5H5zm2-4h2v2H7zM5 19h6v-6H5zm2-4h2v2H7zM19 5h-6v6h6zm-2 4h-2V7h2zm-3.99 4h2v2h-2zm2 2h2v2h-2zm2 2h2v2h-2zm0-4h2v2h-2z" />
        </svg><span>QR Scanner</span></a>
    </div>

    <div id="nav-content-highlight"></div>
  </div>
  <input id="nav-footer-toggle" type="checkbox" />

</div>
</div>
<div class="container">
  <form action="{{ url('add-uniform') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row">
      <div class="col-20">
        <div class="form-group">
          <label>Deparment</label>
          <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">


          <label>Size</label>
          <input type="text" class="form-control" name="description" id="description">
          <label>Price</label>
          <input type="number" class="form-control" name="price" id="price">
          <label>Image</label>
          <input type="file" class="form-control" name="image_url" id="image_url">


          <label>Status</label>
          <input type="text" class="form-control" name="status" id="status">
          <hr>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </form>
</div>
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