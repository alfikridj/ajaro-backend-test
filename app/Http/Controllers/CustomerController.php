<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerController extends Controller
{

    public function __construct()
    {

    }

    public function show_all_customer()
    {
        $data = User::where('role', 'customer')->get();

        return response()->json(compact('data'),200);
    }

    public function show_by_id_customer($id)
    {
        $data = User::where('id', $id)->where('role', 'customer')->first();

        if ($data) {
            return response()->json(compact('data'),200);
        } else {
            $message = 'the id does not exists';
            return response()->json(compact('message'),404);
        }
    }

    public function show_by_name_customer(Request $request)
    {
        $name = $request->input('name');

        $data = User::where('name', $name)->where('role', 'customer')->get();

        if (!$data->isEmpty()) {
            return response()->json(compact('data'),200);
        } else {
            $message = 'the name does not exists';
            return response()->json(compact('message'),404);
        }

    }

    public function delete_customer($id)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $findId = User::where('id', $id)->where('role', 'customer')->first();

            if ($findId) {
                $findId->delete();
                $message = 'customer id '.$id.' successfully removed';
                return response()->json(compact('message'),200);
            } else {
                $message = 'the id does not exists';
                return response()->json(compact('message'),404);
            }
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $message = 'sorry, you are customer';
            return response()->json(compact('message'),404);
        }
    }
}
