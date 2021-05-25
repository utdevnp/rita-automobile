<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function __construct(ResponseController $response){
        $this->response = $response;
    }
    public function info($id)
    {
        if(empty($id)){
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>['id'=>"User id is required."]
            ]);
        }

        return new UserCollection(User::where('id', $id)->get());
    }

    public function updateName(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->update([
            'name' => $request->name,
        ]);
        return response()->json([
            'message' => 'Profile information has been updated successfully'
        ]);
    }

    public function updateShippingAddress(Request $request)
    {

        $validateData = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:users,id',
          ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }

        $user = User::findOrFail($request->user_id);
        $user->update([
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'phone' => $request->phone,
            'postal_code' => $request->postal_code
        ]);

        return $this->response->success([
            'message'=>"Shipping information has been updated successfully",
            'data'=>$user
        ]);
    }

    public function update(Request $request)
    {

        $validateData = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:users,id',
          ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }


        $user = User::findOrFail($request->user_id);
        $user->update([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'phone' => $request->phone,
            'postal_code' => $request->postal_code
        ]);

        return $this->response->success([
            'message'=>"Profile information has been updated successfully",
            'data'=>$user
        ]);

    }

    public function updateAvatar(Request $request)
    {

        $validateData = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:users,id',
            "avatar"=> "required"
          ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }


        $user = User::findOrFail($request->user_id);
        if($request->hasFile('avatar')){
            $user->avatar_original = $request->file('avatar')->store('uploads/avatar');
            $user->avatar = $user->avatar_original;

            $user->save();

            return $this->response->success([
                'message'=>"Profile avatar has been updated successfully",
                'data'=>$user
            ]);

        } else {
            return $this->response->error([
                'message'=>"Error updating profile avatar",
                'data'=>$user
            ]);
        }
    }
}
