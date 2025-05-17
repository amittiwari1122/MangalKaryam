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
  use App\Models\Benefit;
  use App\Models\CommonQuestion;
  use App\Models\UserLike;
  use App\Models\ActivityType;
  use App\Models\Notification;
  use App\Models\UserVisit;
  use App\Models\MaritalStatus;
  use App\Models\UserMatch;
  use App\Models\UserSubscribe;


  use Illuminate\Http\Request;
  use Tymon\JWTAuth\Exceptions\JWTException;
  use Symfony\Component\HttpFoundation\Response;
  use Illuminate\Support\Facades\Validator;
  use Illuminate\Support\Facades\Auth;
  use Session;
  use Intervention\Image\Facades\Image as Image;
  use Hash;
  use Exception;
  use DateTime;

  class CandidateapiController extends Controller
  {

    public function getDisLikedByYou(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      try{
        $getUser = UserLike::where('created_by', $user->id)->where('activity_type_id', 2)->orderBy('updated_at', 'DESC')->get();
      }catch(Exception $e){

        return response()->json([
          "success" => false,
          "data" => [],
          "message" => $e->message
          ]);

      }
     

      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

        $getLike = UserLike::where('user_id', $user['id'])->where('created_by', $user->id)->where('activity_type_id', 2)->first();

        $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
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
        $dataR['blur_image'] = $getDUser->image_hide??'null';
        $dataR['image_count'] = $profileImage->count();
        if($getDUser['created_by_user']){
          $dataR['executive_id'] = $getDUser['created_by_user']??'null';
          $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
          $exuser = User::where('id', $getDUser['created_by_user'])->first();
          $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
          $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
          $dataR['executive_profile_image'] = $exprofileImage;
          $dataR['executive_mobile'] = $exuser->mobile;
        }else{
          $dataR['executive_id'] = 'null';
          $dataR['executive_name'] = 'null';
          $dataR['executive_profile_image'] = 'null';
          $dataR['executive_mobile'] = 'null';
        }
        

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
        $dataR['like'] = (isset($getLike->activity_type_id)) ? $getLike->activity_type_id : '';
        $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
       array_push($dataR1, $dataR);

    }

      return response()->json([
      "success" => true,
      "data" => $dataR1
      ]);

    }

    public function getLikedByYou(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      // $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->skip(70)->take(10)->get();

      $getUser = UserLike::where('created_by', $user->id)->where('activity_type_id', 1)->orderBy('updated_at', 'DESC')->get();
      // return response()->json([
      // "success" => true,
      // "data" => $getUser
      // ]);

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
        $dataR['blur_image'] = $getDUser->image_hide??'null';
        $dataR['image_count'] = $profileImage->count();
        if($getDUser['created_by_user']){
          $dataR['executive_id'] = $getDUser['created_by_user']??'null';
          $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
          $exuser = User::where('id', $getDUser['created_by_user'])->first();
          $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
          $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
          $dataR['executive_profile_image'] = $exprofileImage;
          $dataR['executive_mobile'] = $exuser->mobile;
        }else{
          $dataR['executive_id'] = 'null';
          $dataR['executive_name'] = 'null';
          $dataR['executive_profile_image'] = 'null';
          $dataR['executive_mobile'] = 'null';
        }
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

  public function getLikedByOther(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;
    // $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->skip(70)->take(10)->get();

    $getUser = UserLike::where('user_id', $user->id)->where('activity_type_id', 1)->orderBy('updated_at', 'DESC')->get();


    $dataR1 = array();
    foreach ($getUser as $user) {
      $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['created_by'])->first();

      $getDUser = UserDetails::where('user_id', $user['created_by'])->first();

      $getLike = UserLike::where('user_id', $user['created_by'])->where('activity_type_id', 1)->first();
      // print_r($getDUser);
      $profileImage = File::select('file_path')->where('user_id', $user['created_by'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
      // $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
      $dataR = array();
      $dataR['firstname'] = $getDUser['first_name']??'null';
      $dataR['middlename'] = $getDUser['middle_name']??'null';
      $dataR['lastname'] = $getDUser['last_name']??'null';
      $dataR['gender'] = $getDUser['gender']??'null';
      $dataR['profileImage'] = $profileImage;
      $dataR['user_id'] = $user->created_by;
      $dataR['blur_image'] = $getDUser->image_hide??'null';
      $dataR['image_count'] = $profileImage->count();
      if($getDUser['created_by_user']){
        $dataR['executive_id'] = $getDUser['created_by_user']??'null';
        $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
        $exuser = User::where('id', $getDUser['created_by_user'])->first();
        $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
        $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
        $dataR['executive_profile_image'] = $exprofileImage;
        $dataR['executive_mobile'] = $exuser->mobile;
      }else{
        $dataR['executive_id'] = 'null';
        $dataR['executive_name'] = 'null';
        $dataR['executive_profile_image'] = 'null';
        $dataR['executive_mobile'] = 'null';
      }
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

    public function getArchiveByYou(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      // $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->skip(70)->take(10)->get();

      $getUser = UserLike::where('created_by', $user->id)->where('activity_type_id', 3)->orderBy('updated_at', 'DESC')->get();
      // return response()->json([
      // "success" => true,
      // "data" => $getUser
      // ]);

      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

        $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
        $getLike = UserLike::where('user_id', $user['user_id'])->where('created_by', $user->id)->where('activity_type_id', 3)->first();
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
        $dataR['blur_image'] = $getDUser->image_hide??'null';
        $dataR['image_count'] = $profileImage->count();
        if($getDUser['created_by_user']){
          $dataR['executive_id'] = $getDUser['created_by_user']??'null';
          $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
          $exuser = User::where('id', $getDUser['created_by_user'])->first();
          $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
          $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
          $dataR['executive_profile_image'] = $exprofileImage;
          $dataR['executive_mobile'] = $exuser->mobile;
        }else{
          $dataR['executive_id'] = 'null';
          $dataR['executive_name'] = 'null';
          $dataR['executive_profile_image'] = 'null';
          $dataR['executive_mobile'] = 'null';
        }
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

    public function setArchiveDelete(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      $getUser = UserLike::where('created_by', $user->id)->where('activity_type_id', 3)->orderBy('updated_at', 'DESC')->get();

      $visit = UserLike::where('user_id', $request->user_id)->where('created_by', $user->id)->where('activity_type_id', 3)->update(['activity_type_id' => 5]);

      return response()->json([
      "success" => true,
      "message" => "User delete successfully"
      ]);
    }

    public function setStarUser(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      //$visit = UserLike::where('user_id', $request->user_id)->where('created_by', $user->id)->where('activity_type_id', 3)->update(['activity_type_id' => 4]);

      $check = UserLike::where('user_id', $request->user_id)->where('created_by', $user->id)->count();
      if($check == 0){
        $like = UserLike::create([
          'user_id' => $request->user_id,
          'activity_type_id' => 4,
          'created_by' => $user->id
        ]);
        if($request->user_id != $user->id){
          $noti = Notification::create([
            'user_id' => $request->user_id,
            'content' => "".$user->name." Most Like Your Profile on ".date('Y-m-d'),
            'created_by' => $user->id,
            'status' => 0
          ]);
        }
        
      }else{
        $like = UserLike::where('user_id', $request->user_id)->where('created_by', $user->id)->update(['activity_type_id' => 4]);
      }
      return response()->json([
      "success" => true,
      "message" => "User Star successfully"
      ]);
    }

    public function getStarByYou(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      // $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->skip(70)->take(10)->get();

      $getUser = UserLike::where('created_by', $user->id)->where('activity_type_id', 4)->orderBy('updated_at', 'DESC')->get();
      // return response()->json([
      // "success" => true,
      // "data" => $getUser
      // ]);

      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

        $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
        $getLike = UserLike::where('user_id', $user['user_id'])->where('created_by', $user->id)->where('activity_type_id', 3)->first();
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
        $dataR['blur_image'] = $getDUser->image_hide??'null';
        $dataR['image_count'] = $profileImage->count();
        if($getDUser['created_by_user']){
          $dataR['executive_id'] = $getDUser['created_by_user']??'null';
          $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
          $exuser = User::where('id', $getDUser['created_by_user'])->first();
          $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
          $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
          $dataR['executive_profile_image'] = $exprofileImage;
          $dataR['executive_mobile'] = $exuser->mobile;
        }else{
          $dataR['executive_id'] = 'null';
          $dataR['executive_name'] = 'null';
          $dataR['executive_profile_image'] = 'null';
          $dataR['executive_mobile'] = 'null';
        }
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

    public function setArchiveDeleteAll(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      foreach ($request->user_id as $value) {
        $visit = UserLike::where('user_id', $value)->where('created_by', $user->id)->where('activity_type_id', 3)->update(['activity_type_id' => 5]);
      }
      return response()->json([
      "success" => true,
      "message" => "User delete successfully"
      ]);
    }

    public function getCurrentlyAdded(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      $dateset = date('Y-m-d',strtotime('-20 day'));
      $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->where('users.created_at', '>=', $dateset)->orderBy('updated_at', 'DESC')->take(10)->get();



      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

        $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
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
        $dataR['blur_image'] = $getDUser->image_hide??'null';
        $dataR['image_count'] = $profileImage->count();
        if($getDUser['created_by_user']){
          $dataR['executive_id'] = $getDUser['created_by_user']??'null';
          $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
          $exuser = User::where('id', $getDUser['created_by_user'])->first();
          $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
          $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
          $dataR['executive_profile_image'] = $exprofileImage;
          $dataR['executive_mobile'] = $exuser->mobile;
        }else{
          $dataR['executive_id'] = 'null';
          $dataR['executive_name'] = 'null';
          $dataR['executive_profile_image'] = 'null';
          $dataR['executive_mobile'] = 'null';
        }
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
      $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
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

    public function setRecentVisited(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $check = UserVisit::where('user_id', $request->user_id)->where('visiter_id', $user->id)->count();
      if($check == 0){
        $visit = UserVisit::create([
          'user_id' => $request->user_id,
          'visiter_id' => $user->id
        ]);
        if($request->user_id != $user->id){
          $noti = Notification::create([
            'user_id' => $request->user_id,
            'content' => "".$user->name." Recently Visit Your Profile on ".date('Y-m-d'),
            'created_by' => $user->id,
            'status' => 0
          ]);
        }
      }else{
          $visit = UserVisit::where('user_id', $request->user_id)->where('visiter_id', $user->id)->update(['user_id' => $request->user_id]);
      }
      return response()->json([
      "success" => true,
      "message" => "User Visit successfully",
      "data" => $visit
      ]);
    }

    public function getRecentVisitedToYou(Request $request) {
      $user = JWTAuth::toUser($request->token);
      // $userId = $request->user_id;
      $dateset = date('Y-m-d',strtotime('-20 day'));
      // $getUser = UserVisit::where('user_id', $user->id)->where('created_at', '>=', $dateset)->take(10)->get();

      $getUser = UserVisit::where('user_id', $user->id)->orderBy('updated_at', 'DESC')->get();



      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['visiter_id'])->first();

        $getDUser = UserDetails::where('user_id', $user['visiter_id'])->first();
        // print_r($getDUser);
        $profileImage = File::select('file_path')->where('user_id', $user['visiter_id'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
        // $profileImage = File::select('file_path')->where('user_id', $user['visiter_id'])->where('file_type_id', 1)->where('status', 1)->get();
        $dataR = array();
        $dataR['firstname'] = $getDUser['first_name']??'null';
        $dataR['middlename'] = $getDUser['middle_name']??'null';
        $dataR['lastname'] = $getDUser['last_name']??'null';
        $dataR['gender'] = $getDUser['gender']??'null';
        $dataR['profileImage'] = $profileImage;
        $dataR['user_id'] = $user->visiter_id;
        $dataR['blur_image'] = $getDUser->image_hide??'null';
        $dataR['image_count'] = $profileImage->count();
        if($getDUser['created_by_user']){
          $dataR['executive_id'] = $getDUser['created_by_user']??'null';
          $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
          $exuser = User::where('id', $getDUser['created_by_user'])->first();
          $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
          $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
          $dataR['executive_profile_image'] = $exprofileImage;
          $dataR['executive_mobile'] = $exuser->mobile;
        }else{
          $dataR['executive_id'] = 'null';
          $dataR['executive_name'] = 'null';
          $dataR['executive_profile_image'] = 'null';
          $dataR['executive_mobile'] = 'null';
        }
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
      $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
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

    public function getRecentYouVisited(Request $request) {
      $user = JWTAuth::toUser($request->token);
      // $userId = $request->user_id;
      $dateset = date('Y-m-d',strtotime('-20 day'));

      //$getUser = UserVisit::where('visiter_id', $user->id)->where('created_at', '>=', $dateset)->take(10)->get();
      $getUser = UserVisit::where('visiter_id', $user->id)->orderBy('updated_at', 'DESC')->take(10)->get();



      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

        $getDUser = UserDetails::where('user_id', $user['user_id'])->first();

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
        if($getDUser['created_by_user']){
          $dataR['executive_id'] = $getDUser['created_by_user']??'null';
          $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
          $exuser = User::where('id', $getDUser['created_by_user'])->first();
          $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
          $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
          $dataR['executive_profile_image'] = $exprofileImage;
          $dataR['executive_mobile'] = $exuser->mobile;
        }else{
          $dataR['executive_id'] = 'null';
          $dataR['executive_name'] = 'null';
          $dataR['executive_profile_image'] = 'null';
          $dataR['executive_mobile'] = 'null';
        }
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
      $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
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

    public function getTodayMatch(Request $request) {
      $user = JWTAuth::toUser($request->token);
      
      $userId = $request->user_id;
      $userMobile = User::where('id', $user->id)->first();
      $userGender = UserDetails::where('user_id', $user->id)->first();
     
      $selectedUser = UserLike::select('user_id')->where('created_by', $user->id)->get();
      $dateset = date('Y-m-d',strtotime('-7 day'));
      $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->whereNotIn('user_details.user_id', $selectedUser)->where('users.created_at', '>=', $dateset)->where('users.id', '!=', $user->id)->where('user_details.gender', '!=', $userGender->gender)->orderBy('users.updated_at', 'DESC')->get();
      
      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

        $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
        // print_r($getDUser);
        // return response()->json([
        // "success" => true,
        // "data" => $users->about_me_short
        // ]);
        $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
        $dataR = array();
        $dataR['firstname'] = $getDUser['first_name']??'null';
        $dataR['middlename'] = $getDUser['middle_name']??'null';
        $dataR['lastname'] = $getDUser['last_name']??'null';
        $dataR['gender'] = $getDUser['gender']??'null';
        $dataR['profileImage'] = $profileImage;
        $dataR['user_id'] = $user->user_id;
        $dataR['mobile'] = $userMobile->mobile;
        $dataR['blur_image'] = $getDUser->image_hide??'null';
        $dataR['image_count'] = $profileImage->count();
        if($getDUser['created_by_user']){
          $dataR['executive_id'] = $getDUser['created_by_user']??'null';
          $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
          $exuser = User::where('id', $getDUser['created_by_user'])->first();
          $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
          $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
          $dataR['executive_profile_image'] = $exprofileImage;
          $dataR['executive_mobile'] = $exuser->mobile;
        }else{
          $dataR['executive_id'] = 'null';
          $dataR['executive_name'] = 'null';
          $dataR['executive_profile_image'] = 'null';
          $dataR['executive_mobile'] = 'null';
        }
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
      $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
      $dataR['about_me'] = (isset($users->about_me_short)) ? $users->about_me_short : '';

      $user_hobbies = UserHobby::where('user_id', $user['user_id'])->get();
      $array = [];
      foreach ($user_hobbies as $value) {
        array_push($array,$value->hobby);
      }

      if(count($array)>0){
        $dataR['hobbies'] = $array;
      }else{
        $dataR['hobbies'] = [];
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

    public function getMayMatch(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      $userMobile = User::where('id', $user->id)->first();
      $userGender = UserDetails::where('user_id', $user->id)->first();
      
      $selectedUser = UserLike::select('user_id')->where('created_by', $user->id)->get();
      $dateset = date('Y-m-d',strtotime('-7 day'));
      $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->whereNotIn('user_details.user_id', $selectedUser)->where('users.created_at', '>=', $dateset)->where('users.id', '!=', $user->id)->where('user_details.gender', '!=', $userGender->gender)->orderBy('users.updated_at', 'DESC')->get();



      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

        $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
        // print_r($getDUser);
        // return response()->json([
        // "success" => true,
        // "data" => $users->about_me_short
        // ]);
        $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
        $dataR = array();
        $dataR['firstname'] = $getDUser['first_name']??'null';
        $dataR['middlename'] = $getDUser['middle_name']??'null';
        $dataR['lastname'] = $getDUser['last_name']??'null';
        $dataR['gender'] = $getDUser['gender']??'null';
        $dataR['profileImage'] = $profileImage;
        $dataR['user_id'] = $user->user_id;
        $dataR['mobile'] = $userMobile->mobile;
        $dataR['blur_image'] = $getDUser->image_hide??'null';
        $dataR['image_count'] = $profileImage->count();
        if($getDUser['created_by_user']){
          $dataR['executive_id'] = $getDUser['created_by_user']??'null';
          $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
          $exuser = User::where('id', $getDUser['created_by_user'])->first();
          $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
          $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
          $dataR['executive_profile_image'] = $exprofileImage;
          $dataR['executive_mobile'] = $exuser->mobile;
        }else{
          $dataR['executive_id'] = 'null';
          $dataR['executive_name'] = 'null';
          $dataR['executive_profile_image'] = 'null';
          $dataR['executive_mobile'] = 'null';
        }
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
      $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
      $dataR['about_me'] = (isset($users->about_me_short)) ? $users->about_me_short : '';

      $user_hobbies = UserHobby::where('user_id', $user['user_id'])->get();
      $array = [];
      foreach ($user_hobbies as $value) {
        array_push($array,$value->hobby);
      }

      if(count($array)>0){
        $dataR['hobbies'] = $array;
      }else{
        $dataR['hobbies'] = [];
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

    public function getNearYou(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      $userMobile = User::where('id', $user->id)->first();
      $userGender = UserDetails::where('user_id', $user->id)->first();
      $stateId = UserContact::where('user_id', $user->id)->first();

      // $selectedUser = UserLike::select('user_id')->where('created_by', $user->id)->where('activity_type_id', '!=', 5)->get();
      $selectedUser = UserLike::select('user_id')->where('created_by', $user->id)->get();

      if(isset($stateId)){
        $user_stateId = $stateId->state;
        $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->join('user_contacts', 'user_contacts.user_id', '=', 'users.id')->whereNotIn('user_details.user_id', $selectedUser)->where('user_details.role_id', 3)->where('users.id', '!=', $user->id)->where('user_contacts.state', '=', $user_stateId)->where('user_details.gender', '!=', $userGender->gender)->orderBy('users.updated_at', 'DESC')->get();

      }else{
        $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->join('user_contacts', 'user_contacts.user_id', '=', 'users.id')->whereNotIn('user_details.user_id', $selectedUser)->where('user_details.role_id', 3)->where('users.id', '!=', $user->id)->where('user_details.gender', '!=', $userGender->gender)->orderBy('users.updated_at', 'DESC')->get();

      }

      // return response()->json([
      // "success" => true,
      // "data" => $getUser
      // ]);

        
      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['id'])->first();

        $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
        // print_r($users);exit;
        $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
        //$coverImage = File::select('file_path')->where('user_id', $user['user_id'])->where('user_id', $user['user_id'])->where('status', 1)->get();
        $dataR = array();
        $dataR['firstname'] = $getDUser['first_name']??'null';
        $dataR['middlename'] = $getDUser['middle_name']??'null';
        $dataR['lastname'] = $getDUser['last_name']??'null';
        $dataR['gender'] = $getDUser['gender']??'null';
        $dataR['profileImage'] = $profileImage;
        $dataR['user_id'] = $user['user_id'];
        $dataR['mobile'] = $user->mobile;
        $dataR['blur_image'] = $getDUser->image_hide??'null';
        $dataR['image_count'] = $profileImage->count();
        if($getDUser['created_by_user']){
          $dataR['executive_id'] = $getDUser['created_by_user']??'null';
          $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
          $exuser = User::where('id', $getDUser['created_by_user'])->first();
          $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
          $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
          $dataR['executive_profile_image'] = $exprofileImage;
          $dataR['executive_mobile'] = $exuser->mobile;
        }else{
          $dataR['executive_id'] = 'null';
          $dataR['executive_name'] = 'null';
          $dataR['executive_profile_image'] = 'null';
          $dataR['executive_mobile'] = 'null';
        }
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
        $dataR['about_me'] = $users['about_me_short'];
      }else{
        $dataR['age'] = '';
        $dataR['marital_status'] = '';
        $dataR['height'] = '';
        $dataR['about_me'] = '';
      }
      $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
      

      $user_hobbies = UserHobby::where('user_id', $user['user_id'])->get();
      $array = [];
      foreach ($user_hobbies as $value) {
        array_push($array,$value->hobby);
      }

      if(count($array)>0){
        $dataR['hobbies'] = $array;
      }else{
        $dataR['hobbies'] = [];
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

    public function getReferCode(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      return response()->json([
      "success" => true,
      "data" => $user->refer_code
      ]);
    }

    public function getCountAll(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      $data = array();
      $subsDatas = UserLike::select('user_id')->where('created_by', $user->id)->where('activity_type_id', 1)->get();
      $dfs = array();
      
      $selectedUser = UserLike::select('user_id')->where('created_by', $user->id)->where('activity_type_id', '!=', 5)->get();
      foreach($selectedUser as $subsData){
        array_push($dfs, $subsData['user_id']);
      }
      $dateset = date('Y-m-d',strtotime('-7 day'));
      $getTodayMatch = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->where('users.created_at', '>=', $dateset)->count();
      $data['getTodayMatchCount'] = $getTodayMatch;

      $stateId = UserContact::where('user_id', $user->id)->first();
      if(isset($stateId)){
        $user_stateId = $stateId->id;
         $getNearYouCount = User::join('user_details', 'user_details.user_id', '=', 'users.id')->join('user_contacts', 'user_contacts.user_id', '=', 'users.id')->where('user_details.role_id', '!=',$user->id)->whereNotIn('user_details.user_id', $dfs)->where('user_details.role_id', 3)->where('user_contacts.state', '=', $user_stateId)->count();
      }else{
         $getNearYouCount = User::join('user_details', 'user_details.user_id', '=', 'users.id')->join('user_contacts', 'user_contacts.user_id', '=', 'users.id')->where('user_details.role_id', '!=',$user->id)->whereNotIn('user_details.user_id', $dfs)->where('user_details.role_id', 3)->count();
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


    public function setArchiveRevert(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
    //  $getUser = UserLike::where('created_by', $user->id)->where('activity_type_id', 3)->get();

      $visit = UserLike::where('user_id', $request->user_id)->where('created_by', $user->id)->update(['activity_type_id' => 1]);
      if($visit){
        return response()->json([
          "success" => true,
          "message" => "User Revert Back Successfully"
          ]);
      }else{
        return response()->json([
          "success" => false,
          "message" => "User Not Updated"
        ],500);
      }
    }


    public function getExecutiveUsers(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      $dateset = date('Y-m-d',strtotime('-20 day'));
      $subsData = UserSubscribe::select('subscriber_id')->where('user_id', $user->id)->where('status', '1')->get();
      if(count($subsData) > 0){
        $isSubscribe = 1;
        $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 2)->whereIn('users.id', $subsData)->orderBy('users.updated_at', 'DESC')->take(10)->get();
      }else{
        $isSubscribe = 0;
        $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 2)->where('users.created_at', '>=', $dateset)->orderBy('users.updated_at', 'DESC')->take(10)->get();
      }
      

      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

        $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
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
        $dataR['blur_image'] = $getDUser->image_hide??'null';
        $dataR['image_count'] = $profileImage->count();
        $dataR['intial_fee'] = $users['intial_fee']??'null';
        $dataR['final_fee'] = $users['final_fee']??'null';
        $dataR['is_subscribe'] = $isSubscribe??'null';
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
      $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
       array_push($dataR1, $dataR);
      }


      return response()->json([
      "success" => true,
      "data" => $dataR1
      ]);


    }

    public function getExecutiveUsersPlus(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      $dateset = date('Y-m-d',strtotime('-20 day'));
      $subsData = UserSubscribe::select('subscriber_id')->where('user_id', $user->id)->where('status', '1')->get();
      $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 2)->whereNotIn('users.id', $subsData)->where('users.created_at', '>=', $dateset)->orderBy('users.updated_at', 'DESC')->take(10)->get();
      
      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

        $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
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
        $dataR['blur_image'] = $getDUser->image_hide??'null';
        $dataR['image_count'] = $profileImage->count();
        $dataR['intial_fee'] = $users['intial_fee']??'null';
        $dataR['final_fee'] = $users['final_fee']??'null';
        $dataR['is_subscribe'] = $isSubscribe??'null';
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
      $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
       array_push($dataR1, $dataR);
      }


      return response()->json([
      "success" => true,
      "data" => $dataR1
      ]);


    }

    public function getMatchCandidate(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      $dataR = array();
      //$visit = UserLike::where('user_id', $request->user_id)->where('created_by', $user->id)->where('activity_type_id', 3)->update(['activity_type_id' => 4]);

      $dataR['kundli'] = '20';
      $dataR['habits'] = '40';
      $dataR['occupation'] = '60';
      $dataR['caste'] = '100';

      return response()->json([
      "success" => true,
      "data" => $dataR
      ]);
    }


    public function getReferByAgent(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      // $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->skip(70)->take(10)->get();

      $getUser = UserMatch::where('user_id', $user->id)->orderBy('updated_at', 'DESC')->get();
      // return response()->json([
      // "success" => true,
      // "data" => $getUser
      // ]);

      $dataR1 = array();
      foreach ($getUser as $user) {
        $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['matching_id'])->first();

        $getDUser = UserDetails::where('user_id', $user['matching_id'])->first();

        $getLike = UserLike::where('user_id', $user['matching_id'])->where('created_by', $user->id)->where('activity_type_id', 1)->first();
        // print_r($getDUser);
        $profileImage = File::select('file_path')->where('user_id', $user['matching_id'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();

        // $profileImage = File::select('file_path')->where('user_id', $user['matching_id'])->where('file_type_id', 1)->where('status', 1)->get();
        $dataR = array();
        $dataR['firstname'] = $getDUser['first_name']??'null';
        $dataR['middlename'] = $getDUser['middle_name']??'null';
        $dataR['lastname'] = $getDUser['last_name']??'null';
        $dataR['gender'] = $getDUser['gender']??'null';
        $dataR['profileImage'] = $profileImage;
        $dataR['user_id'] = $users->user_id;
        $dataR['blur_image'] = $getDUser->image_hide??'null';
        $dataR['image_count'] = $profileImage->count();
        if($getDUser['created_by_user']){
          $dataR['executive_id'] = $getDUser['created_by_user']??'null';
          $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
          $exuser = User::where('id', $getDUser['created_by_user'])->first();
          $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
          $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
          $dataR['executive_profile_image'] = $exprofileImage;
          $dataR['executive_mobile'] = $exuser->mobile;
        }else{
          $dataR['executive_id'] = 'null';
          $dataR['executive_name'] = 'null';
          $dataR['executive_profile_image'] = 'null';
          $dataR['executive_mobile'] = 'null';
        }
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


  public function verifyMobile(Request $request) {
    $user = JWTAuth::toUser($request->token);
    $userId = $request->user_id;

    $getUserMobile = User::where('mobile', '=', $request->mobile)->get();
    if($getUserMobile->count() == 0){
      $getMobile = UserMobile::where('mobile', '=', $request->mobile)->get();
        if($getMobile->count() == 0){
          $getMobile = UserMobile::create([
            'mobile' => $request->mobile,
            'otp' => '123456',
            'status' => 1
          ]);
          User::where('id', '=', $userId)->update(['mobile' => $request->mobile]);
        }else{

        }
      return response()->json([
          'success' => true,
          'message' => 'Mobile no. is added successfully. please enter otp',
      ], Response::HTTP_OK);
    }else{
      return response()->json([
          'success' => false,
          'message' => 'This mobile number already registered. Please use another mobile no.',
      ], 400);
    }


  }

public function addUserMatching(Request $request) {
  $user = JWTAuth::toUser($request->token);
  // UserMatch::create([
  //   'matching_id' => $request->matching_id,
  //   'user_id' => $user->id,
  //   ]);

  $check = UserLike::where('user_id', $request->matching_id)->where('created_by', $user->id)->count();
      if($check == 0){
        $like = UserLike::create([
          'user_id' => $request->matching_id,
          'activity_type_id' => 5,
          'created_by' => $user->id
        ]);
        if($request->matching_id != $user->id){
          $noti = Notification::create([
            'user_id' => $request->matching_id,
            'content' => "".$user->name." set matching Your Profile in-progress on ".date('Y-m-d'),
            'created_by' => $user->id,
            'status' => 0
          ]);
        }
      }else{
        $like = UserLike::where('user_id', $request->matching_id)->where('created_by', $user->id)->update(['activity_type_id' => 5]);
      }

  return response()->json([
    "success" => true,
    'message' => 'Matching User created successfully',
    ]);
}

public function getUserMatching(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $request->user_id;
  // $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->skip(70)->take(10)->get();

  // $getUser = UserMatch::where('user_id', $user->id)->orderBy('updated_at', 'DESC')->get();
  $getUser = UserLike::where('created_by', $user->id)->where('activity_type_id', 5)->orderBy('updated_at', 'DESC')->get();
      
  // return response()->json([
  // "success" => true,
  // "data" => $getUser
  // ]);

  $dataR1 = array();
  foreach ($getUser as $user) {
    $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

    $getDUser = UserDetails::where('user_id', $user['user_id'])->first();

    $getLike = UserLike::where('user_id', $user['user_id'])->where('created_by', $user->id)->where('activity_type_id', 5)->first();
    // print_r($getDUser);
    $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();

    // $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
    $dataR = array();
    $dataR['firstname'] = $getDUser['first_name']??'null';
    $dataR['middlename'] = $getDUser['middle_name']??'null';
    $dataR['lastname'] = $getDUser['last_name']??'null';
    $dataR['gender'] = $getDUser['gender']??'null';
    $dataR['profileImage'] = $profileImage;
    $dataR['user_id'] = $users->user_id;
    $dataR['blur_image'] = $getDUser->image_hide??'null';
    $dataR['image_count'] = $profileImage->count();
    if($getDUser['created_by_user']){
      $dataR['executive_id'] = $getDUser['created_by_user']??'null';
      $exusers = UserDetails::where('user_id', $getDUser['created_by_user'])->first();
      $exuser = User::where('id', $getDUser['created_by_user'])->first();
      $exprofileImage = File::select('file_path')->where('user_id', $getDUser['created_by_user'])->where('status', 1)->orderBy('file_type_id', 'ASC')->get();
      $dataR['executive_name'] = $exusers->first_name.' '.$exusers->last_name;
      $dataR['executive_profile_image'] = $exprofileImage;
      $dataR['executive_mobile'] = $exuser->mobile;
    }else{
      $dataR['executive_id'] = 'null';
      $dataR['executive_name'] = 'null';
      $dataR['executive_profile_image'] = 'null';
      $dataR['executive_mobile'] = 'null';
    }
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


public function userDeactivate(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $visit = User::where('id', $user->id)->update(['status' => 0]);

  return response()->json([
    "success" => true,
    'message' => 'User Deactivated successfully',
    ]);
}


public function getUserMatchData(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $current_user = User::where('id', $user->id)->first();
  $matching_user = User::where('id', $request->user_id)->first();
  
  // its static data not completed yet
  $data = array();
  $data['kundli']['total_percentage'] = 35;
  $data['kundli']['list'] = ['Varna - 5%', 'Vasya - 20%', 'Tara - 18%'];

  $data['food_habits']['total_percentage'] = 30;
  $data['food_habits']['list'] = ['seafood', 'fruits', 'vegetarian', 'chinese'];


  $data['occupations']['total_percentage'] = 25;
  $data['occupations']['list'] = ['IT Field', 'Engineer'];
 
  $data['caste']['total_percentage'] = 25;
  $data['caste']['list'] = ['Bhahmin'];

  $data['gotra']['total_percentage'] = 15;
  $data['gotra']['list'] = ['Angad'];

  return response()->json([
  "success" => true,
  "data" => $data
  ]);
}


public function getDataMatchKundali(Request $request) {
  $user = JWTAuth::toUser($request->token);
  try{
    $current_user = User::select(['user_details.first_name','user_details.last_name','user_basic_details.birth_place',"user_basic_details.birth_time","user_basic_details.lat","user_basic_details.long","user_basic_details.dob"])->join('user_details', 'user_details.user_id', '=', 'users.id')->join('user_basic_details', 'user_basic_details.user_id', '=', 'users.id')->where('users.id', $user->id)->first();
    $matching_user = User::select(['user_details.first_name','user_details.last_name','user_basic_details.birth_place',"user_basic_details.birth_time","user_basic_details.lat","user_basic_details.long","user_basic_details.dob"])->join('user_details', 'user_details.user_id', '=', 'users.id')->join('user_basic_details', 'user_basic_details.user_id', '=', 'users.id')->where('users.id', $request->match_user_id)->first();
  }catch(Exception $e){
    return response()->json([
      "success" => false,
      "data" => $e
      ]);
  }
  
  
  // its static data not completed yet
  $data = array();
  $data['kundali_type'] = 1;
  if($current_user){
    $date_in = $current_user['dob']." ".$current_user['birth_time'];
    $dt = new DateTime($date_in);
    $datetime = $dt->format('Y-m-d\TH:i:s').'Z';
    $data['login_user']['first_name'] = $current_user['first_name'];
    $data['login_user']['last_name'] = $current_user['last_name'];
    $data['login_user']['dob'] = $current_user['dob'];
    $data['login_user']['converted_dob'] = $datetime;
    $data['login_user']['birth_place'] = $current_user['birth_place'];
    $data['login_user']['birth_time'] = $current_user['birth_time'];
    $data['login_user']['birth_lat'] = $current_user['lat'];
    $data['login_user']['birth_long'] = $current_user['long'];
  }

  if($matching_user){
    $date_in = $matching_user['dob']." ".$matching_user['birth_time'];
    $dt = new DateTime($date_in);
    $datetime = $dt->format('Y-m-d\TH:i:s').'Z';
    $data['matching_user']['converted_dob'] = $datetime;
    $data['matching_user']['first_name'] = $matching_user['first_name'];
    $data['matching_user']['last_name'] = $matching_user['last_name'];
    $data['matching_user']['dob'] = $matching_user['dob'];
    $data['matching_user']['birth_place'] = $matching_user['birth_place'];
    $data['matching_user']['birth_time'] = $matching_user['birth_time'];
    $data['matching_user']['birth_lat'] = $matching_user['lat'];
    $data['matching_user']['birth_long'] = $matching_user['long'];
  }else{
    return response()->json([
      "success" => false,
      "data" => [],
      "message" => "Please check matching user have some problem please check user Id!"
      ]);
  }
  
  return response()->json([
  "success" => true,
  "data" => $data
  ]);
}



public function getExecutiveList(Request $request) {
  $user = JWTAuth::toUser($request->token);
  
  $userId = $request->user_id;

  // $selectedUser = UserDetails::select('user_id')->where('role_id', 3)->get();
  // $dateset = date('Y-m-d',strtotime('-7 day'));
  $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 2)->orderBy('users.updated_at', 'DESC')->get();
  
  $dataR1 = array();
  foreach ($getUser as $user) {
    $users = UserBasicDetail::select(['user_basic_details.*'])->where('user_id', $user['user_id'])->first();

    $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
    // print_r($getDUser);
    // return response()->json([
    // "success" => true,
    // "data" => $users->about_me_short
    // ]);
    $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('status', 1)->orderBy('file_type_id', 'ASC')->take(5)->get();
    $dataR = array();
    $dataR['firstname'] = $getDUser['first_name']??'null';
    $dataR['middlename'] = $getDUser['middle_name']??'null';
    $dataR['lastname'] = $getDUser['last_name']??'null';
    $dataR['gender'] = $getDUser['gender']??'null';
    $dataR['profileImage'] = $profileImage;
    $dataR['user_id'] = $user->user_id;
    // $dataR['mobile'] = $userMobile->mobile;
    $dataR['blur_image'] = $getDUser->image_hide??'null';
    $dataR['image_count'] = $profileImage->count();
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
  $dataR['is_agent'] = (isset($getDUser->created_by_user)) ? '1' : '0';
  $dataR['about_me'] = (isset($users->about_me_short)) ? $users->about_me_short : '';

  $user_hobbies = UserHobby::where('user_id', $user['user_id'])->get();
  $array = [];
  foreach ($user_hobbies as $value) {
    array_push($array,$value->hobby);
  }

  if(count($array)>0){
    $dataR['hobbies'] = $array;
  }else{
    $dataR['hobbies'] = [];
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


public function getExecutiveDetailUserSide(Request $request) {
  $user = JWTAuth::toUser($request->token);
  
  $userId = $request->user_id;
 
  //for social data

  $dataR1['social_count']['following'] = 0;
  $dataR1['social_count']['followers'] = 0;
  $dataR1['social_count']['likes'] = 0;

  // for portfolioImg

  $file = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 8)->get();
  $dataR1['portfolioImg'] = $file;

  //user details

  $exec_user = UserBasicDetail::where('user_id', $userId)->first();
  // return $user;
  $getUser = User::where('users.id', $userId)->first();
  $getDUser = UserDetails::where('user_id', $userId)->first();
  $profileImage = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 1)->where('status', 1)->get();
  $coverImage = File::select('file_path')->where('user_id', $userId)->where('file_type_id', 2)->where('status', 1)->orderBy('status','DESC')->get();

  // $district = District::where('id', $user->district_id)->first();
  // $state = State::where('id', $user->state)->first();

    $dataR1['exective_details']['firstname'] = $getDUser->first_name;
    $dataR1['exective_details']['middlename'] = $getDUser->middle_name;
    $dataR1['exective_details']['lastname'] = $getDUser->last_name;
    $dataR1['exective_details']['dob'] = $getDUser->dob;
    $dataR1['exective_details']['gender'] = $getDUser->gender;
    $dataR1['exective_details']['email'] = $getUser->email;
    $dataR1['exective_details']['mobile'] = $getUser->mobile;
    $dataR1['exective_details']['profileImage'] = $profileImage;
    $dataR1['exective_details']['coverImage'] = $coverImage;
    $dataR1['exective_details']['user_id'] = $userId;
    $dataR1['exective_details']['about_me'] = (isset($exec_user->about_me_short)) ? $exec_user->about_me_short : '';


  return response()->json([
  "success" => true,
  "data" => $dataR1
  ]);

}


public function getSocialCount(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $request->user_id;

  $dataR = array();
  $dataR['following'] = 10000;
  $dataR['followers'] = 100000;
  $dataR['likes'] = 1000000;

  return response()->json([
    "success" => true,
    "data" => $dataR
    ]);

}

public function getMatchDetails(Request $request) {
  $user = JWTAuth::toUser($request->token);
  $userId = $request->user_id;

  $getLooking = UserSearching::select(['user_searchings.*'])
            ->where('user_id', $user->id)->first();
  $getLooking2nd = UserSearching::select(['user_searchings.*'])
            ->where('user_id', $userId)->first();
            // return response()->json([
            //   "success" => true,
            //   "data" => $user->id
            //   ]);
    $data = array();
    if($request->matchDetailType == 1){
      if($getLooking->diet_type_id > 0){
        $diettype = DietType::where('id', $getLooking->diet_type_id)->first();
        $data['own']['diet_type'] = $diettype->diet;
      }else {
        $data['own']['diet_type'] = '';
      }

      if($getLooking2nd->diet_type_id > 0){
        $diettype2 = DietType::where('id', $getLooking2nd->diet_type_id)->first();
        $data['matchingParty']['diet_type'] = $diettype2->diet;
      }else {
        $data['matchingParty']['diet_type'] = '';
      }
    }
    if($request->matchDetailType == 2){
      if($getLooking->annual_income_id > 0){
        $annualincome = AnnualIncome::where('id', $getLooking->annual_income_id)->first();
        $data['own']['annual_income'] = $annualincome->incomes;
      }else {
        $data['own']['annual_income'] = '';
      }
     
      if($getLooking->work_type > 0){
        $worktype = WorkType::where('id', $getLooking->work_type)->first();
        $data['own']['work_type'] = $worktype->name;
      }else {
        $data['own']['work_type'] = '';
      }
      if($getLooking2nd->annual_income_id > 0){
        $annualincome2 = AnnualIncome::where('id', $getLooking2nd->annual_income_id)->first();
        $data['matchingParty']['annual_income'] = $annualincome2->incomes;
      }else {
        $data['matchingParty']['annual_income'] = '';
      }
     
      if($getLooking2nd->work_type > 0){
        $worktype2 = WorkType::where('id', $getLooking2nd->work_type)->first();
        $data['matchingParty']['work_type'] = $worktype2->name;
      }else {
        $data['matchingParty']['work_type'] = '';
      }
    }
    
    if($request->matchDetailType == 3){
      if($getLooking->caste_id > 0){
        $caste = Caste::where('id', $getLooking->caste_id)->first();
        $data['own']['caste'] = $caste->name;
      }else {
        $data['own']['caste'] = '';
      }
      if($getLooking->gotra_id > 0){
        $gotra = Gotra::where('id', $getLooking->gotra_id)->first();
        $data['own']['gotra'] = $gotra->name;
      }else {
        $data['own']['gotra'] = '';
      }

      if($getLooking2nd->caste_id > 0){
        $caste2 = Caste::where('id', $getLooking2nd->caste_id)->first();
        $data['matchingParty']['caste'] = $caste2->name;
      }else {
        $data['matchingParty']['caste'] = '';
      }
      if($getLooking2nd->gotra_id > 0){
        $gotra2 = Gotra::where('id', $getLooking2nd->gotra_id)->first();
        $data['matchingParty']['gotra'] = $gotra2->name;
      }else {
        $data['matchingParty']['gotra'] = '';
      }
    }

    return response()->json([
      "success" => true,
      "data" => $data
      ]);

}
public function getUserSubscribe(Request $request) {
  $user = JWTAuth::toUser($request->token);
  if($request->user_id == ''){
    return response()->json([
      "success" => true,
      'message' => 'please pass Susbcriber id',
      ]);
  }
  $subs = UserSubscribe::where('user_id', $user->id)->where('subscriber_id', $request->user_id)->first();
  return response()->json([
    "success" => true,
    'data' => $subs,
    ]);
}

public function userSubscribe(Request $request) {
  $user = JWTAuth::toUser($request->token);
  if($request->user_id == ''){
    return response()->json([
      "success" => true,
      'message' => 'please pass Susbcriber id',
      ]);
  }
  if($request->status == ''){
    return response()->json([
      "success" => true,
      'message' => 'please pass status',
      ]);
  }
  $subs = UserSubscribe::where('user_id', $user->id)->where('subscriber_id', $request->user_id)->count();
  if($subs == 0){
    $getusersubs = UserSubscribe::create([
      'user_id' => $user->id,
      'subscriber_id' => $request->user_id,
      'status' => $request->status,
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  }else{
    $getusersubs = UserSubscribe::where('user_id', $user->id)->where('subscriber_id', $request->user_id)->update(['status' => $request->status]);
  }
  

  return response()->json([
    "success" => true,
    'message' => 'User Susbcribed successfully',
    ]);
}


  public function getMatchingOccupation(Request $request)
    {
      $data = array();
      $mainUsers = UserBasicDetail::select(['work_types.*'])->join('work_types', 'work_types.id', '=', 'user_basic_details.work_type_id')->where('user_id', $request->user_id)->first();
      $matchUsers = UserBasicDetail::select(['work_types.*'])->join('work_types', 'work_types.id', '=', 'user_basic_details.work_type_id')->where('user_id', $request->match_user_id)->first();
   
      $data["first_party"] = $mainUsers['name']??'null';
   
      $data["second_party"] = $matchUsers['name']??'null';
        return response()->json([
            'success' => true,
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function getMatchingCaste(Request $request)
    {
      $data = array();
      $mainUsers = UserBasicDetail::select(['castes.*'])->join('castes', 'castes.id', '=', 'user_basic_details.caste_id')->where('user_id', $request->user_id)->first();
      $matchUsers = UserBasicDetail::select(['castes.*'])->join('castes', 'castes.id', '=', 'user_basic_details.caste_id')->where('user_id', $request->match_user_id)->first();
      
        $data["first_party"] = $mainUsers['name']??'null';
      
        $data["second_party"] = $matchUsers['name']??'null';
        return response()->json([
            'success' => true,
            'data' => $data
        ], Response::HTTP_OK);
    }


    public function getMatchingFoodHabits(Request $request)
    {
      $data = array();
      $mainUsers = UserBasicDetail::select(['diet_types.*'])->join('diet_types', 'diet_types.id', '=', 'user_basic_details.diet_type_id')->where('user_id', $request->user_id)->first();
      $matchUsers = UserBasicDetail::select(['diet_types.*'])->join('diet_types', 'diet_types.id', '=', 'user_basic_details.diet_type_id')->where('user_id', $request->match_user_id)->first();
      // $data["first_party"] = $mainUsers['diet'];
      // $data["second_party"] = $matchUsers['diet'];
        $data["first_party"] = $mainUsers['diet']??'null';
        $data["second_party"] = $matchUsers['diet']??'null';
        return response()->json([
            'success' => true,
            'data' => $data
        ], Response::HTTP_OK);
    }


  }
