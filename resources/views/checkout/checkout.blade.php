<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>iBake - Tiers of Joy | Checkout</title>

  <!-- Stylesheets -->
  @include('partials.head')
</head>

<body>

  <div class="page-wrapper">

    <!-- Preloader -->
    @include('partials.preloader')

    <!-- Main Header-->
    @include('partials.navbar')
    <!--End Main Header -->

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/background-6.jpg)">
      <div class="auto-container">
        <h1>Checkout</h1>
        <ul class="page-breadcrumb">
          <li><a href="/">home</a></li>
          <li>Checkout</li>
        </ul>
      </div>
    </section>
    <!--End Page Title-->

    <!--CheckOut Page-->
    <section class="checkout-page">
      <div class="auto-container">
        <!--Default Links-->
        <div class="default-links">
          <div class="message-box with-icon warning">
            <div class="icon-box"><span class="icon fa fa-warning"></span></div> Thank you for choosing iBake! Please note that we only deliver to all areas within Nueva Vizcaya.
             <br>You can also pick up your order at our <a href="{{ route('faqs') }}" target="_blank">shop</a>. 
             <button class="close-btn"><span class="fa fa-times"></span></button>
          </div>
        </div>


        <!--Checkout Details-->
        <div class="checkout-form-container">
          <div class="sec-title">
            <h3>Checkout details</h3>
          </div>
          <form method="POST" action="{{ route('placeOrder') }}" class="checkout-form">
            @CSRF

            <input type="hidden" name="check_token" value="{{ $token }}">
            
            <div class="row clearfix">
              <!--Column-->
              <div class="column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Recipient's Name <sup>*</sup></div>
                    <input type="text" name="recipient_name" value="{{ $user->firstname . ' ' . $user->lastname }}"
                      placeholder="">
                                        @error('recipient_name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Delivery address <sup>*</sup><sup style="font-style: italic; color: #5fcac7; font-size: smaller;"> Required for Delivery</sup></div>
                    <input type="text" name="street_address" value="" placeholder="Unit No./Building Name/Street/Barangay">
                                        @error('street_address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                  </div>

                  <!-- Form Group -->
                  <div class="form-group">
                      <div class="field-label">Town / City <sup>*</sup><sup style="font-style: italic; color: #5fcac7; font-size: smaller;"> Required for Delivery</sup></div>
                      <select name="town" id="town-select">
                          <option value="" disabled selected>Select</option>
                          @foreach ($deliveryFees as $town)
                              <option value="{{ $town->town }}" data-fee="{{ $town->fee }}">{{ $town->town }}</option>
                          @endforeach
                      </select>
                      @error('town')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>


                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Province </div>
                    <input type="text" name="province" value="Nueva Vizcaya" placeholder="" readonly>
                                        @error('province')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Postcode/ ZIP <sup style="font-style: italic; color: #5fcac7; font-size: smaller;"> Optional but recommended</sup></div>
                    <input type="text" name="postcode" value="" placeholder="">
                                        @error('postcode')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Coupon Code</div>
                    <input type="text" name="couponcode" value="{{ isset($coupon) ? $coupon : '' }}" readonly>

             
                  </div>

                </div>
              </div>

              <!--Column-->
              <div class="column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Email Address <sup>*</sup></div>
                    <input type="text" name="recipient_email" value="{{ $user->email }}" placeholder="">
                                        @error('recipient_email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Phone Number <sup>*</sup></div>
                    <input type="text" name="recipient_phone" value="{{ $user->phone }}" placeholder="">
                                        @error('recipient_phone')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Shipping Options <sup>*</sup></div>
                    <div style="display: flex; justify-content: space-between;">
                      <div style="width: 48%;">
                        <div class="radio-option">
                          <input type="radio" name="shipping_method" id="shipping-1" value="Pickup" checked>
                          <label for="shipping-2">Pick-Up</label>
                        </div>
                      </div>
                      <div style="width: 48%;">
                        <div class="radio-option">
                          <input type="radio" name="shipping_method" id="shipping-2" value="Delivery">
                          <label for="shipping-1">Delivery</label>
                        </div>
                      </div>
                    </div>
                                        @error('shipping_method')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                  </div>

                  <!--Form Group-->
                  <div class="form-group ">
                    <div class="field-label">Delivery/Pick-up Date <sup>*</sup></div>
                    <input type="date" id="delivery-date" name="delivery_date">
                                        @error('delivery_date')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                  </div>

                  <!--Form Group-->
                  <div class="form-group">
                    <div class="field-label">Delivery/Pick-up Time <sup>*</sup></div>
                    <input type="time" id="delivery-time" name="delivery_time" value="08:00">
                                        @error('delivery_time')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                  </div>

                  <!--Form Group-->
                  <div class="form-group ">
                    <div class="field-label">Order notes (optional)</div>
                    <textarea class="" name="order_notes"
                      placeholder="Notes about your order,e.g. special notes for delivery."></textarea>
                                        @error('order_notes')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                  </div>

                </div>
              </div>
            </div>
            <!--End Checkout Details-->

            <!--Order Box-->
            <div class="order-box">
                  @if(session('error'))
                      <div class="alert alert-danger">
                          {!! session('error') !!}
                      </div>
                  @endif


              <table>
                <thead>
                  <tr>
                    <th class="product-name">Product</th>
                    <th class="product-total">Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($cartItems as $cartItem)
                  <tr class="cart-item">
                    <td class="product-name"><img src="{{ asset($cartItem->image) }}" alt=""
                        style="width: 80px; height: 80px;">&nbsp;&nbsp;{{ $cartItem->name }}&nbsp;
                      <strong class="product-quantity">× {{ $cartItem->quantity }}</strong>
                    </td>
                    <td class="product-total">
                      <span class="woocommerce-Price-amount amount"><span
                          class="woocommerce-Price-currencySymbol"></span>{{ number_format($cartItem->price * $cartItem->quantity, 2) }}</span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr class="cart-subtotal">
                    <th>Subtotal</th>
                    <td><span class="amount">{{ number_format($totalPrice, 2) }}</span></td>
                  </tr>

                  <tr class="cart-subtotal">
                    <th>Delivery Fee</th>
                    <td><span id="delivery-fee">0</span></td>
                  </tr>
                  @if(isset($discountApplied))
                  <tr class="cart-subtotal">
                    <th>Coupon Discount</th>
                    <td><span class="amount">({{$discountApplied}})</span></td>
                  </tr>

                  <input type="hidden" id="discount" name="discount" value="{{$discountApplied}}">
                  @endif

                  <input type="hidden" id="selected-fee" name="selected_fee" value="0">
                  


                  @php
                      $totalPayment = $totalPrice + (isset($deliveryFee) ? $deliveryFee : 0) - $discountApplied;
                  @endphp




                  <tr class="order-total">
                    <th><strong>Total Payment</strong></th>
                    <td><strong id="total-payment" class="amount">Php {{ number_format($totalPayment, 2) }}</strong></td>
                  </tr>

                </tfoot>
              </table>
            </div>
            <!--End Order Box-->

            <!--Payment Box-->
            <div class="payment-box">
              <div class="upper-box">
                <!--Payment Options-->
                <div class="payment-options">
                    <div class="text">The shipping fee is not included in the total price. 
                      You will pay the shipping fee when you receive your order. For more information, please see our <a href="{{route('terms')}}" target="_blank">Terms & Services.</a></div><br>
                  <ul>
                    <li>
                      <div class="radio-option">
                        <input type="radio" name="payment_method" id="payment-1" value="wallet" checked>
                        <label for="payment-1"><strong>Digital Wallets</strong><span class="small-text">
                        Pay with your favorite digital wallet, such as GCash and Maya. Please use your Order ID as the payment reference. 
                        Your order won’t be shipped until the funds have cleared in our account.</span></label>
                      </div>
                    </li>
                    
                    <li>
                      <div class="radio-option">
                        <input type="radio" name="payment_method" id="payment-2" value="card">
                        <label for="payment-2"><strong>Credit Or Debit Card</strong><span class="small-text">
                        We accept Visa and Mastercard debit and credit cards, make your payment directly using your card details. 
                        Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</span></label>
                      </div>
                    </li>

                    <li>
                      <div class="radio-option">
                        <input type="radio" name="payment_method" id="payment-3" value="bank">
                        <label for="payment-3"><strong>Online Banking</strong><span class="small-text">
                        Make your payment directly using your online banking account. Please use your Order ID as the payment reference. 
                        Your order won’t be shipped until the funds have cleared in our account.</span></label>
                      </div>
                    </li>

                  </ul>
                  <div class="text">Your personal data will be used to process your order, support your experience
                    throughout this website, and for other purposes described in our <a href="{{ route('privacy') }}" target="_blank">Privacy policy.</a></div>
                </div>
              </div>
              <div class="lower-box">
                <button type="submit" class="theme-btn" id="checkout-btn"><span class="btn-title">Place
                    Order</span></button>
              </div>
            </div>
          </form>
          <!--End Payment Box-->
        </div>
      </div>
    </section>
    <!--End CheckOut Page-->

    <!-- Main Footer -->
    @include('partials.footer')
    <!-- End Footer -->

  </div><!-- End Page Wrapper -->

  <!-- Scroll To Top -->
  @include('partials.scroll-to-top')

  <!-- Date of Delivery Validation (2 Days from today) -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const deliveryDateInput = document.getElementById("delivery-date");

      // Get today's date
      const today = new Date();
      
      // Calculate the minimum date (e.g., 1 day from today)
      const minDate = new Date(today);
      minDate.setDate(today.getDate() + 1);

      // Format the minimum date in 'YYYY-MM-DD' format
      const year = minDate.getFullYear();
      const month = String(minDate.getMonth() + 1).padStart(2, "0");
      const day = String(minDate.getDate()).padStart(2, "0");
      const minDateString = `${year}-${month}-${day}`;
      
      // Set the minimum attribute of the input field
      deliveryDateInput.min = minDateString;

      // Check if the selected date is a Sunday
      function isSunday(date) {
        return date.getDay() === 0; // 0 corresponds to Sunday
      }

      // Add an event listener to the input
      deliveryDateInput.addEventListener("click", function() {
        // Set the default date (e.g., 1 day from today)
        const defaultDate = new Date(today);
        defaultDate.setDate(today.getDate() + 1);

        // Format the default date in 'YYYY-MM-DD' format
        const year = defaultDate.getFullYear();
        const month = String(defaultDate.getMonth() + 1).padStart(2, "0");
        const day = String(defaultDate.getDate()).padStart(2, "0");
        const formattedDate = `${year}-${month}-${day}`;

        // Set the value of the input to the default date
        deliveryDateInput.value = formattedDate;
      });

      // Add an event listener to check the selected date on change
      deliveryDateInput.addEventListener("change", function() {
        const selectedDate = new Date(this.value);

        if (selectedDate < minDate) {
          alert("Delivery/Pickup date should be at least two days from today.");
          this.value = ""; // Clear the input value
        }

        // Check if the selected date is a Sunday and show an alert
        if (isSunday(selectedDate)) {
          alert("The shop is closed on Sundays. Please select a different date.");
          this.value = ""; // Clear the input value
        }
      });
    });
  </script>




  <!-- Time of Delivery Validation (8 am to 5:30 pm) -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const deliveryTimeInput = document.getElementById("delivery-time");

      // Set the range for valid delivery times (8 AM to 6 PM)
      const validStartTime = new Date();
      validStartTime.setHours(8, 0, 0, 0); // 8:00 AM

      const validEndTime = new Date();
      validEndTime.setHours(17, 30, 0, 0); // 5:30 PM

      // Add an event listener to check the selected time on change
      deliveryTimeInput.addEventListener("change", function() {
        const selectedTimeParts = this.value.split(":");
        const selectedTime = new Date();
        selectedTime.setHours(parseInt(selectedTimeParts[0]), parseInt(selectedTimeParts[1]), 0, 0);

        if (selectedTime < validStartTime || selectedTime > validEndTime) {
          alert("Delivery/Pickup time should be between 8:00 AM and 5:30 PM.");
          this.value = "08:30"; // Reset the time to the default value
        }
      });
    });
  </script>

    <!-- JavaScript to display prompt message when delivery is ticked -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const deliveryRadio = document.getElementById("shipping-2");
      deliveryRadio.addEventListener("change", function() {
        if (this.checked) {
          // Display the prompt message
          alert("Please note that the shipping fee is not yet included in the total price. It will be added to your total due when you receive your order.");
        }
      });
    });
  </script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // On change event of the town dropdown
    $('#town-select').on('change', function () {
      var selectedTown = $(this).val();
      var selectedFee = $('#town-select option:selected').data('fee');

      // Update the displayed delivery fee
      $('#delivery-fee').text(selectedFee);

      // Store the selected fee in the hidden input field
      $('#selected-fee').val(selectedFee);

      // Update the total payment
      updateTotalPayment();
    });

    // Function to update the total payment
    function updateTotalPayment() {
      var totalPrice = parseFloat("{{ $totalPrice }}");
      var deliveryFee = parseFloat($('#selected-fee').val());
      var discountApplied = parseFloat("{{ $discountApplied ?? 0 }}");

      // Calculate the total payment
      var totalPayment = (totalPrice - discountApplied) + (isNaN(deliveryFee) ? 0 : deliveryFee);

      // Update the displayed total payment
      $('#total-payment').text('Php ' + totalPayment.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));

    }

    // Initial update when the page loads
    updateTotalPayment();
  });
</script>



  <script src="js/jquery.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.fancybox.js"></script>
  <script src="js/owl.js"></script>
  <script src="js/wow.js"></script>
  <script src="js/appear.js"></script>
  <script src="js/select2.min.js"></script>
  <script src="js/sticky_sidebar.min.js"></script>
  <script src="js/script.js"></script>
  <script src="{{ asset('js/cart.js') }}?v={{ filemtime(public_path('js/cart.js')) }}"></script>
</body>

</html>
