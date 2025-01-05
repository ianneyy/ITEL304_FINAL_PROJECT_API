@extends('layout.admin_design')

@section('content')
<style>
  #nav-content-highlight {
    position: absolute;
    left: 10px;
    right: 10px;
    top: 128px;
    height: 54px;
    background-color: #636363;
    background-attachment: fixed;
    border-radius: 10px 10px 10px 10px;
    transition: top 0.2s;
    border: 1px solid #7b7b7b;
  }

  .container {
    position: absolute;
    top: 20px;
    height: auto;


    left: var(--navbar-width);
    /* Adjust left based on sidebar width */
    transition: width 0.3s ease, left 0.3s ease;
    /* Smooth transition */
    margin-left: 50px;
    font-family: "Signika", sans-serif;

  }

  label {
    color: #F9F6EE;
  }

  .container input,
  .container textarea {
    color: white;
    border: none;
  }
</style>
<link rel="stylesheet" href="../css/add_uniform.css">
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
        </svg><span style="color: #FFBD2E;">Inventory</span></a>
    </div>
      <div class="nav-button"><a href="{{ url('sales') }}" style="text-decoration: none; color: inherit;">

        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 48 48"><g fill="none" stroke="#FFBD2E" stroke-linejoin="round" stroke-width="4"><path d="M41 14L24 4L7 14v20l17 10l17-10z"/><path stroke-linecap="round" d="M24 22v8m8-12v12m-16-4v4"/></g></svg><span>Sales</span></a>
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
        </svg><span  id="footer-logout">Logout</span>

      </button>
    </form>
  </div>

</div>
</div>
<div class="container p-4 col-xl-9">

  <h2 style="color: #FFBD2E">Product Information</h2>
  <form action="{{ url('add-uniform') }}" method="post" enctype="multipart/form-data">
    @csrf
  
    <div class="product-info-wrapper p-4">
      <div class="mb-3">
        <label for="image-upload">Image</label>
        <input style="background-color: var(--navbar-dark-secondary); color: var(--secondary-color)" type="file" id="image-upload" name="image_url">
        <div class="info-wrapper w-75">
          <div class="pp-wrapper w-50">
            <div class="input-wrapper w-auto">
              <label class="text" for="product_name" class="placeholder">Product Name</label>
              <input class="input w-100" type="text" id="product_name" name="product_name" placeholder="Enter product name here" required>
            </div>
            <div class="input-wrapper w-auto">
              <label class="text" for="price" class="form-label">Price</label>
              <input class="input w-100" type="number" id="price" name="price" required>
            </div>
            <div class="input-wrapper w-auto">
              <label class="text" for="product_stock" class="form-label">Stock</label>
              <input class="input w-100" type="number" name="stocks" id="product_stock" name="product_stock">
            </div>
          </div>

          <div class="input-wrapper w-50">
            <label class="text" for="description" class="form-label">Description</label>
            <textarea class="input w-100" id="description" rows="3" placeholder="Enter product description" name="description"></textarea>
          </div>
        </div>
      </div>
    </div>

    <div id="variation-section">


    </div>
    <div class="variation-wrapper my-4 p-3">
      <h5>Variants</h5>
      <button id="add-variation"><i class="fa fa-plus"></i>ADD VARIATION</button>

    </div>

    <!-- <button type="button" class="btn btn-secondary hide-more-variation" id="add-variation" style="display: none;">Add More Variations</button> -->
    <div class="submit-btn">
      <button type="submit" class="subb btn mt-3" style="background-color:var(--primary-color); color: #F9F6EE">Submit</button>
    </div>
  </form>



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
  let index = 0;
  document.getElementById('add-variation').addEventListener('click', function() {
    index++;
    // Create a new variation input group
    const variationGroup = document.createElement('div');
    variationGroup.classList.add('variation-group', 'my-4', 'p-3');

    // Inner HTML for the variation group
    variationGroup.innerHTML = `
       <div class="variation-input">
       <div class="variation_img">
         <label for="sub-image-upload">Image</label>
        <input style="background-color: var(--navbar-dark-secondary); color: var(--secondary-color)" type="file" id="sub-image-upload-${index}" name="variations[${index}][sub_image_url]">
        </div>
          <div class="input-wrapper w-25 mb-4">
            <label class="text" for="variation-type" class="form-label">Variation Name</label>
            <input class="input w-100" type="text" name="variations[${index}][variation-type]" placeholder="Variation Name" required>
          </div>
          <div class="remove">
              <button  type="button" class="delete-variation btn">
                  <i class="fa-solid fa-x" style="color: #f58a8a"></i>
              </button>
          </div>
      </div>

      <div class="sizes mb-4">
        <div class="size-stock-container w-50">
          
          
        </div>
        <button type="button" class="mt-3 add-size"><i class="fa fa-plus"></i>Add Size</button>
      </div>
      
      
    `;

    // Append the new variation group to the variation section
    document.getElementById('variation-section').appendChild(variationGroup);

    variationGroup.querySelector('.delete-variation').addEventListener('click', function() {
      variationGroup.remove();
    });
    // Add event listener for adding more sizes
    variationGroup.querySelector('.add-size').addEventListener('click', function() {
      const sizeStockContainer = variationGroup.querySelector('.size-stock-container');



      const newSizeStockItem = document.createElement('div');
      newSizeStockItem.classList.add('size-stock-item');


      newSizeStockItem.innerHTML = `
        <div class="input-wrapper w-25">
            <label class="text" for="size" class="form-label">Size</label>
            <input class="input" type="text" name="variations[${index}][sizes][]" placeholder="Size">
        </div>
        <div class="input-wrapper w-25">
            <label class="text" for="stock" class="form-label">Stock</label>
            <input class="input" type="number" name="variations[${index}][stock][]" placeholder="Stock" min="0">
        </div>
        <div class="remove">
            <button  type="button" class="delete-size-stock btn">
                <i class="fa-solid fa-x" style="color: #f58a8a"></i>
            </button>
        </div>
    `;

      sizeStockContainer.appendChild(newSizeStockItem);



      newSizeStockItem.querySelector('.delete-size-stock').addEventListener('click', function() {
        newSizeStockItem.remove();
      });

    });

    // Event listener for deleting the variation

  });
</script>
@endsection