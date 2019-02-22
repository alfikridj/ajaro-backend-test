<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{

    public function __construct()
    {

    }

    public function create_product(Request $request)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'price' => 'required|string',
                'weight' => 'required|string',
                'description' => 'required',
                'category_id' => 'required|integer',
                'stock' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(),400);
            }

            $image = $request->file('image');
            $categoryId = $request->get('category_id');
            $findCategoryId = Category::where('id', $categoryId)->get();

            if ($findCategoryId->isEmpty()) {
                $message = 'the category id does not exists';
                return response()->json(compact('message'),404);
            } else {
                if ($image == '') {
                    $data = Product::create([
                        'name' => $request->get('name'),
                        'price' => $request->get('price'),
                        'weight' => $request->get('weight'),
                        'description' => $request->get('description'),
                        'image' => asset('images/products/noimage.png'),
                        'category_id' => $categoryId,
                        'stock' => $request->get('stock')
                    ]);

                    $data = Product::where('product.id', $data->id)
                        ->join('category', 'category.id', '=', 'product.category_id')
                        ->select('product.*', 'category.name as category_name')
                        ->first();

                    return response()->json(compact('data'), 201);
                } else {
                    $data = Product::create([
                        'name' => $request->get('name'),
                        'price' => $request->get('price'),
                        'weight' => $request->get('weight'),
                        'description' => $request->get('description'),
                        'image' => $image,
                        'category_id' => $categoryId,
                        'stock' => $request->get('stock')
                    ]);

                    $data = Product::where('product.id', $data->id)
                        ->join('category', 'category.id', '=', 'product.category_id')
                        ->select('product.*', 'category.name as category_name')
                        ->first();

                    if ($image) {
                        $imageName = $image->getClientOriginalName();
                        $imagePath = public_path('images\\products\\');
                        $image->move($imagePath, $imageName);

                        $data->image = $imageName;
                        $data->save();
                    }

                    return response()->json(compact('data'), 201);
                }
            }
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $message = 'sorry, you are customer';
            return response()->json(compact('message'),404);
        }
    }

    public function show_all_product()
    {
        $data = Product::join('category', 'category.id', '=', 'product.category_id')
            ->select('product.*', 'category.name as category_name')
            ->get();

        if (!$data->isEmpty()) {
            return response()->json(compact('data'), 200);
        } else {
            $message = 'the data is empty';
            return response()->json(compact('data','message'),200);
        }
    }

    public function show_by_id_product($id)
    {
        $data = Product::find($id)
            ->join('category', 'category.id', '=', 'product.category_id')
            ->select('product.*', 'category.name as category_name')
            ->first();;

        if ($data) {
            if ($data->stock < 0 || $data->stock == 0) {
                $message = 'the stock is up';
                return response()->json(compact('data', 'message'), 200);
            } else {
                return response()->json(compact('data'), 200);
            }
        } else {
            $message = 'the id does not exists';
            return response()->json(compact('message'),404);
        }
    }

    public function show_by_name_product(Request $request)
    {
        $name = $request->get('name');

        $data = Product::where('product.name', 'like', '%'.$name.'%')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->select('product.*', 'category.name as category_name')
            ->get();

        if (!$data->isEmpty()) {
            return response()->json(compact('data'),200);
        } else {
            $message = 'the name does not exists';
            return response()->json(compact('message'),404);
        }
    }

    public function show_by_category_id_product($id)
    {
        $data = Product::where('product.category_id',$id)
            ->join('category', 'category.id', '=', 'product.category_id')
            ->select('product.*', 'category.name as category_name')
            ->get();

        if (!$data->isEmpty()) {
            return response()->json(compact('data'),200);
        } else {
            $message = 'the category id does not exists';
            return response()->json(compact('message'),404);
        }
    }

    //blum
    public function update_product(Request $request, $id)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'price' => 'required|string',
                'weight' => 'required|string',
                'description' => 'required',
                'category_id' => 'required|integer',
                'stock' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 404);
            }

            $data = Product::find($id);

            $image = $request->file('image');
            $categoryId = $request->get('category_id');
            $findCategoryId = Category::where('id', $categoryId)->get();

            if (!$data) {
                $message = 'the id does not exist';
                return response()->json(compact('message'), 404);
            } else {

                if ($findCategoryId->isEmpty()) {
                    $message = 'the category id does not exists';
                    return response()->json(compact('message'),404);
                } else {
                    if ($image == '' || $image == $data->image) {
                        $data->update([
                            'name' => $request->get('name'),
                            'price' => $request->get('price'),
                            'weight' => $request->get('weight'),
                            'description' => $request->get('description'),
                            'image' => $data->image,
                            'category_id' => $categoryId,
                            'stock' => $request->get('stock')
                        ]);

                        $data = Product::where('product.id', $data->id)
                            ->join('category', 'category.id', '=', 'product.category_id')
                            ->select('product.*', 'category.name as category_name')
                            ->first();

                        return response()->json(compact('data'), 200);
                    } else {
                        $data->update([
                            'name' => $request->get('name'),
                            'price' => $request->get('price'),
                            'weight' => $request->get('weight'),
                            'description' => $request->get('description'),
                            'image' => $image,
                            'category_id' => $categoryId,
                            'stock' => $request->get('stock')
                        ]);

                        $data = Product::where('product.id', $data->id)
                            ->join('category', 'category.id', '=', 'product.category_id')
                            ->select('product.*', 'category.name as category_name')
                            ->first();

                        if ($image) {
                            $imageName = $image->getClientOriginalName();
                            $imagePath = public_path('images\\products\\');
                            $image->move($imagePath, $imageName);

                            $data->image = $imageName;
                            $data->save();
                        }

                        return response()->json(compact('data'), 200);
                    }
                }

            }


        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $message = 'sorry, you are customer';
            return response()->json(compact('message'),200);
        }
    }

    public function delete_product($id)
    {
        if (JWTAuth::parseToken()->authenticate()->role == 'admin') {
            $data = Product::find($id);

            if (!$data) {
                $message = 'the id does not exists';
                return response()->json(compact('message'),404);
            } else {
                $data->delete();
                $message = 'product id '.$id.' successfully removed';
                return response()->json(compact('status','message'),200);
            }
        } else if (JWTAuth::parseToken()->authenticate()->role == 'customer') {
            $message = 'sorry, you are customer';
            return response()->json(compact('message'),404);
        }
    }
}
