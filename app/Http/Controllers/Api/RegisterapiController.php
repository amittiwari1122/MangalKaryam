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
use App\Models\UserCareer;
use App\Models\UserSearching;
use App\Models\UserFamily;
use App\Models\UserLocation;
use App\Models\UserHobby;
use App\Models\ManglikType;
use App\Models\BeardType;
use App\Models\SkinTone;
use App\Models\AllergicType;
use App\Models\DrinkType;
use App\Models\MaritalStatus;
use App\Models\Job;
use App\Models\BodyType;
use App\Models\Education;
use App\Models\Nationality;
use App\Models\City;
use App\Models\Quality;
use App\Models\UserSecurityquestion;
use App\Models\ApiResponse;
use App\Models\Weight;
use App\Models\UserRegistrationPercentage;
use App\Models\District;


use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use Intervention\Image\Facades\Image as Image;
use Hash;

class RegisterapiController extends Controller
{


    public function getBasic(Request $request) {
    $user = JWTAuth::toUser($request->token);
    if(!$user){
      return response()->json([
      "success" => true,
      "data" => $user
      ]);
    }
    $userId = $user->id;
    $getuser = User::where('id', $userId)->first();
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
              $data['createdBy'] = $getuserdetails->created_by;
              $data['referedBy'] = $getuserdetails->refer_by;
              $data['address'] = $getuserbasicdetails->address;
              $data['marital_status'] = $getuserbasicdetails->marital_status;
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

    public function updateBasic(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $user->id;
    $countuserbasic = UserBasicDetail::where('user_id', $userId)->count();
    ApiResponse::create([
      'api_name' => 'update_basic',
      'response' => $request,
      'user_id' => $userId,
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


      if ($getuserbasic) {
        UserRegistrationPercentage::where('user_id', $userId)->update(['basic' => 20]);
        $getPercentage = UserRegistrationPercentage::where('user_id', $userId)->first();
        $addPercentage = $getPercentage['basic'] + $getPercentage['looking_for'] + $getPercentage['contact'] + $getPercentage['career'] + $getPercentage['family'] + $getPercentage['location'] + $getPercentage['hobby'];

        $user = User::where('id', $userId)
                    ->update(['profile_complete' => $addPercentage]);
          }
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }


    public function getLookingFor(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $getLooking = UserSearching::where('user_id', $userId)->first();

      $data = array();

      if($getLooking === null){
        $data['height_from'] = null;
        $data['height_to'] = null;
        $data['age_from'] = null;
        $data['age_to'] = null;
        $data['annual_income'] = null;
        $data['diet'] = null;
        $data['work_type'] = null;
        $data['marital_status'] = null;
        $data['gotra'] = null;
        $data['caste'] = null;
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
      }
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function updateLookingFor(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $looking_for = UserSearching::where('user_id', $userId)->count();
      ApiResponse::create([
        'api_name' => 'update_lookingfor',
        'response' => $request,
        'user_id' => $userId,
      ]);
      if($looking_for > 0){
        $getusersearch = UserSearching::where('user_id', $userId)
                    ->update(['height_from' => $request->height_from, 'quality_id' => $request->quality, 'height_to' => $request->height_to, 'age_from' => $request->age_from, 'age_to' => $request->age_to, 'work_type' => $request->work_type,'annual_income_id' => $request->annual_income,'diet_type_id' => $request->diet,'marital_status' => $request->marital_status,'caste_id' => $request->caste,'gotra_id' => $request->gotra]);


      }else{
        // return response()->json([
        // "success" => true,
        // "data" => $request->work_type
        // ]);
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
          'user_id' => $userId,
        ]);

      }
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
      $data['quality_id'] = $request->quality;

      if ($getusersearch) {
        UserRegistrationPercentage::where('user_id', $userId)->update(['looking_for' => 20]);
        $getPercentage = UserRegistrationPercentage::where('user_id', $userId)->first();
        $addPercentage = $getPercentage['basic'] + $getPercentage['looking_for'] + $getPercentage['contact'] + $getPercentage['career'] + $getPercentage['family'] + $getPercentage['location'] + $getPercentage['hobby'];

        $user = User::where('id', $userId)
                    ->update(['profile_complete' => $addPercentage]);
          }
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function getContact(Request $request) {
      $user = JWTAuth::toUser($request->token);
      //print_r($user);
      $userId = $user->id;
      $getContact = UserContact::where('user_id', $userId)->first();

      $data = array();

      if($getContact === null){
          $data['mobile'] = $user->mobile;
        $data['alt_mobile'] = null;
        $data['email'] = $user->email;
        $data['address'] = null;
        $data['state'] = null;
        $data['pincode'] = null;
        $data['country'] = null;
        $data['district'] = null;
        $data['city'] = null;
      }else{
        $data['mobile'] = $user->mobile;
        $data['alt_mobile'] = $getContact->alt_mobile;
        $data['email'] = $user->email;
        $data['address'] = $getContact->address;
        $data['state'] = $getContact->state;
        $data['pincode'] = $getContact->pincode;
        $data['country'] = $getContact->country_id;
        $data['district'] = $getContact->district;
        $data['city'] = $getContact->city;
      }
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function updateContact(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;


      $looking_for = UserContact::where('user_id', $userId)->count();

      ApiResponse::create([
        'api_name' => 'update_contact',
        'response' => $request,
        'user_id' => $userId,
      ]);

      if($looking_for > 0){
        $getlooking = UserContact::where('user_id', $userId)
                    ->update(['mobile' => $user->mobile, 'alt_mobile' => $request->alt_mobile, 'email' => $user->email,'address' => $request->address, 'state' => $request->state, 'pincode' => $request->pincode,'country_id' => $request->country,'district' => $request->district,'city' => $request->city]);

      }else{
        $getlooking = UserContact::create([
          'mobile' => $user->mobile,
          'alt_mobile' => $request->alt_mobile,
          'email' => $user->email,
          'address' => $request->address,
          'state' => $request->state,
          'pincode' => $request->pincode,
          'country_id' => $request->country,
          'district' => $request->district,
          'city' => $request->city,
          'created_at' => now(),
          'updated_at' => now(),
          'user_id' => $userId,
        ]);
      }

      $data = array();
      $data['mobile'] = $user->mobile;
      $data['alt_mobile'] = $request->alt_mobile;
      $data['email'] = $user->email;
      $data['address'] = $request->address;
      $data['state'] = $request->state;
      $data['pincode'] = $request->pincode;
      $data['country'] = $request->country;
      $data['district'] = $request->district;
      $data['city'] = $request->city;

      if ($getlooking) {
        UserRegistrationPercentage::where('user_id', $userId)->update(['contact' => 10]);
        $getPercentage = UserRegistrationPercentage::where('user_id', $userId)->first();
        $addPercentage = $getPercentage['basic'] + $getPercentage['looking_for'] + $getPercentage['contact'] + $getPercentage['career'] + $getPercentage['family'] + $getPercentage['location'] + $getPercentage['hobby'];

        $user = User::where('id', $userId)
                    ->update(['profile_complete' => $addPercentage]);
          }
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function getCareer(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $usercareer = UserCareer::where('user_id', $userId)->first();

      $data = array();

      if($usercareer === null){
        $data['profession'] = null;
        $data['annual_income'] = null;
        $data['qualification'] = null;
        $data['qualification_fields'] = null;
        $data['university_name'] = null;
      }else{
        $data['profession'] = $usercareer->profession??'';
        $data['annual_income'] = $usercareer->annual_income_id??'';
        $data['qualification'] = $usercareer->qualification_id??'';
        $data['qualification_fields'] = $usercareer->education_fields??'';
        $data['university_name'] = $usercareer->university_name??'';
        $data['job'] = $usercareer->job_id??'';
        $data['education'] = $usercareer->education_id??'';
      }

        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function updateCareer(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $countusercareer = UserCareer::where('user_id', $userId)->count();
      ApiResponse::create([
        'api_name' => 'update_career',
        'response' => $request,
        'user_id' => $userId,
      ]);

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
        $getusercareer1 = UserCareer::where('user_id', $userId)
                    ->update(['education_id' => $request->education]);
      }
      $data = array();
      $data['profession'] = $request->profession??'';
      $data['annual_income'] = $request->annual_income??'';
      $data['qualification'] = $request->qualification??'';
      $data['qualification_fields'] = $request->qualification_fields??'';
      $data['university_name'] = $request->university_name??'';
      // $data['job'] = $request->job;
      $data['education'] = $request->education??'';

      if ($getusercareer) {
        UserRegistrationPercentage::where('user_id', $userId)->update(['career' => 10]);
        $getPercentage = UserRegistrationPercentage::where('user_id', $userId)->first();
        $addPercentage = $getPercentage['basic'] + $getPercentage['looking_for'] + $getPercentage['contact'] + $getPercentage['career'] + $getPercentage['family'] + $getPercentage['location'] + $getPercentage['hobby'];

        $user = User::where('id', $userId)
                    ->update(['profile_complete' => $addPercentage]);
          }
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }


    public function getFamily(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $userfamily = UserFamily::where('user_id', $userId)->first();

      $data = array();

      if($userfamily === null){
        $data['family_type'] = null;
        //$data['religion'] = null;
        $data['mother_tounge'] = null;
        $data['father_occupation'] = null;
        $data['mother_occupation'] = null;
        $data['family_income'] = null;
        $data['no_brothers'] = null;
        $data['married_brothers'] = null;
        $data['no_sisters'] = null;
        $data['married_sisters'] = null;
        $data['family_based_out'] = null;
      }else{
        $data['family_type'] = $userfamily->family_type;
        //$data['religion'] = $userfamily->religion_id;
        $data['mother_tounge'] = $userfamily->mother_tounge;
        $data['father_occupation'] = $userfamily->father_occupation;
        $data['mother_occupation'] = $userfamily->mother_occupation;
        $data['family_income'] = $userfamily->family_income;
        $data['no_brothers'] = $userfamily->no_brothers;
        $data['married_brothers'] = $userfamily->married_brothers;
        $data['no_sisters'] = $userfamily->no_sisters;
        $data['married_sisters'] = $userfamily->married_sisters;
        $data['family_based_out'] = $userfamily->family_based_out;

      }

        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function updateFamily(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $countuserfamily = UserFamily::where('user_id', $userId)->count();
      ApiResponse::create([
        'api_name' => 'update_family',
        'response' => $request,
        'user_id' => $userId,
      ]);
      if($countuserfamily > 0){
        $getuserfamily = UserFamily::where('user_id', $userId)
                    ->update(['family_type' => $request->family_type, 'mother_tounge' => $request->mother_tounge, 'father_occupation' => $request->father_occupation, 'mother_occupation' => $request->mother_occupation, 'family_income' => $request->family_income, 'no_brothers' => $request->no_brothers, 'married_brothers' => $request->married_brothers, 'no_sisters' => $request->no_sisters, 'married_sisters' => $request->married_sisters, 'family_based_out' => $request->family_based_out]);

      }else{
        $getuserfamily = UserFamily::create([
          'family_type' => $request->family_type,
          'mother_tounge' => $request->mother_tounge,
          'father_occupation' => $request->father_occupation,
          'mother_occupation' => $request->mother_occupation,
          'family_income' => $request->family_income,
          'no_brothers' => $request->no_brothers,
          'married_brothers' => $request->married_brothers,
          'no_sisters' => $request->no_sisters,
          'married_sisters' => $request->married_sisters,
          'family_based_out' => $request->family_based_out,
          'created_at' => now(),
          'updated_at' => now(),
          'user_id' => $userId,
        ]);
      }
      $data = array();
      $data['family_type'] = $request->family_type;
      // $data['religion'] = $request->religion;
      $data['mother_tounge'] = $request->mother_tounge;
      $data['father_occupation'] = $request->father_occupation;
      $data['mother_occupation'] = $request->mother_occupation;
      $data['family_income'] = $request->family_income;
      $data['no_brothers'] = $request->no_brothers;
      $data['married_brothers'] = $request->married_brothers;
      $data['no_sisters'] = $request->no_sisters;
      $data['married_sisters'] = $request->married_sisters;
      $data['family_based_out'] = $request->family_based_out;

      if ($getuserfamily) {
        UserRegistrationPercentage::where('user_id', $userId)->update(['family' => 20]);
        $getPercentage = UserRegistrationPercentage::where('user_id', $userId)->first();
        $addPercentage = $getPercentage['basic'] + $getPercentage['looking_for'] + $getPercentage['contact'] + $getPercentage['career'] + $getPercentage['family'] + $getPercentage['location'] + $getPercentage['hobby'];

        $user = User::where('id', $userId)
                    ->update(['profile_complete' => $addPercentage]);
          }
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function getCurrentLocation(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $userlocation = UserLocation::where('user_id', $userId)->first();

      $data = array();

      if($userlocation === null){
        $data['living_place'] = null;
        $data['city'] = null;
        $data['state'] = null;
        $data['country'] = null;
        $data['district'] = null;
        $data['lat'] = null;
        $data['long'] = null;
      }else{
        $data['living_place'] = $userlocation->living_place;
        $data['city'] = $userlocation->city;
        $data['state'] = $userlocation->state_id;
        $data['country'] = $userlocation->country_id;
        $data['district'] = $userlocation->district_id;
        $data['lat'] = $userlocation->lat;
        $data['long'] = $userlocation->long;

      }

        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function updateCurrentLocation(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $countuserlocation = UserLocation::where('user_id', $userId)->count();
      ApiResponse::create([
        'api_name' => 'update_location',
        'response' => $request,
        'user_id' => $userId,
      ]);
      if($countuserlocation > 0){
        $getuserlocation = UserLocation::where('user_id', $userId)
                    ->update(['lat' => $request->lat,'long' => $request->long, 'living_place' => $request->living_place, 'district_id' => $request->district, 'city' => $request->city, 'state_id' => $request->state, 'country_id' => $request->country]);

      }else{
        $getuserlocation = UserLocation::create([
          'living_place' => $request->living_place,
          'city' => $request->city,
          'state_id' => $request->state,
          'country_id' => $request->country,
          'district_id' => $request->district,
          'lat' => $request->lat,
          'long' => $request->long,
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
      $data['lat'] = $request->lat;
      $data['long'] = $request->long;

      if ($getuserlocation) {
        UserRegistrationPercentage::where('user_id', $userId)->update(['location' => 20]);
        $getPercentage = UserRegistrationPercentage::where('user_id', $userId)->first();
        $addPercentage = $getPercentage['basic'] + $getPercentage['looking_for'] + $getPercentage['contact'] + $getPercentage['career'] + $getPercentage['family'] + $getPercentage['location'] + $getPercentage['hobby'];

        $user = User::where('id', $userId)
                    ->update(['profile_complete' => $addPercentage]);
          }
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function getProfileCompletion(Request $request) {

      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $user1 = UserBasicDetail::select(['user_basic_details.*'])
      ->where('user_id', $userId)->first();
      $getUser = User::where('users.id', $userId)->first();

                $data = array();
                $data['profile_completion'] = $getUser->profile_complete;

                return response()->json([
                "success" => true,
                "data" => $data
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
                $data['profile']['profile_completion'] = $getUser->profile_complete;
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
                if($user1->weight_id > 0){
                  $weightdtaa = Weight::where('id', $user1->weight_id)->first();
                  $data['basicInfo']['weight'] = $weightdtaa->name;
                }else {
                  $data['basicInfo']['weight'] = '';
                }
                //$data['basicInfo']['weight'] = (isset($user1->weight_id)) ? $user1->weight_id : '';
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
              $data['lookingFor']['quality'] = null;
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
              if($getLooking->quality_id > 0){
                $maritalstatus = Quality::where('id', $getLooking->quality_id)->first();
                $data['lookingFor']['quality'] = $maritalstatus->name;
              }else {
                $data['lookingFor']['quality'] = '';
              }


            }

        // $getContact = UserContact::select(['user_contacts.*','countries.name as country','states.name as statename'])
        // ->join('countries', 'countries.id', '=', 'user_contacts.country_id')
        // ->join('states', 'states.id', '=', 'user_contacts.state')
        // ->where('user_id', $userId)->first();
        $getContact = UserContact::select(['user_contacts.*'])
        ->where('user_id', $userId)->first();

        if($getContact === null){
          $data['userContact']['mobile'] = $user->mobile;
          $data['userContact']['alt_mobile'] = null;
          $data['userContact']['email'] = $user->email;
          $data['userContact']['address'] = null;
          $data['userContact']['state'] = null;
          $data['userContact']['pincode'] = null;
          $data['userContact']['country'] = null;
          $data['userContact']['city'] = null;
          $data['userContact']['distirct'] = null;
        }else{
          $data['userContact']['mobile'] = $getContact->mobile;
          $data['userContact']['alt_mobile'] = $getContact->alt_mobile;
          $data['userContact']['email'] = $getContact->email;
          $data['userContact']['address'] = $getContact->address;
          $data['userContact']['city'] = $getContact->city;
          if($getContact->district > 0){
            $city = District::where('id', $getContact->district)->first();
            $data['userContact']['district'] = $city->name;
          }else {
            $data['userContact']['district'] = '';
          }
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

      // $user_hobbies = UserHobby::where('user_id', $userId)->get();
      // $array = [];
      // foreach ($user_hobbies as $value) {
      //   array_push($array,$value->hobby);
      // }
      //
      // if(count($array)>0){
      //   $data['userHobbies']['hobbies'] = $array;
      // }else{
      //   $data['userHobbies']['hobbies'] = '';
      // }

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

    public function getUserHobby(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $user_hobbies = UserHobby::where('user_id', $userId)->get();
      $array = [];
      foreach ($user_hobbies as $value) {
        array_push($array,$value->hobby);
      }

      if($user_hobbies === null){
        $data['userHobbies']['hobbies'] = null;
      }else{
        $data['userHobbies']['hobbies'] = $array;
      }
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function updateUserHobby(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $countuserhobby = UserHobby::where('user_id', $userId)->count();
      ApiResponse::create([
        'api_name' => 'update_hobby',
        'response' => $request,
        'user_id' => $userId,
      ]);
      if($countuserhobby > 0){
        $deleteuserhobby = UserHobby::where('user_id', $userId)->delete();

      }
      foreach ($request->hobbies as $value) {
        $getuserhobby = UserHobby::create([
          'hobby' => $value,
          'created_at' => now(),
          'updated_at' => now(),
          'user_id' => $userId,
        ]);
      }
      $data = array();
      $data['hobbies'] = $request->hobbies;

      if ($countuserhobby) {
        UserRegistrationPercentage::where('user_id', $userId)->update(['hobby' => 10]);
        $getPercentage = UserRegistrationPercentage::where('user_id', $userId)->first();
        $addPercentage = $getPercentage['basic'] + $getPercentage['looking_for'] + $getPercentage['contact'] + $getPercentage['career'] + $getPercentage['family'] + $getPercentage['location'] + $getPercentage['hobby'];

        $user = User::where('id', $userId)
                    ->update(['profile_complete' => $addPercentage]);
          }
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }


    public function getAllInfoCandidateWise(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      $user1 = UserBasicDetail::select(['user_basic_details.*'])
      ->where('user_id', $userId)->first();


      $getUser = User::where('id', $userId)->first();
      $getUserDetails = UserDetails::where('user_id', $userId)->first();
      $profileImage = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 1)->where('status', 1)->first();

                $data = array();
                $data['profile']['profile_completion'] = $getUser->profile_complete;
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
                //$data['basicInfo']['weight'] = (isset($user1->weight_id)) ? $user1->weight_id : '';
                $data['basicInfo']['dob'] = (isset($user1->dob)) ? $user1->dob : '';
                if($user1->weight_id > 0){
                  $weightdtaa = Weight::where('id', $user1->weight_id)->first();
                  $data['basicInfo']['weight'] = $weightdtaa->name;
                }else {
                  $data['basicInfo']['weight'] = '';
                }
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
                  $R = Religion::where('id', $user1->religion_id)->first();
                  $data['basicInfo']['religion'] = $R->name;
                }else {
                  $data['basicInfo']['religion'] = '';
                }
                $data['basicInfo']['birth_place'] = (isset($user1->birth_place)) ? $user1->birth_place : '';
                $data['basicInfo']['birth_time'] = (isset($user1->birth_time)) ? $user1->birth_time : '';
                $data['basicInfo']['is_agent'] = (isset($getUserDetails->created_by_user)) ? '1' : '0';
                if($getUserDetails['created_by_user']){
                  $data['executive_id'] = $getUserDetails['created_by_user']??'null';
                  $exusers = UserDetails::where('user_id', $getUserDetails['created_by_user'])->first();
                  $exuserBDetails = UserBasicDetail::where('user_id', $getUserDetails['created_by_user'])->first();
                  $exuser = User::where('id', $getUserDetails['created_by_user'])->first();
                  $exprofileImage = File::select('file_path')->where('user_id', $getUserDetails['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
                  $data['basicInfo']['executive_firstname'] = $exusers->first_name;
                  $data['basicInfo']['executive_middlename'] = $exusers->middle_name;
                  $data['basicInfo']['executive_lastname'] = $exusers->last_name;
                  $data['basicInfo']['executive_email'] = $exuser->email;
                  $data['basicInfo']['executive_profile_image'] = $exprofileImage;
                  $data['basicInfo']['executive_mobile'] = $exuser->mobile;
                  $data['basicInfo']['executive_address'] = $exuserBDetails->address;
                  $data['basicInfo']['executive_state'] = $exuserBDetails->state;
                  $data['basicInfo']['executive_district'] = $exuserBDetails->district;
                }else{
                  $data['basicInfo']['executive_id'] = 'null';
                  $data['basicInfo']['executive_firstname'] = 'null';
                  $data['basicInfo']['executive_middlename'] = 'null';
                  $data['basicInfo']['executive_lastname'] = 'null';
                  $data['basicInfo']['executive_email'] = 'null';
                  $data['basicInfo']['executive_profile_image'] = 'null';
                  $data['basicInfo']['executive_mobile'] = 'null';
                  $data['basicInfo']['executive_address'] = 'null';
                  $data['basicInfo']['executive_state'] = 'null';
                  $data['basicInfo']['executive_district'] = 'null';
                }

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
              $data['lookingFor']['quality'] = null;
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
              if($getLooking->quality_id > 0){
                $maritalstatus = Quality::where('id', $getLooking->quality_id)->first();
                $data['lookingFor']['quality'] = $maritalstatus->name;
              }else {
                $data['lookingFor']['quality'] = '';
              }



            }

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

        if($getUserDetails['created_by_user']){
          $data['executive_id'] = $getUserDetails['created_by_user']??'null';
          $exusers = UserDetails::where('user_id', $getUserDetails['created_by_user'])->first();
          $exuserBDetails = UserBasicDetail::where('user_id', $getUserDetails['created_by_user'])->first();
          $exuser = User::where('id', $getUserDetails['created_by_user'])->first();
          $exprofileImage = File::select('file_path')->where('user_id', $getUserDetails['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
          $data['userContact']['executive_firstname'] = $exusers->first_name;
          $data['userContact']['executive_middlename'] = $exusers->middle_name;
          $data['userContact']['executive_lastname'] = $exusers->last_name;
          $data['userContact']['executive_email'] = $exuser->email;
          $data['userContact']['executive_profile_image'] = $exprofileImage;
          $data['userContact']['executive_mobile'] = $exuser->mobile;
          $data['userContact']['executive_address'] = $exuserBDetails->address;
          $data['userContact']['executive_state'] = $exuserBDetails->state;
          $data['userContact']['executive_district'] = $exuserBDetails->district;
        }else{
          $data['userContact']['executive_id'] = 'null';
          $data['userContact']['executive_firstname'] = 'null';
          $data['userContact']['executive_middlename'] = 'null';
          $data['userContact']['executive_lastname'] = 'null';
          $data['userContact']['executive_email'] = 'null';
          $data['userContact']['executive_profile_image'] = 'null';
          $data['userContact']['executive_mobile'] = 'null';
          $data['userContact']['executive_address'] = 'null';
          $data['userContact']['executive_state'] = 'null';
          $data['userContact']['executive_district'] = 'null';
        }


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


    public function oldUserName(Request $request) {

      if($request->email == ''){
        $checkuser = User::where('users.mobile', '=', $request->mobile)->first();
      }else{
        $checkuser = User::where('users.email', '=', $request->email)->first();
      }
      if (!$checkuser ) {
        return response()->json([
              'code' => 0,
              'success' => false,
              'message' => 'User Details is not matched',
            ], Response::HTTP_OK);
      }else{
        $update = User::where('id', $checkuser->id)->update(['user_change' => 1]);
        return response()->json([
            'success' => true,
            'message' => 'User Details is matched',
            'data' => $checkuser
        ], Response::HTTP_OK);

      }

    }


    public function getUserWithSecurityQuestion(Request $request) {

      $selectRecords = UserSecurityquestion::select(['user_securityquestions.*','security_questions.question as question'])->join('security_questions', 'security_questions.id', '=', 'user_securityquestions.question_id')->where('user_securityquestions.user_id', $request->user_id)->get();

         return response()->json([
             'success' => true,
             'data' => $selectRecords
         ], Response::HTTP_OK);

    }

    public function updateMobleEmail(Request $request) {
      if($request->email == ''){
        $mesage = "This mobile number is already exist";
        $checkuser = User::where('users.mobile', '=', $request->mobile)->first();
      }else{
        $mesage = "This email is already exist";
        $checkuser = User::where('users.email', '=', $request->email)->first();
      }

      if ($checkuser ) {
        return response()->json([
              'code' => 0,
              'success' => false,
              'message' => $mesage,
            ], Response::HTTP_OK);
      }

      if($request->mobile == ''){
        $update = User::where('id', $request->user_id)->update(['email' => $request->email]);
      }else{
        $update = User::where('id', $request->user_id)->update(['mobile' => $request->mobile]);
      }
      return response()->json([
          'code' => 1,
          'success' => true,
          'message' => 'updated successfully, Please login again to same details',
      ], Response::HTTP_OK);

    }







}