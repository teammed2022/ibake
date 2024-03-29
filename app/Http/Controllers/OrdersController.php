<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\DeliveryFee;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrderItemsController;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\CustomizeOrderDetail;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
{
  //dd($request);
    $coupon = $request->couponCode;
    $originalPrice = $request->totalPrice;
    $discountApplied = $request->discountApplied;
    $discountedAmount = $request->discountedAmount;


    $user = Auth::user();
    $cartItems = (new CartsController())->userCart();

    // Check if the token is already in the session
    $token = session('payment_token');

    if (!$token) {
        // Generate and store the token in the session
        $token = Str::random(32);
        session(['payment_token' => $token]);
    }


    if ($cartItems->isEmpty()) {
        return redirect()->back()->withErrors(['cart' => 'Cannot proceed to checkout. There are no items in the cart.']);
    }

    $totalPrice = 0;
    foreach ($cartItems as $cartItem) {
        $totalPrice += ($cartItem->price * $cartItem->quantity);
    }

    $deliveryFees = DeliveryFee::all();

    return view('checkout.checkout')->with([
        'user' => $user,
        'cartItems' => $cartItems,
        'totalPrice' => $totalPrice,
        'token' => $token,
        'deliveryFees' => $deliveryFees,
        'coupon' => $coupon,
        'discountApplied' => $discountApplied,
        'discountedAmount' => $discountedAmount,
    ]);
}




  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreOrdersRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $token)
  {

    // Check token to prevent resubmission of payment and order storing
    if($token === $request->session()->get('payment_token')) {


        // Retrieve PayMongo Payment IDs
        $paymentSessionId = Session::get('paymentSession_id');
        $paymentIntentId = Session::get('paymentIntent_id');

        // Retrieve Orders form data from the session
        $orderData = $request->session()->get('order_data');

        $recipientName = $orderData['recipient_name'];
        $streetAddress = $orderData['street_address'];
        //$town = $orderData['town'];
        $province = $orderData['province'];
        $postcode = $orderData['postcode'];
        $recipientEmail = $orderData['recipient_email'];
        $recipientPhone = $orderData['recipient_phone'];
        $shippingMethod = $orderData['shipping_method'];
        $deliveryDate = $orderData['delivery_date'];
        $deliveryTime = $orderData['delivery_time'];
        $paymentMethod = $orderData['payment_method'];
        $orderNotes = $orderData['order_notes'];


            // Check if 'town' exists in the session
        if (isset($orderData['town'])) {
          $town = $orderData['town'];
        } else {
          // Set a default value if 'town' doesn't exist in the session
          $town = null;
        }

        if($shippingMethod == 'Delivery'){
          $address = $streetAddress . ',' . $town . ',' . $province . ',' . $postcode;
        }else{
          $address = "";
        }


        //check order total price
        $cartItems = (new CartsController())->userCart();
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
          $totalPrice += ($cartItem->price * $cartItem->quantity);
        }
        //update all ordered products available qty in products table and if qty reach 0 will update availabilty status
        foreach ($cartItems as $cartItem) {
          $newQty = $cartItem->available_qty - $cartItem->quantity;
          $ordered_product_id = $cartItem->product_id;
      
          Product::where('id', $ordered_product_id)->update(['available_qty' => $newQty]);
      
          if ($newQty === 0 || $cartItem->available_qty === null) {
              Product::where('id', $ordered_product_id)->update(['availability' => 0]);
          }
        }
      

        //store data to orders table
        $order = Order::create([
          'user_id' => Auth::id(),
          'order_id' => date("sdmY"),
          'recipient_name' => $recipientName,
          'recipient_email' => $recipientEmail,
          'recipient_phone' => $recipientPhone,
          'shipping_method' => $shippingMethod,
          'delivery_date' => $deliveryDate,
          'delivery_time' => $deliveryTime,
          'delivery_address' => $address,
          'total_price' => $totalPrice,
          'payment_method' => $paymentMethod,
          'payment_status' => 'Fully Paid',
          'payment_session_id' => $paymentSessionId,
          'payment_intent_id' => $paymentIntentId,
          'notes' => $orderNotes,
          'created_at' => now(),
        ]);

        //store data to order_items table
        $orderItem = new OrderItemsController();
        $orderId = $order->id;
        foreach ($cartItems as $cartItem) {
          $productId = $cartItem->product_id;
          $price = $cartItem->price;
          $quantity = $cartItem->quantity;
          $orderItem->store($orderId, $productId, $price, $quantity);
        }

        //Delete items in the Cart
        // Get the user's cart ID
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        // Delete all cart items associated with the user's cart
        CartItem::where('cart_id', $cart->id)->delete();

        // Clear the session variable if needed
        $request->session()->forget('order_data');
        $request->session()->forget('check_token');
        $request->session()->forget('payment_token');
        session()->forget(['paymentSession_id', 'paymentIntent_id']);

        return redirect()->route('customer');

    }else{
      return redirect()->route('shop');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function show(Order $orders)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function edit(Order $orders)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateOrdersRequest  $request
   * @param  \App\Models\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateOrdersRequest $request, Order $orders)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function destroy(Order $orders)
  {
    //
  }



  /**
   * Show the active orders on by accessing
   * thorough the sidebar.
   *
   */
  function activeOrders(Request $request)
  {
    // Active Shop Orders
    $activeOrders = Order::where('order_status', 'Pending')
        ->with('orderItems.product');

        if (isset($request->sort_by) && isset($request->order_by)) {
          $activeOrders = $activeOrders->orderBy($request->sort_by, $request->order_by);
      }

    $activeOrders = $activeOrders->paginate(10); // Adjust the number of items per page

    // Active Custom Cake Orders
    $activeCustomOrders = CustomizeOrderDetail::where('order_status', 'Pending')
    ->with('user') ;

    if (isset($request->sort_by) && isset($request->order_by)) {
      $activeCustomOrders = $activeCustomOrders->orderBy($request->sort_by, $request->order_by);
    }

    $activeCustomOrders = $activeCustomOrders->paginate(10); // Adjust the number of items per page

    return view('admin.pages.orders.active-orders')->with([
        'activeOrders' => $activeOrders,
        'activeCustomOrders' => $activeCustomOrders,
    ]);
  }

  function ongoingOrders(Request $request)
{
    // Ongoing Shop Orders
    $ongoingOrders = Order::where('order_status', 'Processing')
        ->with('orderItems.product');

        if (isset($request->sort_by) && isset($request->order_by)) {
          $ongoingOrders = $ongoingOrders->orderBy($request->sort_by, $request->order_by);
      }
      

    $ongoingOrders = $ongoingOrders->paginate(10); // Adjust the number of items per page

    // Ongoing Custom Cake Orders
    $ongoingCustomOrders = CustomizeOrderDetail::where('order_status', 'Processing');

    if (isset($request->sort_by) && isset($request->order_by)) {
      $ongoingCustomOrders = $ongoingCustomOrders->orderBy($request->sort_by, $request->order_by);
    }

    $ongoingCustomOrders = $ongoingCustomOrders->paginate(10); // Adjust the number of items per page

    $orderDetails = CustomizeOrderDetail::where('order_status', 'Processing')
        ->with('CustomizeOrder')
        ->get();

    return view('admin.pages.orders.ongoing-orders')->with([
        'ongoingOrders' => $ongoingOrders,
        'ongoingCustomOrders' => $ongoingCustomOrders,
        'orderDetails' => $orderDetails,
    ]);
}


function completedOrders(Request $request)
  {
    // Completed Shop Orders
    $completedOrders = Order::where('order_status', 'Completed')
        ->with('orderItems.product');

        if (isset($request->sort_by) && isset($request->order_by)) {
          $completedOrders = $completedOrders->orderBy($request->sort_by, $request->order_by);
        }

    $completedOrders = $completedOrders->paginate(10); // Adjust the number of items per page

    // Completed Custom Cake Orders
    $completedCustomOrders = CustomizeOrderDetail::where('order_status', 'Completed');

    if (isset($request->sort_by) && isset($request->order_by)) {
      $completedCustomOrders = $completedCustomOrders->orderBy($request->sort_by, $request->order_by);
    }

    $completedCustomOrders = $completedCustomOrders->paginate(10); // Adjust the number of items per page

    $orderDetails = CustomizeOrderDetail::where('order_status', 'Completed')
        ->with('CustomizeOrder')
        ->get();

    return view('admin.pages.orders.completed-orders')->with([
        'completedOrders' => $completedOrders,
        'completedCustomOrders' => $completedCustomOrders,
        'orderDetails' => $orderDetails,
    ]);
  }



  function readyOrders(Request $request)
  {
    // Ready Shop Orders
    $readyOrders = Order::where('order_status', 'On Delivery')
        ->with('orderItems.product');

        if (isset($request->sort_by) && isset($request->order_by)) {
          $readyOrders = $readyOrders->orderBy($request->sort_by, $request->order_by);
        }

    $readyOrders = $readyOrders->paginate(10); // Adjust the number of items per page

    // Ready Custom Cake Orders
    $readyCustomOrders = CustomizeOrderDetail::where('order_status', 'On Delivery');

    if (isset($request->sort_by) && isset($request->order_by)) {
      $readyCustomOrders = $readyCustomOrders->orderBy($request->sort_by, $request->order_by);
    }

    $readyCustomOrders = $readyCustomOrders->paginate(10); // Adjust the number of items per page

    $orderDetails = CustomizeOrderDetail::where('order_status', 'Completed')
        ->with('CustomizeOrder')
        ->get();

    return view('admin.pages.orders.ready-orders')->with([
        'readyOrders' => $readyOrders,
        'readyCustomOrders' => $readyCustomOrders,
        'orderDetails' => $orderDetails,
    ]);
  }

  function cancelledOrders(Request $request)
  {
    // Cancelled Shop Orders
    $cancelledOrders = Order::where('order_status', 'Cancelled')
        ->with('orderItems.product');

        if (isset($request->sort_by) && isset($request->order_by)) {
          $cancelledOrders = $cancelledOrders->orderBy($request->sort_by, $request->order_by);
        }

    $cancelledOrders = $cancelledOrders->paginate(10); // Adjust the number of items per page

    // Cancelled Custom Cake Orders
    $cancelledCustomOrders = CustomizeOrderDetail::where('order_status', 'Cancelled');

    if (isset($request->sort_by) && isset($request->order_by)) {
      $cancelledCustomOrders = $cancelledCustomOrders->orderBy($request->sort_by, $request->order_by);
    }

    $cancelledCustomOrders = $cancelledCustomOrders->paginate(10); // Adjust the number of items per page

    $orderDetails = CustomizeOrderDetail::where('order_status', 'Completed')
        ->with('CustomizeOrder')
        ->get();

    return view('admin.pages.orders.cancelled-orders')->with([
        'cancelledOrders' => $cancelledOrders,
        'cancelledCustomOrders' => $cancelledCustomOrders,
        'orderDetails' => $orderDetails,
    ]);
  }
 


}
