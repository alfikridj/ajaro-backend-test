<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {

    }

    public function authenticate(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'incorrect email or password'],400);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'could not create token'],500);
        }

        $data = User::where('email', $email)->first();

        return response()->json(compact('data','token'), 201);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'phone' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()], 400);
        }

        $role = '';

        if (Route::currentRouteName() == 'register.admin') {
            $role = 'admin';
        } else if (Route::currentRouteName() == 'register.customer') {
            $role = 'customer';
        }

        $data = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->get('phone'),
            'image' => 'https://github.com/identicons/'.str_random(2).'.png',
            'role' => $role
        ]);

        $message = 'login here '.route('login');

        return response()->json(compact('data', 'message'), 201);
    }

    public function update(Request $request)
    {
        if (Route::currentRouteName() == 'update.admin') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|string|email',
                'phone' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 404);
            }

            $data = User::find(JWTAuth::parseToken()->authenticate()->id);

            $image = $request->file('image');

            if (!$data) {
                $message = 'the id does not exist';
                return response()->json(compact('message'), 404);
            } else {
                if ($data->role != 'admin') {
                    $message = 'sorry, you are customer';
                    return response()->json(compact('message'), 404);
                } else {
                    if ($image == '' || $image == $data->image) {
                        $data->update([
                            'name' => $request->get('name'),
                            'email' => $request->get('email'),
                            'password' => $data->password,
                            'phone' => $request->get('phone'),
                            'image' => $data->image,
                            'role' => $data->role
                        ]);

                        return response()->json(compact('data'), 200);
                    } else {
                        $data->update([
                            'name' => $request->get('name'),
                            'email' => $request->get('email'),
                            'password' => $data->password,
                            'phone' => $request->get('phone'),
                            'image' => $image,
                            'role' => $data->role
                        ]);

                        if ($image) {
                            $imageName = $image->getClientOriginalName();
                            $imagePath = public_path('images\\users\\admins\\');
                            $image->move($imagePath, $imageName);

                            $data->image = $imageName;
                            $data->save();
                        }

                        return response()->json(compact('data'), 200);
                    }
                }
            }
        } else if (Route::currentRouteName() == 'update.customer') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|string|email',
                'phone' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 404);
            }

            $data = User::find(JWTAuth::parseToken()->authenticate()->id);

            $image = $request->file('image');

            if (!$data) {
                $message = 'the id does not exist';
                return response()->json(compact('message'), 404);
            } else {
                if ($data->role != 'customer') {
                    $message = 'sorry, you are admin';
                    return response()->json(compact('message'), 404);
                } else {
                    if ($image == '' || $image == $data->image) {
                        $data->update([
                            'name' => $request->get('name'),
                            'email' => $request->get('email'),
                            'password' => $data->password,
                            'phone' => $request->get('phone'),
                            'image' => $data->image,
                            'role' => $data->role
                        ]);

                        return response()->json(compact('data'), 200);
                    } else {
                        $data->update([
                            'name' => $request->get('name'),
                            'email' => $request->get('email'),
                            'password' => $data->password,
                            'phone' => $request->get('phone'),
                            'image' => $image,
                            'role' => $data->role
                        ]);

                        if ($image) {
                            $imageName = $image->getClientOriginalName();
                            $imagePath = public_path('images\\users\\customers\\');
                            $image->move($imagePath, $imageName);

                            $data->image = $imageName;
                            $data->save();
                        }

                        return response()->json(compact('data'), 200);
                    }
                }
            }
        }
    }

    public function getAuthenticatedUser()
    {
        try {
            if (! $data = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'user not found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['message' => 'token expired'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['message' => 'token absent'], $e->getStatusCode());
        }

        return response()->json(compact('data'),200);
    }

}
