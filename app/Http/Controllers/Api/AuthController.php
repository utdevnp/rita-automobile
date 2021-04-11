<?php 

namespace App\Http\Controllers\Api;

use App\Models\BusinessSetting;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Validator;
use App\Http\Controllers\Api\ResponseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class AuthController extends Controller
{

    public function __construct(ResponseController $response){
        $this->response = $response;
    }

    public function signup(Request $request)
    {
       //dd($request->all());

      
        $validateData = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6'
          ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'email_verified_at' => Carbon::now()
        ]);
        $user->save();
        $customer = new Customer;
        $customer->user_id = $user->id;
        $customer->save();
        
        $userData = User::find($user->id);
        return $this->response->success([
            'message'=>"Registration Successful. Please log in to your account",
            'data'=>$userData
        ]);
    }

    public function login(Request $request)
    {
        $validateData = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json(['message' => 'Unauthorized'], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        //return $this->loginSuccess($tokenResult, $user);
        
        return $this->response->loginSuccess([
            'message'=>"Login Successfull",
            "token"=>$tokenResult->accessToken,
            "expires_at"=> Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'data'=>$user
        ]);

    }

    public function user(Request $request)
    {
        $formData = $request->all();

        $validateData = Validator::make($formData,[
            'user_id' => 'required|numeric'
        ]);

        if ($validateData->fails()) {
            return $this->response->error([
                'message'=>"Validation Error",
                'data'=>$validateData->errors()
            ]);
        }


        $user   = User::find($formData['user_id']);

        if(! $user){
            return $this->response->error([
                'message'=>"User cannot find with id ".$formData['user_id'],
                'data'=>null
            ]);
        }
        return $this->response->success([
            'message'=>"User detail listed successful",
            'data'=>$user
        ]);

        //return response()->json(['hello'=>"hi"]);
    }

    public function logout(Request $request)
    {
        $formData = $request->all();
        $revokeToken =  DB::table('oauth_access_tokens')->where("user_id",$formData['user_id'])->delete();
        if($revokeToken == 0){
            return $this->response->error([
                'message'=>"Already Logout",
                'data'=>$revokeToken
            ]);
        }
        return $this->response->success([
            'message'=>"Successfully Logout.",
            'data'=>$revokeToken
        ]);

    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);
        if (User::where('email', $request->email)->count() > 0) {
            $user = User::where('email', $request->email)->first();
        } else {
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'provider_id' => $request->provider,
                'email_verified_at' => Carbon::now()
            ]);
            $user->save();
            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->save();
        }
        $tokenResult = $user->createToken('Personal Access Token');
        return $this->loginSuccess($tokenResult, $user);
    }

    protected function loginSuccess($tokenResult, $user)
    {
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user' => [
                'id' => $user->id,
                'type' => $user->user_type,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'avatar_original' => $user->avatar_original,
                'address' => $user->address,
                'country'  => $user->country,
                'city' => $user->city,
                'postal_code' => $user->postal_code,
                'phone' => $user->phone
            ]
        ]);
    }
}
