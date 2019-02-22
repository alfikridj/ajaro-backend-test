<?php

namespace App\Http\Controllers;

use rizalafani\rajaongkirlaravel\RajaOngkirFacade;
use App\Address;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function __construct()
    {

    }

    public function create_address(Request $request)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $message = 'sorry, you are admin';
            return response()->json(compact('message'),404);
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'city' => 'required|string',
                'state' => 'required|string',
                'zip' => 'required|string',
                'country' => 'required|string',
                'address' => 'required|string',
                'description' => 'required|string',
                'phone' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(),400);
            }

            $userId = $request->get('user_id');
            $findUserId = User::where('id', $userId)->where('role', 'customer')->get();

            if ($findUserId->isEmpty()) {
                $message = 'the user id does not exists';
                return response()->json(compact('message'),404);
            } else {
                $data = Address::create([
                    'user_id' => $userId,
                    'city' => $request->get('city'),
                    'state' => $request->get('state'),
                    'zip' => $request->get('zip'),
                    'country' => $request->get('country'),
                    'address' => $request->get('address'),
                    'description' => $request->get('description'),
                    'phone' => $request->get('phone')
                ]);

                $data = Address::where('address.id', $data->id)
                    ->where('address.user_id', $data->user_id)
                    ->join('users', 'users.id', '=', 'address.user_id')
                    ->select('address.*', 'users.name as user_name')
                    ->first();

                return response()->json(compact('data'), 200);
            }
        }

    }

    public function show_all_address()
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $data = Address::join('users', 'users.id', '=', 'address.user_id')
                ->select('address.*', 'users.name as user_name')
                ->get();
            return response()->json(compact('data'),200);
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $message = 'sorry, you are customer';
            return response()->json(compact('message'),404);
        }
    }

    public function show_by_id_address($id)
    {
            $data = Address::where('address.id', $id)
                ->join('users', 'users.id', '=', 'address.user_id')
                ->select('address.*', 'users.name as user_name')
                ->first();;

            if (!$data) {
                $message = 'the id doest not exists';
                return response()->json(compact('message'),200);
            } else {
                return response()->json(compact('data'),200);
            }

    }

    public function show_all_by_user_id_address($id)
    {
        $data = Address::where('address.user_id', $id)
            ->join('users', 'users.id', '=', 'address.user_id')
            ->select('address.*', 'users.name as user_name')
            ->get();

        if (!$data->isEmpty()) {
            return response()->json(compact('data'),200);
        } else {
            $message = 'the user id does not exists';
            return response()->json(compact('message'),404);
        }
    }

//    public function show_id_by_user_id_address($id, $userId)
//    {
//        $findId = Address::where('address.id', $id)
//            ->join('users', 'users.id', '=', 'address.user_id')
//            ->select('address.*', 'users.name as user_name')
//            ->first();
//
//        if (!$findId) {
//            $message = 'the id does not exists';
//            return response()->json(compact('message'),404);
//
//        } else {
//            $data = Address::where('id', $id)->where('user_id', $userId)->first();
//
//            if ($data) {
//                return response()->json(compact('data'),200);
//            } else {
//                $message = 'the user id does not exists';
//                return response()->json(compact('message'),404);
//            }
//        }
//    }

    public function update_address(Request $request, $id)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $message = 'sorry, you are admin';
            return response()->json(compact('message'),404);
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {

            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'city' => 'required|string',
                'state' => 'required|string',
                'zip' => 'required|string',
                'country' => 'required|string',
                'address' => 'required|string',
                'description' => 'required|string',
                'phone' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 404);
            }

            $data = Address::find($id);
            $userId = $request->get('user_id');
            $findUserId = User::where('id', $userId)->where('role', 'customer')->get();

            if (!$data) {
                $message = 'the id does not exist';
                return response()->json(compact('message'), 404);
            } else {
                if ($findUserId->isEmpty()) {
                    $message = 'the user id does not exists';
                    return response()->json(compact('message'),404);
                } else {
                    $data->update([
                        'user_id' => $userId,
                        'city' => $request->get('city'),
                        'state' => $request->get('state'),
                        'zip' => $request->get('zip'),
                        'country' => $request->get('country'),
                        'address' => $request->get('address'),
                        'description' => $request->get('description'),
                        'phone' => $request->get('phone')
                    ]);

                    $data = Address::where('address.id', $id)
                        ->where('address.user_id', $data->user_id)
                        ->join('users', 'users.id', '=', 'address.user_id')
                        ->select('address.*', 'users.name as user_name')
                        ->first();

                    return response()->json(compact('data'), 201);
                }

            }
        }
    }

    public function delete_address($id)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $message = 'sorry, you are admin';
            return response()->json(compact('message'),404);
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $findId = Address::find($id);

            if ($findId) {
                $findId->delete();
                $message = 'address id '.$id.' successfully removed';
                return response()->json(compact('message'),200);
            } else {
                $message = 'the id does not exists';
                return response()->json(compact('message'),404);
            }
        }
    }

//    public function delete_address_id_by_user_id($id, $userId)
//    {
//        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
//            $message = 'sorry, you are admin';
//            return response()->json(compact('message'),404);
//        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
//            $findId = Address::where('id', $id)->first();
//
//            if ($findId) {
//                $findUserId = Address::where('id', $id)->where('user_id', $userId)->first();
//
//                if ($findUserId) {
//                    $findId->delete();
//                    $message = 'address id '.$id.' successfully removed';
//                    return response()->json(compact('message'),200);
//                } else {
//                    $message = 'the user id does not exists';
//                    return response()->json(compact('message'),404);
//                }
//            } else {
//                $message = 'the id does not exists';
//                return response()->json(compact('message'),404);
//            }
//        }
//    }
}
