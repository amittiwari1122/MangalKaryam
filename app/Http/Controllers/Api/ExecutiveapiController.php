<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserBasicDetail;
use App\Models\UserContact;
use App\Models\State;
use App\Models\Country;
use App\Models\Age;
use App\Models\Gotra;
use App\Models\Caste;
use App\Models\Profession;
use App\Models\WorkType;
use App\Models\UserMobile;
use App\Models\Region;
use App\Models\Height;
use App\Models\DietType;
use App\Models\SecurityQuestion;
use App\Models\File;
use App\Models\Qualification;
use App\Models\AnnualIncome;
use App\Models\Religion;
use App\Models\FileType;
use App\Models\DynamicContent;
use App\Models\ContactUs;
use App\Models\Weight;
use App\Models\MaritalStatus;
use App\Models\UserSearching;
use App\Models\City;
use App\Models\UserCareer;
use App\Models\UserFamily;
use App\Models\UserLocation;
use App\Models\UserHobby;
use App\Models\UserManagement;
use App\Models\ManglikType;
use App\Models\BeardType;
use App\Models\SkinTone;
use App\Models\AllergicType;
use App\Models\DrinkType;
use App\Models\UserLike;
use App\Models\ActivityType;
use App\Models\Job;
use App\Models\BodyType;
use App\Models\Education;
use App\Models\Nationality;
use App\Models\UserVisit;
use App\Models\Notification;
use App\Models\UserMatch;
use App\Models\Quality;
use App\Models\Benefit;
use App\Models\CommonQuestion;
use App\Models\Review;
use App\Models\UserReviewComment;
use App\Models\UserPost;
use App\Models\UserPostAction;
use App\Models\UserPostComment;
use App\Models\District;
use App\Models\ApiResponse;
use App\Models\UserFollow;


use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use Intervention\Image\Facades\Image as Image;
use Hash;
use DateTime;

class ExecutiveapiController extends Controller
{

  public function getCandidate(Request $request)
  {

    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    $getuser = User::where('id', $userId)->first();
    if(!$getuser){
      return response()->json([
      "success" => false,
      "data" => []
    ], 200);
    }

    $getuserdetails = UserDetails::where('user_id', $userId)->first();
    $getuserbasicdetails = UserBasicDetail::where('user_id', $userId)->first();
    // return $user;
              $data = array();
              $data['firstname'] = $getuserdetails->first_name;
              $data['middlename'] = $getuserdetails->middle_name;
              $data['lastname'] = $getuserdetails->last_name;
              $data['mobile'] = $getuser->mobile;
              $data['email'] = $getuser->email;
              $data['gender'] = $getuserdetails->gender;
              $data['created_by'] = $getuserdetails->created_by;
              $data['refer_by'] = $getuserdetails->refer_by;
              $data['address'] = $getuserbasicdetails->address;
              $data['marital_status'] = $getuserbasicdetails->marital_status;
              $data['pin'] = $getuserbasicdetails->pin;
              $data['user_id'] = $userId;
              if($getuserbasicdetails->height_id == null){
                $data['height'] = '';
              }else{
                $data['height'] = $getuserbasicdetails->height_id;
               }
              if($getuserbasicdetails->weight_id == null){
                $data['weight'] = '';
              }else{
                $data['weight'] = $getuserbasicdetails->weight_id;
               }
              if($getuserbasicdetails->age_id == null){
                $data['age'] = '';
              }else{
                $data['age'] = $getuserbasicdetails->age_id;
               }
              $data['dob'] = $getuserbasicdetails->dob;
              if($getuserbasicdetails->caste_id == null){
                $data['caste'] = '';
              }else{
                $data['caste'] = $getuserbasicdetails->caste_id;
               }
              if($getuserbasicdetails->gotra_id == null){
                $data['gotra'] = '';
              }else{
                $data['gotra'] = $getuserbasicdetails->gotra_id;
               }
              if($getuserbasicdetails->skin_tone_id == null){
                $data['skin_tone'] = '';
              }else{
                $data['skin_tone'] = $getuserbasicdetails->skin_tone_id;
               }
              if($getuserbasicdetails->allergic_type_id == null){
                $data['allergic_type'] = '';
              }else{
                $data['allergic_type'] = $getuserbasicdetails->allergic_type_id;
               }
              if($getuserbasicdetails->manglik_type_id == null){
                $data['manglik_type'] = '';
              }else{
                $data['manglik_type'] = $getuserbasicdetails->manglik_type_id;
               }
              if($getuserbasicdetails->beard_type_id == null){
                $data['beard_type'] = '';
              }else{
                $data['beard_type'] = $getuserbasicdetails->beard_type_id;
               }
              if($getuserbasicdetails->drink_type_id == null){
                $data['drink_type'] = '';
              }else{
                $data['drink_type'] = $getuserbasicdetails->drink_type_id;
               }
              if($getuserbasicdetails->body_type_id == null){
                $data['body_type'] = '';
              }else{
                $data['body_type'] = $getuserbasicdetails->body_type_id;
               }
             if($getuserbasicdetails->religion_id == null){
               $data['religion'] = '';
             }else{
               $data['religion'] = $getuserbasicdetails->religion_id;
              }
              $data['birth_place'] = $getuserbasicdetails->birth_place;
              $data['birth_time'] = $getuserbasicdetails->birth_time;
              if($getuserbasicdetails->nationality_id == null){
                $data['nationality'] = '';
              }else{
                $data['nationality'] = $getuserbasicdetails->nationality_id;
               }
        return response()->json([
        "success" => true,
        "data" => $data
        ]);

        

  }

  public function addCandidate(Request $request)
  {

    $loginuser = JWTAuth::toUser($request->token);
    $createdBy = $loginuser->id;

    //DB::beginTransaction();

    ApiResponse::create([
      'api_name' => 'executive user creation',
      'response' => $request,
      'user_id' => $createdBy,
    ]);
    $checkEmail = User::where('email', $request->email)->get()->count();
    if($checkEmail > 0){
      return response()->json([
        "success" => true,
        "data" => [],
        "message" => "Email already exist."
        ]);
    }
    $checkPhone = User::where('mobile', $request->mobile)->get()->count();
    if($checkPhone > 0){
      return response()->json([
        "success" => true,
        "data" => [],
        "message" => "Mobile number already exist."
        ]);
    }

    $user = User::create([
      'name' => $request->firstname.' '.$request->lastname,
      'email' => $request->email,
      'mobile' =>$request->mobile,
      'password' => bcrypt(123456),
      'profile_code' => $request->fullname.'_'.substr($request->mobile, 0, 5),
      'profile_complete' => '20',
      'refer_code' => substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12)
    ]);

    $user1 = UserDetails::create([
      'user_id' => $user->id,
      'first_name' => $request->firstname,
      'middle_name' => $request->middlename,
      'last_name' => $request->lastname,
      'dob' => $request->dob,
      'gender' => $request->gender,
      'created_by' =>'Executive',
      'created_by_user' =>$createdBy,
      'refer_by' => $request->refer_by,
      'role_id' => 3,
      'group_id' => 1
    ]);

    $birthday = new DateTime($request->dob);
    $interval = $birthday->diff(new DateTime);
    $agedata = $interval->y;
    $getAgeId = Age::where('name', $agedata)->first();

    // $user2 = UserBasicDetail::create([
    //   'user_id' => $user->id,
    //   'dob' => $request->dob,
    //   'address' => $request->address,
    //   'pin' => $request->pincode,
    //   'marital_status' => $request->marital_status,
    //   'state' => $request->state,
    //   'religion_id' => $request->religion,
    //   'about_me_long' => $request->about_me_long,
    //   'about_me_short' => "",
    //   'age_id' => $getAgeId->id
    // ]);

    $user2 = UserBasicDetail::create([
      'address' => $request->address,
      'pin' => $request->pincode,
      'state' => $request->state,
      'marital_status' => $request->marital_status,
      'age_id' => $getAgeId->id,
      'height_id' => $request->height,
      'weight_id' => $request->weight,
      'dob' => $request->dob,
      'birth_place' => $request->birth_place,
      'birth_time' => $request->birth_time,
      'caste_id' => $request->caste,
      'gotra_id' => $request->gotra,
      'skin_tone_id' => $request->skin_tone,
      'allergic_type_id' => $request->allergic_type,
      'manglik_type_id' => $request->manglik_type,
      'beard_type_id' => $request->beard_type,
      'drink_type_id' => $request->drink_type,
      'body_type_id' => $request->body_type,
      'religion_id' => $request->religion,
      'about_me_long' => $request->about_me_long,
      'about_me_short' => "",
      'user_id' => $user->id,
    ]);
    UserBasicDetail::where('id', $user2->id)->update(['skin_tone_id' => $request->skin_tone, 'body_type_id' => $request->body_type, 'nationality_id' => $request->nationality]);

    $getuserlocation = UserLocation::create([
      'living_place' => $request->address,
      'city' => "",
      'state_id' => $request->state,
      'country_id' => $request->country,
      'district_id' => $request->district,
      'created_at' => now(),
      'updated_at' => now(),
      'user_id' => $user->id,
    ]);
    UserLocation::where('id', $getuserlocation->id)->update(['district_id' => $request->district]);
  
  $checkUserContact = UserContact::where('user_id', $user->id)->get()->count();
    if($checkUserContact == 0){
      $getuserContact = UserContact::create([
        'address' => $request->living_place,
        'city' => "",
        'state' => $request->state,
        'country_id' => $request->country,
        'district' => $request->district,
        'mobile' => $user->mobile,
        'email' => $user->email,
        'created_at' => now(),
        'updated_at' => now(),
        'user_id' => $user->id,
      ]);
    }

    if($loginuser->id != $user->id){
      $noti = Notification::create([
        'user_id' => $loginuser->id,
        'content' => " You are created By Agent ".$loginuser->firstname.' '.$loginuser->lastname." on ".date('Y-m-d'),
        'created_by' => $user->id,
        'status' => 0
      ]);
    }
    if($loginuser->id != $user->id){
      $noti1 = Notification::create([
        'user_id' => $user->id,
        'content' => "".$request->firstname.' '.$request->lastname." add as new users in Manglam on ".date('Y-m-d'),
        'created_by' => $loginuser->id,
        'status' => 0
      ]);
    }
    //DB::commit();
    $data = array();
    $data['firstname'] = $request->firstname;
    $data['middlename'] = $request->middlename;
    $data['lastname'] = $request->lastname;
    $data['body_type'] = $request->body_type;
    $data['refer_by'] = $request->refer_by;
    $data['gender'] = $request->gender;
    $data['created_by'] = $request->created_by;
    $data['nationality'] = $request->nationality;
    $data['address'] = $request->address;
    $data['pin'] = $request->pincode;
    $data['state'] = $request->state;
    $data['age'] = $request->age;
    $data['marital_status'] = $request->marital_status;
    $data['height'] = $request->height;
    $data['weight'] = $request->weight;
    $data['dob'] = $request->dob;
    $data['caste'] = $request->caste;
    $data['gotra'] = $request->gotra;
    $data['skin_tone'] = $request->skin_tone;
    $data['allergic_type'] = $request->allergic_type;
    $data['manglik_type'] = $request->manglik_type;
    $data['beard_type'] = $request->beard_type;
    $data['drink_type'] = $request->drink_type;
    $data['birth_place'] = $request->birth_place;
    $data['birth_time'] = $request->birth_time;
    $data['user_id'] = $user->id;
    if($user2){
      //$data['fullname'] = $request->fullname;
      return response()->json([
      "success" => true,
      "data" => $data
      ]);
    }else{
      return response()->json([
      "success" => false,
      "data" => $data
    ], 500);
    }

  }

  public function updateCandidate(Request $request)
  {

    

    $loginuser = JWTAuth::toUser($request->token);
    $createdBy = $loginuser->id;

    // $user = User::where('id', $request->user_id)
    //             ->update(['name' => $request->firstname.' '.$request->lastname]);

    // $user1 = UserDetails::where('user_id', $request->user_id)
    //             ->update(['first_name' => $request->firstname,'last_name' => $request->lastname, 'dob' => $request->dob, 'gender' => $request->gender]);

    // $user2 = UserBasicDetail::where('user_id', $request->user_id)
    //             ->update(['address' => $request->address, 'dob' => $request->dob, 'pin' => $request->pincode, 'about_me_long' => $request->about_me_long, 'state' => $request->state, 'marital_status' => $request->marital_status,'religion_id' => $request->religion]);

    // $user3 = UserLocation::where('user_id', $request->user_id)
    //             ->update(['living_place' => $request->address,'state_id' => $request->state,'country_id' => $request->country, 'district_id' => $request->district]);

    // $data = array();
    // $data['fullname'] = $request->fullname;
    // $data['email'] = $request->email;
    // $data['mobile'] = $request->mobile;
    // $data['dob'] = $request->dob;
    // $data['gender'] = $request->gender;
    // $data['address'] = $request->address;
    // $data['pincode'] = $request->pincode;
    // $data['marital_status'] = $request->marital_status;
    // $data['state'] = $request->state;
    // $data['about_me_long'] = $request->about_me_long;
    // $data['country'] = $request->country;
    // $data['district'] = $request->district;

    // return response()->json([
    // "success" => true,
    // "data" => $data
    // ]);



    $userId = $request->user_id;
    $countuserbasic = UserBasicDetail::where('user_id', $userId)->count();
    ApiResponse::create([
      'api_name' => 'executive user update',
      'response' => $request,
      'user_id' => $request->user_id,
    ]);
      if($countuserbasic > 0){
        $getuserbasic = UserBasicDetail::where('user_id', $userId)
                    ->update(['address' => $request->address, 'marital_status' => $request->marital_status, 'age_id' => $request->age, 'height_id' => $request->height, 'weight_id' => $request->weight,'dob' => $request->dob,'birth_place' => $request->birth_place,'birth_time' => $request->birth_time,'skin_tone_id' => $request->skin_tone,'allergic_type_id' => $request->allergic_type,'manglik_type_id' => $request->manglik_type, 'beard_type_id' => $request->beard_type,'drink_type_id' => $request->drink_type,'body_type_id' => $request->body_type,'nationality_id' => $request->nationality,'gotra_id' => $request->gotra, 'caste_id' => $request->caste, 'religion_id' => $request->religion]);

        $user = User::where('id', $userId)
                    ->update(['name' => $request->firstname.' '.$request->lastname]);

        $userbasic = UserDetails::where('user_id', $userId)
                    ->update(['first_name' => $request->firstname, 'middle_name' => $request->middlename, 'last_name' => $request->lastname, 'gender' => $request->gender, 'created_by' => $request->created_by, 'refer_by' => $request->refer_by]);
      }else{
        $getuserbasic = UserBasicDetail::create([
          'address' => $request->address,
          'marital_status' => $request->marital_status,
          'age_id' => $request->age,
          'height_id' => $request->height,
          'weight_id' => $request->weight,
          'dob' => $request->dob,
          'birth_place' => $request->birth_place,
          'birth_time' => $request->birth_time,
          'caste_id' => $request->caste,
          'gotra_id' => $request->gotra,
          'skin_tone_id' => $request->skin_tone,
          'allergic_type_id' => $request->allergic_type,
          'manglik_type_id' => $request->manglik_type,
          'beard_type_id' => $request->beard_type,
          'drink_type_id' => $request->drink_type,
          'body_type_id' => $request->body_type,
          'religion_id' => $request->religion,
          'user_id' => $userId,
        ]);
      }
    // return $user;
    $getUser = User::where('users.id', $userId)->first();
              $data = array();
              $data['firstname'] = $request->firstname;
              $data['middlename'] = $request->middlename;
              $data['lastname'] = $request->lastname;
              $data['body_type'] = $request->body_type;
              $data['refer_by'] = $request->refer_by;
              $data['gender'] = $request->gender;
              $data['created_by'] = $request->created_by;
              $data['nationality'] = $request->nationality;
              $data['address'] = $request->address;
              $data['age'] = $request->age;
              $data['marital_status'] = $request->marital_status;
              $data['height'] = $request->height;
              $data['weight'] = $request->weight;
              $data['dob'] = $request->dob;
              $data['caste'] = $request->caste;
              $data['gotra'] = $request->gotra;
              $data['skin_tone'] = $request->skin_tone;
              $data['allergic_type'] = $request->allergic_type;
              $data['manglik_type'] = $request->manglik_type;
              $data['beard_type'] = $request->beard_type;
              $data['drink_type'] = $request->drink_type;
              $data['birth_place'] = $request->birth_place;
              $data['birth_time'] = $request->birth_time;
              $data['user_id'] = $userId;


        return response()->json([
        "success" => true,
        "data" => $data
        ]);
  }

  public function getLookingFor(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $getLooking = UserSearching::where('user_id', $request->user_id)->first();

    $data = array();

    if($getLooking === null){
      $data['height_from'] = "";
      $data['height_to'] = "";
      $data['age_from'] = "";
      $data['age_to'] = "";
      $data['annual_income'] = "";
      $data['diet'] = "";
      $data['marital_status'] = "";
      $data['gotra'] = "";
      $data['caste'] = "";
      $data['quality'] = "";
      $data['user_id'] = $request->user_id;
    }else{
      $data['height_from'] = $getLooking->height_from;
      $data['height_to'] = $getLooking->height_to;
      $data['age_from'] = $getLooking->age_from;
      $data['age_to'] = $getLooking->age_to;
      $data['annual_income'] = $getLooking->annual_income_id;
      $data['diet'] = $getLooking->diet_type_id;
      $data['work_type'] = $getLooking->work_type;
      $data['marital_status'] = $getLooking->marital_status;
      $data['gotra'] = $getLooking->gotra_id;
      $data['caste'] = $getLooking->caste_id;
      $data['quality'] = $getLooking->quality_id;
      $data['user_id'] = $request->user_id;
    }
      return response()->json([
      "success" => true,
      "data" => $data
      ]);
  }

  public function addLookingFor(Request $request) {
    $user = JWTAuth::toUser($request->token);
    ApiResponse::create([
      'api_name' => 'executive user looking add',
      'response' => $request,
      'user_id' => $request->user_id,
    ]);
    $data = array();
    try {
      $getusersearch = UserSearching::create([
        'height_from' => $request->height_from,
        'height_to' => $request->height_to,
        'age_from' => $request->age_from,
        'age_to' => $request->age_to,
        'annual_income_id' => $request->annual_income,
        'diet_type_id' => $request->diet,
        'work_type' => $request->work_type,
        'marital_status' => $request->marital_status,
        'caste_id' => $request->caste,
        'gotra_id' => $request->gotra,
        'quality_id' => $request->quality,
        'created_at' => now(),
        'updated_at' => now(),
        'user_id' => $request->user_id,
      ]);
     
      $data['height_from'] = $request->height_from;
      $data['height_to'] = $request->height_to;
      $data['age_from'] = $request->age_from;
      $data['age_to'] = $request->age_to;
      $data['annual_income'] = $request->annual_income;
      $data['diet'] = $request->diet;
      $data['work_type'] = $request->work_type;
      $data['marital_status'] = $request->marital_status;
      $data['gotra'] = $request->gotra;
      $data['caste'] = $request->caste;
      $data['quality'] = $request->quality;

      $success = true;
      $message = "created successfully";

    } catch (Exception $e) {
          $success = false;
          $data = [];
          $message = $e->getMessage();
    }

    return response()->json([
      "success" => $success,
      "data" => $data,
      "message" => $message
      ]);
      
  }

  public function updateLookingFor(Request $request) {
    $user = JWTAuth::toUser($request->token);
    ApiResponse::create([
      'api_name' => 'executive user looking update',
      'response' => $request,
      'user_id' => $request->user_id,
    ]);
    $getusersearch = UserSearching::where('user_id', $request->user_id)
                  ->update(['height_from' => $request->height_from, 'height_to' => $request->height_to, 'age_from' => $request->age_from, 'age_to' => $request->age_to, 'work_type' => $request->work_type,'annual_income_id' => $request->annual_income,'diet_type_id' => $request->diet,'marital_status' => $request->marital_status,'caste_id' => $request->caste,'gotra_id' => $request->gotra,'quality_id' => $request->quality]);

    $data = array();
    $data['height_from'] = $request->height_from;
    $data['height_to'] = $request->height_to;
    $data['age_from'] = $request->age_from;
    $data['age_to'] = $request->age_to;
    $data['annual_income'] = $request->annual_income;
    $data['diet'] = $request->diet;
    $data['work_type'] = $request->work_type;
    $data['marital_status'] = $request->marital_status;
    $data['gotra'] = $request->gotra;
    $data['caste'] = $request->caste;
    $data['quality'] = $request->quality;

    return response()->json([
      "success" => true,
      "data" => $data
      ]);
  }

  public function getOther(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $getOther= UserBasicDetail::where('user_id', $request->user_id)->first();

    $data = array();

    if($getOther === null){
      $data['height'] = "";
      $data['weight'] = "";
      $data['marital_status'] = "";
      $data['diet'] = "";
      $data['user_id'] = $request->user_id;
    }else{
      $data['height'] = $getOther->height_id;
      $data['weight'] = $getOther->weight_id;
      $data['marital_status'] = $getOther->marital_status;
      $data['diet'] = $getOther->diet_type_id;
      $data['user_id'] = $request->user_id;
    }
      return response()->json([
      "success" => true,
      "data" => $data
      ]);
  }

  public function addOther(Request $request) {
    $user = JWTAuth::toUser($request->token);
    ApiResponse::create([
      'api_name' => 'executive user others add',
      'response' => $request,
      'user_id' => $request->user_id,
    ]);
    $data = array();
    try{
      $getusersearch = UserBasicDetail::where('user_id', $request->user_id)
                    ->update(['height_id' => $request->height, 'weight_id' => $request->weight, 'marital_status' => $request->marital_status, 'diet_type_id' => $request->diet]);

      $data['height'] = $request->height;
      $data['weight'] = $request->weight;
      $data['diet'] = $request->diet;
      $data['marital_status'] = $request->marital_status;
      $success = true;
      $message = "created successfully";
      
    } catch (Exception $e) {
          $success = false;
          $data = [];
          $message = $e->getMessage();
    }

  return response()->json([
    "success" => $success,
    "data" => $data,
    "message" => $message
    ]);


  }

  public function updateOther(Request $request) {
    $user = JWTAuth::toUser($request->token);
    ApiResponse::create([
      'api_name' => 'executive user others update',
      'response' => $request,
      'user_id' => $request->user_id,
    ]);
    $getusersearch = UserBasicDetail::where('user_id', $request->user_id)
                  ->update(['height_id' => $request->height, 'weight_id' => $request->weight, 'marital_status' => $request->marital_status, 'diet_type_id' => $request->diet]);

    $data = array();
    $data['height'] = $request->height;
    $data['weight'] = $request->weight;
    $data['diet'] = $request->diet;
    $data['marital_status'] = $request->marital_status;

    return response()->json([
      "success" => true,
      "data" => $data
      ]);
  }

  public function getQualification(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    $usercareer = UserCareer::where('user_id', $userId)->first();

      $data = array();

      if($usercareer === null){
        $data['profession'] = null;
        $data['annual_income'] = null;
        $data['qualification'] = null;
        $data['qualification_fields'] = null;
        $data['university_name'] = null;
        $data['user_id'] = $request->user_id;
      }else{
        $data['profession'] = $usercareer->profession??'';
        $data['annual_income'] = $usercareer->annual_income_id??'';
        $data['qualification'] = $usercareer->qualification_id??'';
        $data['qualification_fields'] = $usercareer->education_fields??'';
        $data['university_name'] = $usercareer->university_name??'';
        $data['job'] = $usercareer->job_id??'';
        $data['education'] = $usercareer->education_id??'';
        $data['user_id'] = $request->user_id;
      }

        return response()->json([
        "success" => true,
        "data" => $data
        ]);
  }

  public function addQualification(Request $request) {
    $user = JWTAuth::toUser($request->token);
    ApiResponse::create([
      'api_name' => 'executive user add qualification',
      'response' => $request,
      'user_id' => $request->user_id,
    ]);
    $userId = $request->user_id;
    $countusercareer = UserCareer::where('user_id', $userId)->count();
    if($countusercareer > 0){
      $getusercareer = UserCareer::where('user_id', $userId)
                  ->update(['profession' => $request->profession, 'annual_income_id' => $request->annual_income, 'qualification_id' => $request->qualification, 'education_fields' => $request->qualification_fields, 'university_name' => $request->university_name, 'education_id' => $request->education]);

    }else{
      $getusercareer = UserCareer::create([
        'profession' => $request->profession,
        'annual_income_id' => $request->annual_income,
        'qualification_id' => $request->qualification,
        'education_fields' => $request->qualification_fields,
        'university_name' => $request->university_name,
        'education_id' => $request->education,
        'created_at' => now(),
        'updated_at' => now(),
        'user_id' => $userId,
      ]);
    }
    $data = array();
    $data['profession'] = $request->profession??'';
    $data['annual_income'] = $request->annual_income??'';
    $data['qualification'] = $request->qualification??'';
    $data['qualification_fields'] = $request->qualification_fields??'';
    $data['university_name'] = $request->university_name??'';
    // $data['job'] = $request->job;
    $data['education'] = $request->education??'';

      return response()->json([
      "success" => true,
      "data" => $data
      ]);

  }

  public function updateQualification(Request $request) {
    $user = JWTAuth::toUser($request->token);
    ApiResponse::create([
      'api_name' => 'executive user update qualification',
      'response' => $request,
      'user_id' => $request->user_id,
    ]);

    $userId = $request->user_id;
    $countusercareer = UserCareer::where('user_id', $userId)->count();
    if($countusercareer > 0){
      $getusercareer = UserCareer::where('user_id', $userId)
                  ->update(['profession' => $request->profession, 'annual_income_id' => $request->annual_income, 'qualification_id' => $request->qualification, 'education_fields' => $request->qualification_fields, 'university_name' => $request->university_name, 'education_id' => $request->education]);

    }else{
      $getusercareer = UserCareer::create([
        'profession' => $request->profession,
        'annual_income_id' => $request->annual_income,
        'qualification_id' => $request->qualification,
        'education_fields' => $request->qualification_fields,
        'university_name' => $request->university_name,
        'education_id' => $request->education,
        'created_at' => now(),
        'updated_at' => now(),
        'user_id' => $userId,
      ]);
    }
    $data = array();
    $data['profession'] = $request->profession??'';
    $data['annual_income'] = $request->annual_income??'';
    $data['qualification'] = $request->qualification??'';
    $data['qualification_fields'] = $request->qualification_fields??'';
    $data['university_name'] = $request->university_name??'';
    // $data['job'] = $request->job;
    $data['education'] = $request->education??'';

      return response()->json([
      "success" => true,
      "data" => $data
      ]);
  }

  public function getCurrentLocation(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    $userlocation = UserLocation::where('user_id', $userId)->first();

    $data = array();

    if($userlocation === null){
      $data['living_place'] = null;
      $data['city'] = null;
      $data['state'] = null;
      $data['country'] = null;
      $data['district'] = null;
      $data['user_id'] = $request->user_id;
    }else{
      $data['living_place'] = $userlocation->living_place;
      $data['city'] = $userlocation->city;
      $data['state'] = $userlocation->state_id;
      $data['country'] = $userlocation->country_id;
      $data['district'] = $userlocation->district_id;
      $data['user_id'] = $request->user_id;

    }

      return response()->json([
      "success" => true,
      "data" => $data
      ]);
  }

  public function updateCurrentLocation(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    $countuserlocation = UserLocation::where('user_id', $userId)->count();
    ApiResponse::create([
      'api_name' => 'update_location executive side User',
      'response' => $request,
      'user_id' => $userId,
    ]);
    if($countuserlocation > 0){
      $getuserlocation = UserLocation::where('user_id', $userId)
                  ->update(['living_place' => $request->living_place, 'district_id' => $request->district, 'city' => $request->city, 'state_id' => $request->state, 'country_id' => $request->country]);

    }else{
      $getuserlocation = UserLocation::create([
        'living_place' => $request->living_place,
        'city' => $request->city,
        'state_id' => $request->state,
        'country_id' => $request->country,
        'district_id' => $request->district,
        'created_at' => now(),
        'updated_at' => now(),
        'user_id' => $userId,
      ]);
      UserLocation::where('id', $getuserlocation->id)->update(['district_id' => $request->district]);
    }
    $checkUserContact = UserContact::where('user_id', $userId)->get()->count();
      if($checkUserContact == 0){
        $getuserContact = UserContact::create([
          'address' => $request->living_place,
          'city' => $request->city,
          'state' => $request->state,
          'country_id' => $request->country,
          'district' => $request->district,
          'mobile' => $user->mobile,
          'email' => $user->email,
          'created_at' => now(),
          'updated_at' => now(),
          'user_id' => $userId,
        ]);
      }
    $data = array();
    $data['living_place'] = $request->living_place;
    $data['city'] = $request->city;
    $data['state'] = $request->state;
    $data['country'] = $request->country;
    $data['district'] = $request->district;

    
      return response()->json([
      "success" => true,
      "data" => $data
      ]);
  }



  public function getExcutiveProfile(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;
  $user = UserBasicDetail::where('user_id', $userId)->first();
  $getUser = User::where('users.id', $userId)->first();
  $getDUser = UserDetails::where('user_id', $userId)->first();
  $getUserContact = UserContact::where('user_id', $userId)->first();
  $profileImage = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 1)->where('status', 1)->get();
  $coverImage = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 2)->where('status', 1)->orderBy('created_at','DESC')->get();

  $district = District::where('id', $user->district_id)->first();
  $state = State::where('id', $user->state)->first();

            $dataR = array();
            $dataR['firstname'] = $getDUser->first_name;
            $dataR['middlename'] = $getDUser->middle_name;
            $dataR['lastname'] = $getDUser->last_name;
            $dataR['dob'] = $getDUser->dob;
            $dataR['gender'] = $getDUser->gender;
            $dataR['email'] = $getUser->email;
            $dataR['mobile'] = $getUser->mobile;
            $dataR['profession'] = $getDUser->profession;
            $dataR['subprofession'] = $getDUser->subprofession;
            $dataR['work_with'] = $getDUser->work_with;
            $dataR['distict'] = (isset($district->name)) ? $district->name : '';
            $dataR['state'] = (isset($state->name)) ? $state->name : '';
            $dataR['religion'] = $user->religion;
            $dataR['intial_fee'] = $user->intial_fee;
            $dataR['final_fee'] = $user->final_fee;
            $dataR['pincode'] = $user->pin;
            $dataR['profileImage'] = $profileImage;
            $dataR['coverImage'] = $coverImage;
            $dataR['user_id'] = $user->user_id;

      return response()->json([
      "success" => true,
      "data" => $dataR
      ]);
  }

  public function updateExcutiveProfile(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $user->id;
    $user = UserBasicDetail::where('user_id', $userId)->update(['district_id' => $request->district, 'state' => $request->state, 'pin' => $request->pincode,'religion_id' => $request->religion, 'intial_fee' => $request->intial_fee, 'final_fee' => $request->final_fee]);
    // return $user;
    // $getUser = User::where('users.id', $userId)->update(['first_name' => $request->firstname, 'first_name' => $request->firstname]);
    $getDUser = UserDetails::where('user_id', $userId)->update(['first_name' => $request->firstname, 'middle_name' => $request->middlename, 'last_name' => $request->lastname, 'dob' => $request->dob, 'profession_id' => $request->profession, 'gender' => $request->gender, 'subprofession_id' => $request->subprofession, 'work_with' => $request->work_with]);
    // $getUserContact = UserContact::where('user_id', $userId)->first();
    
    // $profileImage = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 1)->where('status', 1)->get();
    // $coverImage = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 2)->where('status', 1)->get();
  
  
              $dataR = array();
              $dataR['firstname'] = $request->firstname;
              $dataR['middlename'] = $request->middlename;
              $dataR['lastname'] = $request->lastname;
              $dataR['dob'] = $request->dob;
              $dataR['gender'] = $request->gender;
              // $dataR['email'] = $request->email;
              // $dataR['mobile'] = $request->mobile;
              $dataR['profession'] = $request->profession;
              $dataR['subprofession'] = $request->subprofession;
              $dataR['work_with'] = $request->work_with;
              $dataR['distict'] = $request->district;
              $dataR['state'] = $request->state;
              $dataR['pincode'] = $request->pincode;
              $dataR['religion'] = $request->religion;
              $dataR['intial_fee'] = $request->intial_fee;
              $dataR['final_fee'] = $request->final_fee;
              $dataR['user_id'] = $userId;
  
        return response()->json([
        "success" => true,
        "data" => $dataR
        ]);
    }


  public function getAllInformation(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $user->id;
    $user1 = UserBasicDetail::select(['user_basic_details.*'])
    ->where('user_id', $userId)->first();



    // $user1 = UserBasicDetail::select(['user_basic_details.*','ages.name as agedtaa','heights.height as height','marital_statuses.name as maritalstatus', 'gotras.name as gotra', 'castes.name as caste','manglik_types.name as manglic_type','allergic_types.name as allergic_type','beard_types.name as beard_type','skin_tones.name as skin_tone','drink_types.name as drink_type','skin_tones.name as skin_tone','drink_types.name as drink_type','allergic_types.name as allergic_type','manglik_types.name as manglik_type','beard_types.name as beard_type'])
    // ->join('ages', 'ages.id', '=', 'user_basic_details.age_id')
    // ->join('heights', 'heights.id', '=', 'user_basic_details.height_id')
    // ->join('castes', 'castes.id', '=', 'user_basic_details.caste_id')
    // ->join('gotras', 'gotras.id', '=', 'user_basic_details.gotra_id')
    // ->join('allergic_types', 'allergic_types.id', '=', 'user_basic_details.allergic_type_id')
    // ->join('manglik_types', 'manglik_types.id', '=', 'user_basic_details.manglik_type_id')
    // ->join('skin_tones', 'skin_tones.id', '=', 'user_basic_details.skin_tone_id')
    // ->join('drink_types', 'drink_types.id', '=', 'user_basic_details.drink_type_id')
    // ->join('beard_types', 'beard_types.id', '=', 'user_basic_details.beard_type_id')
    // ->join('marital_statuses', 'marital_statuses.id', '=', 'user_basic_details.marital_status')
    // ->where('user_id', $userId)->first();


    $getUser = User::where('users.id', $userId)->first();
    $getUserDetails = UserDetails::where('user_id', $userId)->first();
    $profileImage = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 1)->where('status', 1)->first();
    
              $data = array();
              $data['basicInfo']['name'] = $getUserDetails->first_name.' '.$getUserDetails->last_name;
              $data['basicInfo']['firstname'] = $getUserDetails->first_name;
              $data['basicInfo']['middlename'] = $getUserDetails->middle_name;
              $data['basicInfo']['lastname'] = $getUserDetails->last_name;
              $data['basicInfo']['gender'] = $getUserDetails->gender;
              $data['basicInfo']['createdBy'] = $getUserDetails->created_by;
              $data['basicInfo']['referedBy'] = $getUserDetails->refer_by;
              $data['basicInfo']['email'] = $getUser->email;
              $data['basicInfo']['mobile'] = $getUser->mobile;
              $data['basicInfo']['code'] = $getUser->profile_code;
              $data['basicInfo']['image'] = (isset($profileImage->file_path)) ? $profileImage->file_path : '';
              $data['basicInfo']['weight'] = (isset($user1->weight_id)) ? $user1->weight_id : '';
              $data['basicInfo']['dob'] = (isset($user1->dob)) ? $user1->dob : '';

              if($user1->age_id > 0){
                $agedtaa = Age::where('id', $user1->age_id)->first();
                $data['basicInfo']['age'] = $agedtaa->name;
              }else {
                $data['basicInfo']['age'] = '';
              }
              if($user1->marital_status > 0){
                $maritalstatus = MaritalStatus::where('id', $user1->marital_status)->first();
                $data['basicInfo']['marital_status'] = $maritalstatus->name;
              }else {
                $data['basicInfo']['marital_status'] = '';
              }
              if($user1->height_id > 0){
                $height = Height::where('id', $user1->height_id)->first();
                $data['basicInfo']['height'] = $height->height;
              }else {
                $data['basicInfo']['height'] = '';
              }
              if($user1->caste_id > 0){
                $caste = Caste::where('id', $user1->caste_id)->first();
                $data['basicInfo']['caste'] = $caste->name;
              }else {
                $data['basicInfo']['caste'] = '';
              }
              if($user1->gotra_id > 0){
                $gotra = Gotra::where('id', $user1->gotra_id)->first();
                $data['basicInfo']['gotra'] = $gotra->name;
              }else {
                $data['basicInfo']['gotra'] = '';
              }
              if($user1->skin_tone_id > 0){
                $skin_tone = SkinTone::where('id', $user1->skin_tone_id)->first();
                $data['basicInfo']['skin_tone'] = $skin_tone->name;
              }else {
                $data['basicInfo']['skin_tone'] = '';
              }
              if($user1->allergic_type_id > 0){
                $allergic_type = AllergicType::where('id', $user1->allergic_type_id)->first();
                $data['basicInfo']['allergic_type'] = $allergic_type->name;
              }else {
                $data['basicInfo']['allergic_type'] = '';
              }
              if($user1->manglik_type_id > 0){
                $manglik_type = ManglikType::where('id', $user1->manglik_type_id)->first();
                $data['basicInfo']['manglik_type'] = $manglik_type->name;
              }else {
                $data['basicInfo']['manglik_type'] = '';
              }
              if($user1->beard_type_id > 0){
                $beard_type = BeardType::where('id', $user1->beard_type_id)->first();
                $data['basicInfo']['beard_type'] = $beard_type->name;
              }else {
                $data['basicInfo']['beard_type'] = '';
              }
              if($user1->drink_type_id > 0){
                $drink_type = DrinkType::where('id', $user1->drink_type_id)->first();
                $data['basicInfo']['drink_type'] = $drink_type->name;
              }else {
                $data['basicInfo']['drink_type'] = '';
              }
              if($user1->drink_type_id > 0){
                $drink_type = DrinkType::where('id', $user1->drink_type_id)->first();
                $data['basicInfo']['drink_type'] = $drink_type->name;
              }else {
                $data['basicInfo']['drink_type'] = '';
              }
              if($user1->nationality_id > 0){
                $nation = Nationality::where('id', $user1->nationality_id)->first();
                $data['basicInfo']['nationality'] = $nation->name;
              }else {
                $data['basicInfo']['nationality'] = '';
              }
              if($user1->body_type_id > 0){
                $body = BodyType::where('id', $user1->body_type_id)->first();
                $data['basicInfo']['body_type'] = $body->name;
              }else {
                $data['basicInfo']['body_type'] = '';
              }
              if($user1->religion_id > 0){
                $religion = Religion::where('id', $user1->religion_id)->first();
                $data['basicInfo']['religion'] = $religion->name;
              }else {
                $data['basicInfo']['religion'] = '';
              }
              $data['basicInfo']['birth_place'] = (isset($user1->birth_place)) ? $user1->birth_place : '';
              $data['basicInfo']['birth_time'] = (isset($user1->birth_time)) ? $user1->birth_time : '';

          // $getLooking = UserSearching::select(['user_searchings.*','age_from.name as age_from','age_to.name as age_to','height_from.height as height_from','height_to.height as height_to','annual_incomes.incomes as annual_income', 'diet_types.diet as diet_type', 'gotras.name as gotra','castes.name as caste','marital_statuses.name as maritalstatus', 'work_types.name as work_type_name'])
          // ->join('ages as age_from', 'age_from.id', '=', 'user_searchings.age_from')
          // ->join('ages as age_to', 'age_to.id', '=', 'user_searchings.age_to')
          // ->join('heights as height_from', 'height_from.id', '=', 'user_searchings.height_from')
          // ->join('heights as height_to', 'height_to.id', '=', 'user_searchings.height_to')
          // ->join('annual_incomes', 'annual_incomes.id', '=', 'user_searchings.annual_income_id')
          // ->join('diet_types', 'diet_types.id', '=', 'user_searchings.diet_type_id')
          // ->join('gotras', 'gotras.id', '=', 'user_searchings.gotra_id')
          // ->join('castes', 'castes.id', '=', 'user_searchings.caste_id')
          // ->join('work_types', 'work_types.id', '=', 'user_searchings.work_type')
          // ->join('marital_statuses', 'marital_statuses.id', '=', 'user_searchings.marital_status')
          // ->where('user_id', $userId)->first();

          $getLooking = UserSearching::select(['user_searchings.*'])
          ->where('user_id', $userId)->first();


          if($getLooking === null){
            $data['lookingFor']['height_from'] = null;
            $data['lookingFor']['height_to'] = null;
            $data['lookingFor']['age_from'] = null;
            $data['lookingFor']['age_to'] = null;
            $data['lookingFor']['annual_income'] = null;
            $data['lookingFor']['diet'] = null;
            $data['lookingFor']['work_type'] = null;
            $data['lookingFor']['marital_status'] = null;
            $data['lookingFor']['gotra'] = null;
            $data['lookingFor']['caste'] = null;
          }else{
            if($getLooking->height_from > 0){
              $heightfrom = Height::where('id', $getLooking->height_from)->first();
              $data['lookingFor']['height_from'] = $heightfrom->height;
            }else {
              $data['lookingFor']['height_from'] = '';
            }
            if($getLooking->height_to > 0){
              $heightto = Height::where('id', $getLooking->height_to)->first();
              $data['lookingFor']['height_to'] = $heightto->height;
            }else {
              $data['lookingFor']['height_to'] = '';
            }
            if($getLooking->age_from > 0){
              $agefrom = Age::where('id', $getLooking->age_from)->first();
              $data['lookingFor']['age_from'] = $agefrom->name;
            }else {
              $data['lookingFor']['age_from'] = '';
            }
            if($getLooking->age_to > 0){
              $ageto = Age::where('id', $getLooking->age_to)->first();
              $data['lookingFor']['age_to'] = $ageto->name;
            }else {
              $data['lookingFor']['age_to'] = '';
            }
            if($getLooking->annual_income_id > 0){
              $annualincome = AnnualIncome::where('id', $getLooking->annual_income_id)->first();
              $data['lookingFor']['annual_income'] = $annualincome->incomes;
            }else {
              $data['lookingFor']['annual_income'] = '';
            }
            if($getLooking->diet_type_id > 0){
              $diettype = DietType::where('id', $getLooking->diet_type_id)->first();
              $data['lookingFor']['diet_type'] = $diettype->diet;
            }else {
              $data['lookingFor']['diet_type'] = '';
            }
            if($getLooking->work_type > 0){
              $worktype = WorkType::where('id', $getLooking->work_type)->first();
              $data['lookingFor']['work_type'] = $worktype->name;
            }else {
              $data['lookingFor']['work_type'] = '';
            }
            if($getLooking->caste_id > 0){
              $caste = Caste::where('id', $getLooking->caste_id)->first();
              $data['lookingFor']['caste'] = $caste->name;
            }else {
              $data['lookingFor']['caste'] = '';
            }
            if($getLooking->gotra_id > 0){
              $gotra = Gotra::where('id', $getLooking->gotra_id)->first();
              $data['lookingFor']['gotra'] = $gotra->name;
            }else {
              $data['lookingFor']['gotra'] = '';
            }
            if($getLooking->marital_status > 0){
              $maritalstatus = MaritalStatus::where('id', $getLooking->marital_status)->first();
              $data['lookingFor']['marital_status'] = $maritalstatus->name;
            }else {
              $data['lookingFor']['marital_status'] = '';
            }


          }

      // $getContact = UserContact::select(['user_contacts.*','countries.name as country','states.name as statename'])
      // ->join('countries', 'countries.id', '=', 'user_contacts.country_id')
      // ->join('states', 'states.id', '=', 'user_contacts.state')
      // ->where('user_id', $userId)->first();
      $getContact = UserContact::select(['user_contacts.*'])
      ->where('user_id', $userId)->first();

      if($getContact === null){
        $data['userContact']['mobile'] = null;
        $data['userContact']['alt_mobile'] = null;
        $data['userContact']['email'] = null;
        $data['userContact']['address'] = null;
        $data['userContact']['state'] = null;
        $data['userContact']['pincode'] = null;
        $data['userContact']['country'] = null;
      }else{
        $data['userContact']['mobile'] = $getContact->mobile;
        $data['userContact']['alt_mobile'] = $getContact->alt_mobile;
        $data['userContact']['email'] = $getContact->email;
        $data['userContact']['address'] = $getContact->address;
        if($getContact->state > 0){
          $state = State::where('id', $getContact->state)->first();
          $data['userContact']['state'] = $state->name;
        }else {
          $data['userContact']['state'] = '';
        }
        if($getContact->country_id > 0){
          $country = Country::where('id', $getContact->country_id)->first();
          $data['userContact']['country'] = $country->name;
        }else {
          $data['userContact']['country'] = '';
        }

        $data['userContact']['pincode'] = $getContact->pincode;
      }

  // $usercareer = UserCareer::select(['user_careers.*','annual_incomes.incomes as annual_income','qualifications.qualification as qualificationdata', 'professions.name as professionname'])
  // ->join('annual_incomes', 'annual_incomes.id', '=', 'user_careers.annual_income_id')
  // ->join('qualifications', 'qualifications.id', '=', 'user_careers.qualification_id')
  // ->join('professions', 'professions.id', '=', 'user_careers.profession')
  // ->where('user_id', $userId)->first();

  $usercareer = UserCareer::select(['user_careers.*'])->where('user_id', $userId)->first();

  if($usercareer === null){
    $data['userCareer']['profession'] = null;
    $data['userCareer']['annual_income'] = null;
    $data['userCareer']['qualification'] = null;
    $data['userCareer']['education_fields'] = null;
    $data['userCareer']['university_name'] = null;
  }else{
    if($usercareer->annual_income_id > 0){
      $AI = AnnualIncome::where('id', $usercareer->annual_income_id)->first();
      $data['userCareer']['annual_income'] = $AI->incomes;
    }else {
      $data['userCareer']['annual_income'] = '';
    }
    if($usercareer->profession > 0){
      $Pro = Profession::where('id', $usercareer->profession)->first();
      $data['userCareer']['profession'] = $Pro->name;
    }else {
      $data['userCareer']['profession'] = '';
    }
    if($usercareer->qualification_id > 0){
      $Q = Qualification::where('id', $usercareer->qualification_id)->first();
      $data['userCareer']['qualification'] = $Q->qualification;
    }else {
      $data['userCareer']['qualification'] = '';
    }
    if($usercareer->job_id > 0){
      $j = Job::where('id', $usercareer->job_id)->first();
      $data['userCareer']['job'] = $j->name;
    }else {
      $data['userCareer']['job'] = '';
    }
    if($usercareer->education_id > 0){
      $E = Education::where('id', $usercareer->education_id)->first();
      $data['userCareer']['education'] = $E->name;
    }else {
      $data['userCareer']['education'] = '';
    }
    $data['userCareer']['education_fields'] = $usercareer->education_fields;
    $data['userCareer']['university_name'] = $usercareer->university_name;
  }

  // $userfamily = UserFamily::select(['user_families.*','religions.name as religionName','annual_incomes.incomes as incomes'])
  // ->join('religions', 'religions.id', '=', 'user_families.religion_id')
  // ->join('annual_incomes', 'annual_incomes.id', '=', 'user_families.family_income')
  // ->where('user_id', $userId)->first();

  $userfamily = UserFamily::select(['user_families.*'])
  ->where('user_id', $userId)->first();

  if($userfamily === null){
    $data['userFamily']['family_type'] = null;
    $data['userFamily']['religion'] = null;
    $data['userFamily']['mother_tounge'] = null;
    $data['userFamily']['father_occupation'] = null;
    $data['userFamily']['mother_occupation'] = null;
    $data['userFamily']['family_income'] = null;
    $data['userFamily']['no_brothers'] = null;
    $data['userFamily']['married_brothers'] = null;
    $data['userFamily']['no_sisters'] = null;
    $data['userFamily']['married_sisters'] = null;
    $data['userFamily']['family_based_out'] = null;
  }else{
    if($userfamily->family_type == 1){
      $data['userFamily']['family_type'] = 'Modern';
    }
    if($userfamily->family_type == 2){
      $data['userFamily']['family_type'] = 'Moderate';
    }
    if($userfamily->family_type == 3){
      $data['userFamily']['family_type'] = 'Orthodox';
    }

    if($userfamily->religion_id > 0){
      $R = Religion::where('id', $userfamily->religion_id)->first();
      $data['userFamily']['religion'] = $R->name;
    }else {
      $data['userFamily']['religion'] = '';
    }
    $data['userFamily']['mother_tounge'] = $userfamily->mother_tounge;
    if($userfamily->father_occupation > 0){
      $father = Profession::where('id', $userfamily->father_occupation)->first();
      $data['userFamily']['father_occupation'] = $father->name;
    }else {
      $data['userFamily']['father_occupation'] = '';
    }
    if($userfamily->mother_occupation > 0){
      $father1 = Profession::where('id', $userfamily->mother_occupation)->first();
      $data['userFamily']['mother_occupation'] = $father1->name;
    }else {
      $data['userFamily']['mother_occupation'] = '';
    }

    if($userfamily->family_income > 0){
      $AI = AnnualIncome::where('id', $userfamily->family_income)->first();
      $data['userFamily']['family_income'] = $AI->incomes;
    }else {
      $data['userFamily']['family_income'] = '';
    }
    $data['userFamily']['no_brothers'] = $userfamily->no_brothers;
    $data['userFamily']['married_brothers'] = $userfamily->married_brothers;
    $data['userFamily']['no_sisters'] = $userfamily->no_sisters;
    $data['userFamily']['married_sisters'] = $userfamily->married_sisters;
    $data['userFamily']['family_based_out'] = $userfamily->family_based_out;
  }

  // $userlocation = UserLocation::select(['user_locations.*','countries.name as country','states.name as statename', 'cities.name as cityname'])
  // ->join('countries', 'countries.id', '=', 'user_locations.country_id')
  // ->join('cities', 'cities.id', '=', 'user_locations.city')
  // ->join('states', 'states.id', '=', 'user_locations.state_id')->where('user_id', $userId)->first();

  $userlocation = UserLocation::select(['user_locations.*'])->where('user_id', $userId)->first();

  if($userlocation === null){
    $data['userLocation']['living_place'] = null;
    $data['userLocation']['city'] = null;
    $data['userLocation']['district'] = null;
    $data['userLocation']['state'] = null;
    $data['userLocation']['country'] = null;
  }else{
    $data['userLocation']['living_place'] = $userlocation->living_place;
    $data['userLocation']['city'] = $userlocation->city;
    if($userlocation->district_id > 0){
      $city = District::where('id', $userlocation->district_id)->first();
      $data['userLocation']['district'] = $city->name;
    }else {
      $data['userLocation']['district'] = '';
    }
    if($userlocation->state_id > 0){
      $state = State::where('id', $userlocation->state_id)->first();
      $data['userLocation']['state'] = $state->name;
    }else {
      $data['userLocation']['state'] = '';
    }
    if($userlocation->country_id > 0){
      $country = Country::where('id', $userlocation->country_id)->first();
      $data['userLocation']['country'] = $country->name;
    }else {
      $data['userLocation']['country'] = '';
    }


  }

  $user_hobbies = UserHobby::where('user_id', $userId)->get();
  $array = [];
  foreach ($user_hobbies as $value) {
    array_push($array,$value->hobby);
  }

  if(count($array)>0){
    $data['userHobbies']['hobbies'] = $array;
  }else{
    $data['userHobbies']['hobbies'] = [];
  }


      return response()->json([
      "success" => true,
      "data" => $data
      ]);
  }


  public function getAllcandidate(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    //$getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->skip(70)->take(10)->get();
        $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.created_by_user', $user->id)->orderBy('user_details.updated_at', 'DESC')->take(30)->get();
        

    $dataR1 = array();
    foreach ($getUser as $users) {
      
      $user = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $users['user_id'])->first();
      // $users = UserBasicDetail::select(['user_basic_details.*','ages.name as agedtaa','heights.height as height','marital_statuses.name as maritalstatus'])
      // ->join('ages', 'ages.id', '=', 'user_basic_details.age_id')
      // ->join('heights', 'heights.id', '=', 'user_basic_details.height_id')
      // ->join('marital_statuses', 'marital_statuses.id', '=', 'user_basic_details.marital_status')
      // ->where('user_id', $user['id'])->first();
      
      $getLike = UserLike::where('user_id', $users['user_id'])->where('created_by', $users['user_id'])->first();
      $userMobile = User::where('id', $users['user_id'])->first();
      $getDUser = UserDetails::where('user_id', $users['user_id'])->first();
      // print_r($getDUser);
      
      $profileImage = File::select('file_path')->where('user_id', $users['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
      $dataR = array();
      $dataR['firstname'] = $getDUser['first_name']??'null';
      $dataR['middlename'] = $getDUser['middle_name']??'null';
      $dataR['lastname'] = $getDUser['last_name']??'null';
      $dataR['gender'] = $getDUser['gender']??'null';
      $dataR['profileImage'] = $profileImage;
      $dataR['user_id'] = $users->user_id;
      $dataR['mobile'] = $userMobile->mobile;
      // $dataR['age'] = (isset($user->agedtaa)) ? $user->agedtaa : '';
      // $dataR['marital_status'] = (isset($user->maritalstatus)) ? $user->maritalstatus : '';
      // $dataR['height'] = (isset($user->height)) ? $user->height : '';
      
      if($users->age_id > 0){
        $agedtaa = Age::where('id', $users->age_id)->first();
        $dataR['age'] = $agedtaa->name;
      }else {
        $dataR['age'] = '';
      }

      if($users->marital_status > 0){
        $maritalstatus = MaritalStatus::where('id', $users->marital_status)->first();
        $dataR['marital_status'] = $maritalstatus->name;
      }else {
        $dataR['marital_status'] = '';
      }

      if($users->height_id > 0){
        $height = Height::where('id', $users->height_id)->first();
        $dataR['height'] = $height->height;
      }else {
        $dataR['height'] = '';
      }
      if($users->caste_id > 0){
        $caste = Caste::where('id', $users->caste_id)->first();
        $dataR['caste'] = $caste->name;
      }else {
        $dataR['caste'] = '';
      }
      $dataR['like'] = (isset($getLike->activity_type_id)) ? $getLike->activity_type_id : '';
     array_push($dataR1, $dataR);
    }

    return response()->json([
    "success" => true,
    "data" => $dataR1
    ]);

  }

  public function addUserManagement(Request $request) {
    $user = JWTAuth::toUser($request->token);

      $getusersearch = UserManagement::create([
        'user_id' => $request->user_id,
        'budget' => $request->budget,
        'details' => $request->details,
        'visit_count' => $request->visit_count,
        'spacial_notes' => $request->spacial_notes,
        'followup_date' => $request->followup_date,
      ]);

    $data = array();
    $data['user_id'] = $request->user_id;
    $data['budget'] = $request->budget;
    $data['details'] = $request->details;
    $data['visit_count'] = $request->visit_count;
    $data['spacial_notes'] = $request->spacial_notes;
    $data['followup_date'] = $request->followup_date;


    return response()->json([
      "success" => true,
      "data" => $data
      ]);

  }

  public function getUserManagement(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $request->user_id;
  $userManagement = UserManagement::where('user_id', $userId)->first();

if($userManagement == null){
  $data = array();
  $data['user_id'] = "";
  $data['budget'] = "";
  $data['details'] = "";
  $data['visit_count'] = "";
  $data['spacial_notes'] = "";
  $data['followup_date'] = "";
}else{

  $data = array();
  $data['user_id'] = $userManagement->user_id;
  $data['budget'] = $userManagement->budget;
  $data['details'] = $userManagement->details;
  $data['visit_count'] = $userManagement->visit_count;
  $data['spacial_notes'] = $userManagement->spacial_notes;
  $data['followup_date'] = $userManagement->followup_date;
}
      return response()->json([
      "success" => true,
      "data" => $data
      ]);
  }


  public function updateUserManagement(Request $request) {
    $user = JWTAuth::toUser($request->token);

    $getusersearch = UserManagement::where('user_id', $request->user_id)
                  ->update(['budget' => $request->budget, 'details' => $request->details, 'visit_count' => $request->visit_count, 'spacial_notes' => $request->spacial_notes, 'followup_date' => $request->followup_date]);

    $data = array();
    $data['user_id'] = $request->user_id;
    $data['budget'] = $request->budget;
    $data['details'] = $request->details;
    $data['visit_count'] = $request->visit_count;
    $data['spacial_notes'] = $request->spacial_notes;
    $data['followup_date'] = $request->followup_date;

    return response()->json([
      "success" => true,
      "data" => $data
      ]);
  }


  public function getNearYou(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    $stateId = UserContact::where('user_id', $user->id)->first();
    if(isset($stateId)){
      $user_stateId = $stateId->id;
      $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->join('user_contacts', 'user_contacts.user_id', '=', 'users.id')->where('user_details.user_id', '!=',$user->id)->where('user_details.role_id', 3)->where('user_contacts.state', '=', $user_stateId)->orderBy('user_details.updated_at', 'DESC')->get();

    }else{
      $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->join('user_contacts', 'user_contacts.user_id', '=', 'users.id')->where('user_details.user_id', '!=',$user->id)->where('user_details.role_id', 3)->orderBy('user_details.updated_at', 'DESC')->get();

    }

    // return response()->json([
    // "success" => true,
    // "data" => $getUser
    // ]);


    $dataR1 = array();
    foreach ($getUser as $user) {
      $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

      $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
      // print_r($getDUser);
      $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
      $dataR = array();
      $dataR['firstname'] = $getDUser['first_name']??'null';
      $dataR['middlename'] = $getDUser['middle_name']??'null';
      $dataR['lastname'] = $getDUser['last_name']??'null';
      $dataR['gender'] = $getDUser['gender']??'null';
      $dataR['profileImage'] = $profileImage;
      $dataR['user_id'] = $user->user_id;
      if(isset($users)){
      if($users->age_id > 0){
        $agedtaa = Age::where('id', $users->age_id)->first();
        $dataR['age'] = $agedtaa->name;
      }else {
        $dataR['age'] = '';
      }

      if($users->marital_status > 0){
        $maritalstatus = MaritalStatus::where('id', $users->marital_status)->first();
        $dataR['marital_status'] = $maritalstatus->name;
      }else {
        $dataR['marital_status'] = '';
      }

      if($users->height_id > 0){
        $height = Height::where('id', $users->height_id)->first();
        $dataR['height'] = $height->height;
      }else {
        $dataR['height'] = '';
      }
    }else{
      $dataR['age'] = '';
      $dataR['marital_status'] = '';
      $dataR['height'] = '';
    }
      // $dataR['age'] = (isset($user->agedtaa)) ? $user->agedtaa : '';
      // $dataR['marital_status'] = (isset($user->maritalstatus)) ? $user->maritalstatus : '';
      // $dataR['height'] = (isset($user->height)) ? $user->height : '';
     array_push($dataR1, $dataR);
    }


    return response()->json([
    "success" => true,
    "data" => $dataR1
    ]);

  }

  public function getMyMatch(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    $dateset = date('Y-m-d',strtotime('-7 day'));
    $getUserDt = UserLike::select('user_id')->where('created_by', $user->id)->where('activity_type_id', 6)->orderBy('updated_at', 'DESC')->get();
    $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->whereNotIn('users.id', $getUserDt)->orderBy('users.updated_at', 'DESC')->get();



    $dataR1 = array();
    foreach ($getUser as $user) {
      $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

      $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
      // print_r($getDUser);
      // return response()->json([
      // "success" => true,
      // "data" => $user
      // ]);
      $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
      $dataR = array();
      $dataR['firstname'] = $getDUser['first_name']??'null';
      $dataR['middlename'] = $getDUser['middle_name']??'null';
      $dataR['lastname'] = $getDUser['last_name']??'null';
      $dataR['gender'] = $getDUser['gender']??'null';
      $dataR['profileImage'] = $profileImage;
      $dataR['user_id'] = $user->user_id;
      if(isset($users)){
      if($users->age_id != null){
        $agedtaa = Age::where('id', $users->age_id)->first();
        $dataR['age'] = $agedtaa->name;
      }else {
        $dataR['age'] = '';
      }

      if($users->marital_status > 0){
        $maritalstatus = MaritalStatus::where('id', $users->marital_status)->first();
        $dataR['marital_status'] = $maritalstatus->name;
      }else {
        $dataR['marital_status'] = '';
      }

      if($users->height_id > 0){
        $height = Height::where('id', $users->height_id)->first();
        $dataR['height'] = $height->height;
      }else {
        $dataR['height'] = '';
      }
    }else{
      $dataR['age'] = '';
      $dataR['marital_status'] = '';
      $dataR['height'] = '';
    }
      // $dataR['age'] = (isset($user->agedtaa)) ? $user->agedtaa : '';
      // $dataR['marital_status'] = (isset($user->maritalstatus)) ? $user->maritalstatus : '';
      // $dataR['height'] = (isset($user->height)) ? $user->height : '';
     array_push($dataR1, $dataR);
    }


    return response()->json([
    "success" => true,
    "data" => $dataR1
    ]);

  }

  public function getByCaste(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    $dateset = date('Y-m-d',strtotime('-7 day'));

    $getUserDt = UserLike::select('user_id')->where('created_by', $user->id)->where('activity_type_id', 6)->orderBy('updated_at', 'DESC')->get();
    $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->whereNotIn('users.id', $getUserDt)->orderBy('users.updated_at', 'DESC')->get();



    $dataR1 = array();
    foreach ($getUser as $user) {
      $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

      $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
      // print_r($getDUser);
      // return response()->json([
      // "success" => true,
      // "data" => $user
      // ]);
      $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
      $dataR = array();
      $dataR['firstname'] = $getDUser['first_name']??'null';
      $dataR['middlename'] = $getDUser['middle_name']??'null';
      $dataR['lastname'] = $getDUser['last_name']??'null';
      $dataR['gender'] = $getDUser['gender']??'null';
      $dataR['profileImage'] = $profileImage;
      $dataR['user_id'] = $user->user_id;
      if(isset($users)){
      if($users->age_id != null){
        $agedtaa = Age::where('id', $users->age_id)->first();
        $dataR['age'] = $agedtaa->name;
      }else {
        $dataR['age'] = '';
      }

      if($users->marital_status > 0){
        $maritalstatus = MaritalStatus::where('id', $users->marital_status)->first();
        $dataR['marital_status'] = $maritalstatus->name;
      }else {
        $dataR['marital_status'] = '';
      }

      if($users->height_id > 0){
        $height = Height::where('id', $users->height_id)->first();
        $dataR['height'] = $height->height;
      }else {
        $dataR['height'] = '';
      }
    }else{
      $dataR['age'] = '';
      $dataR['marital_status'] = '';
      $dataR['height'] = '';
    }
      // $dataR['age'] = (isset($user->agedtaa)) ? $user->agedtaa : '';
      // $dataR['marital_status'] = (isset($user->maritalstatus)) ? $user->maritalstatus : '';
      // $dataR['height'] = (isset($user->height)) ? $user->height : '';
     array_push($dataR1, $dataR);
    }


    return response()->json([
    "success" => true,
    "data" => $dataR1
    ]);

  }

  public function getCountAll(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->id;
    $data = array();

    $dateset = date('Y-m-d',strtotime('-7 day'));
    $getTodayMatch = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->where('users.created_at', '>=', $dateset)->count();
    $data['getTodayMatchCount'] = $getTodayMatch;

    $stateId = UserContact::where('user_id', $user->id)->first();
    if(isset($stateId)){
      $user_stateId = $stateId->id;
      $getNearYouCount = User::join('user_details', 'user_details.user_id', '=', 'users.id')->join('user_contacts', 'user_contacts.user_id', '=', 'users.id')->where('user_details.role_id', '!=',$user->id)->where('user_details.role_id', 3)->where('user_contacts.state', '=', $user_stateId)->count();
    }else{
      $getNearYouCount = User::join('user_details', 'user_details.user_id', '=', 'users.id')->join('user_contacts', 'user_contacts.user_id', '=', 'users.id')->where('user_details.role_id', '!=',$user->id)->where('user_details.role_id', 3)->count();
    }
    $data['getNearYouCount'] = $getNearYouCount;

    $dateset = date('Y-m-d',strtotime('-7 day'));
    $getMyMatch = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->where('users.created_at', '>=', $dateset)->count();
    $data['getMyMatchCount'] = $getMyMatch;

    $getDisLikedByYou = UserLike::where('created_by', $user->id)->where('activity_type_id', 2)->count();
    $data['getDisLikedCount'] = $getDisLikedByYou;

    $getLikedByYou = UserLike::where('created_by', $user->id)->where('activity_type_id', 1)->count();
    $data['getLikedCount'] = $getLikedByYou;

    $getArchiveByYou = UserLike::where('created_by', $user->id)->where('activity_type_id', 3)->count();
    $data['getArchiveCount'] = $getArchiveByYou;

    $getRecentVisitedToYou = UserVisit::where('user_id', $user->id)->count();
    $data['getRecentVisitedByYouCount'] = $getRecentVisitedToYou;

    $getRecentYouVisited = UserVisit::where('visiter_id', $user->id)->count();
    $data['getRecentYouVisitedCount'] = $getRecentYouVisited;

    $dateset1 = date('Y-m-d',strtotime('-20 day'));
    $getRecentAdded = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->where('users.created_at', '>=', $dateset1)->count();
    $data['getNewUsersCount'] = $getRecentAdded;

    return response()->json([
    "success" => true,
    "data" => $data
    ]);
  }

  public function getUserLookingFor(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    $getLooking = UserSearching::where('user_id', $userId)->first();

    $data = array();

    if($getLooking === null){
      $data['user_id'] = $userId;
      $data['lookingFor']['height_from'] = "";
      $data['lookingFor']['height_to'] = "";
      $data['lookingFor']['age_from'] = "";
      $data['lookingFor']['age_to'] = "";
      $data['lookingFor']['annual_income'] = "";
      $data['lookingFor']['diet'] = "";
      $data['lookingFor']['work_type'] = "";
      $data['lookingFor']['marital_status'] = "";
      $data['lookingFor']['gotra'] = "";
      $data['lookingFor']['caste'] = "";
      $data['lookingFor']['user_id'] = "";
      $data['lookingFor']['quality'] = "";
    }else{
      // $data['height_from'] = $getLooking->height_from;
      // $data['height_to'] = $getLooking->height_to;
      // $data['age_from'] = $getLooking->age_from;
      // $data['age_to'] = $getLooking->age_to;
      // $data['annual_income'] = $getLooking->annual_income_id;
      // $data['diet'] = $getLooking->diet_type_id;
      // $data['work_type'] = $getLooking->work_type;
      // $data['marital_status'] = $getLooking->marital_status;
      // $data['gotra'] = $getLooking->gotra_id;
      // $data['caste'] = $getLooking->caste_id;
      // $data['quality'] = $getLooking->quality_id;
      $data['user_id'] = $userId;

      if($getLooking->height_from > 0){
        $heightfrom = Height::where('id', $getLooking->height_from)->first();
        $data['lookingFor']['height_from'] = $heightfrom->height;
      }else {
        $data['lookingFor']['height_from'] = '';
      }
      if($getLooking->height_to > 0){
        $heightto = Height::where('id', $getLooking->height_to)->first();
        $data['lookingFor']['height_to'] = $heightto->height;
      }else {
        $data['lookingFor']['height_to'] = '';
      }

      if($getLooking->height_to > 0){
        $heightfrom = Height::where('id', $getLooking->height_from)->first();
        $heightto = Height::where('id', $getLooking->height_to)->first();
        $data['lookingFor']['height'] = $heightfrom->height." - ".$heightto->height;
      }else {
        $data['lookingFor']['height'] = '';
      }

      if($getLooking->age_from > 0){
        $agefrom = Age::where('id', $getLooking->age_from)->first();
        $data['lookingFor']['age_from'] = $agefrom->name;
      }else {
        $data['lookingFor']['age_from'] = '';
      }
      if($getLooking->age_to > 0){
        $ageto = Age::where('id', $getLooking->age_to)->first();
        $data['lookingFor']['age_to'] = $ageto->name;
      }else {
        $data['lookingFor']['age_to'] = '';
      }
      if($getLooking->age_to > 0){
        $agefrom = Age::where('id', $getLooking->age_from)->first();
        $ageto = Age::where('id', $getLooking->age_to)->first();
        $data['lookingFor']['age'] = $agefrom->name." - ".$ageto->name;
      }else {
        $data['lookingFor']['age'] = '';
      }
      if($getLooking->annual_income_id > 0){
        $annualincome = AnnualIncome::where('id', $getLooking->annual_income_id)->first();
        $data['lookingFor']['annual_income'] = $annualincome->incomes;
      }else {
        $data['lookingFor']['annual_income'] = '';
      }
      if($getLooking->diet_type_id > 0){
        $diettype = DietType::where('id', $getLooking->diet_type_id)->first();
        $data['lookingFor']['diet_type'] = $diettype->diet;
      }else {
        $data['lookingFor']['diet_type'] = '';
      }
      if($getLooking->work_type > 0){
        $worktype = WorkType::where('id', $getLooking->work_type)->first();
        $data['lookingFor']['work_type'] = $worktype->name;
      }else {
        $data['lookingFor']['work_type'] = '';
      }
      if($getLooking->caste_id > 0){
        $caste = Caste::where('id', $getLooking->caste_id)->first();
        $data['lookingFor']['caste'] = $caste->name;
      }else {
        $data['lookingFor']['caste'] = '';
      }
      if($getLooking->gotra_id > 0){
        $gotra = Gotra::where('id', $getLooking->gotra_id)->first();
        $data['lookingFor']['gotra'] = $gotra->name;
      }else {
        $data['lookingFor']['gotra'] = '';
      }
      if($getLooking->marital_status > 0){
        $maritalstatus = MaritalStatus::where('id', $getLooking->marital_status)->first();
        $data['lookingFor']['marital_status'] = $maritalstatus->name;
      }else {
        $data['lookingFor']['marital_status'] = '';
      }
      if($getLooking->quality_id > 0){
        $maritalstatus = Quality::where('id', $getLooking->quality_id)->first();
        $data['lookingFor']['quality'] = $maritalstatus->name;
      }else {
        $data['lookingFor']['quality'] = '';
      }

    }
      return response()->json([
      "success" => true,
      "data" => $data
      ]);
  }


  public function addMatchmaking(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $match = explode(',',$request->matching_id);
    foreach ($match as $value) {
      UserMatch::create([
        'user_id' => $request->user_id,
        'matching_id' => $value,
        'agent_id' => $user->id,
        ]);
    }

    ApiResponse::create([
      'api_name' => 'user matching add',
      'response' => $request,
      'user_id' => $userId,
    ]);

    return response()->json([
      "success" => true,
      'message' => 'Matching User created successfully',
      ]);
  }

  public function getReferUser(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.created_by_user', $user->id)->where('user_details.user_id', '!=' , $userId)->where('user_details.gender', '!=' , $request->gender)->orderBy('user_details.updated_at', 'DESC')->take(30)->get();


$dataR1 = array();
foreach ($getUser as $users) {
  $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $users['user_id'])->first();

  $getLike = UserLike::where('user_id', $users['user_id'])->where('created_by', $user->id)->first();

  $getDUser = UserDetails::where('user_id', $users['user_id'])->first();
  // print_r($getDUser);

  $profileImage = File::select('file_path')->where('user_id', $users['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
  $dataR = array();
  $dataR['firstname'] = $getDUser['first_name']??'null';
  $dataR['middlename'] = $getDUser['middle_name']??'null';
  $dataR['lastname'] = $getDUser['last_name']??'null';
  $dataR['gender'] = $getDUser['gender']??'null';
  $dataR['profileImage'] = $profileImage;
  $dataR['user_id'] = $users->user_id;
  // $dataR['age'] = (isset($user->agedtaa)) ? $user->agedtaa : '';
  // $dataR['marital_status'] = (isset($user->maritalstatus)) ? $user->maritalstatus : '';
  // $dataR['height'] = (isset($user->height)) ? $user->height : '';

  if($users->age_id > 0){
    $agedtaa = Age::where('id', $users->age_id)->first();
    $dataR['age'] = $agedtaa->name;
  }else {
    $dataR['age'] = '';
  }

  if($users->marital_status > 0){
    $maritalstatus = MaritalStatus::where('id', $users->marital_status)->first();
    $dataR['marital_status'] = $maritalstatus->name;
  }else {
    $dataR['marital_status'] = '';
  }

  if($users->height_id > 0){
    $height = Height::where('id', $users->height_id)->first();
    $dataR['height'] = $height->height;
  }else {
    $dataR['height'] = '';
  }
  if($users->caste_id > 0){
    $caste = Caste::where('id', $users->caste_id)->first();
    $dataR['caste'] = $caste->name;
  }else {
    $dataR['caste'] = '';
  }
  $dataR['like'] = (isset($getLike->activity_type_id)) ? $getLike->activity_type_id : '';
 array_push($dataR1, $dataR);
}

return response()->json([
"success" => true,
"data" => $dataR1
]);

}

public function getBenefit(Request $request) {
  // $user = JWTAuth::toUser($request->token);
  // $userId = $user->id;
  $getbenefitnormal = Benefit::where('type', 2)->where('section', 1)->where('status', 1)->orderBy('order', 'ASC')->get();
  $getbenefitpayment = Benefit::where('type', 2)->where('section', 2)->where('status', 1)->orderBy('order', 'ASC')->get();
  $data = array();
  $dataR1 = array();
  $dataR2 = array();
  $dataR3  = array();
  $i = 0;
  foreach ($getbenefitnormal as $value) {
    $dataR1['benefit'][$i]['question'] = $value['question'];
    $dataR1['benefit'][$i]['answer'] = $value['answer'];
    $i++;
  }
  if(count($dataR1) > 0){
    array_push($data, $dataR1);
  }
  $y = 0;
  $getCommQuestion = CommonQuestion::where('status', 1)->where('type', 2)->get();
  foreach ($getCommQuestion as $value) {
    $dataR2['commonquestion'][$y]['question'] = $value['question'];
    $dataR2['commonquestion'][$y]['answer'] = $value['answer'];
    $y++;
  }
  if(count($dataR2) > 0){
    array_push($data, $dataR2);
  }
  $z = 0;
  foreach ($getbenefitpayment as $value) {
    $dataR3['payment'][$z]['type'] = $value['question'];
    $dataR3['payment'][$z]['content'] = $value['answer'];
    $z++;
  }if(count($dataR3) > 0){
    array_push($data, $dataR3);
  }
  return response()->json([
  "success" => true,
  "data" => $data
  ]);
}

public function dashboard(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;
  $profileImage = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 1)->where('status', 1)->first();
  
  // its static data not completed yet
  $data = array();
  $data['marrage']['in_progress'] = 3;
  $data['marrage']['final'] = 2;
  $data['marrage']['completed'] = 1;

  $data['revenue']['monthly'] = 2000;
  $data['revenue']['monthly_marrage_count'] = 7;
  $data['revenue']['yearly'] = 12000;
  $data['revenue']['yearly_marrage_count'] = 20;

  $data['withdraw_proposal']['current_month'] = 202;
  $data['withdraw_proposal']['current_month_marrage_count'] = 2;
  $data['withdraw_proposal']['previous_month'] = 2000;
  $data['withdraw_proposal']['previous_month_marrage_count'] = 12;
  $data['withdraw_proposal']['yearly'] = 20000;
  $data['withdraw_proposal']['yearly_marrage_count'] = 30;

  $data['review'][0]['username'] = "Amit Tiwari";
  $data['review'][0]['profileImage'] = "http://65.1.238.125:8080/public/images/profile/executiveProfile/1702655725.jpg";
  $data['review'][0]['email'] = "abcd@test.com";
  $data['review'][0]['rating'] = 3.5;
  $data['review'][0]['comment'] = "Because none of you read the question entirely: you proposed something which was not relevant: there is no file. Period. This was the main problem, as mentioned in the question";
  $data['review'][1]['username'] = "Sanjay Singh";
  $data['review'][1]['profileImage'] = "http://65.1.238.125:8080/public/images/profile/executiveProfile/1702655725.jpg";
  $data['review'][1]['email'] = "sanjay@test.com";
  $data['review'][1]['rating'] = 3;
  $data['review'][1]['comment'] = "Because none of you read the question entirely: you proposed something which was not relevant: there is no file. Period. This was the main problem, as mentioned in the question";

  $data['profile_image'] = $profileImage->file_path??'null';
  $data['profile_complete'] = 80;
  $data['rating'] = 4;

  return response()->json([
  "success" => true,
  "data" => $data
  ]);
}

public function updateAboutMe(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;
$user = UserBasicDetail::where('user_id', $userId)
            ->update(['about_me_short' => $request->about_me, 'about_me_long' => $request->about_me]);
          $data = array();
          $data['about_me'] = $request->about_me;
    return response()->json([
    "success" => true,
    "message" => "Updated successfully",
    "data" => $data
    ]);
}

public function getAboutMe(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;
  $user = UserBasicDetail::where('user_id', $userId)->first();
// return $user;
          $data = array();
          $data['about_me'] = $user->about_me_short;
    return response()->json([
    "success" => true,
    "data" => $data
    ]);
}

public function addPost(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;
  $data = $request->all();
        // dd($data);exit;
 
  $post = UserPost::create([
    'title' => $request->title,
    'post' => $request->post,
    'user_id' => $userId,
    'status' => 1,
    'like_count' => 0,
    'dislike_count' => 0,
    'comment_count' => 0,
  ]);
  $image = new Image;
    if(isset($request->image)){
      // foreach ($request->image as $value) {
        $getImage = $request->image;
        $imageName = time().'.'.$getImage->extension();
        $imagePath = public_path(). '/images/post';

        $image->path = $imagePath;
        $image->image = $imageName;
        $ddd = $getImage->move($imagePath, $imageName);

        $imagepath = 'http://65.1.238.125:8080/public/images/post/'.$imageName;

        $fileadd = File::create([
          'user_id' => $userId,
          'file_type_id' => 7,
          'file_name' => $imageName,
          'file_path' => $imagepath,
          'file_origin' => $request->image,
          'status' => 1,
          'post_id' => $post->id
        ]);
      // }
    }
  if($post){
    return response()->json([
      "success" => true,
      "message" => "new Post created Successfully",
      "data" => $post
      ]);
  }else{
    return response()->json([
      "success" => false,
      "message" => "Post not created"
      ]);
  }
  
}

public function getPost(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;

  $getPost1 = UserPost::get();
  $dataR = array();
  foreach($getPost1 as $getPost){
    $getuserImage1 = file::where('user_id', $getPost['user_id'])->where('file_type_id', 1)->first();
    $userDetails = User::where('id', $getPost['user_id'])->first();  
    $postImage = file::where('post_id', $getPost['id'])->where('file_type_id', 7)->first();
    $dataR1 = array(); 
        $dataR1['post'] = $getPost['post']??'null';
        $dataR1['post_id'] = $getPost['id']??'null';
        $dataR1['user_id'] = $getPost['user_id']??'null';
        $dataR1['user_name'] = $userDetails['name']??'null';
        $dataR1['date'] = $getPost['created_at']??'null';
        $dataR1['like_count'] = $getPost['like_count']??'null';
        $dataR1['dislike_count'] = $getPost['dislike_count']??'null';
        $dataR1['comment_count'] = $getPost['comment_count']??'null';
        $dataR1['rating'] = 3;
        $dataR1['postImage'] = $postImage['file_path']??'null';
        $dataR1['profileImage'] = $getuserImage1['file_path']??'null';

        array_push($dataR, $dataR1);
  }
// return $user;
    return response()->json([
    "success" => true,
    "data" => $dataR
    ]);
}

public function addPostLike(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;
  $getPost = UserPostAction::where('user_id', $userId)->where('user_post_id', $request->post_id)->where('action', $request->action)->first();
  if(is_null($getPost)){
    if($request->action == 1){
      $usercheck = UserPostAction::where('user_id', $userId)->where('action', 2)->where('user_post_id', $request->post_id)->first();
     
      if(!is_null($usercheck)){
        UserPostAction::where('user_id', $userId)->where('action', 2)->where('user_post_id', $request->post_id)->update(['action' => $request->action]);
      }else{
        UserPostAction::create([
          'user_post_id' => $request->post_id,
          'user_id' => $userId,
          'action' => $request->action
        ]);
      }
      $getpostLCount = UserPostAction::where('user_id', $userId)->where('action', 1)->where('user_post_id', $request->post_id)->count();
      $getpostDLCount = UserPostAction::where('user_id', $userId)->where('action', 2)->where('user_post_id', $request->post_id)->count();
      UserPost::where('id', $request->post_id)->update(['like_count' => $getpostLCount,'dislike_count' => $getpostDLCount]);

     return response()->json([
        "success" => true,
        "message" => "like Successfully"
        ]);
    } else if($request->action == 2){
    $usercheck = UserPostAction::where('user_id', $userId)->where('user_post_id', $request->post_id)->where('action', 1)->first();
    if(!is_null($usercheck)){
      UserPostAction::where('user_id', $userId)->where('action', 1)->where('user_post_id', $request->post_id)->update(['action' => $request->action]);
    }else{
      UserPostAction::create([
        'user_post_id' => $request->post_id,
        'user_id' => $userId,
        'action' => $request->action
      ]);
    }
    $getpostLCount = UserPostAction::where('user_id', $userId)->where('action', 1)->where('user_post_id', $request->post_id)->count();
    $getpostDLCount = UserPostAction::where('user_id', $userId)->where('action', 2)->where('user_post_id', $request->post_id)->count();
    UserPost::where('id', $request->post_id)->update(['like_count' => $getpostLCount,'dislike_count' => $getpostDLCount]);
    return response()->json([
      "success" => true,
      "message" => "Dis-like Successfully"
      ]);
    }else{
      return response()->json([
        "success" => false,
        "message" => "not Done"
        ]);
    }
  } else {
    return response()->json([
      "success" => true,
      "message" => "all Ready done for this post"
      ]);
  }
  
    
}

public function addPostDisLike(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;
  $getPost = UserPostAction::where('user_id', $userId)->where('user_post_id', $request->post_id)->where('action', $request->action)->first();
  if(is_null($getPost)){
    if($request->action == 2){
      $usercheck = UserPostAction::where('user_id', $userId)->where('user_post_id', $request->post_id)->where('action', 1)->first();
      if(!is_null($usercheck)){
        UserPostAction::where('user_id', $userId)->where('action', 1)->where('user_post_id', $request->post_id)->update(['action' => $request->action]);
      }else{
        UserPostAction::create([
          'user_post_id' => $request->post_id,
          'user_id' => $userId,
          'action' => $request->action
        ]);
      }
      $getpostLCount = UserPostAction::where('user_id', $userId)->where('action', 1)->where('user_post_id', $request->post_id)->count();
      $getpostDLCount = UserPostAction::where('user_id', $userId)->where('action', 2)->where('user_post_id', $request->post_id)->count();
      UserPost::where('id', $request->post_id)->update(['like_count' => $getpostLCount,'dislike_count' => $getpostDLCount]);
      return response()->json([
        "success" => true,
        "message" => "Dis-like Successfully"
        ]);
    }else{
      return response()->json([
        "success" => false,
        "message" => "not Done"
        ]);
    }

  }else{
    return response()->json([
      "success" => true,
      "message" => "all Ready done for this post"
      ]);
  }
  
    
}

public function addReview(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;
  $review = Review::create([
    'title' => $request->title,
    'review' => $request->post,
    'user_id' => $userId,
    'status' => 1
  ]);
  $image = new Image;
    if(isset($request->image)){
      // foreach ($request->image as $value) {
        $getImage = $request->image;
        $imageName = time().'.'.$getImage->extension();
        $imagePath = public_path(). '/images/review';

        $image->path = $imagePath;
        $image->image = $imageName;
        $ddd = $getImage->move($imagePath, $imageName);

        $imagepath = 'http://65.1.238.125:8080/public/images/review/'.$imageName;

        $fileadd = File::create([
          'user_id' => $userId,
          'file_type_id' => 8,
          'file_name' => $imageName,
          'file_path' => $imagepath,
          'file_origin' => $request->image,
          'status' => 1,
          'review_id' => $review->id
        ]);
      // }
    }
  if($review){
    return response()->json([
      "success" => true,
      "message" => "new Review created Successfully"
      ]);
  }else{
    return response()->json([
      "success" => false,
      "message" => "Review is not created Successfully"
      ]);
  }
}

public function getReview(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;

  $getreview = Review::get();
  $dataR1 = array();
  foreach ($getreview as $review) {
    $getreviewComment = UserReviewComment::where('review_id', $review->id)->get();
    $dataR = array();
    $getuserImage1 = file::where('user_id', $review['user_id'])->where('file_type_id', 1)->first();
    $userDetails = User::where('id', $review['user_id'])->first(); 
    $reviewImage = file::where('review_id', $review['id'])->where('file_type_id', 8)->first();  
        $dataR['review'] = $review['review']??'null';
        $dataR['review_id'] = $review['id']??'null';
        $dataR['user_id'] = $review['user_id']??'null';
        $dataR['user_name'] = $userDetails['name']??'null';
        $dataR['date'] = $review['created_at']??'null';
        $dataR['rating'] = 3;
        $dataR['reviewImage'] = $reviewImage['file_path']??'null';
        $dataR['profileImage'] = $getuserImage1['file_path']??'null';
        $i = 0;
        if($getreviewComment->count() > 0){

        foreach ($getreviewComment as $reviewC) {
          $getuserImage = file::where('user_id', $reviewC['user_id'])->where('file_type_id', 1)->first();
          //$dataR2 = array();
          $userDetail1 = User::where('id', $reviewC['user_id'])->first(); 
          $dataR['comment'][$i]['comment'] = $reviewC['comment']??'null';
          $dataR['comment'][$i]['user_id'] = $reviewC['user_id']??'null';
          $dataR['comment'][$i]['comment_id'] = $reviewC['id']??'null';
          $dataR['comment'][$i]['user_name'] = $userDetail1['name']??'null';
          $dataR['comment'][$i]['date'] = $reviewC['created_at']??'null';
          $dataR['comment'][$i]['profileImage'] = $getuserImage['file_path']??'null';
          //array_push($dataR, $dataR2);
          $i++;
        }
      }else{
        $dataR['comment'] = [];
      }
       array_push($dataR1, $dataR);
  }
// return $user;
    return response()->json([
    "success" => true,
    "data" => $dataR1
    ]);
}

public function addPostComment(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;
  $user = UserPostComment::create([
    'user_post_id' => $request->post_id,
    'comment' => $request->comment,
    'user_id' => $userId
  ]);
  $postData = UserPost::where('id', $request->post_id)->first();
  $getpostLCount = $postData['comment_count'] + 1;
  UserPost::where('id', $request->post_id)->update(['comment_count' => $getpostLCount]);
  if($user){
    return response()->json([
      "success" => true,
      "message" => "save comment Successfully"
      ]);
  }else{
    return response()->json([
      "success" => false,
      "message" => "Not Saved"
      ]);
  }
}

public function getPostComment(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;

  $getPostComment = UserPostComment::where('user_post_id', $request->post_id)->get();
  $dataR1 = array();
  foreach ($getPostComment as $postComment) {
    $getreviewComment = UserPostComment::where('user_post_id', $postComment->id)->get();
    $userDetail1 = User::where('id', $postComment['user_id'])->first(); 
    $dataR = array();
    $getuserImage1 = file::where('user_id', $postComment['user_id'])->where('file_type_id', 1)->first();
        $dataR['comment'] = $postComment['comment']??'null';
        $dataR['user_id'] = $postComment['user_id']??'null';
        $dataR['profileImage'] = $getuserImage1['file_path']??'null';
        $dataR['comment_id'] = $postComment['id']??'null';
        $dataR['user_name'] = $userDetail1['name']??'null';
        $dataR['date'] = $postComment['created_at']??'null';
       array_push($dataR1, $dataR);
  }
    return response()->json([
    "success" => true,
    "data" => $dataR1
    ]);
}

public function addReviewComment(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $user->id;
  $user = UserReviewComment::create([
    'review_id' => $request->review_id,
    'comment' => $request->comment,
    'user_id' => $userId
  ]);
  if($user){
    return response()->json([
      "success" => true,
      "message" => "save comment Successfully"
      ]);
  }else{
    return response()->json([
      "success" => false,
      "message" => "Not Saved"
      ]);
  }
}

public function movetofinal(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      if($request->user_id == null){
        return response()->json([
        "success" => false,
        "message" => "Please pass User Id"
        ]);
      }
      $check = UserLike::where('user_id', $request->user_id)->where('created_by', $user->id)->count();
      if($check == 0){
        $like = UserLike::create([
          'user_id' => $request->user_id,
          'activity_type_id' => 6,
          'created_by' => $user->id
        ]);
        if($request->user_id != $user->id){
          $noti = Notification::create([
            'user_id' => $request->user_id,
            'content' => "".$user->name."Move to final Your Profile on ".date('Y-m-d'),
            'created_by' => $user->id,
            'status' => 0
          ]);
        }
      }else{
        $like = UserLike::where('user_id', $request->user_id)->where('created_by', $user->id)->update(['activity_type_id' => 6]);
      }
      ApiResponse::create([
        'api_name' => 'Move to final api call',
        'response' => $request,
        'user_id' => $userId,
      ]);
      return response()->json([
      "success" => true,
      "message" => "User set Move to final successfully",
      "data" => $like
      ]);
    }
    
    public function deletefinal(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      if($request->user_id == null){
        return response()->json([
        "success" => false,
        "message" => "Please pass User Id"
        ]);
      }
      $like = UserLike::where('user_id', $request->user_id)->where('created_by', $user->id)->update(['activity_type_id' => 3]);
       
      ApiResponse::create([
        'api_name' => 'delete from final api call',
        'response' => $request,
        'user_id' => $userId,
      ]);
      return response()->json([
      "success" => true,
      "message" => "User delete from final discussion",
      "data" => $like
      ]);
    }

    public function getLikedByPerson(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      if($request->user_id == null){
        return response()->json([
        "success" => false,
        "message" => "Please pass User Id"
        ]);
      }
      $like = UserLike::where('activity_type_id', 1)->where('user_id', $request->user_id)->get();
      
      return response()->json([
      "success" => true,
      "message" => "get All liked data",
      "data" => $like
      ]);
    }

    // public function getLikedByPerson(Request $request)
    // {
    //   $user = JWTAuth::toUser($request->token);
    //   $userId = $request->user_id;
    //   if($request->user_id == null){
    //     return response()->json([
    //     "success" => false,
    //     "message" => "Please pass User Id"
    //     ]);
    //   }
    //   $like = UserLike::where('activity_type_id', 1)->where('user_id', $request->user_id)->get();
      
    //   return response()->json([
    //   "success" => true,
    //   "message" => "get All liked data",
    //   "data" => $like
    //   ]);
    // }
    

    public function userPreferences(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      
      $users = User::where('id', $request->user_id)->update(['user_preferences' => 1]);
      
      if($users){
        return response()->json([
          "success" => true,
          "message" => "set preferences Successfully"
          ]);
      }else{
        return response()->json([
          "success" => false,
          "message" => "Not Saved"
          ]);
      }
    }

    public function profileVerify(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $users = User::where('id', $request->user_id)->update(['user_verification' => 1]);
      if($users){
        return response()->json([
          "success" => true,
          "message" => "Profile Activated Successfully"
          ]);
      }else{
        return response()->json([
          "success" => false,
          "message" => "Not Saved"
          ]);
      }
    }

    public function getMoveToFinal(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      $getUser = UserLike::where('created_by', $user->id)->where('activity_type_id', 6)->orderBy('updated_at', 'DESC')->get();
      
      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

        $getDUser = UserDetails::where('user_id', $user['user_id'])->first();

        $getLike = UserLike::where('user_id', $user['user_id'])->where('created_by', $user->id)->where('activity_type_id', 1)->first();
        // print_r($getDUser);
        $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
        // $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
        $dataR = array();
        $dataR['firstname'] = $getDUser['first_name']??'null';
        $dataR['middlename'] = $getDUser['middle_name']??'null';
        $dataR['lastname'] = $getDUser['last_name']??'null';
        $dataR['gender'] = $getDUser['gender']??'null';
        $dataR['profileImage'] = $profileImage;
        $dataR['user_id'] = $user->user_id;
        $dataR['blur_image'] = $getDUser['image_hide']??'null';
        $dataR['image_count'] = $profileImage->count();
        if(isset($users)){
        if($users->age_id > 0){
          $agedtaa = Age::where('id', $users->age_id)->first();
          $dataR['age'] = $agedtaa->name;
        }else {
          $dataR['age'] = '';
        }

        if($users->marital_status > 0){
          $maritalstatus = MaritalStatus::where('id', $users->marital_status)->first();
          $dataR['marital_status'] = $maritalstatus->name;
        }else {
          $dataR['marital_status'] = '';
        }

        if($users->height_id > 0){
          $height = Height::where('id', $users->height_id)->first();
          $dataR['height'] = $height->height;
        }else {
          $dataR['height'] = '';
        }
      }else{
        $dataR['age'] = '';
        $dataR['marital_status'] = '';
        $dataR['height'] = '';
      }
        // $dataR['age'] = (isset($user->agedtaa)) ? $user->agedtaa : '';
        // $dataR['marital_status'] = (isset($user->maritalstatus)) ? $user->maritalstatus : '';
        // $dataR['height'] = (isset($user->height)) ? $user->height : '';
        $dataR['like'] = (isset($getLike->activity_type_id)) ? $getLike->activity_type_id : '';
        $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
       array_push($dataR1, $dataR);
     }

      return response()->json([
      "success" => true,
      "data" => $dataR1
      ]);


  }

  public function getMatchMakingByOther(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    $getUser = UserLike::where(['created_by !='.$user->id])->where('activity_type_id', 6)->orderBy('updated_at', 'DESC')->take(10)->get();
    
    $dataR1 = array();
    foreach ($getUser as $user) {
      $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

      $getDUser = UserDetails::where('user_id', $user['user_id'])->first();

      $getLike = UserLike::where('user_id', $user['user_id'])->where('created_by', $user->id)->where('activity_type_id', 1)->first();
      // print_r($getDUser);
      $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
      // $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
      $dataR = array();
      $dataR['firstname'] = $getDUser['first_name']??'null';
      $dataR['middlename'] = $getDUser['middle_name']??'null';
      $dataR['lastname'] = $getDUser['last_name']??'null';
      $dataR['gender'] = $getDUser['gender']??'null';
      $dataR['profileImage'] = $profileImage;
      $dataR['user_id'] = $user->user_id;
      $dataR['blur_image'] = $getDUser['image_hide']??'null';
      $dataR['image_count'] = $profileImage->count();
      if(isset($users)){
      if($users->age_id > 0){
        $agedtaa = Age::where('id', $users->age_id)->first();
        $dataR['age'] = $agedtaa->name;
      }else {
        $dataR['age'] = '';
      }

      if($users->marital_status > 0){
        $maritalstatus = MaritalStatus::where('id', $users->marital_status)->first();
        $dataR['marital_status'] = $maritalstatus->name;
      }else {
        $dataR['marital_status'] = '';
      }

      if($users->height_id > 0){
        $height = Height::where('id', $users->height_id)->first();
        $dataR['height'] = $height->height;
      }else {
        $dataR['height'] = '';
      }
    }else{
      $dataR['age'] = '';
      $dataR['marital_status'] = '';
      $dataR['height'] = '';
    }
      // $dataR['age'] = (isset($user->agedtaa)) ? $user->agedtaa : '';
      // $dataR['marital_status'] = (isset($user->maritalstatus)) ? $user->maritalstatus : '';
      // $dataR['height'] = (isset($user->height)) ? $user->height : '';
      $dataR['like'] = (isset($getLike->activity_type_id)) ? $getLike->activity_type_id : '';
      $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
     array_push($dataR1, $dataR);
   }

    return response()->json([
    "success" => true,
    "data" => $dataR1
    ]);


}
public function getMatchByMangal(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $request->user_id;
  $getUser = UserLike::orderBy('updated_at', 'DESC')->take(10)->get();
  
  $dataR1 = array();
  foreach ($getUser as $user) {
    $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

    $getDUser = UserDetails::where('user_id', $user['user_id'])->first();

    $getLike = UserLike::where('user_id', $user['user_id'])->where('created_by', $user->id)->where('activity_type_id', 1)->first();
    // print_r($getDUser);
    $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
    // $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
    $dataR = array();
    $dataR['firstname'] = $getDUser['first_name']??'null';
    $dataR['middlename'] = $getDUser['middle_name']??'null';
    $dataR['lastname'] = $getDUser['last_name']??'null';
    $dataR['gender'] = $getDUser['gender']??'null';
    $dataR['profileImage'] = $profileImage;
    $dataR['user_id'] = $user->user_id;
    $dataR['blur_image'] = $getDUser['image_hide']??'null';
    $dataR['image_count'] = $profileImage->count();
    if(isset($users)){
    if($users->age_id > 0){
      $agedtaa = Age::where('id', $users->age_id)->first();
      $dataR['age'] = $agedtaa->name;
    }else {
      $dataR['age'] = '';
    }

    if($users->marital_status > 0){
      $maritalstatus = MaritalStatus::where('id', $users->marital_status)->first();
      $dataR['marital_status'] = $maritalstatus->name;
    }else {
      $dataR['marital_status'] = '';
    }

    if($users->height_id > 0){
      $height = Height::where('id', $users->height_id)->first();
      $dataR['height'] = $height->height;
    }else {
      $dataR['height'] = '';
    }
  }else{
    $dataR['age'] = '';
    $dataR['marital_status'] = '';
    $dataR['height'] = '';
  }
    // $dataR['age'] = (isset($user->agedtaa)) ? $user->agedtaa : '';
    // $dataR['marital_status'] = (isset($user->maritalstatus)) ? $user->maritalstatus : '';
    // $dataR['height'] = (isset($user->height)) ? $user->height : '';
    $dataR['like'] = (isset($getLike->activity_type_id)) ? $getLike->activity_type_id : '';
    $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
   array_push($dataR1, $dataR);
 }

  return response()->json([
  "success" => true,
  "data" => $dataR1
  ]);


}

public function getLikedByUserExecutive(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $request->user_id;
  $getUser = UserLike::where('created_by', $userId)->where('activity_type_id', 1)->orderBy('updated_at', 'DESC')->take(10)->get();
  
  $dataR1 = array();
  foreach ($getUser as $user) {
    $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

    $getDUser = UserDetails::where('user_id', $user['user_id'])->first();

    $getLike = UserLike::where('user_id', $user['user_id'])->where('created_by', $user->id)->where('activity_type_id', 1)->first();
    // print_r($getDUser);
    $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
    // $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
    $dataR = array();
    $dataR['firstname'] = $getDUser['first_name']??'null';
    $dataR['middlename'] = $getDUser['middle_name']??'null';
    $dataR['lastname'] = $getDUser['last_name']??'null';
    $dataR['gender'] = $getDUser['gender']??'null';
    $dataR['profileImage'] = $profileImage;
    $dataR['user_id'] = $user->user_id;
    $dataR['blur_image'] = $getDUser['image_hide']??'null';
    $dataR['image_count'] = $profileImage->count();
    if(isset($users)){
    if($users->age_id > 0){
      $agedtaa = Age::where('id', $users->age_id)->first();
      $dataR['age'] = $agedtaa->name;
    }else {
      $dataR['age'] = '';
    }

    if($users->marital_status > 0){
      $maritalstatus = MaritalStatus::where('id', $users->marital_status)->first();
      $dataR['marital_status'] = $maritalstatus->name;
    }else {
      $dataR['marital_status'] = '';
    }

    if($users->height_id > 0){
      $height = Height::where('id', $users->height_id)->first();
      $dataR['height'] = $height->height;
    }else {
      $dataR['height'] = '';
    }
  }else{
    $dataR['age'] = '';
    $dataR['marital_status'] = '';
    $dataR['height'] = '';
  }
    // $dataR['age'] = (isset($user->agedtaa)) ? $user->agedtaa : '';
    // $dataR['marital_status'] = (isset($user->maritalstatus)) ? $user->maritalstatus : '';
    // $dataR['height'] = (isset($user->height)) ? $user->height : '';
    $dataR['like'] = (isset($getLike->activity_type_id)) ? $getLike->activity_type_id : '';
    $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
   array_push($dataR1, $dataR);
 }

  return response()->json([
  "success" => true,
  "data" => $dataR1
  ]);


}

public function getInProgressInExecutive(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $request->user_id;
  $getUser = UserLike::orderBy('updated_at', 'DESC')->take(10)->get();
  
  $dataR1 = array();
  foreach ($getUser as $user) {
    $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

    $getDUser = UserDetails::where('user_id', $user['user_id'])->first();

    $getLike = UserLike::where('user_id', $user['user_id'])->where('created_by', $user->id)->where('activity_type_id', 1)->first();
    // print_r($getDUser);
    $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
    // $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
    $dataR = array();
    $dataR['firstname'] = $getDUser['first_name']??'null';
    $dataR['middlename'] = $getDUser['middle_name']??'null';
    $dataR['lastname'] = $getDUser['last_name']??'null';
    $dataR['gender'] = $getDUser['gender']??'null';
    $dataR['profileImage'] = $profileImage;
    $dataR['user_id'] = $user->user_id;
    $dataR['blur_image'] = $getDUser['image_hide']??'null';
    $dataR['image_count'] = $profileImage->count();
    if(isset($users)){
    if($users->age_id > 0){
      $agedtaa = Age::where('id', $users->age_id)->first();
      $dataR['age'] = $agedtaa->name;
    }else {
      $dataR['age'] = '';
    }

    if($users->marital_status > 0){
      $maritalstatus = MaritalStatus::where('id', $users->marital_status)->first();
      $dataR['marital_status'] = $maritalstatus->name;
    }else {
      $dataR['marital_status'] = '';
    }

    if($users->height_id > 0){
      $height = Height::where('id', $users->height_id)->first();
      $dataR['height'] = $height->height;
    }else {
      $dataR['height'] = '';
    }
  }else{
    $dataR['age'] = '';
    $dataR['marital_status'] = '';
    $dataR['height'] = '';
  }
    // $dataR['age'] = (isset($user->agedtaa)) ? $user->agedtaa : '';
    // $dataR['marital_status'] = (isset($user->maritalstatus)) ? $user->maritalstatus : '';
    // $dataR['height'] = (isset($user->height)) ? $user->height : '';
    $dataR['like'] = (isset($getLike->activity_type_id)) ? $getLike->activity_type_id : '';
    $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
   array_push($dataR1, $dataR);
 }

  return response()->json([
  "success" => true,
  "data" => $dataR1
  ]);


}

public function userFollow(Request $request) {

  $user = JWTAuth::toUser($request->token);
  $userId = $request->user_id;
  if($userId){
    $fileadd = UserFollow::where('user_id', $user->id)->where('follow_id', $userId)->delete();
  
    if(!$fileadd){
      $fileadd = UserFollow::create([
        'user_id' => $user->id,
        'follow_id' => $userId
      ]);
      
    }
  }
  else{
    return response()->json([
      "success" => false,
      "message" => "please enter follow up user id"
      ]);
  }
  
  return response()->json([
    "success" => true,
    "data" => $fileadd
    ]);

}

public function getPortfolioImg(Request $request)
  {
      $data = $request->all();
      // dd($data);exit;

      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;

      $file = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 8)->get();
      return response()->json([
        "success" => true,
        "data" => $file
        ]);
  }


  public function getExecutiveWiseUserMatch(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    $dateset = date('Y-m-d',strtotime('-7 day'));
    $getUserDt = UserDetails::select('user_id')->where('created_by_user', $user->id)->orderBy('updated_at', 'DESC')->get();
    $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->whereNotIn('users.id', $getUserDt)->orderBy('users.updated_at', 'DESC')->get();


    $dataR1 = array();
    foreach ($getUser as $user) {
      $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

      $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
      // print_r($getDUser);
      // return response()->json([
      // "success" => true,
      // "data" => $user
      // ]);
      $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
      $dataR = array();
      $dataR['firstname'] = $getDUser['first_name']??'null';
      $dataR['middlename'] = $getDUser['middle_name']??'null';
      $dataR['lastname'] = $getDUser['last_name']??'null';
      $dataR['gender'] = $getDUser['gender']??'null';
      $dataR['profileImage'] = $profileImage;
      $dataR['user_id'] = $user->user_id;
      if(isset($users)){
      if($users->age_id != null){
        $agedtaa = Age::where('id', $users->age_id)->first();
        $dataR['age'] = $agedtaa->name;
      }else {
        $dataR['age'] = '';
      }

      if($users->marital_status > 0){
        $maritalstatus = MaritalStatus::where('id', $users->marital_status)->first();
        $dataR['marital_status'] = $maritalstatus->name;
      }else {
        $dataR['marital_status'] = '';
      }

      if($users->height_id > 0){
        $height = Height::where('id', $users->height_id)->first();
        $dataR['height'] = $height->height;
      }else {
        $dataR['height'] = '';
      }
    }else{
      $dataR['age'] = '';
      $dataR['marital_status'] = '';
      $dataR['height'] = '';
    }
      // $dataR['age'] = (isset($user->agedtaa)) ? $user->agedtaa : '';
      // $dataR['marital_status'] = (isset($user->maritalstatus)) ? $user->maritalstatus : '';
      // $dataR['height'] = (isset($user->height)) ? $user->height : '';
     array_push($dataR1, $dataR);
    }


    return response()->json([
    "success" => true,
    "data" => $dataR1
    ]);

  }
  public function getUserImageGallery(Request $request)
  {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    $profileImage = File::where('user_id', $userId)->where('file_type_id', 1)->get();
    $coverImage = File::where('user_id', $userId)->where('file_type_id', 2)->get();

    $data['profileImage'] = array();
    foreach ($profileImage as $user) {
      $dataR = array();
      $dataR['image_id'] = $user['id']??'null';
      $dataR['image'] = $user['file_path']??'null';
      $dataR['status'] = $user['status']??'null';
      array_push($data['profileImage'], $dataR);
    }

    $data['coverImage'] = array();
    foreach ($coverImage as $user1) {
      $dataR1 = array();
      $dataR1['image_id'] = $user1['id']??'null';
      $dataR1['image'] = $user1['file_path']??'null';
      $dataR1['status'] = $user1['status']??'null';
      array_push($data['coverImage'], $dataR1);
    }
      return response()->json([
          'success' => true,
          'data' => $data
      ], Response::HTTP_OK);
  }

}
