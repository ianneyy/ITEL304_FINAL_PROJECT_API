@extends('layout.design')

@section('content')
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
  integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer" />
<style>
  #nav-content-highlight {
    position: absolute;
    left: 10px;
    right: 10px;
    top: 20px;
    height: 54px;
    background-color: #efefef;
    background-attachment: fixed;
    border-radius: 10px 10px 10px 10px;
    transition: top 0.2s;
    border: 1px solid #bcbaba;
  }


  .container {
    position: absolute;
    height: auto;
    width: 100%;
    max-width: 1100px;
    background-color: #e8e8e8;
    border-radius: 10px;
    top: 100px;
    filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.2));
    left: var(--navbar-width);
    /* Adjust left based on sidebar width */
    transition: width 0.3s ease, left 0.3s ease;
    /* Smooth transition */
    margin-left: 50px;
    padding: 20px;
    font-family: "Signika", sans-serif;
  }
</style>
<div id="nav-bar">
  <input id="nav-toggle" type="checkbox" />
  <div id="nav-header"><a id="nav-title" target="_blank">LSPU-BAO</a>
    <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
    <hr />
  </div>
  <div id="nav-content">
    <div class="nav-button">
      <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
        <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 4l6 2v5h-3v8a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-8H3V6l6-2a3 3 0 0 0 6 0" />
      </svg><span style="color: #FFBD2E;">Uniforms</span>
    </div>

    <div class="nav-button">
      <a href="{{ url('student/reservation') }}" style="text-decoration: none; color: inherit;">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
          <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.5 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6M16 3v4M8 3v4m-4 4h16m-5 8l2 2l4-4" />
        </svg><span>My Reservation</span>
      </a>
    </div>

    <div class="nav-button"><a href="{{ url('student/size_guide') }}" style="text-decoration: none; color: inherit;">

        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
          <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19.875c0 .621-.512 1.125-1.143 1.125H5.143A1.134 1.134 0 0 1 4 19.875V4a1 1 0 0 1 1-1h5.857C11.488 3 12 3.504 12 4.125zM12 9h-2m2-3H9m3 6H9m3 6H9m3-3h-2M21 3h-4m2 0v18m2 0h-4" />
        </svg><span>Uniform Size Guide</span></a>
    </div>

    <div class="nav-button"><a href="{{ url('student/announcement') }}" style="text-decoration: none; color: inherit;">

        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
          <g fill="none" fill-rule="evenodd">
            <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
            <path fill="#FFBD2E" d="M19 4.741V8a3 3 0 1 1 0 6v3c0 1.648-1.881 2.589-3.2 1.6l-2.06-1.546A8.66 8.66 0 0 0 10 15.446v2.844a2.71 2.71 0 0 1-5.316.744l-1.57-5.496a4.7 4.7 0 0 1 3.326-7.73l3.018-.168a9.34 9.34 0 0 0 4.19-1.259l2.344-1.368C17.326 2.236 19 3.197 19 4.741M5.634 15.078l.973 3.407A.71.71 0 0 0 8 18.29v-3.01l-1.56-.087a5 5 0 0 1-.806-.115M17 4.741L14.655 6.11A11.3 11.3 0 0 1 10 7.604v5.819c1.787.246 3.488.943 4.94 2.031L17 17zM8 7.724l-1.45.08a2.7 2.7 0 0 0-.17 5.377l.17.015l1.45.08zM19 10v2a1 1 0 0 0 .117-1.993z" />
          </g>
        </svg><span>Announcements</span></a>
    </div>

    <div class="nav-button"><a href="{{ url('student/help') }}" style="text-decoration: none; color: inherit;">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
          <path fill="#FFBD2E" d="M11.95 18q.525 0 .888-.363t.362-.887t-.362-.888t-.888-.362t-.887.363t-.363.887t.363.888t.887.362m-.9-3.85h1.85q0-.825.188-1.3t1.062-1.3q.65-.65 1.025-1.238T15.55 8.9q0-1.4-1.025-2.15T12.1 6q-1.425 0-2.312.75T8.55 8.55l1.65.65q.125-.45.563-.975T12.1 7.7q.8 0 1.2.438t.4.962q0 .5-.3.938t-.75.812q-1.1.975-1.35 1.475t-.25 1.825M12 22q-2.075 0-3.9-.787t-3.175-2.138T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8" />
        </svg><span>Help/FAQs</span></a>
    </div>

    <div class="nav-button"><a href="{{ url('student/contact') }}" style="text-decoration: none; color: inherit;">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
          <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.6 14.522c-2.395 2.52-8.504-3.534-6.1-6.064c1.468-1.545-.19-3.31-1.108-4.609c-1.723-2.435-5.504.927-5.39 3.066c.363 6.746 7.66 14.74 14.726 14.042c2.21-.218 4.75-4.21 2.215-5.669c-1.268-.73-3.009-2.17-4.343-.767" />
        </svg><span>Contact Us</span></a>
    </div>

    <div id="nav-content-highlight"></div>
  </div>
  <input id="nav-footer-toggle" type="checkbox" />

</div>
</div>
<div class="container col-xl-9">


  @forelse($data as $d)
  <form action="{{ url('reservation-form')}}" method="post">
    @csrf
    <a href="{{url('student/uniforms')}}">
      <div class="arrow-back">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="3em"
          height="3em"
          viewBox="0 0 512 512">
          <path
            fill="none"
            stroke="#5a5a5a"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="48"
            d="M244 400L100 256l144-144M120 256h292" />
        </svg>
      </div>
    </a>
    <div class="wrapper">
      <div class="image-container">
        <div class="small-image-container">
          <div class="image-wrapper">
            <img
              class="sub-image"
              src="{{ '../' . $d->image_url }}"
              alt="Product Image" />
          </div>
          <div class="image-wrapper">
            <img
              class="sub-image"
              src="{{ '../' . $d->image_url }}"
              alt="Product Image" />
          </div>
          <div class="image-wrapper">
            <img
              class="sub-image"
              src="{{ '../' . $d->image_url }}"
              alt="Product Image" />
          </div>
        </div>
        <div class="main-image-wrapper">
          <img
            class="main-image"
            src="{{ '../' . $d->image_url }}"
            alt="" />
        </div>
        <input type="hidden" name="image_url" value="{{ $d->image_url }}">
      </div>
      <div class="details">
        <h2 name="name">{{ $d->name }}</h2>
        <h4 style="color: #1769ff; font-size: 20px;" name="price">&#8369;{{ $d->price }}</h4>
        <h5 style="font-size: 15px;">{{ $d->description }}</h5>
        <hr />
        <input type="hidden" name="name" value="{{ $d->name }}">
        <input type="hidden" name="price" value="{{ $d->price }}">

        @empty
        <p>No products available.</p>
        @endforelse
        <h6>VARIATION</h6>

        <div class="dept-list">

          @forelse($deptData as $department)
          <option class="option" data-id="{{ $department->id }}" onclick="changeBorderColor(this),selectDepartment(this)">{{ $department->variation_type }}</option>
          @empty
          <p>No department available.</p>
          @endforelse
          <input type="hidden" name="department" id="selected-department">
        </div>
        <h6>SIZE</h6>
        <div class="size-list">

          @forelse($sizeData as $size)
          <option class="sizeOption" data-id="{{ $size->id }}" onclick="changeSizeBorderColor(this), selectSize(this)" @if($size->stock <= 0) disabled @endif>{{ $size->size }}</option>
          @empty
          <p>No size available.</p>
          @endforelse
          <input type="hidden" name="size" id="selected-size">


        </div>
        <h6>QTY</h6>
        <div class="main-button">



          @if($d->stock > 0)
          <div class="qty">
            <span class="minus">-</span>
            <!-- <span class="num" name="qty">01</span> -->

            <input type="number" name="qty" class="num" value="1" min="1" max="{{ $d->stock}}">

            <span class="plus">+</span>
          </div>
          @else
          @php
          $hasStock = false;
          @endphp

          @foreach ($sizeData as $size)
          @if($size->stock > 0)
          @php
          $hasStock = true;
          @endphp
          @break
          @endif
          @endforeach
          @if($hasStock)
          <div class="qty">
            <span class="minus">-</span>
            <!-- <span class="num" name="qty">01</span> -->

            <input type="number" name="qty" class="num" value="1" min="1" max="10">

            <span class="plus">+</span>
          </div>
          @else
          <p>Out of Stock</p>
          @endif
          @endif
          <div class="sub-btn">



            @if($d->stock > 0)
            <button type="submit" name="action" class="add-cart-btn" value="add_to_cart">ADD TO CART</button>
            <button type="submit" name="action" class="reserve-btn" value="reserve_now">RESERVE NOW</button>
            @else
            @php
            $hasStock = false;
            @endphp
            @foreach ($sizeData as $size)
            @if($size->stock > 0)
            @php
            $hasStock = true;
            @endphp
            @break
            @endif
            @endforeach

            @if($hasStock)
            <button type="submit" name="action" class="add-cart-btn" value="add_to_cart">ADD TO CART</button>
            <button type="submit" name="action" class="reserve-btn" value="reserve_now">RESERVE NOW</button>
            @else
            <button type="submit" name="action" class="wishlist-btn" value="add_to_wishlist">
              <i class="fa-regular fa-heart heart-reg" style="margin-right: 5px;"></i>
              ADD TO WISHLIST
            </button>
            @endif
            @endif

          </div>
        </div>
      </div>

    </div>
  </form>

</div>

@if(session('cart_success'))
<div class="success" style="display: flex;">
    <div class="success__icon">
      <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="m12 1c-6.075 0-11 4.925-11 11s4.925 11 11 11 11-4.925 11-11-4.925-11-11-11zm4.768 9.14c.0878-.1004.1546-.21726.1966-.34383.0419-.12657.0581-.26026.0477-.39319-.0105-.13293-.0475-.26242-.1087-.38085-.0613-.11844-.1456-.22342-.2481-.30879-.1024-.08536-.2209-.14938-.3484-.18828s-.2616-.0519-.3942-.03823c-.1327.01366-.2612.05372-.3782.1178-.1169.06409-.2198.15091-.3027.25537l-4.3 5.159-2.225-2.226c-.1886-.1822-.4412-.283-.7034-.2807s-.51301.1075-.69842.2929-.29058.4362-.29285.6984c-.00228.2622.09851.5148.28067.7034l3 3c.0983.0982.2159.1748.3454.2251.1295.0502.2681.0729.4069.0665.1387-.0063.2747-.0414.3991-.1032.1244-.0617.2347-.1487.3236-.2554z" fill="#393a37" fill-rule="evenodd"></path></svg>
    </div>
    <div class="success__title">Item added to cart successfuly</div>
    <div class="success__close"><svg height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z" fill="#393a37"></path></svg></div>
</div>
@endif
<div class="bottom-nav">
  <a href="{{ url('uniforms') }}" style="text-decoration: none; color: inherit;">
    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
      <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 4l6 2v5h-3v8a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-8H3V6l6-2a3 3 0 0 0 6 0" />
    </svg></a>


  <a href="{{ url('reservation') }}" style="text-decoration: none; color: inherit;">
    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
      <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.5 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6M16 3v4M8 3v4m-4 4h16m-5 8l2 2l4-4" />
    </svg></a>

  <a href="{{ url('size_guide') }}" style="text-decoration: none; color: inherit;">
    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
      <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19.875c0 .621-.512 1.125-1.143 1.125H5.143A1.134 1.134 0 0 1 4 19.875V4a1 1 0 0 1 1-1h5.857C11.488 3 12 3.504 12 4.125zM12 9h-2m2-3H9m3 6H9m3 6H9m3-3h-2M21 3h-4m2 0v18m2 0h-4" />
    </svg></a>

  <a href="{{ url('announcement') }}" style="text-decoration: none; color: inherit;">

    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
      <g fill="none" fill-rule="evenodd">
        <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
        <path fill="#FFBD2E" d="M19 4.741V8a3 3 0 1 1 0 6v3c0 1.648-1.881 2.589-3.2 1.6l-2.06-1.546A8.66 8.66 0 0 0 10 15.446v2.844a2.71 2.71 0 0 1-5.316.744l-1.57-5.496a4.7 4.7 0 0 1 3.326-7.73l3.018-.168a9.34 9.34 0 0 0 4.19-1.259l2.344-1.368C17.326 2.236 19 3.197 19 4.741M5.634 15.078l.973 3.407A.71.71 0 0 0 8 18.29v-3.01l-1.56-.087a5 5 0 0 1-.806-.115M17 4.741L14.655 6.11A11.3 11.3 0 0 1 10 7.604v5.819c1.787.246 3.488.943 4.94 2.031L17 17zM8 7.724l-1.45.08a2.7 2.7 0 0 0-.17 5.377l.17.015l1.45.08zM19 10v2a1 1 0 0 0 .117-1.993z" />
      </g>
    </svg></a>

  <a href="{{ url('help') }}" style="text-decoration: none; color: inherit;">
    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
      <path fill="#FFBD2E" d="M11.95 18q.525 0 .888-.363t.362-.887t-.362-.888t-.888-.362t-.887.363t-.363.887t.363.888t.887.362m-.9-3.85h1.85q0-.825.188-1.3t1.062-1.3q.65-.65 1.025-1.238T15.55 8.9q0-1.4-1.025-2.15T12.1 6q-1.425 0-2.312.75T8.55 8.55l1.65.65q.125-.45.563-.975T12.1 7.7q.8 0 1.2.438t.4.962q0 .5-.3.938t-.75.812q-1.1.975-1.35 1.475t-.25 1.825M12 22q-2.075 0-3.9-.787t-3.175-2.138T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8" />
    </svg></a>

  <a href="{{ url('contact') }}" style="text-decoration: none; color: inherit;">
    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 24 24">
      <path fill="none" stroke="#FFBD2E" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.6 14.522c-2.395 2.52-8.504-3.534-6.1-6.064c1.468-1.545-.19-3.31-1.108-4.609c-1.723-2.435-5.504.927-5.39 3.066c.363 6.746 7.66 14.74 14.726 14.042c2.21-.218 4.75-4.21 2.215-5.669c-1.268-.73-3.009-2.17-4.343-.767" />
    </svg></a>
</div>


<script>

   document.addEventListener('DOMContentLoaded', function () {
    const successDiv = document.querySelector('.success');
    if (successDiv) {
        setTimeout(() => {
            successDiv.style.display = 'none';
        }, 3000); // Hide after 3 seconds
    }
});


  function selectDepartment(element) {
    document.getElementById('selected-department').value = element.getAttribute('data-id');
    // Optionally update button appearance to indicate selection
  }

  // Function to select the size
  function selectSize(element) {
    document.getElementById('selected-size').value = element.getAttribute('data-id');
    // Optionally update button appearance to indicate selection
  }







  document.querySelectorAll('.plus').forEach(button => {
    button.addEventListener('click', () => {
      const input = button.previousElementSibling;
      const max = parseInt(input.getAttribute('max'), 10);
      let currentValue = parseInt(input.value, 10);
      if (currentValue < max) {
        input.value = currentValue + 1;
      }
    });
  });

  document.querySelectorAll('.minus').forEach(button => {
    button.addEventListener('click', () => {
      const input = button.nextElementSibling;
      const min = parseInt(input.getAttribute('min'), 10);
      let currentValue = parseInt(input.value, 10);
      if (currentValue > min) {
        input.value = currentValue - 1;
      }
    });
  });

  function changeBorderColor(element) {
    // Reset the border-bottom of all .option elements
    const options = document.querySelectorAll('.option');
    options.forEach(option => {
      option.style.borderBottom = '1px solid #9f9f9f70';
      option.style.color = '#5d5d5d';
    });

    // Apply the border-bottom to the clicked element
    element.style.borderBottom = '3px solid #ffbd2e';
    element.style.color = '#ffbd2e'; // Set the new border color
  }

  function changeSizeBorderColor(element) {
    // Reset the border-bottom of all .option elements
    const options = document.querySelectorAll('.sizeOption');
    options.forEach(option => {
      option.style.borderBottom = '1px solid #9f9f9f70';
      option.style.color = '#5d5d5d';
    });

    // Apply the border-bottom to the clicked element
    element.style.borderBottom = '3px solid #ffbd2e';
    element.style.color = '#ffbd2e'; // Set the new border color
  }
</script>
@endsection