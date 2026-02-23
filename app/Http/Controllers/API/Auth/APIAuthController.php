<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationSettingsController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SocialLoginRequest;
use App\Http\Resources\API\UsersResource;
use App\Mail\User\Auth\ForgotPasswordEmail;
use App\Notifications\Auth\ResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Session;

class APIAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api' , 'api_setting']);
        $this->middleware(['auth:api'])->only(['logout','getLoggedInUser','deleteAccount']);
        // $this->middleware('guest')->except(['logout']);
    }

    public function submitForgotPasswordForm(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email'
            ]
        );

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $token = Str::random(64);
            DB::table('password_resets')->where('email', $request->email)->delete(); // revoke previous tokens
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            $user->update(['forgot_pass_token' => $token]);
            Notification::send($user, new ResetPassword($token));
            $notifiable_users = [$user];
            NotificationSettingsController::fireNotificationEvent($user,'change_password',$notifiable_users,'','Change Password Requested');

            $response = generateResponse(null,true,"Email Sent Successfully Please Check Your Inbox!",null,'collection');
        }else{
            $response = generateResponse(null,false,"User Not Found",null,'collection');
        }
        return response()->json($response);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'token' => 'required|exists:password_resets,token',
        ]);
        $password_reset = DB::table('password_resets')->where('token', $request->token)->first();
        if ($password_reset) {
            $user = User::where('email', $password_reset->email)->first();
            if ($user) {
                $user_data = [];
                $user_data['password'] = Hash::make($request->password);
                $user->update($user_data);
                DB::table('password_resets')->where('email', $user->email)->delete();
                $notifiable_users = [$user];
                NotificationSettingsController::fireNotificationEvent($user,'reset_password',$notifiable_users,'','Password Reset Successfully');

                $response = generateResponse(null,true,"Password Resets Successfully",null,'collection');
            }
            $response = generateResponse(null,false,"Invalid Token Provided",null,'collection');

        } else {
            $response = generateResponse(null,false,"Invalid Token Provided",null,'collection');
        }
        return response()->json($response);
    }

    public function submitLoginForm(LoginRequest $request)
    {
        
        $user = User::withAll()->where('email', $request->email)->first();
        
        if ($user) {
            $email = $request->email;
            $password = $request->password;
            
            if (!$user->is_active) {
                $response = generateResponse(null,false,"User Is Inactive",null,'collection');
            }
            if ($request->login_as == 'lawyer' && !$user->hasRole(Role::$Lawyer)) {
                $response = generateResponse(null,false,"Invalid Email or Password Provided",null,'collection');
            }
            if ($request->login_as == 'customer' && !$user->hasRole(Role::$Customer)) {
                $response = generateResponse(null,false,"Invalid Email or Password Provided",null,'collection');
            }
            if ($request->login_as == 'law_firm' && !$user->hasRole(Role::$LawFirm)) {
                $response = generateResponse(null,false,"Invalid Email or Password Provided",null,'collection');
            }

            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $request->session()->put('logged_in_as', $request->login_as);
                $success['user'] = new UsersResource($user);
                //$token = $user->createToken('MyApp',[]);
                // $success['token'] =  $token->accessToken;
                 $success['token'] =  '123456789';
                $response = generateResponse($success,true,"Successfully Login",null,'collection');
            } else {
                $response = generateResponse(null,false,"Invalid Email or Password Provided",null,'collection');
            }
        } else {
            $response = generateResponse(null,false,"Invalid Email or Password Provided",null,'collection');
        }
        return response()->json($response);
    }

    public function submitRegisterForm(Request $request)
    {
        $request->validate(
            [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:8|confirmed',
            ]
        );
        $is_auto_approve = GeneralSetting::where('name', 'is_auto_approve')->first();
        $data = $request->all();
        $data['name'] = $data['first_name'].' '.$data['last_name'];
        $data['password'] = Hash::make($request->password);
        $data['is_active'] = 1;
        $user = User::create($data);
        $user->roles()->attach([$request->login_as]);
        if($request->login_as == 'lawyer'){
            $pricing_plan = getLawyerDefaultPricingPlan();
            $lawyer = $user->lawyer()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $data['first_name'], 'last_name' => $data['last_name'],'zip_code' => $data['zip_code'] ?? null]);
            $email_users = [$user];
            NotificationSettingsController::fireNotificationEvent($lawyer, 'new-signup-law', $email_users);
        }
        if($request->login_as == 'customer'){
            $customer = $user->customer()->create(['first_name' => $data['first_name'], 'last_name' => $data['last_name'],'zip_code' => $data['zip_code'] ?? null]);
            $email_users = [$user];
            // NotificationSettingsController::fireNotificationEvent($customer, 'new-signup-customer', $email_users);
        }
        if($request->login_as == 'law_firm'){
            $pricing_plan = getLawFirmDefaultPricingPlan();
            $law_firm  = $user->law_firm()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $data['first_name'], 'last_name' => $data['last_name'],'zip_code' => $data['zip_code'] ?? null]);
            $email_users = [$user];
            NotificationSettingsController::fireNotificationEvent($law_firm, 'new-signup-law-firm', $email_users);
        }
        // if ($is_auto_approve->value == 1) {
        //     $user->markEmailAsVerified();
        // } else {
        //     $user->sendEmailVerificationNotification();
        // }
        if ($user) {
            $user = User::where('id',$user->id)->withAll()->first();
            $success['user'] = new UsersResource($user);
            $token = $user->createToken('MyApp',[]);
            $success['token'] =  $token->accessToken;
            // $success['token'] = '123456789';
            $response = generateResponse($success,true,"Successfully Login",null,'collection');
        } else {
            $response = generateResponse(null,false,"Invalid Request",null,'collection');

        }
        return response()->json($response);

    }

    public function getLoggedInUser(){
        $user = Auth::user();
        $user = User::where('id',$user->id)->withAll()->first();
        $user = new UsersResource($user);
        $response = generateResponse($user,true,"Successfully Login",null,'collection');
        return response()->json($response);

    }

    public function socialLogin(SocialLoginRequest $request){
        try {
             DB::beginTransaction();
              $data = $request->only('email' , 'first_name' , 'login_as' , 'last_name');
              $data['name'] = $data['first_name'] ?? '-'.' '.$data['last_name'] ?? '-';
              $data['is_active'] = 1;
              $user = User::where('email' , $request->email)->first();
              if($user && $user->hasRole($request->login_as)){
                if(!$user->hasVerifiedEmail()){
                    $user->markEmailAsVerified();
                }
                $response['is_login'] = 1;
                $response = $this->loginUser($user ,$request, $data);
              }else{
                if(!$user){
                    $user = User::create($data);
                }
                if(!$user->hasVerifiedEmail()){
                    $user->markEmailAsVerified();
                }
                $user->roles()->attach([$request->login_as]);
                if($request->login_as == 'lawyer'){
                    $pricing_plan = getLawyerDefaultPricingPlan();
                    $lawyer = $user->lawyer()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $data['first_name'], 'last_name' => $data['last_name'],'zip_code' => $data['zip_code'] ?? null]);
                    $email_users = [$user];
                    NotificationSettingsController::fireNotificationEvent($lawyer, 'new-signup-law', $email_users);
                }
                if($request->login_as == 'customer'){
                    $customer = $user->customer()->create(['first_name' => $data['first_name'], 'last_name' => $data['last_name'],'zip_code' => $data['zip_code'] ?? null]);
                    $email_users = [$user];
                    NotificationSettingsController::fireNotificationEvent($customer, 'new-signup-customer', $email_users);
                }
                if($request->login_as == 'law_firm'){
                    $pricing_plan = getLawFirmDefaultPricingPlan();
                    $law_firm = $user->law_firm()->create(['pricing_plan_id' => $pricing_plan->id ?? null,'first_name' => $data['first_name'], 'last_name' => $data['last_name'],'zip_code' => $data['zip_code'] ?? null]);
                    $email_users = [$user];
                    NotificationSettingsController::fireNotificationEvent($law_firm, 'new-signup-law-firm', $email_users);
                }
                $response['is_login'] = 0 ;
                $data['is_social'] = 1;
                $response = $this->loginUser($user , $request , $response);
            }
            DB::commit();
              return response()->json($response, 200);
        } catch (\Exception $e) {
          DB::rollback();
          $response = generateResponse(null,false,$e->getMessage(),null,'object');
          return response()->json($response, 200);
        }

     }
     public function loginUser($user ,$request, $data){
        $user = User::where('id',$user->id)->withAll()->first();
        $success['user'] = new UsersResource($user);
        $token = $user->createToken('MyApp',[]);
        $success['token'] =  $token->accessToken;
        $request->session()->put('logged_in_as', $data['login_as'] ?? 'customer');
        $response = generateResponse($success,true,"Successfully Login",null,'collection');
        return $response;
    }

    public function logout(Request $request)
    {
        //Auth::user()->token()->revoke();
        $response = generateResponse([],true,'User successfully logged out',[],'object');
        return response()->json($response, 200);
    }

    public function deleteAccount()
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            // if ($user->hasRole(Role::$Lawyer)) {
            //     $user->lawyer()->delete();
            // }
            // if ($user->hasRole(Role::$Customer)) {
            //     $user->customer()->delete();
            // }
            // if ($user->hasRole(Role::$LawFirm)) {
            //     $user->law_firm()->delete();
            // }

            // // Detach all roles
            // $user->roles()->detach();
            $userTokens = $user->tokens;
            foreach ($userTokens as $token) {
                $token->revoke();
            }
            DB::table('sessions')->where('user_id', $user->id)->delete();
            $user->delete();
            DB::commit();

            return response()->json(generateResponse(null, true, "Account Deleted Successfully", null, 'collection'));
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(generateResponse(null, false, "Account Deletion Failed: " . $e->getMessage(), null, 'collection'), 500);
        }
    }
}
