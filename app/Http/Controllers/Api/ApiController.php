<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserBasicDetail;
use App\Models\UserContact;
use App\Models\UserMobile;
use App\Models\File;
use App\Models\Age;
use App\Models\ApiResponse;
use App\Models\UserRegistrationPercentage;
use App\Models\NotificationMsg;
use App\Models\UserExemptSms;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use DateTime;
use DB;
use App\Models\Notification;

class ApiController extends Controller
{
    public function register(Request $request)
    {
    
      if($request->token){
        
        $checkUser = User::where('email', $request->email)->first();
        ApiResponse::create([
          'api_name' => 'update_users_in_Register',
          'response' => $request,
          'user_id' => $checkUser->id,
        ]);
        $namedata = $request->firstname.' '.$request->lastname;
        $updateUser = User::where('id', $checkUser->id)
                    ->update(['name' => $namedata]);

                  
        $updateUserDetails = UserDetails::where('user_id', $checkUser->id)
                    ->update(['first_name' => $request->firstname, 'middle_name' => $request->middlename, 'last_name' => $request->lastname, 'dob' => $request->dob, 'gender' => $request->gender, 'created_by' =>$request->createdBy, 'refer_by' =>$request->referBy]);


        $birthday = new DateTime($request->dob);
        $interval = $birthday->diff(new DateTime);
        $agedata = $interval->y;
        $getAgeId = Age::where('name', $agedata)->first();

        $updateUserBD = UserBasicDetail::where('user_id', $checkUser->id)
                    ->update(['dob' => $request->dob,'age_id' => $getAgeId->id,'birth_place' => $request->birth_place,'birth_time' => $request->birth_time,'lat' => $request->birth_lat,'long' => $request->birth_long]);

        // $noti = Notification::create([
        //   'user_id' => $checkUser->id,
        //   'content' => "Welcome to Mangal Karyam",
        //   'created_by' => $checkUser->id,
        //   'status' => 0
        // ]);

        $userId = $checkUser->id;
        
      }else{
        if($request->provider == ''){
          if($request->email != ''){
            $checkUser = User::where('email', $request->email)->count();
            if($checkUser > 0){
              return response()->json([
                  'success' => false,
                  'message' => 'This email already in use. please check'
              ], 400);
            }
          }
          if($request->mobile != ''){
            $checkUser = User::where('mobile', $request->mobile)->count();
            if($checkUser > 0){
              return response()->json([
                  'success' => false,
                  'message' => 'This mobile already in use. please check'
              ], 400);
            }
          }

          try{
          DB::beginTransaction();
            //Request is valid, create new user
            $user = User::create([
              'name' => $request->firstname,
              'email' => $request->email,
              'mobile' =>$request->mobile,
              'password' => bcrypt(123456),
              'profile_code' => $request->firstname.'_'.substr($request->mobile, 0, 5),
              'profile_complete' => '20',
              'refer_code' => substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12),
              'step_complete' => '1'
            ]);

            ApiResponse::create([
              'api_name' => 'user register by mobile/email',
              'response' => $request,
              'user_id' => $user->id,
            ]);
            
            $percentage = UserRegistrationPercentage::create([
              'user_id' => $user->id,
              'basic' => 20,
              'looking_for' => 0,
              'contact' => 0,
              'career' => 0,
              'family' => 0,
              'location' => 0,
              'hobby' => 0
            ]);

            $user1 = UserDetails::create([
              'user_id' => $user->id,
              'first_name' => $request->firstname,
              'middle_name' => $request->middlename,
              'last_name' => $request->lastname,
              'dob' => $request->dob,
              'gender' => $request->gender,
              'created_by' =>$request->createdBy,
              'refer_by' =>$request->referBy,
              'requestcontact_view' => 1,
              'role_id' => 3,
              'group_id' => 1
            ]);
            //01144458678

            $birthday = new DateTime($request->dob);
            $interval = $birthday->diff(new DateTime);
            $agedata = $interval->y;
            $getAgeId = Age::where('name', $agedata)->first();

            $user1 = UserBasicDetail::create([
              'user_id' => $user->id,
              'dob' => $request->dob,
              'age_id' => $getAgeId->id,
              'birth_place' => $request->birth_place,
              'birth_time' => $request->birth_time,
              'lat' => $request->birth_lat,
              'long' => $request->birth_long,
              'about_me_long' => 'I always look for natural ingredients or. grow the ingredients by self',
              'about_me_short' => "I'm ".$request->firstname.", I am Obsessed with healthy foods. For me, all the ingredients should be as less processed as possible."
            ]);
            $getNotiMsg = NotificationMsg::where('notification_type', 1)->first();
            $noti = Notification::create([
              'user_id' => $user->id,
              'content' => $getNotiMsg->discription,
              'created_by' => $user->id,
              'status' => 0
            ]);
            DB::commit();

            $userId = $user->id;
            $url="https://shorturl.at/1vLcE";
          \App\Services\Sms::sendWelcomeSms($request->mobile, $url);

          }catch(Exception $e) {
            DB::rollBack();
            return response()->json([
              'success' => false,
              'message' => 'Somethings went wrong!'
          ], 400);
          }

      }else{
        
        $checkUser = User::where('email', $request->email)->first();
        ApiResponse::create([
          'api_name' => 'update_provider user',
          'response' => $request,
          'user_id' => $checkUser->id,
        ]);
        $namedata = $request->firstname.' '.$request->lastname;
        $updateUser = User::where('id', $checkUser->id)
                    ->update(['mobile' => $request->mobile, 'name' => $namedata]);

                   
        $updateUserDetails = UserDetails::where('user_id', $checkUser->id)
                    ->update(['first_name' => $request->firstname, 'middle_name' => $request->middlename, 'last_name' => $request->lastname, 'dob' => $request->dob, 'gender' => $request->gender, 'created_by' =>$request->createdBy, 'refer_by' =>$request->referBy]);


        $birthday = new DateTime($request->dob);
        $interval = $birthday->diff(new DateTime);
        $agedata = $interval->y;
        $getAgeId = Age::where('name', $agedata)->first();

        $updateUserBD = UserBasicDetail::where('user_id', $checkUser->id)
                    ->update(['dob' => $request->dob,'age_id' => $getAgeId->id,'birth_place' => $request->birth_place,'birth_time' => $request->birth_time,'lat' => $request->birth_lat,'long' => $request->birth_long]);

        $noti = Notification::create([
          'user_id' => $checkUser->id,
          'content' => "Welcome to Mangal Karyam",
          'created_by' => $checkUser->id,
          'status' => 0
        ]);

        $userId = $checkUser->id;

      }
    }

      

        $dataR = array();
        $dataR['firstname'] = $request->firstname;
        $dataR['middlename'] = $request->middlename;
        $dataR['lastname'] = $request->lastname;
        $dataR['dob'] = $request->dob;
        $dataR['gender'] = $request->gender;
        $dataR['email'] = $request->email;
        $dataR['mobile'] = $request->mobile;
        $dataR['createdBy'] = $request->createdBy;
        $dataR['referBy'] = $request->referBy;
        $dataR['user_id'] = $userId;
        $dataR['birth_place'] = $request->birth_place;
        $dataR['birth_time'] = $request->birth_time;
        $dataR['lat'] = $request->birth_lat;
        $dataR['long'] = $request->birth_long;

        if($request->mobile != ''){
          $token = JWTAuth::attempt(['mobile' => $request->mobile, 'password' => 123456]);
        }else{
          $token = JWTAuth::attempt(['email' => $request->email, 'password' => 123456]);
        }
        // $token = JWTAuth::attempt(['mobile' => $request->mobile, 'password' => 123456]);
        $dataR['token'] = $token;

        // ApiResponse::create([
        //   'api_name' => 'after user register by mobile/email',
        //   'response' => $dataR,
        //   'user_id' => $user->id,
        // ]);

        //User created, return success response
        return response()->json([
          'success' => true,
          'message' => 'User created successfully',
          'data' => $dataR
      ], Response::HTTP_OK);
    }

    public function exec_register(Request $request)
    {
    	
        if($request->token){
        
          // $user = JWTAuth::toUser($request->token);
          // dd($user);
          $checkUser = User::where('email', $request->email)->first();
          ApiResponse::create([
            'api_name' => 'update_exe-users_in_Register',
            'response' => $request,
            'user_id' => $checkUser->id,
          ]);
          $namedata = $request->firstname.' '.$request->lastname;
          $updateUser = User::where('id', $checkUser->id)
                      ->update(['name' => $namedata]);
  
                    
          $updateUserDetails = UserDetails::where('user_id', $checkUser->id)
                      ->update(['first_name' => $request->firstname, 'middle_name' => $request->middlename, 'last_name' => $request->lastname, 'dob' => $request->dob, 'gender' => $request->gender, 'created_by' =>$request->createdBy, 'refer_by' =>$request->referBy]);
  
  
          $birthday = new DateTime($request->dob);
          $interval = $birthday->diff(new DateTime);
          $agedata = $interval->y;
          $getAgeId = Age::where('name', $agedata)->first();
  
          $updateUserBD = UserBasicDetail::where('user_id', $checkUser->id)
                      ->update(['dob' => $request->dob,'age_id' => $getAgeId->id,'state' => $request->state,'district_id' => $request->district,'pin' => $request->pincode,'intial_fee' => $request->intial_fee,'final_fee' => $request->final_fee,'about_me_long' => 'I always look for natural ingredients or. grow the ingredients by self','about_me_short' => "I'm ".$request->firstname.", I am Obsessed with healthy foods. For me, all the ingredients should be as less processed as possible."]);
  
          
  
          $userId = $checkUser->id;
          
        }else{
            if($request->email != ''){
              $checkUser = User::where('email', $request->email)->count();
              if($checkUser > 0){
                return response()->json([
                    'success' => false,
                    'message' => 'This email already in use. please check'
                ], 400);
              }
            }
            if($request->mobile != ''){
              $checkUser = User::where('mobile', $request->mobile)->count();
              if($checkUser > 0){
                return response()->json([
                    'success' => false,
                    'message' => 'This mobile already in use. please check'
                ], 400);
              }
            }

            //Request is valid, create new user
            $user = User::create([
              'name' => $request->firstname,
              'email' => $request->email,
              'mobile' =>$request->mobile,
              'password' => bcrypt(123456),
              'profile_code' => $request->firstname.'_'.substr($request->mobile, 0, 5),
              'profile_complete' => '20',
              'refer_code' => substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12)
            ]);

            ApiResponse::create([
              'api_name' => 'executive register by mobile/email',
              'response' => $request,
              'user_id' => $user->id,
            ]);

            // $getMobileId = UserMobile::select('id')->where('mobile', $request->mobile)->first();
            // $updatefile = File::where('mobile_id', $getMobileId->id)
            //             ->update(['user_id' => $user->id]);


            $user1 = UserDetails::create([
              'user_id' => $user->id,
              'first_name' => $request->firstname,
              'middle_name' => $request->middlename,
              'last_name' => $request->lastname,
              'dob' => $request->dob,
              'gender' => $request->gender,
              'profession_id' => $request->profession,
              'subprofession_id' => $request->subprofession,
              'work_with' => $request->work_with,
              'role_id' => 2,
              'group_id' => 1,
              'active_status' => 1
            ]);

            $birthday = new DateTime($request->dob);
            $interval = $birthday->diff(new DateTime);
            $agedata = $interval->y;
            $getAgeId = Age::where('name', $agedata)->first();

            $user2 = UserBasicDetail::create([
              'user_id' => $user->id,
              'dob' => $request->dob,
              'age_id' => $getAgeId->id,
              'state' => $request->state,
              'district_id' => $request->district,
              'pin' => $request->pincode,
              'intial_fee' => $request->intial_fee,
              'final_fee' => $request->final_fee,
              'about_me_long' => 'I always look for natural ingredients or. grow the ingredients by self',
              'about_me_short' => "I'm ".$request->firstname.", I am Obsessed with healthy foods. For me, all the ingredients should be as less processed as possible."
            ]);
            $getuserbasic = UserBasicDetail::where('id', $user2->id)->update(['district_id' => $request->district]);
            $userId = $user->id;

            $noti = Notification::create([
              'user_id' => $user->id,
              'content' => "Welcome to Mangal Karyam",
              'created_by' => $user->id,
              'status' => 0
            ]);
          }
        $dataR = array();
        $dataR['firstname'] = $request->firstname;
        $dataR['middlename'] = $request->middlename;
        $dataR['lastname'] = $request->lastname;
        $dataR['dob'] = $request->dob;
        $dataR['gender'] = $request->gender;
        $dataR['email'] = $request->email;
        $dataR['mobile'] = $request->mobile;
        $dataR['profession'] = $request->profession;
        $dataR['subprofession'] = $request->subprofession;
        $dataR['work_with'] = $request->work_with;
        $dataR['state'] = $request->state;
        $dataR['district'] = $request->district;
        $dataR['intial_fee'] = $request->intial_fee;
        $dataR['final_fee'] = $request->final_fee;
        $dataR['pincode'] = $request->pincode;
        $dataR['user_id'] = $userId;


        $token = JWTAuth::attempt(['email' => $request->email, 'password' => 123456]);
        $dataR['token'] = $token;

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Executive User created successfully',
            'data' => $dataR
        ], Response::HTTP_OK);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $massage = 'You are Not Authorize';
        if(!isset($request->type) && $request->type == ''){
          return response()->json([
                'code' => 0,
                'success' => false,
                'message' => 'Please Pass type value',
              ], 500);
          }else{
            if($request->email == ''){
              $checkuser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('users.mobile', '=', $request->mobile)->where('user_details.role_id', '=', $request->type)->first();
              
            }else{
              $checkuser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('users.email', '=', $request->email)->where('user_details.role_id', '=', $request->type)->first();
            }
            
            if($request->type == 2){
              $massage = "You are Not Authorized to be an executive";
            }else if($request->type == 3){
              $massage = "You are Not Authorized to be a user";
            }
            
            if (!$checkuser ) {
              if($request->email == ''){
                $checkuserbywithoutType = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('users.mobile', '=', $request->mobile)->first();
              }else{
                $checkuserbywithoutType = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('users.email', '=', $request->email)->first();
              }
              
              if(!$checkuserbywithoutType){
                if($request->email == ''){
                $checkuserMobileOtp = UserMobile::where('mobile', '=', $request->mobile)->where('otp', '=', $request->otp)->first();
                  if(!$checkuserMobileOtp){
                    return response()->json([
                      'code' => 0,
                      'success' => false,
                      'message' => "Otp is invalid, Please check!",
                    ], 500);
                  }
                }
                return response()->json([
                  'code' => 0,
                  'success' => false,
                  'message' => "User Not Present in our Records",
                ], 404);
              }else{
                if($request->type != ''){
                  return response()->json([
                    'code' => 1,
                    'success' => false,
                    'message' => $massage,
                  ], 500);
                }
              }
              
            }else{
              if($checkuser->status != 1){
                return response()->json([
                  'code' => 1,
                  'success' => false,
                  'message' => "You are Not Authorized to Access",
                ], 500);
              }
            }
          }
        //valid credential
        // $validator = Validator::make($credentials, [
        //     'email' => 'required|email',
        //     'password' => 'required|string|min:6|max:50'
        // ]);

        //Send failed response if request is not valid
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->messages()], 200);
        // }

        //Request is validated
        //Crean token
        if($request->email == ''){
          $token = JWTAuth::attempt(['mobile' => $request->mobile, 'password' => $request->otp]);
          // if (! $token ) {
          //   $mobile = $request->mobile;
          //   $mobile = (int) $mobile;
          //   $otpSms = $this->generateOtp($mobile);
          // }
        }else{
          $token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->otp]);
        }
        try {
            if (! $token ) {

              // $getMobile = UserMobile::where('mobile', '=', $request->mobile)->get();
              //     if($getMobile->count() == 0){
              //       $getMobile = UserMobile::create([
              //         'mobile' => $request->mobile,
              //         'otp' => '1234',
              //         'status' => 1
              //       ]);
              //     }
               
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
    	return $credentials;
            return response()->json([
                  'code' => 0,
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }

 		//Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

		//Request is validated, do logout
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }

    public function addBasicDetails(Request $request)
    {
    	//Validate data
        //$data = $request->only('name', 'email', 'password');
        // $validator = Validator::make($data, [
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|string|min:6|max:50'
        // ]);

        //Send failed response if request is not valid
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->messages()], 200);
        // }

        ApiResponse::create([
          'api_name' => 'update_basic',
          'response' => $request,
          'user_id' => $request->user_id,
        ]);

        $birthday = new DateTime($request->dob);
        $interval = $birthday->diff(new DateTime);
        $agedata = $interval->y;
        $getAgeId = Age::where('name', $agedata)->first();
        

        //Request is valid, create new user
        $user = UserBasicDetail::create([
        	'user_id' => $request->user_id,
        	'age_id' => $getAgeId->id,
        	'height' => $request->height,
          'weight' => $request->weight,
          'dob' => $request->dob,
          'religion_id' => $request->religion,
          'birth_time' => $request->birthtime,
          'birth_place' => $request->birthplace,
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User Basic Details created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function addContactDetails(Request $request)
    {
    	//Validate data
        //$data = $request->only('name', 'email', 'password');
        // $validator = Validator::make($data, [
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|string|min:6|max:50'
        // ]);

        //Send failed response if request is not valid
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->messages()], 200);
        // }

        //Request is valid, create new user
        $user = UserContact::create([
        	'user_id' => $request->user_id,
        	'address' => $request->address,
          'city' => $request->city,
          'district' => $request->district,
        	'state' => $request->state,
          'country_id' => $request->country,
          'pincode' => $request->pincode
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User Contact Details created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function registerMobile(Request $request)
    {
      //dd($request);
      $getMobile = UserMobile::where('mobile', '=', $request->mobile)->get();
      $exemptData = UserExemptSms::where('id', '=', 1)->first();
      $exemptExplode = explode(',', $exemptData['mobile']);
      $mobileArray= [];
      foreach($exemptExplode as $exemptExplodeData){
        array_push($mobileArray, $exemptExplodeData);
      }
      $otp = '123456';
      if(in_array($request->mobile, $mobileArray)){

        $checkUserDetails = User::where('users.mobile', '=', $request->mobile)->first();
            try {
              if($checkUserDetails){
              User::where('id', $checkUserDetails->id)
                    ->update(['password' => bcrypt($otp)]);
              }else{
                $getMobile = UserMobile::create([
                  'mobile' => $request->mobile,
                  'otp' => $otp,
                  'status' => 1
                ]);
              }
              if($getMobile->count() > 0){
              UserMobile::where('mobile', $request->mobile)
                ->update(['otp' => $otp]);
              }

            }catch(Exception $e){
              return response()->json([
                'success' => false,
                'message' => 'please check mobile no.',
            ], 400);
            }

        return response()->json([
          'success' => true,
          'data' => "mobile no is bypass"
      ], Response::HTTP_OK);

      }

      
          if($getMobile->count() == 0){
            $mobile = $request->mobile;
            $otp = '123456';
            $getMobile = UserMobile::create([
              'mobile' => $request->mobile,
              'otp' => $otp,
              'status' => 1
            ]);
           
            $otpSms = $this->generateOtp($mobile);
            // dd($access);
            return response()->json([
                'success' => true,
                'data' => $otpSms
            ], Response::HTTP_OK);
          }else{
              $mobile = $request->mobile;
              $otpSms = $this->generateOtp($mobile);
              return response()->json([
                  'success' => true,
                  'message' => 'Please enter your otp on next page',
              ], Response::HTTP_OK);
          }

    }
  

    public function checkOtp(Request $request)
    {
      $getMobile = UserMobile::where('mobile', '=', $request->mobile)->where('otp', '=', $request->otp)->get();
          if($getMobile->count() != 0){
            return response()->json([
                'success' => true,
                'message' => 'otp matched'
            ], Response::HTTP_OK);
          }else{
            return response()->json([
                'success' => false,
                'message' => 'Please enter the correct otp',
            ], 400);
          }
    }


    public function getUserCheck(Request $request)
    {
      //dd($request);
      $getuser = JWTAuth::toUser($request->token);
      $getUserDetails = UserDetails::where('user_id', $getuser->id)->first();
      $getUserBasicDetails = UserBasicDetail::where('user_id', $getuser->id)->first();
      $profileImage = File::select('file_path')->where('user_id', $getuser->id)->where('file_type_id', 1)->where('status', 1)->first();

      $data = array();
      $data['user_id'] = $getuser->id;
      $data['username'] = $getUserDetails->first_name.' '.$getUserDetails->last_name;
      $data['profileImage'] = (isset($profileImage->file_path)) ? $profileImage->file_path : '';
      $data['payment_status'] = $getUserDetails->payment_status;
      $data['online_status'] = $getUserDetails->active_status;
      $data['contact_status'] = $getUserDetails->requestcontact_view??'';
      $data['my_prefer'] = $getUserDetails->my_prefer??'';
      $data['birth_time'] = $getUserBasicDetails->birth_time??'';
      $data['birth_place'] = $getUserBasicDetails->birth_place??'';

            return response()->json([
                'success' => true,
                'data' => $data
            ], Response::HTTP_OK);
          // }else{
          //
          //   return response()->json([
          //       'success' => false,
          //       'message' => 'This mobile number already registered. Please use another mobile no.',
          //   ], 400);
          //
          // }

    }


    public function registerWithSocialMedia(Request $request)
    {
      $checkDta = User::where('email', $request->email)->count();
      if($checkDta > 0){
        $request->attempt = 'old';
      }else{
        $request->attempt = 'new';
      }

      ApiResponse::create([
        'api_name' => 'register_With_Social_Media',
        'response' => $request,
        'user_id' => null,
      ]);
     
        if($request->attempt == 'new'){

          if($request->email != ''){
            $checkUser = User::where('email', $request->email)->count();
            if($checkUser > 0){
              return response()->json([
                  'success' => false,
                  'message' => 'This email already in use. please check'
              ], 400);
            }
          }
          if($request->mobile != ''){
            $checkUser = User::where('mobile', $request->mobile)->count();
            if($checkUser > 0){
              return response()->json([
                  'success' => false,
                  'message' => 'This mobile already in use. please check'
              ], 400);
            }
          }

          if(!isset($request->type) && $request->type == ''){
            return response()->json([
                  'code' => 0,
                  'success' => false,
                  'message' => 'Please Pass type value',
                ], 500);
            }else{
        
                $checkuser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('users.email', '=', $request->email)->where('user_details.role_id', '=', $request->type)->first();
              
              if($request->type == 2){
                $massage = "You are Not Authorized to be an executive";
              }else if($request->type == 3){
                $massage = "You are Not Authorized to be a user";
              }
              if (!$checkuser ) {
                
                  $checkuserbywithoutType = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('users.email', '=', $request->email)->first();
                
        
                if(!$checkuserbywithoutType){
                  //Request is valid, create new user
                    $user = User::create([
                      'name' => $request->display_name,
                      'email' => $request->email,
                      'mobile' =>$request->mobile,
                      'password' => bcrypt(123456),
                      'profile_code' => $request->display_name.'_'.substr($request->mobile, 0, 5),
                      'profile_complete' => '20',
                      'refer_code' => substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12)
                    ]);

                    $percentage = UserRegistrationPercentage::create([
                      'user_id' => $user->id,
                      'basic' => 20,
                      'looking_for' => 0,
                      'contact' => 0,
                      'career' => 0,
                      'family' => 0,
                      'location' => 0,
                      'hobby' => 0
                    ]);
        
                    $getname = explode(' ', $request->display_name);
                    $user1 = UserDetails::create([
                      'user_id' => $user->id,
                      'first_name' => $getname[0],
                      'middle_name' => '',
                      'last_name' => $getname[1],
                      'role_id' => $request->type,
                      'group_id' => 1,
                      'requestcontact_view' => 1,
                      'provider' => $request->provider
                    ]);
                    //01144458678
                    
        
                    $user1 = UserBasicDetail::create([
                      'user_id' => $user->id,
                      'about_me_long' => 'I always look for natural ingredients or. grow the ingredients by self',
                      'about_me_short' => "I'm ".$request->firstname.", I am Obsessed with healthy foods. For me, all the ingredients should be as less processed as possible."
                    ]);
        
                    $dataR = array();
                    $dataR['firstname'] = $getname[0];
                    $dataR['middlename'] = '';
                    $dataR['lastname'] = $getname[1];
                    $dataR['email'] = $request->email;
                    $dataR['mobile'] = $request->mobile;
                    $dataR['provider'] = $request->provider;
                    $dataR['uid'] = $request->uid;
                    $dataR['user_id'] = $user->id;
        
        
                    $token = JWTAuth::attempt(['email' => $request->email, 'password' => 123456]);
                    $dataR['token'] = $token;
        
                    //User created, return success response
                    return response()->json([
                        'success' => true,
                        'message' => 'User created successfully',
                        'data' => $dataR
                    ], Response::HTTP_OK);
                    // return response()->json([
                    //   'code' => 0,
                    //   'success' => false,
                    //   'message' => "User Not Present in our Records",
                    // ], 404);
                }else{
                  if($request->type != ''){
                  return response()->json([
                    'code' => 1,
                    'success' => false,
                    'message' => $massage,
                  ], 500);
                }
              }
                
              }
            }

        //Request is valid, create new user
        $user = User::create([
        	'name' => $request->display_name,
        	'email' => $request->email,
          'mobile' =>$request->mobile,
        	'password' => bcrypt(123456),
          'profile_code' => $request->display_name.'_'.substr($request->mobile, 0, 5),
          'profile_complete' => '20',
          'refer_code' => substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12)
        ]);

        $percentage = UserRegistrationPercentage::create([
          'user_id' => $user->id,
        	'basic' => 20,
        	'looking_for' => 0,
        	'contact' => 0,
          'career' => 0,
        	'family' => 0,
          'location' => 0,
          'hobby' => 0
        ]);

        // $getMobileId = UserMobile::select('id')->where('mobile', $request->mobile)->first();
        // $updatefile = File::where('mobile_id', $getMobileId->id)
        //             ->update(['user_id' => $user->id]);

        $getname = explode(' ', $request->display_name);
        $user1 = UserDetails::create([
        	'user_id' => $user->id,
        	'first_name' => $getname[0],
          'middle_name' => '',
          'last_name' => $getname[1],
          'role_id' => 3,
          'group_id' => 1,
          'provider' => $request->provider
        ]);
        //01144458678
        
        $user1 = UserBasicDetail::create([
        	'user_id' => $user->id,
          'about_me_long' => 'I always look for natural ingredients or. grow the ingredients by self',
          'about_me_short' => "I'm ".$request->firstname.", I am Obsessed with healthy foods. For me, all the ingredients should be as less processed as possible."
        ]);

        $dataR = array();
        $dataR['firstname'] = $getname[0];
        $dataR['middlename'] = '';
        $dataR['lastname'] = $getname[1];
        $dataR['email'] = $request->email;
        $dataR['mobile'] = $request->mobile;
        $dataR['provider'] = $request->provider;
        $dataR['uid'] = $request->uid;
        $dataR['user_id'] = $user->id;


        $token = JWTAuth::attempt(['email' => $request->email, 'password' => 123456]);
        $dataR['token'] = $token;

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $dataR
        ], Response::HTTP_OK);
    }else{
      $request->otp = '123456';
      
      if(!isset($request->type) && $request->type == ''){
            return response()->json([
                  'code' => 0,
                  'success' => false,
                  'message' => 'Please Pass type value',
                ], 500);
            }else{

                $checkuser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('users.email', '=', $request->email)->where('user_details.role_id', '=', $request->type)->first();
              
              if($request->type == 2){
                $massage = "You are Not Authorized to be an executive";
              }else if($request->type == 3){
                $massage = "You are Not Authorized to be a user";
              }
              if (!$checkuser ) {
                
                  $checkuserbywithoutType = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('users.email', '=', $request->email)->first();
                
  
                if(!$checkuserbywithoutType){
                  return response()->json([
                    'code' => 0,
                    'success' => false,
                    'message' => "User Not Present in our Records",
                  ], 404);
                }else{
                  if($request->type != ''){
                  return response()->json([
                    'code' => 1,
                    'success' => false,
                    'message' => $massage,
                  ], 500);
                }
              }
                
              }
            }

            if($request->email == ''){
              $token = JWTAuth::attempt(['mobile' => $request->mobile, 'password' => $request->otp]);
            }else{
              $token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->otp]);
            }

      try {
          if (! $token ) {

            // $getMobile = UserMobile::where('mobile', '=', $request->mobile)->get();
            //     if($getMobile->count() == 0){
            //       $getMobile = UserMobile::create([
            //         'mobile' => $request->mobile,
            //         'otp' => '1234',
            //         'status' => 1
            //       ]);
            //     }
              return response()->json([
                'success' => false,
                'message' => 'Login credentials are invalid.',
              ], 400);
          }
      } catch (JWTException $e) {
          //return $credentials;
          return response()->json([
                'code' => 0,
                'success' => false,
                'message' => 'Could not create token.',
              ], 500);
      }

  //Token created, return with success response and jwt token
      return response()->json([
          'success' => true,
          'token' => $token,
      ], 200);
    }



  }

  // 1207172318650649064 for otp

  // 1207172318863234623- Register

  public function generateOtp($mobile)
    {
      $randomOtp = random_int(100000, 999999);
      
          $checkuser = UserMobile::where('mobile', '=', $mobile)->first();
          if($checkuser){
            
            $checkUserDetails = User::where('users.mobile', '=', $mobile)->first();
           
            try {
              if($checkUserDetails){
              User::where('id', $checkUserDetails->id)
                    ->update(['password' => bcrypt($randomOtp)]);
              }

                    UserMobile::where('mobile', $mobile)
            ->update(['otp' => $randomOtp]);

            \App\Services\Sms::sendLoginOtpSms($mobile, $randomOtp);

            }catch(Exception $e){
              return response()->json([
                'success' => false,
                'message' => 'please check mobile no.',
            ], 400);
            }
            
            // return response()->json([
            //     'success' => true,
            //     'message' => 'otp matched'
            // ], Response::HTTP_OK);
          }else{
            return response()->json([
                'success' => false,
                'message' => 'Mobile/Email is not Register',
            ], 400);
          }
    }

    public function postGenerateOtp(Request $request)
    {
      $mobile = $request->mobile;
      $randomOtp = random_int(100000, 999999);
      
          $checkuser = UserMobile::where('mobile', '=', $mobile)->first();
          if($checkuser){
            
            $checkUserDetails = User::where('users.mobile', '=', $mobile)->first();
           
            try {
              if($checkUserDetails){
              User::where('id', $checkUserDetails->id)
                    ->update(['password' => bcrypt($randomOtp)]);
              }

                    UserMobile::where('mobile', $mobile)
            ->update(['otp' => $randomOtp]);

            \App\Services\Sms::sendLoginOtpSms($mobile, $randomOtp);
            return response()->json([
              'success' => true,
              'message' => 'Otp Re-Send successfully,please check on mobile no.',
          ], 200);
            }catch(Exception $e){
              return response()->json([
                'success' => false,
                'message' => 'please check mobile no.',
            ], 400);
            }
            
            // return response()->json([
            //     'success' => true,
            //     'message' => 'otp matched'
            // ], Response::HTTP_OK);
          }else{
            return response()->json([
                'success' => false,
                'message' => 'Mobile/Email is not Register',
            ], 400);
          }
    }

    // public function sendSms($mobile)
    // {
    //   // $message ='Your message';
    //   // $url = 'www.your-domain.com/api.php?to='.$mobile.'&text='.$message;

    //   //   $ch = curl_init();
    //   //   curl_setopt($ch, CURLOPT_URL, $url);
    //   //   curl_setopt($ch, CURLOPT_POST, 0);
    //   //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //   //   $response = curl_exec ($ch);
    //   //   $err = curl_error($ch);  //if you need
    //   //   curl_close ($ch);
    //   //   return $response;


    //     $curl = \curl_init();
    //     $YOUR_API_KEY = urlencode("yf7MCBXF3qpNLoOUD6J5uxjgIVKz2Z0eQswPkTtcrlva1YS48ERvXfSYKCEeDhu2nWOI7kxiyrqcG1Bb");
    //     $route = urlencode("dlt");
    //     $senderId = urlencode("MK0116");
    //     $message = urlencode("167175");
    //     $varValues = urlencode("123321");
    //     $mobile = urlencode("8470035353");
    //     curl_setopt_array($curl, array(
    //       CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=".$YOUR_API_KEY."&route=".$route."&sender_id=".$senderId."&message=".$message."&variables_values=".$varValues."&flash=0&numbers=".$mobile,
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => "",
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 30,
    //       CURLOPT_SSL_VERIFYHOST => 0,
    //       CURLOPT_SSL_VERIFYPEER => 0,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => "GET",
    //       CURLOPT_HTTPHEADER => array(
    //         "cache-control: no-cache"
    //       ),
    //     ));

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     return $response;
    // }

}
