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
use App\Models\UserSecurityquestion;
use App\Models\ApiResponse;
use App\Models\UserVisit;
use Carbon\Carbon;
use App\Models\NotificationMsg;
use App\Models\MaritalStatus;



use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use Intervention\Image\Facades\Image as Image;
use Hash;

class CommonapiController extends Controller
{

    public function getBenefit(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $user->id;
      $getbenefitnormal = Benefit::where('type', 1)->where('section', 1)->where('status', 1)->orderBy('order', 'ASC')->get();
      $getbenefitpayment = Benefit::where('type', 1)->where('section', 2)->where('status', 1)->orderBy('order', 'ASC')->get();
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
      $getCommQuestion = CommonQuestion::where('status', 1)->where('type', 1)->get();
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
      }
      if(count($dataR3) > 0){
        array_push($data, $dataR3);
      }
      return response()->json([
      "success" => true,
      "data" => $data
      ]);
    }

    public function getSearch(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      if($request->search != ''){
        $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->where('users.name','LIKE', '%'.$request->search.'%')->take(10)->get();
      }else{
        $getUser = UserVisit::join('users', 'users.id', '=', 'user_visits.user_id')->where('user_visits.visiter_id', $user->id)->orderBy('user_visits.updated_at', 'DESC')->get();
      }
      $dataR1 = array();
      foreach ($getUser as $user) {
        // $users = UserBasicDetail::select(['user_basic_details.*','ages.name as agedtaa','heights.height as height','marital_statuses.name as maritalstatus'])
        // ->join('ages', 'ages.id', '=', 'user_basic_details.age_id')
        // ->join('heights', 'heights.id', '=', 'user_basic_details.height_id')
        // ->join('marital_statuses', 'marital_statuses.id', '=', 'user_basic_details.marital_status')
        // ->where('user_id', $user['id'])->first();
        $userBasiDetails = UserBasicDetail::select(['user_basic_details.*'])
        ->where('user_id', $user['user_id'])->first();


        $getDUser = UserDetails::where('user_id', $user['user_id'])->first();
        // print_r($getDUser);
        $profileImage = File::select('file_path')->where('user_id', $user['user_id'])->where('file_type_id', 1)->where('status', 1)->get();
        $dataR = array();
        $dataR['username'] = $user['name'];
        $dataR['place'] = $userBasiDetails['birth_place']??'null';

        if(!empty($userBasiDetails['state']) && $userBasiDetails['state']>0){
          $getstate = State::where('id', $userBasiDetails['state'])->first();
          $dataR['state'] = $getstate->name;
        }else{
          $dataR['state'] = '';
        }
        // $dataR['firstname'] = $getDUser['first_name']??'null';
        // $dataR['middlename'] = $getDUser['middle_name']??'null';
        // $dataR['lastname'] = $getDUser['last_name']??'null';
        $dataR['gender'] = $getDUser['gender']??'null';
        $dataR['profileImage'] = $profileImage;
        $dataR['user_id'] = $user->user_id;
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
    public function getFilter(Request $request) {
      $user = JWTAuth::toUser($request->token);
      $userId = $request->user_id;
      $gender = $request->gender;
      $age_from = $request->age_from;
      $age_to = $request->age_to;
      $distance_from = $request->distance_from;
      $distance_to = $request->distance_to;
      $lang = $request->lang;
      $getUser = User::join('user_details', 'user_details.user_id', '=', 'users.id')->join('user_basic_details', 'user_basic_details.user_id', '=', 'users.id')->where('user_details.role_id', 3)->where('user_details.gender','=', $gender)->take(10)->get();
      
      $dataR1 = array();
      foreach ($getUser as $user) {
        
        $users = UserBasicDetail::select(['user_basic_details.*','ages.name as agedtaa','heights.height as height','marital_statuses.name as maritalstatus'])
        ->join('ages', 'ages.id', '=', 'user_basic_details.age_id')
        ->join('heights', 'heights.id', '=', 'user_basic_details.height_id')
        ->join('marital_statuses', 'marital_statuses.id', '=', 'user_basic_details.marital_status')
        ->where('user_id', $user->user_id)->first();

        $getDUser = UserDetails::where('user_id', $user->user_id)->first();
        //print_r($getDUser);
        $profileImage = File::select('file_path')->where('user_id', $user->user_id)->where('file_type_id', 1)->where('status', 1)->get();
        $dataR = array();
        $dataR['firstname'] = $getDUser['first_name']??'null';
        $dataR['middlename'] = $getDUser['middle_name']??'null';
        $dataR['lastname'] = $getDUser['last_name']??'null';
        $dataR['gender'] = $getDUser['gender']??'null';
        $dataR['profileImage'] = $profileImage;
        $dataR['user_id'] = $user->user_id;
        $dataR['age'] = (isset($users->agedtaa)) ? $users->agedtaa : '';
        $dataR['marital_status'] = (isset($user->maritalstatus)) ? $users->maritalstatus : '';
        $dataR['height'] = (isset($users->height)) ? $users->height : '';
       array_push($dataR1, $dataR);
      }

      return response()->json([
      "success" => true,
      "data" => $dataR1
      ]);

    }
    public function like(Request $request)
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
          'activity_type_id' => 1,
          'created_by' => $user->id
        ]);
        $getNotiMsg = NotificationMsg::where('notification_type', 3)->first();
        if($request->user_id != $user->id){
          $noti = Notification::create([
            'user_id' => $request->user_id,
            'content' => "".$user->name." " .$getNotiMsg->discription. " ".date('Y-m-d'),
            'created_by' => $user->id,
            'status' => 0
          ]);
        }
      }else{
        $like = UserLike::where('user_id', $request->user_id)->where('created_by', $user->id)->update(['activity_type_id' => 1]);
      }
      ApiResponse::create([
        'api_name' => 'like ap',
        'response' => $request,
        'user_id' => $userId,
      ]);
      return response()->json([
      "success" => true,
      "message" => "User set Like successfully",
      "data" => $like
      ]);
    }

    public function dislike(Request $request)
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
          'activity_type_id' => 2,
          'created_by' => $user->id
        ]);
        if($request->user_id != $user->id){
          $noti = Notification::create([
            'user_id' => $request->user_id,
            'content' => "".$user->name." Dis-Like Your Profile on ".date('Y-m-d'),
            'created_by' => $user->id,
            'status' => 0
          ]);
        }
      }else{
        $like = UserLike::where('user_id', $request->user_id)->where('created_by', $user->id)->update(['activity_type_id' => 2]);
      }
      ApiResponse::create([
        'api_name' => 'dislike api',
        'response' => $request,
        'user_id' => $userId,
      ]);
      return response()->json([
      "success" => true,
      "message" => "User set Dislike successfully",
      "data" => $like
      ]);
    }

    public function archive(Request $request)
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
          'activity_type_id' => 3,
          'created_by' => $user->id
        ]);
        if($request->user_id != $user->id){
          $noti = Notification::create([
            'user_id' => $request->user_id,
            'content' => "".$user->name." Archive Your Profile on ".date('Y-m-d'),
            'created_by' => $user->id,
            'status' => 0
          ]);
        }
      }else{
        $like = UserLike::where('user_id', $request->user_id)->where('created_by', $user->id)->update(['activity_type_id' => 3]);
      }
      ApiResponse::create([
        'api_name' => 'archive api',
        'response' => $request,
        'user_id' => $userId,
      ]);
      return response()->json([
      "success" => true,
      "message" => "User set Archive successfully",
      "data" => $like
      ]);
    }

    public function getNotification(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $from = Carbon::now();
      $to = Carbon::now()->subDays(7);

        $notifica = Notification::where('user_id', $user->id)->whereBetween('created_at', [$to, $from])->orderBy('created_at', 'DESC')->get();
        $data['week'] = array();
        foreach ($notifica as $val) {
          $getDUser = UserDetails::where('user_id', $val->created_by)->first();
          $profileImage = File::select('file_path')->where('user_id', $val->created_by)->where('file_type_id', 1)->where('status', 1)->first();
          $dataR1 = array();
          $dataR1['notification'] = $val->content;
          $dataR1['user_id'] = $val->created_by;
          $dataR1['user_name'] = $getDUser->first_name." ".$getDUser->last_name;
          $dataR1['notification_id'] = $val->id;
          $dataR1['active_status'] = $getDUser->active_status??'';
          if($profileImage == null){
            $dataR1['image']['file_path'] = null;
          }else{
            $dataR1['image'] = $profileImage;
          }

          $dataR1['read'] = $val->status;
          array_push($data['week'], $dataR1);
        }

        $oneYearBack = Carbon::now()->subDays(365);
        $from = Carbon::now()->subDays(7);
        $notifica = Notification::where('user_id', $user->id)->whereBetween('created_at', [$oneYearBack, $from])->get();
        $data['year'] = array();
        foreach ($notifica as $val) {
          $getDUser = UserDetails::where('user_id', $val->created_by)->first();
          $profileImage = File::select('file_path')->where('user_id', $val->created_by)->where('file_type_id', 1)->where('status', 1)->first();
          $dataR2 = array();
          $dataR2['notification'] = $val->content;
          $dataR2['user_id'] = $val->created_by;
          $dataR2['user_name'] = $getDUser->first_name." ".$getDUser->last_name;
          $dataR2['notification_id'] = $val->id;
          $dataR2['active_status'] = $getDUser->active_status??'';
          if($profileImage == null){
            $dataR2['image']['file_path'] = null;
          }else{
            $dataR2['image'] = $profileImage;
          }
          $dataR2['read'] = $val->status;
          array_push($data['year'], $dataR2);
        }
        return response()->json([
            'success' => true,
            'data' => $data
        ], Response::HTTP_OK);
        //add
    }

    public function getNotificationCount(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
        $notifica = Notification::where('user_id', $user->id)->where('status', 0)->count();

        return response()->json([
            'success' => true,
            'data' => $notifica
        ], Response::HTTP_OK);
    }
    public function getNotificationRead(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $notifica = Notification::where('id', $request->notification_id)->update(['status' => 1]);

        return response()->json([
            'success' => true,
            "message" => "Read successfully",
            'data' => $notifica
        ], Response::HTTP_OK);
    }

    public function addUserWiseSecurityQuestion(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $deleteRecords = UserSecurityquestion::where('user_id', $user->id)->delete();

     foreach ($request->security_question as $value) {
       UserSecurityquestion::create([
         'user_id' => $user->id,
         'question_id' => $value["question_id"],
         'answer' => $value["answer"]
       ]);
     }

     $selectRecords = UserSecurityquestion::where('user_id', $user->id)->get();

        return response()->json([
            'success' => true,
            "message" => "added successfully",
            'data' => $selectRecords
        ], Response::HTTP_OK);
    }

    public function setPreferCommuni(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $notifica = UserDetails::where('user_id', $user->id)->update(['prefer_communication' => $request->set_communication]);

        return response()->json([
            'success' => true,
            "message" => "update successfully",
            'data' => $notifica
        ], Response::HTTP_OK);
    }
    public function setBlur(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $notifica = UserDetails::where('user_id', $user->id)->update(['image_hide' => $request->set_blur]);

        return response()->json([
            'success' => true,
            "message" => "User set Blur successfully",
            'data' => $notifica
        ], Response::HTTP_OK);
    }
    public function setUserRequestContact(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $notifica = UserDetails::where('user_id', $user->id)->update(['requestcontact_view' => $request->contact_status]);

        return response()->json([
            'success' => true,
            'data' => $notifica
        ], Response::HTTP_OK);
    }
    public function setOnlineOffline(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $notifica = UserDetails::where('user_id', $user->id)->update(['active_status' => $request->active_status]);

        return response()->json([
            'success' => true,
            "message" => "User set Blur successfully",
            'data' => $notifica
        ], Response::HTTP_OK);
    }

    public function getUserImageGallery(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $profileImage = File::where('user_id', $user->id)->where('file_type_id', 1)->get();
      $coverImage = File::where('user_id', $user->id)->where('file_type_id', 2)->get();

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

    public function setCoverImageDefault(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $notifica = File::where('user_id', $user->id)->where('file_type_id', 2)->update(['status' => 2]);
      $updateDefault = File::where('user_id', $user->id)->where('id', $request->image_id)->update(['status' => 1]);
      if($updateDefault){
      return response()->json([
            'success' => true,
            "message" => "set default cover image successfully"
        ], Response::HTTP_OK);
     }else{
          return response()->json([
            'success' => true,
            "message" => "selected image is not set as cover image"
        ], Response::HTTP_OK);
      }
     }


     public function deleteCoverImage(Request $request)
    {
      $user = JWTAuth::toUser($request->token);
      $deleteImage = File::where('id', $request->image_id)->firstorfail()->delete();
      if($deleteImage){
      return response()->json([
            'success' => true,
            "message" => "Image deleted successfully"
        ], Response::HTTP_OK);
     }else{
          return response()->json([
            'success' => true,
            "message" => "selected image is not delete"
        ], Response::HTTP_OK);
      }
     }

     public function setMyPrefer(Request $request)
     {
       $user = JWTAuth::toUser($request->token);
       $notifica = UserDetails::where('user_id', $user->id)->update(['my_prefer' => $request->my_prefer]);
 
         return response()->json([
             'success' => true,
             "message" => "update successfully",
             'data' => $notifica
         ], Response::HTTP_OK);
     }

     public function getRecommenedForYou(Request $request) {
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

  public function paymentUpdate(Request $request)
  {
    $user = JWTAuth::toUser($request->token);
    $notifica = UserDetails::where('user_id', $user->id)->update(['payment_status' => $request->payment_status]);

      return response()->json([
          'success' => true,
          "message" => "update successfully",
          'data' => $notifica
      ], Response::HTTP_OK);
  }

  }
