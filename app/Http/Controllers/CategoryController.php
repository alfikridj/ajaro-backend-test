<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class CategoryController extends Controller
{

    public function __construct()
    {

    }

    public function create_category(Request $request)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(),400);
            }

            $category = new Category();

            $name = $request->get('name');
            $findName = $category->where('name', $name)->first();

            if (!$findName) {
                $data = $category->create([
                    'name' => $request->get('name')
                ]);
                return response()->json(compact('data'), 201);
            } else{
                $message = 'the name has already been taken';
                return response()->json(compact('message'), 400);
            }

        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $message = 'sorry, you are customer';
            return response()->json(compact('message'),404);
        }

    }

    public function show_all_category()
    {
        $data = Category::all();

        if (!$data->isEmpty()) {
            return response()->json(compact('data'), 200);
        } else {
            $message = 'the data is empty';
            return response()->json(compact('data','message'),200);
        }
    }

    public function show_by_id_category($id)
    {
        $data = Category::find($id);

        if (!$data) {
            $message = 'the id does not exist';
            return response()->json(compact('message'),200);
        } else {
            return response()->json(compact('data'), 200);
        }
    }

    public function show_by_name_category(Request $request)
    {
        $name = $request->get('name');

        $data = Category::where('name', 'like', '%'.$name.'%')->get();

        if (!$data->isEmpty()) {
            return response()->json(compact('data'),200);
        } else {
            $message = 'the name does not exists';
            return response()->json(compact('message'),404);
        }
    }

    public function update_category(Request $request, $id)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 404);
            }

            $data = Category::find($id);

            if (!$data) {
                $message = 'the id does not exist';
                return response()->json(compact('message'), 404);
            } else {
                $name = $request->get('name');
                $findName = Category::where('name', $name)->first();

                if (!$findName) {
                    $data->update([
                        'name' => $name
                    ]);
                    return response()->json(compact('data'), 201);
                } else {
                    if ($name == $data->name) {
                        $data->update([
                            'name' => $name
                        ]);
                        $message = 'nothing change';
                        return response()->json(compact('data', 'message'), 201);
                    } else {
                        $message = 'the name has already been taken';
                        return response()->json(compact('message'), 400);
                    }
                }
            }

        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $message = 'sorry, you are customer';
            return response()->json(compact('message'),404);
        }
    }

    public function delete_category($id)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $data = Category::find($id);

            if (!$data) {
                $message = 'the id does not exists';
                return response()->json(compact('message'),404);
            } else {
                $data->delete();
                $message = 'category id '.$id.' successfully removed';
                return response()->json(compact('status','message'),200);
            }
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $message = 'sorry, you are customer';
            return response()->json(compact('message'),404);
        }
    }
}
