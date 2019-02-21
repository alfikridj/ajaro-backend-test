<?php

namespace App\Http\Controllers;

use App\Address;
use App\OrderDetail;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Route;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{

    public function __construct()
    {

    }

    /*--------------------------------
    ------------ Order ---------------
    --------------------------------*/

    public function create_order(Request $request)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $message = 'sorry, you are admin';
            return response()->json(compact('message'),404);
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {

            if (Route::currentRouteName() == 'order.create') {
                $validator = Validator::make($request->only([
                    'user_id',
//                    'amount',
                    'address_id'
//                    'shipping',
//                    'tax'
                ]), [
                    'user_id' => 'required|integer',
//                    'amount' => 'required|string',
                    'address_id' => 'required|integer',
//                    'shipping' => 'required|string',
//                    'tax' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(),400);
                }

                $userId = $request->get('user_id');
                $addressId = $request->get('address_id');
                $findUserId = User::where('id', $userId)->where('role', 'customer')->get();
                $findAddressId = Address::where('id', $addressId)->get();

                if ($findUserId->isEmpty()) {
                    $message = 'the user id does not exist';
                    return response()->json(compact('message'), 404);
                } else {
                    if ($findAddressId->isEmpty()) {
                        $message = 'the address id does not exist';
                        return response()->json(compact('message'), 404);
                    } else {
                        $data = Order::create([
                            'user_id' => $userId,
                            'amount' => '',
                            'address_id' => $addressId,
                            'shipping' => '',
                            'tracking_number' => '',
                            'tax' => '',
                        ]);

                        $data = Order::where('order.id', $data->id)
                            ->where('order.user_id', $data->user_id)
                            ->where('order.address_id', $data->address_id)
                            ->join('users', 'users.id', '=', 'order.user_id')
                            ->join('address', 'address.id', '=', 'order.user_id')
                            ->select('order.*', 'users.name as user_name', 'address.city as address_city')
                            ->first();

                        return response()->json(compact('data'),200);
                    }
                }
            } else if (Route::currentRouteName() == 'order.detail.create') {
                $validator = Validator::make($request->only([
                    'order_id',
                    'product_id',
                    'quantity'
                ]), [
                    'order_id' => 'required|integer',
                    'product_id' => 'required|integer',
                    'quantity' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }

                $orderId = $request->get('order_id');
                $productId = $request->get('product_id');
                $quantity = $request->get('quantity');
                $findOrderId = Order::where('id', $orderId)->get();
                $findProductId = Product::where('id', $productId)->get();

                if ($findOrderId->isEmpty()) {
                    $message = 'the order id does not exist';
                    return response()->json(compact('message'), 404);
                } else {
                    if ($findProductId->isEmpty()) {
                        $message = 'the product id does not exist';
                        return response()->json(compact('message'), 404);
                    } else {
                        $product = Product::find($productId);
                        $dataStock = $product->stock - $quantity;
                        $product->update([
                            'stock' => $dataStock
                        ]);

                        if ($product->stock < 0 || $product->stock == 0) {
                            $message = 'sorry, the stock is up';
                            return response()->json(compact('message'), 404);
                        } else {
                            $data = OrderDetail::create([
                                'order_id' => $request->get('order_id'),
                                'product_id' => $request->get('product_id'),
                                'quantity' => $quantity
                            ]);

                            $data = OrderDetail::where('order_detail.id', $data->id)
                                ->where('order_detail.order_id', $data->order_id)
                                ->where('order_detail.product_id', $data->product_id)
                                ->join('order', 'order.id', '=', 'order_detail.order_id')
                                ->join('product', 'product.id', '=', 'order_detail.product_id')
                                ->select('order_detail.*', 'product.name as product_name', 'product.price as product_price', 'product.stock as product_stock')
                                ->first();

                            return response()->json(compact('data'),200);
                        }
                    }
                }
            }
        }
    }

    public function show_all_order()
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $data = Order::join('users', 'users.id', '=', 'order.user_id')
                ->join('address', 'address.id', '=', 'order.user_id')
                ->select('order.*', 'users.name as user_name', 'address.city as address_city')
                ->get();;

            return response()->json(compact('data'),200);
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $message = 'sorry, you are customer';
            return response()->json(compact('message'),404);
        }
    }

    public function show_by_id_order($id)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $order = Order::where('order.id', $id)
                ->join('users', 'users.id', '=', 'order.user_id')
                ->join('address', 'address.id', '=', 'order.user_id')
                ->select('order.*', 'users.name as user_name', 'address.city as address_city')
                ->first();
            $orderDetail = OrderDetail::where('order_id', $id)
                ->join('order', 'order.id', '=', 'order_detail.order_id')
                ->join('product', 'product.id', '=', 'order_detail.product_id')
                ->select('order_detail.*', 'product.name as product_name', 'product.price as product_price', 'product.stock as product_stock')
                ->get();

            $amount = 0;
            foreach ($orderDetail as $key => $value) {
                $amount += $value['product_price'];
            }
            $tax = 1.5 / 100 * $amount;


//            $data = Order::where('order.id', $id)
//                ->join('users', 'users.id', '=', 'order.user_id')
//                ->join('address', 'address.id', '=', 'order.user_id')
//                ->select('order.*', 'users.name as user_name', 'address.city as address_city')
//                ->first();
//            if (!$data) {
//                $message = 'the id does not exists';
//                return response()->json(compact('message'),200);
//            } else {
                return response()->json(compact('amount','tax', 'trackingNumber'),200);
//            }
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $message = 'sorry, you are customer';
            return response()->json(compact('message'),404);
        }
    }

    public function show_all_by_user_id_order($id)
    {
        $data = Order::where('order.user_id', $id)
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('address', 'address.id', '=', 'order.user_id')
            ->select('order.*', 'users.name as user_name', 'address.city as address_city')
            ->get();

        if (!$data->isEmpty()) {
            return response()->json(compact('data'),200);
        } else {
            $message = 'the user id does not exists';
            return response()->json(compact('message'),404);
        }
    }

    public function show_id_by_user_id_order($id, $userId)
    {
        $findId = Order::find($id);
//        $findOrderDetail = OrderDetail::where('order_id', $id)->get();

        if (!$findId) {
            $message = 'the id does not exists';
            return response()->json(compact('message'),404);

        } else {
            $data = Order::where('order.id', $id)
                ->where('order.user_id', $userId)
                ->join('users', 'users.id', '=', 'order.user_id')
                ->join('address', 'address.id', '=', 'order.user_id')
                ->select('order.*', 'users.name as user_name', 'address.city as address_city')
                ->first();


            if ($data) {
                return response()->json(compact('data'),200);
            } else {
                $message = 'the user id does not exists';
                return response()->json(compact('message'),404);
            }
        }
    }

    /*--------------------------------
    -------- Order Detail ------------
    --------------------------------*/

    public function show_all_orderdetail()
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $data = OrderDetail::join('order', 'order.id', '=', 'order_detail.order_id')
                ->join('product', 'product.id', '=', 'order_detail.product_id')
                ->select('order_detail.*', 'product.name as product_name', 'product.price as product_price', 'product.stock as product_stock')
                ->get();

            return response()->json(compact('data'),200);
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $message = 'sorry, you are customer';
            return response()->json(compact('message'),404);
        }
    }

    public function show_by_id_orderdetail($id)
    {
        $data = OrderDetail::where('order_detail.id',$id)
            ->join('order', 'order.id', '=', 'order_detail.order_id')
            ->join('product', 'product.id', '=', 'order_detail.product_id')
            ->select('order_detail.*', 'product.name as product_name', 'product.price as product_price', 'product.stock as product_stock')
            ->first();

        if (!$data) {
            $message = 'the id does not exists';
            return response()->json(compact('message'),200);
        } else {
            return response()->json(compact('data'),200);
        }
    }

    public function show_all_by_order_id_orderdetail($id)
    {
        $data = OrderDetail::where('order_detail.order_id', $id)
            ->join('order', 'order.id', '=', 'order_detail.order_id')
            ->join('product', 'product.id', '=', 'order_detail.product_id')
            ->select('order_detail.*', 'product.name as product_name', 'product.price as product_price', 'product.stock as product_stock')
            ->get();

        if (!$data->isEmpty()) {
            return response()->json(compact('data'),200);
        } else {
            $message = 'the order id does not exists';
            return response()->json(compact('message'),404);
        }
    }

    public function show_all_by_product_id_orderdetail($id)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $data = OrderDetail::where('order_detail.product_id', $id)
                ->join('order', 'order.id', '=', 'order_detail.order_id')
                ->join('product', 'product.id', '=', 'order_detail.product_id')
                ->select('order_detail.*', 'product.name as product_name', 'product.price as product_price', 'product.stock as product_stock')
                ->get();

            if (!$data->isEmpty()) {
                return response()->json(compact('data'),200);
            } else {
                $message = 'the products id does not exists';
                return response()->json(compact('message'),404);
            }
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $message = 'sorry, you are customer';
            return response()->json(compact('message'),404);
        }
    }
}
