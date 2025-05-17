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
use App\Models\City;
use App\Models\SubProfession;
use App\Models\WorkingAs;
use App\Models\ManglikType;
use App\Models\BeardType;
use App\Models\SkinTone;
use App\Models\AllergicType;
use App\Models\DrinkType;
use App\Models\Job;
use App\Models\BodyType;
use App\Models\Education;
use App\Models\Nationality;
use App\Models\Quality;
use App\Models\District;
use App\Models\Hobby;
use App\Models\ApiResponse;
use App\Models\Plan;
use App\Models\Banner;
use App\Models\UserKundali;
use App\Models\Notification;


use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use Hash;

class MasterapiController extends Controller
{

    public function getState(Request $request)
    {
      if($request->country != ''){
        $state = State::where('status', 1)->where('country_id', $request->country)->get(['id','name']);
      }else{
        $state = State::where('status', 1)->get(['id','name']);
      }


        return response()->json([
            'success' => true,
            'data' => $state
        ], Response::HTTP_OK);
    }

    public function getHobbies(Request $request)
    {
      if($request->search != ''){
        $job = Hobby::where('status', 1)->where('name', 'LIKE', '%'.$request->search.'%')->get(['name']);
      }else{
        $job = Hobby::where('status', 1)->get(['name']);
      }


        return response()->json([
            'success' => true,
            'data' => $job
        ], Response::HTTP_OK);
    }

    public function getCountry(Request $request)
    {
        $state = Country::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $state
        ], Response::HTTP_OK);
    }

    public function getAge(Request $request)
    {
      if(isset($request->select_age) && !empty($request->select_age)){
          $age = Age::where('status', 1)->where('id', '>=', $request->select_age)->orderBy('order','ASC')->get(['id','name']);

      }else{
        $age = Age::where('status', 1)->orderBy('order','ASC')->get(['id','name']);
      }



        return response()->json([
            'success' => true,
            'data' => $age
        ], Response::HTTP_OK);
    }

    public function getCity(Request $request)
    {
        $city = City::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $city
        ], Response::HTTP_OK);
    }

    public function getEarning(Request $request)
    {
        $earning = Earning::where('status', 1)->orderBy('order','ASC')->get(['id','details']);

        return response()->json([
            'success' => true,
            'data' => $earning
        ], Response::HTTP_OK);
    }

    public function getMaritalstatus(Request $request)
    {
        $marital = MaritalStatus::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $marital
        ], Response::HTTP_OK);
    }

    public function getWorktype(Request $request)
    {
        $worktype = WorkType::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $worktype
        ], Response::HTTP_OK);
    }

    public function getCaste(Request $request)
    {
        $caste = Caste::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $caste
        ], Response::HTTP_OK);
    }

    public function getGotra(Request $request)
    {
        $gotra = Gotra::where('status', 1)->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $gotra
        ], Response::HTTP_OK);
    }

    public function getWeight(Request $request)
    {
      if(isset($request->select_weight) && !empty($request->select_weight)){
        $weight = Weight::where('status', 1)->where('id', '>=', $request->select_weight)->orderBy('order','ASC')->get(['id','name']);
      }else{
        $weight = Weight::where('status', 1)->orderBy('order','ASC')->get(['id','name']);
      }

        return response()->json([
            'success' => true,
            'data' => $weight
        ], Response::HTTP_OK);
    }

    public function getProfession(Request $request)
    {
        $profession = Profession::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $profession
        ], Response::HTTP_OK);
    }
    public function getSubProfession(Request $request)
    {
        $profession = SubProfession::where('profession_id', $request->profession)->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $profession
        ], Response::HTTP_OK);
    }
    public function getAllergic(Request $request)
    {
        $allergic = AllergicType::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $allergic
        ], Response::HTTP_OK);
    }

    public function getDrink(Request $request)
    {
        $drink = DrinkType::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $drink
        ], Response::HTTP_OK);
    }

    public function getManglik(Request $request)
    {
        $manglic = ManglikType::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $manglic
        ], Response::HTTP_OK);
    }

    public function getSkin(Request $request)
    {
        $skin = SkinTone::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $skin
        ], Response::HTTP_OK);
    }

    public function getBeard(Request $request)
    {
        $beard = BeardType::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $beard
        ], Response::HTTP_OK);
    }
    public function getQuality(Request $request)
    {
        $Quality = Quality::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $Quality
        ], Response::HTTP_OK);
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

        //Request is valid, create new user
        $user = UserBasicDetail::create([
        	'user_id' => $request->user_id,
        	'age' => $request->age,
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
        	'state' => $request->state,
          'pincode' => $request->pincode
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User Contact Details created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function addMobile(Request $request)
    {
      //dd($request);
      $user = UserMobile::create([
        'mobile' => $request['mobile'],
        'otp' => '1234',
        'status' => 1
      ]);

        return response()->json([
            'success' => true,
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function addUser(Request $request)
    {
      $user = User::create([
        'name' => $request['fname'].' '.$request['lname'],
        'email' => $request['email'],
        'password' => Hash::make(12345678)
      ]);

      return response()->json([
          'success' => true,
          'data' => $user
      ], Response::HTTP_OK);
    }

    public function getRegion(Request $request)
    {
        $region = Region::where('status', 1)->orderBy('order','ASC')->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $region
        ], Response::HTTP_OK);
    }
    public function getHeight(Request $request)
    {
        if(isset($request->select_height) && !empty($request->select_height)){
          $ht = Height::where('status', 1)->where('id', '>=', $request->select_height)->orderBy('order','ASC')->get(['id','height','order']);
        }else{
          $ht = Height::where('status', 1)->orderBy('order','ASC')->get(['id','height','order']);
        }
        return response()->json([
            'success' => true,
            'data' => $ht
        ], Response::HTTP_OK);
    }
    public function getDiet(Request $request)
    {
        $dt = DietType::where('status', 1)->orderBy('order','ASC')->get(['id','diet','order']);

        return response()->json([
            'success' => true,
            'data' => $dt
        ], Response::HTTP_OK);
    }
    public function getSecurity(Request $request)
    {
      if(isset($request->select_question) && !empty($request->select_question)){
        $sq = SecurityQuestion::where('status', 1)->whereNotIn('id', explode(',',$request->select_question))->orderBy('order','ASC')->get(['id','question','order']);
      }else{
        $sq = SecurityQuestion::where('status', 1)->orderBy('order','ASC')->get(['id','question','order']);
      }


        return response()->json([
            'success' => true,
            'data' => $sq
        ], Response::HTTP_OK);
    }

    public function getQualification(Request $request)
    {
        $dt = Qualification::where('status', 1)->orderBy('order','ASC')->get(['id','qualification','order']);

        return response()->json([
            'success' => true,
            'data' => $dt
        ], Response::HTTP_OK);
    }

    public function getAnnualIncome(Request $request)
    {
        $dt = AnnualIncome::where('status', 1)->orderBy('order','ASC')->get(['id','incomes','order']);

        return response()->json([
            'success' => true,
            'data' => $dt
        ], Response::HTTP_OK);
    }

    public function getReligion(Request $request)
    {
        $dt = Religion::where('status', 1)->orderBy('order','ASC')->get(['id','name','order']);

        return response()->json([
            'success' => true,
            'data' => $dt
        ], Response::HTTP_OK);
    }

    public function getFileType(Request $request)
    {
        $dt = FileType::where('status', 1)->orderBy('order','ASC')->get(['id','name','order']);

        return response()->json([
            'success' => true,
            'data' => $dt
        ], Response::HTTP_OK);
    }

    public function getWorkingAs(Request $request)
    {
        $as = WorkingAs::where('status', 1)->orderBy('order','ASC')->get(['id','name','order']);

        return response()->json([
            'success' => true,
            'data' => $as
        ], Response::HTTP_OK);
    }

    public function getJob(Request $request)
    {
        $job = Job::where('status', 1)->orderBy('order','ASC')->get(['id','name','order']);

        return response()->json([
            'success' => true,
            'data' => $job
        ], Response::HTTP_OK);
    }
    public function getEducation(Request $request)
    {
        $Ed = Education::where('status', 1)->orderBy('order','ASC')->get(['id','name','order']);

        return response()->json([
            'success' => true,
            'data' => $Ed
        ], Response::HTTP_OK);
    }
    public function getBodyType(Request $request)
    {
        $BT = BodyType::where('status', 1)->orderBy('order','ASC')->get(['id','name','order']);

        return response()->json([
            'success' => true,
            'data' => $BT
        ], Response::HTTP_OK);
    }
    public function getNationality(Request $request)
    {
        $n = Nationality::where('status', 1)->orderBy('order','ASC')->get(['id','name','order']);

        return response()->json([
            'success' => true,
            'data' => $n
        ], Response::HTTP_OK);
    }

    public function profileImage(Request $request)
    {
        $data = $request->all();
        // dd($data);exit;

        $user = JWTAuth::toUser($request->token);
        $userId = $user->id;

        ApiResponse::create([
          'api_name' => 'image upload for profile/cover',
          'response' => $request,
          'user_id' => $user->id,
        ]);
        if($request->image_type == 'old'){

          $upatefile = File::where('user_id', $userId)->where('file_type_id', 2)->update(['status' => 0]);

          $upatefile = File::where('id', $image_id)->update(['status' => 1]);


        }else{
        //$mobile = User::select('id')->where('user_id', $request->user_id)->first();
        if($request->image_type_id == 1){

                  // $image = new Image;
                  $getImage = $request->image;
                  $imageName = time().'.'.$getImage->extension();
                  // $imagePath = public_path(). '/images/profile/userProfile';

                  // $image->path = $imagePath;
                  // $image->image = $imageName;

                  $path = Storage::disk('s3')->put('userProfile/profile', $request->image);
                  $imagepath = Storage::disk('s3')->url($path);
                  $upatefile = File::where('user_id', $userId)->where('file_type_id', 1)->update(['status' => 0]);

                  $fileadd = File::create([
                    'user_id' => $userId,
                    'file_type_id' => 1,
                    'file_name' => $imageName,
                    'file_path' => $imagepath,
                    'file_origin' => $request->image,
                    'status' => 1
                  ]);
                  $upateUser = User::where('id', $userId)->update(['step_complete' => 2]);
                  ApiResponse::create([
                    'api_name' => 'User profile image upload',
                    'response' => $request,
                    'user_id' => $userId,
                  ]);
        }else if($request->image_type_id == 2){

                  // $image = new Image;
                  $getImage = $request->image;
                  $imageName = time().'.'.$getImage->extension();
                  // $imagePath = public_path(). '/images/profile';

                  // $image->path = $imagePath;
                  // $image->image = $imageName;

                  // $ddd = $getImage->move($imagePath, $imageName);

                  // $imagepath = 'http://65.1.238.125:8080/public/images/profile/'.$imageName;
 
                   $path = Storage::disk('s3')->put('userProfile/cover', $request->image);
                   $imagepath = Storage::disk('s3')->url($path);

                  $upatefile = File::where('user_id', $userId)->where('file_type_id', 2)->update(['status' => 0]);


                  $fileadd = File::create([
                    'user_id' => $userId,
                    'file_type_id' => 2,
                    'file_name' => $imageName,
                    'file_path' => $imagepath,
                    'file_origin' => $request->image,
                    'status' => 1
                  ]);

                  ApiResponse::create([
                    'api_name' => 'User cover image upload',
                    'response' => $request,
                    'user_id' => $userId,
                  ]);

        }
      }

        return response()->json([
        "success" => true,
        "message" => "File updated successfully",
        "data" => $fileadd
        ]);
    }


    public function execforcandiateprofileImage(Request $request)
    {
        $data = $request->all();
        // dd($data);exit;

        $user = JWTAuth::toUser($request->token);
        $userId = $user->id;

        //$mobile = User::select('id')->where('user_id', $request->user_id)->first();
        if($request->image_type_id == 1){

                  // $image = new Image;
                  $getImage = $request->image;
                  $imageName = time().'.'.$getImage->extension();
                  // $imagePath = public_path(). '/images/profile/userProfile';

                  // $image->path = $imagePath;
                  // $image->image = $imageName;

                  // $ddd = $getImage->move($imagePath, $imageName);

                  // $imagepath = 'http://65.1.238.125:8080/public/images/profile/userProfile/'.$imageName;
                  $path = Storage::disk('s3')->put('userProfile/profile', $request->image);
                  $imagepath = Storage::disk('s3')->url($path);

                  $upatefile = File::where('user_id', $request->user_id)->where('file_type_id', 1)->update(['status' => 0]);

                  $fileadd = File::create([
                    'user_id' => $request->user_id,
                    'file_type_id' => 1,
                    'file_name' => $imageName,
                    'file_path' => $imagepath,
                    'file_origin' => $request->image,
                    'status' => 1
                  ]);

        }else if($request->image_type_id == 2){

                  // $image = new Image;
                  $getImage = $request->image;
                  $imageName = time().'.'.$getImage->extension();
                  // $imagePath = public_path(). '/images/profile';

                  // $image->path = $imagePath;
                  // $image->image = $imageName;

                  // $ddd = $getImage->move($imagePath, $imageName);

                  // $imagepath = 'http://65.1.238.125:8080/public/images/profile/'.$imageName;

                  $path = Storage::disk('s3')->put('userProfile/cover', $request->image);
                  $imagepath = Storage::disk('s3')->url($path);


                  $fileadd = File::create([
                    'user_id' => $request->user_id,
                    'file_type_id' => 2,
                    'file_name' => $imageName,
                    'file_path' => $imagepath,
                    'file_origin' => $request->image,
                    'status' => 1
                  ]);

        }


        return response()->json([
        "success" => true,
        "message" => "File updated successfully",
        "data" => $fileadd
        ]);
    }


    public function executiveProfileImage(Request $request)
    {
        $data = $request->all();
        // dd($data);exit;

        $user = JWTAuth::toUser($request->token);
        $userId = $user->id;

        //$mobile = User::select('id')->where('user_id', $request->user_id)->first();
        if($request->image_type_id == 1){

                  // $image = new Image;
                  $getImage = $request->image;
                  $imageName = time().'.'.$getImage->extension();
                  // $imagePath = public_path(). '/images/profile/executiveProfile';

                  // $image->path = $imagePath;
                  // $image->image = $imageName;

                  // $ddd = $getImage->move($imagePath, $imageName);

                  // $imagepath = 'http://65.1.238.125:8080/public/images/profile/executiveProfile/'.$imageName;
                  $path = Storage::disk('s3')->put('executiveProfile/profile', $request->image);
                  $imagepath = Storage::disk('s3')->url($path);
                  $upatefile = File::where('user_id', $userId)->where('file_type_id', 1)->update(['status' => 0]);

                  $fileadd = File::create([
                    'user_id' => $userId,
                    'file_type_id' => 1,
                    'file_name' => $imageName,
                    'file_path' => $imagepath,
                    'file_origin' => $request->image,
                    'status' => 1
                  ]);

         } else if($request->image_type_id == 2){

                  // $image = new Image;
                  $getImage = $request->image;
                  $imageName = time().'.'.$getImage->extension();
                  // $imagePath = public_path(). '/images/executiveCover';

                  // $image->path = $imagePath;
                  // $image->image = $imageName;

                  // $ddd = $getImage->move($imagePath, $imageName);

                  // $imagepath = 'http://65.1.238.125:8080/public/images/executiveCover/'.$imageName;

                  $path = Storage::disk('s3')->put('executiveProfile/cover', $request->image);
                   $imagepath = Storage::disk('s3')->url($path);


                  $fileadd = File::create([
                    'user_id' => $userId,
                    'file_type_id' => 2,
                    'file_name' => $imageName,
                    'file_path' => $imagepath,
                    'file_origin' => $request->image,
                    'status' => 1
                  ]);

        }


        return response()->json([
        "success" => true,
        "message" => "Executive Cover Image updated successfully",
        "data" => $fileadd
        ]);
    }

    public function executivePanImage(Request $request)
    {
        $data = $request->all();
        // dd($data);exit;

        $user = JWTAuth::toUser($request->token);
        $userId = $user->id;

        //$mobile = User::select('id')->where('user_id', $request->user_id)->first();
        if($request->image_type_id == 4){

                  // $image = new Image;
                  $getImage = $request->image;
                  $imageName = time().'.'.$getImage->extension();
                  // $imagePath = public_path(). '/images/document/Pan';

                  // $image->path = $imagePath;
                  // $image->image = $imageName;

                  // $ddd = $getImage->move($imagePath, $imageName);

                  // $imagepath = 'http://65.1.238.125:8080/public/images/document/Pan/'.$imageName;
                  $path = Storage::disk('s3')->put('document/Pan', $request->image);
                  $imagepath = Storage::disk('s3')->url($path);

                  //$upatefile = File::where('user_id', $userId)->where('file_type_id', 1)->update(['status' => 0]);

                  $fileadd = File::create([
                    'user_id' => $userId,
                    'file_type_id' => 4,
                    'file_name' => $imageName,
                    'file_path' => $imagepath,
                    'file_origin' => $request->image,
                    'status' => 1
                  ]);

         }

        return response()->json([
        "success" => true,
        "message" => "PAN Card Image updated successfully",
        "data" => $fileadd
        ]);
    }

    public function executiveAadharImage(Request $request)
    {
        $data = $request->all();
        // dd($data);exit;

        $user = JWTAuth::toUser($request->token);
        $userId = $user->id;

        //$mobile = User::select('id')->where('user_id', $request->user_id)->first();
        if($request->image_type_id == 5){

                  // $image = new Image;
                  $getImage = $request->image;
                  $imageName = time().'.'.$getImage->extension();
                  // $imagePath = public_path(). '/images/document/Aadhar';

                  // $image->path = $imagePath;
                  // $image->image = $imageName;

                  // $ddd = $getImage->move($imagePath, $imageName);

                  // $imagepath = 'http://65.1.238.125:8080/public/images/document/Aadhar/'.$imageName;

                  $path = Storage::disk('s3')->put('document/Aadhar', $request->image);
                  $imagepath = Storage::disk('s3')->url($path);

                  //$upatefile = File::where('user_id', $userId)->where('file_type_id', 1)->update(['status' => 0]);

                  $fileadd = File::create([
                    'user_id' => $userId,
                    'file_type_id' => 5,
                    'file_name' => $imageName,
                    'file_path' => $imagepath,
                    'file_origin' => $request->image,
                    'status' => 1
                  ]);

         }

        return response()->json([
        "success" => true,
        "message" => "Aadhar Card Image updated successfully",
        "data" => $fileadd
        ]);
    }

    public function executiveManagmentImage(Request $request)
    {
        $data = $request->all();
        // dd($data);exit;

        $user = JWTAuth::toUser($request->token);
        $userId = $request->user_id;

        //$mobile = User::select('id')->where('user_id', $request->user_id)->first();
        //if($request->image_type_id == 5){

                  // $image = new Image;
                  $getImage = $request->image;
                  $imageName = time().'.'.$getImage->extension();
                  // $imagePath = public_path(). '/images/document/executiveManagment';

                  // $image->path = $imagePath;
                  // $image->image = $imageName;

                  // $ddd = $getImage->move($imagePath, $imageName);

                  // $imagepath = 'http://65.1.238.125:8080/public/images/document/executiveManagment/'.$imageName;
                  $path = Storage::disk('s3')->put('executiveManagment', $request->image);
                  $imagepath = Storage::disk('s3')->url($path);
                  //$upatefile = File::where('user_id', $userId)->where('file_type_id', 1)->update(['status' => 0]);

                  $fileadd = File::create([
                    'user_id' => $userId,
                    'file_type_id' => 10,
                    'file_name' => $imageName,
                    'file_path' => $imagepath,
                    'file_origin' => $request->image,
                    'status' => 1
                  ]);

        // }

        return response()->json([
        "success" => true,
        "message" => "Home Image updated successfully",
        "data" => $fileadd
        ]);
    }

    public function getExecutiveManagmentImage(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $userId = $request->user_id;

        $profileImage = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 10)->where('status', 1)->get();
    

        return response()->json([
        "success" => true,
        "data" => $profileImage
        ]);
    }



    public function updateAbout(Request $request) {
      $getuser = JWTAuth::toUser($request->token);
      $userId = $getuser->id;
    $getuserbasic = UserBasicDetail::where('user_id', $userId)
                ->update(['address' => $request->address, 'religion_id' => $request->religion, 'age_id' => $request->age, 'looking_for' => $request->looking_for, 'pin' => $request->pincode]);
            $getuserdetails = UserDetails::where('user_id', $userId)
                        ->update(['first_name' => $request->full_name, 'last_name' => '']);
            if($request->email != $getuser->email){
              $users = User::where('id', $userId)
                        ->update(['email' => $request->email, 'mobile' => $request->mobile]);
            }else{
              $users = User::where('id', $userId)
                        ->update(['mobile' => $request->mobile]);
            }
                $data = array();
              $data['address'] = $request->address;
              $data['religion'] = $request->religion;
              $data['age'] = $request->age;
              $data['looking_for'] = $request->looking_for;
              $data['pincode'] = $request->pincode;
              $data['full_name'] = $request->full_name;
              $data['email'] = $request->email;
              $data['mobile'] = $request->mobile;

        return response()->json([
        "success" => true,
        "message" => "Updated successfully",
        "data" => $data
        ]);
    }

    public function updateOthers(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
    $user = UserBasicDetail::where('user_id', $userId)
                ->update(['marital_status' => $request->marital_status, 'diet_type_id' => $request->diet, 'height_id' => $request->height, 'weight_id' => $request->weight]);
                $data = array();
              $data['marital_status'] = $request->marital_status;
              $data['diet'] = $request->diet;
              $data['height'] = $request->height;
              $data['weight'] = $request->weight;
        return response()->json([
        "success" => true,
        "message" => "Updated successfully",
        "data" => $data
        ]);
    }

    public function updateQualification(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
    $user = UserBasicDetail::where('user_id', $userId)
                ->update(['qualification_id' => $request->qualification, 'work_type_id' => $request->work_type, 'work_post' => $request->work_post, 'annual_income_id' => $request->annual_income]);
                $data = array();
              $data['qualification'] = $request->qualification;
              $data['work_type'] = $request->work_type;
              $data['work_post'] = $request->work_post;
              $data['annual_income'] = $request->annual_income;
        return response()->json([
        "success" => true,
        "message" => "Updated successfully",
        "data" => $data
        ]);
    }

    public function getProfileQualification(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
    $user = UserBasicDetail::where('user_id', $userId)->first();
                $data = array();
              $data['qualification'] = $user->qualification_id;
              $data['work_type'] = $user->work_type_id;
              $data['work_post'] = $user->work_post;
              $data['annual_income'] = $user->annual_income_id;
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function getProfileOthers(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
    $user = UserBasicDetail::where('user_id', $userId)->first();
    // return $user;
              $data = array();
              $data['marital_status'] = $user->marital_status;
              $data['diet'] = $user->diet_type_id;
              $data['height'] = $user->height_id;
              $data['weight'] = $user->weight_id;
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function getProfileAbout(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $user->id;
    $user = UserBasicDetail::where('user_id', $userId)->first();
    // return $user;
    $getUser = User::where('users.id', $userId)->first();
    $getDUser = UserDetails::where('user_id', $userId)->first();
    $profileImage = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 1)->where('status', 1)->get();
    $coverImage = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 2)->orderBy('status','ASC')->get();
    // return response()->json([
    //   "success" => true,
    //   "data" => $coverImage
    //   ]);   
    $data = array();
              $data['address'] = $user->address;
              $data['religion'] = $user->religion_id;
              $data['age'] = $user->age_id;
              $data['looking_for'] = $user->looking_for;
              $data['pincode'] = $user->pin;
              $data['email'] = $getUser->email;
              $data['full_name'] = $getDUser->first_name.' '.$getDUser->last_name;
              $data['mobile'] = $getUser->mobile;
              $data['myselfoneline'] = $user->about_me_short;
              $data['myself'] = $user->about_me_long;
              $data['profileImage'] = $profileImage;
              $data['coverImage'] = $coverImage;
              $data['blur_image'] = $getDUser->image_hide??'null';
              $data['active_status'] = $getDUser->active_status;
              $data['contact_status'] = $getDUser->requestcontact_view;
              $data['my_prefer'] = $getDUser->my_prefer;

        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }


    public function getAboutUs(Request $request) {
      if($request->type){
        $dataAbout = DynamicContent::select(['title','content'])->where('page_wise_id', 1)->where('user_type', $request->type)->where('status', 1)->get();
        $dataTermCondition = DynamicContent::select(['title','content'])->where('page_wise_id', 2)->where('user_type', $request->type)->where('status', 1)->get();
        $dataPrivacy = DynamicContent::select(['title','content'])->where('page_wise_id', 3)->where('user_type', $request->type)->where('status', 1)->get();
          $data = array();
          $data['about_us'] = $dataAbout;
          $data['term_condition'] = $dataTermCondition;
          $data['privacy_policy'] = $dataPrivacy;
            return response()->json([
            "success" => true,
            "data" => $data
            ]);
      }else{
        return response()->json([
          "success" => false,
          "message" => "Please Pass User Type"
          ]);
      }
    
    }

    public function postContactUs(Request $request) {

        $addContact = ContactUs::create([
              'full_name' => $request->full_name,
              'email' => $request->email,
              'mobile_no' => $request->mobile,
              'message' => $request->message
            ]);

            // $image = new Image;
            if(isset($request->image)){
              // foreach ($request->image as $value) {
                
                  $getImage = $request->image;
                  $imageName = time().'.'.$getImage->extension();

                  $path = Storage::disk('s3')->put('contactUs', $request->image);
                  $imagepath = Storage::disk('s3')->url($path);


                $fileadd = File::create([
                  'user_id' => $addContact->id,
                  'file_type_id' => 3,
                  'file_name' => $imageName,
                  'file_path' => $imagepath,
                  'file_origin' => $request->image,
                  'contactus_id' => $addContact->id,
                  'status' => 1
                ]);
              // }
            }


        return response()->json([
        "success" => true,
        "message" => "Your ContactUs Submitted successfully",
        "data" => $addContact
        ]);
    }

    public function updateAboutMe(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
    $user = UserBasicDetail::where('user_id', $userId)
                ->update(['about_me_short' => $request->myselfoneline, 'about_me_long' => $request->myself]);
              $data = array();
              $data['myselfoneline'] = $request->myselfoneline;
              $data['myself'] = $request->myself;
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
              $data['myselfoneline'] = $user->about_me_short;
              $data['myself'] = $user->about_me_long;
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function getTest(Request $request) {
      //print_r($request);
      //dd($request);
      $the = $request->all();
      $th2 = json_decode($the['file']);
      foreach ($th2 as $key => $value) {
        $data[] = $value->name;
       }
        return response()->json([
        "success" => true,
        "data" => $data
        ]);
    }

    public function setUserLang(Request $request) {
      //print_r($request);
      //dd($request);
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $user = UserBasicDetail::where('user_id', $userId)
                ->update(['language_id' => $request->lang]);
              $data = array();
              $data['lang'] = $request->lang;
        return response()->json([
        "success" => true,
        "message" => "Update Language successfully",
        "data" => $data
        ]);
    }

    public function getDistrict(Request $request)
    {
        $district = District::where('status', 1)->where('state_id', $request->state)->get(['id','name']);

        return response()->json([
            'success' => true,
            'data' => $district
        ], Response::HTTP_OK);
    }

    public function feedbackForm(Request $request) {

      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $user = User::where('id', $userId)->first();

      $addContact = ContactUs::create([
            'full_name' => $user->name,
            'email' => $user->email,
            'mobile_no' => $user->mobile,
            'message' => $request->message
          ]);

          // $image = new Image;
          if(isset($request->image)){
            // foreach ($request->image as $value) {
              // $getImage = $request->image;
              // $imageName = time().'.'.$getImage->extension();
              // $imagePath = public_path(). '/images/contactUs';

              // $image->path = $imagePath;
              // $image->image = $imageName;
              // $ddd = $getImage->move($imagePath, $imageName);

              // $imagepath = 'http://65.1.238.125:8080/public/images/contactUs/'.$imageName;

              $getImage = $request->image;
                  $imageName = time().'.'.$getImage->extension();

                  $path = Storage::disk('s3')->put('feedBack', $request->image);
                  $imagepath = Storage::disk('s3')->url($path);

              $fileadd = File::create([
                'user_id' => $addContact->id,
                'file_type_id' => 4,
                'file_name' => $imageName,
                'file_path' => $imagepath,
                'file_origin' => $request->image,
                'feedback_id' => $addContact->id,
                'status' => 1
              ]);
            // }
          }


      return response()->json([
      "success" => true,
      "message" => "Your Feedback Submitted successfully",
      "data" => $addContact
      ]);
  }

  public function getPlan(){
      $plan = Plan::where('status', 1)->get();
      return response()->json([
          'success' => true,
          'data' => $plan
      ], Response::HTTP_OK);
  }

  public function uploadPortfolioImg(Request $request)
  {
      $data = $request->all();
      // dd($data);exit;

      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;

      //$mobile = User::select('id')->where('user_id', $request->user_id)->first();
      if($request->image_type_id == 8){

                $image = new Image;
                $getImage = $request->image;
                $imageName = time().'.'.$getImage->extension();
                $imagePath = public_path(). '/images/portfolio';

                $image->path = $imagePath;
                $image->image = $imageName;

                $ddd = $getImage->move($imagePath, $imageName);

                $imagepath = 'http://65.1.238.125:8080/public/images/portfolio/'.$imageName;

                //$upatefile = File::where('user_id', $userId)->where('file_type_id', 1)->update(['status' => 0]);

                $fileadd = File::create([
                  'user_id' => $userId,
                  'file_type_id' => 8,
                  'file_name' => $imageName,
                  'file_path' => $imagepath,
                  'file_origin' => $request->image,
                  'status' => 1
                ]);

       }else{
        return response()->json([
          "success" => false,
          "message" => "please add correct image type"
          ]);
       } 


      return response()->json([
      "success" => true,
      "message" => "Executive portfolio Image updated successfully",
      "data" => $fileadd
      ]);
  }

  public function bannerMeeting(Request $request){

    $image = File::select('file_path')->where('file_type_id', 100)->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
    return response()->json([
      "success" => true,
      "data" => $image
      ]);
  }

  public function firstThreePages(Request $request){

    $image = Banner::where('user_type', $request->user_type)->get();
    return response()->json([
      "success" => true,
      "data" => $image
      ]);
  }

  public function kundaliData(Request $request){

    $data = $request->all();
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;    

    $fileadd = UserKundali::create([
      'kundali_male_id' => $request->kundali_male_id,
      'kundali_female_id' => $request->kundali_female_id,
      'user_id' => $userId,
      'info' => json_encode($request->info),
      'status' => 1
    ]);

    return response()->json([
      "success" => true,
      "data" => $fileadd
      ]);
  }

  public function getKundaliData(Request $request){

    $user = JWTAuth::toUser($request->token);
    $userId = $user->id;

    $data = UserKundali::where('user_id', $userId)->get();
    return response()->json([
      "success" => true,
      "data" => $data
      ]);
  }

  public function sendNotification(Request $request){

    $user = JWTAuth::toUser($request->token);
    $userId = $user->id;

    $noti = Notification::create([
      'user_id' => $request->user_id,
      'content' => $request->message,
      'created_by' => $user->id,
      'status' => 0
    ]);

    return response()->json([
      "success" => true,
      "message" => "Notification Sent Successfully"
      ]);
  }

  public function sendEmail(Request $request){
    $token = "hgshdsakjbdusahdjksnafcnsdlkx";
    Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
      $message->to($request->email);
      $message->subject('Reset Password');
  });
  }

}
