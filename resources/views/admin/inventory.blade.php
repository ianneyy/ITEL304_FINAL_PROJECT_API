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

  /* button {
    padding-left: 30px;
    padding-right: 30px;
    padding-top: 10px;
    padding-bottom: 10px;


  } */

  /* .invent {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  td,
  th {
    border: none;
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



  

  .add {
    padding: 5px 25px 5px 25px;
    text-align: center;
    margin-bottom: 20px;
    margin-top: 20px;
    background-color: #ffbd2e;
    color: #fefefe;
    border-radius: 5px;
  } */
  .ed {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3px 10px 3px 10px;
    background-color: #ececec;
    border-radius: 5px;
    height: 35px;
  }

  .edit {
    margin-right: 5px;
  }
</style>
<link rel="stylesheet" href="../css/inventory.css">
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
<div class="container p-4 col-xl-9">

  <div class="headings-container">
    <div class="title-container">
      <div class="page-title" style="color: #FFBD2E">Inventory</div>
      <div class="page-desc" style="color: #cdcdcd">View and manage your stock</div>
    </div>
    <div class="add-invent">
      <a class="add" href="{{ url('add_uniforms/')}}">Add uniform</a>
    </div>
  </div>
  @forelse($data as $d)
  @foreach($d->variations as $variation) <!-- Loop through each variation -->
  @foreach($variation->sizes as $size) <!-- Loop through each size in the variation -->
  <div class="content-bar">
    <div class="itemnum">#{{ $d->id }}</div>
    <div class="itemtitle">{{ $d->name }}</div>
    <div class="itemvariation">{{ $variation->variation_type ?? 'N/A' }}</div> <!-- Variation color -->
    <div class="itemsize">{{ $size->size ?? 'N/A'}}</div> <!-- Size for the variation -->
    <div class="itemprice">${{ $d->price }}</div>
    <div class="itemstock">{{ $size->stock ?? $d->stock ?? 'N/A'}} In Stock</div>

    <div class="btncontainer">
      <div class="ed" style="background-color: #ffd37b">
        <a href="{{ url('edit-uniforms-form/' .$d->id)}}" style="color: #936d1b;">
          <svg class="edit" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
            <g class="edit-outline">
              <g fill="#936d1b" fill-rule="evenodd" class="Vector" clip-rule="evenodd">
                <path d="M2 6.857A4.857 4.857 0 0 1 6.857 2H12a1 1 0 1 1 0 2H6.857A2.857 2.857 0 0 0 4 6.857v10.286A2.857 2.857 0 0 0 6.857 20h10.286A2.857 2.857 0 0 0 20 17.143V12a1 1 0 1 1 2 0v5.143A4.857 4.857 0 0 1 17.143 22H6.857A4.857 4.857 0 0 1 2 17.143z" />
                <path d="m15.137 13.219l-2.205 1.33l-1.033-1.713l2.205-1.33l.003-.002a1.2 1.2 0 0 0 .232-.182l5.01-5.036a3 3 0 0 0 .145-.157c.331-.386.821-1.15.228-1.746c-.501-.504-1.219-.028-1.684.381a6 6 0 0 0-.36.345l-.034.034l-4.94 4.965a1.2 1.2 0 0 0-.27.41l-.824 2.073a.2.2 0 0 0 .29.245l1.032 1.713c-1.805 1.088-3.96-.74-3.18-2.698l.825-2.072a3.2 3.2 0 0 1 .71-1.081l4.939-4.966l.029-.029c.147-.15.641-.656 1.24-1.02c.327-.197.849-.458 1.494-.508c.74-.059 1.53.174 2.15.797a2.9 2.9 0 0 1 .845 1.75a3.15 3.15 0 0 1-.23 1.517c-.29.717-.774 1.244-.987 1.457l-5.01 5.036q-.28.281-.62.487m4.453-7.126s-.004.003-.013.006z" />
              </g>
            </g>
          </svg>Edit</a>
      </div>

      <div class="ed del" style="background-color: #f58a8a" data-id="{{$d->id}}" data-sizeId="{{$size->id}}">
        <a href="javascript:void(0)" class="delete-button-2" style="color: #a80000;">
          <svg class="edit" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
            <g fill="none" stroke="#a80000" stroke-width="2">
              <path stroke-linecap="round" d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79s-2.196.81-4.856.81h-.774c-2.66 0-3.991 0-4.856-.81c-.865-.809-.954-2.136-1.13-4.79l-.46-6.9" />
              <path d="M6.5 6h.11a2 2 0 0 0 1.83-1.32l.034-.103l.097-.291c.083-.249.125-.373.18-.479a1.5 1.5 0 0 1 1.094-.788C9.962 3 10.093 3 10.355 3h3.29c.262 0 .393 0 .51.019a1.5 1.5 0 0 1 1.094.788c.055.106.097.23.18.479l.097.291A2 2 0 0 0 17.5 6" />
            </g>
          </svg>Delete</a>
      </div>
    </div>
  </div> 
    <div id="overlay" class="modal-overlay"></div>
    <div class="card">
      <div class="card-content">
        <p class="card-heading">Delete item?</p>
        <p class="card-description">Are you sure you want to delete this item? This action cannot be undone.</p>
      </div>
      <div class="card-button-wrapper">
        <button class="card-button secondary">Cancel</button>
        <a id="delete-link-2" href="#" class="card-button primary" style="text-align:center; display: flex; justify-content: center; align-items:center;">Delete</a>
      </div>
      <button class="exit-button">
        <svg height="20px" viewBox="0 0 384 512">
          <path
            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
          ></path>
        </svg>
      </button>
    </div>
  @endforeach
  @endforeach
  @if($d->variations->isEmpty())
  <div class="content-bar">
    <div class="itemnum">#{{ $d->id }}</div>
    <div class="itemtitle">{{ $d->name }}</div>
    <div class="itemvariation">N/A</div> <!-- Variation color -->
    <div class="itemsize">N/A</div> <!-- Size for the variation -->
    <div class="itemprice">${{ $d->price }}</div>
    <div class="itemstock">{{ $d->stock }} In Stock</div>

    <div class="btncontainer">
      <div class="ed" style="background-color: #ffd37b">
        <a href="{{ url('edit-uniforms-form/' .$d->id)}}" style="color: #936d1b;">
          <svg class="edit" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
            <g class="edit-outline">
              <g fill="#936d1b" fill-rule="evenodd" class="Vector" clip-rule="evenodd">
                <path d="M2 6.857A4.857 4.857 0 0 1 6.857 2H12a1 1 0 1 1 0 2H6.857A2.857 2.857 0 0 0 4 6.857v10.286A2.857 2.857 0 0 0 6.857 20h10.286A2.857 2.857 0 0 0 20 17.143V12a1 1 0 1 1 2 0v5.143A4.857 4.857 0 0 1 17.143 22H6.857A4.857 4.857 0 0 1 2 17.143z" />
                <path d="m15.137 13.219l-2.205 1.33l-1.033-1.713l2.205-1.33l.003-.002a1.2 1.2 0 0 0 .232-.182l5.01-5.036a3 3 0 0 0 .145-.157c.331-.386.821-1.15.228-1.746c-.501-.504-1.219-.028-1.684.381a6 6 0 0 0-.36.345l-.034.034l-4.94 4.965a1.2 1.2 0 0 0-.27.41l-.824 2.073a.2.2 0 0 0 .29.245l1.032 1.713c-1.805 1.088-3.96-.74-3.18-2.698l.825-2.072a3.2 3.2 0 0 1 .71-1.081l4.939-4.966l.029-.029c.147-.15.641-.656 1.24-1.02c.327-.197.849-.458 1.494-.508c.74-.059 1.53.174 2.15.797a2.9 2.9 0 0 1 .845 1.75a3.15 3.15 0 0 1-.23 1.517c-.29.717-.774 1.244-.987 1.457l-5.01 5.036q-.28.281-.62.487m4.453-7.126s-.004.003-.013.006z" />
              </g>
            </g>
          </svg>Edit</a>
      </div>

      <div class="ed" style="background-color: #f58a8a" data-id="{{$d->id}}">
        <a href="javascript:void(0)" class="delete-button" style="color: #a80000;">
          <svg class="edit" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
            <g fill="none" stroke="#a80000" stroke-width="2">
              <path stroke-linecap="round" d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79s-2.196.81-4.856.81h-.774c-2.66 0-3.991 0-4.856-.81c-.865-.809-.954-2.136-1.13-4.79l-.46-6.9" />
              <path d="M6.5 6h.11a2 2 0 0 0 1.83-1.32l.034-.103l.097-.291c.083-.249.125-.373.18-.479a1.5 1.5 0 0 1 1.094-.788C9.962 3 10.093 3 10.355 3h3.29c.262 0 .393 0 .51.019a1.5 1.5 0 0 1 1.094.788c.055.106.097.23.18.479l.097.291A2 2 0 0 0 17.5 6" />
            </g>
          </svg>Delete</a>
      </div>
    </div>
  </div>
      <div id="overlay" class="modal-overlay"></div>
    <div class="card">
      <div class="card-content">
        <p class="card-heading">Delete item?</p>
        <p class="card-description">Are you sure you want to delete this item? This action cannot be undone.</p>
      </div>
      <div class="card-button-wrapper">
        <button class="card-button secondary">Cancel</button>
        <a id="delete-link" href="#" class="card-button primary" style="text-align:center; display: flex; justify-content: center; align-items:center;">Delete</a>
      </div>
      <button class="exit-button">
        <svg height="20px" viewBox="0 0 384 512">
          <path
            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
          ></path>
        </svg>
      </button>
    </div>
  @endif
  @empty
  <div style="color: #fff; margin-top: 50px">No Inventory</div>
  @endforelse



</div>



<script>
  document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button');
    const deleteButtons2 = document.querySelectorAll('.delete-button-2');
    const modal = document.querySelector('.card');
    const overlay = document.querySelector('#overlay');
    const closeModalButtons = document.querySelectorAll('.exit-button, .card-button.secondary');
    
    // Loop through all delete buttons and add event listeners
    deleteButtons.forEach(button => {
      button.addEventListener('click', function() {
        // Get the data-id from the closest .ed container
        const id = this.closest('.ed').getAttribute('data-id');
        
        const deleteUrl = '/delete-product/' + id;
       
        
        // Set the delete URL dynamically in the delete link
        document.getElementById('delete-link').setAttribute('href', deleteUrl);

        // Show the modal and overlay
        modal.classList.add('active');
        overlay.classList.add('active');
      });
    });

     deleteButtons2.forEach(button => {
      button.addEventListener('click', function() {
        // Get the data-id from the closest .ed container
       
         const idd = this.closest('.del').getAttribute('data-id');
         const sizeId = this.closest('.del').getAttribute('data-sizeId');
       
        const deleteUrl2 = '/delete-uniforms/' + idd + '/' + sizeId;
        
        // Set the delete URL dynamically in the delete link
        
        document.getElementById('delete-link-2').setAttribute('href', deleteUrl2);

        // Show the modal and overlay
        modal.classList.add('active');
        overlay.classList.add('active');
      });
    });

    // Close modal when clicking on cancel buttons or the close icon
    closeModalButtons.forEach(button => {
      button.addEventListener('click', function() {
        modal.classList.remove('active');
        overlay.classList.remove('active');
      });
    });

    // Close modal if overlay is clicked
    overlay.addEventListener('click', function() {
      modal.classList.remove('active');
      overlay.classList.remove('active');
    });
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