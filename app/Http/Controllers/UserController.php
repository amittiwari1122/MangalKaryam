<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\UserRegistrationPercentage;
use App\Models\Status;
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
use App\Models\Weight;
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
use App\Models\SkinTone;
use App\Models\BodyType;
use App\Models\AllergicType;
use App\Models\MaritalStatus;
use App\Models\ApiResponse;
use App\Models\Quality;
use App\Models\ManglikType;
use App\Models\ImportUser;
use App\Models\Nationality;
use App\Models\District;
use App\Models\Education;
use Mail;
use Illuminate\Support\Str;
use App\Models\File;

use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use DateTime;
use App\Models\Notification;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index(Request $request)
      {
        \DB::statement("SET SQL_MODE=''");
        $user = User::select(['users.id as id','users.name','users.email','users.created_at','users.updated_at','user_details.role_id','files.file_path','files.file_type_id'])->join('user_details', 'user_details.user_id', '=', 'users.id')->join('files', 'files.user_id', '=', 'users.id')->where('files.file_type_id', '=', '1')->where('files.status', '=', '1')->orderBy('updated_at', 'desc')->groupBy('users.id')->get();
        // $result = User::query();
        // $user = $result->get();
        $destinationPath = public_path('uploads');
         return view('user.index', ['user' => $user,'destinationPath' => $destinationPath]);
      }

      public function deleteUser($id)
        {
          $userId = $id;
          $checkUserBasicDetails = User::where('id', $userId)->count();
          if($checkUserBasicDetails > 0){
            try{
              User::where('id', $userId)->delete();
            }catch(Exception $e){

            }
            
          }
          $checkUserBasicDetails = UserBasicDetail::where('user_id', $userId)->count();
          if($checkUserBasicDetails > 0){
            UserBasicDetail::where('user_id', $userId)->delete();
          }
          $checkUserDetails = UserDetails::where('user_id', $userId)->count();
          if($checkUserDetails > 0){
            UserDetails::where('user_id', $userId)->delete();
          }
        }
      

      public function searchUser(Request $request)
      {
        //$result = User::query();
        \DB::statement("SET SQL_MODE=''");

        $result = User::select(['users.id as id','users.name', 'users.email','users.mobile','user_details.role_id','files.file_path','files.file_type_id'])->join('user_details', 'user_details.user_id', '=', 'users.id')->join('files', 'files.user_id', '=', 'users.id');

        //print_r($request);
        // dd($request);
        $destinationPath = public_path('uploads');

        if (!empty($request->first_name)) {
            $result = $result->where('users.name', 'like', '%'.$request->first_name.'%');
            //dd($request);
        }

        if (!empty($request->email)) {
            $result = $result->where('users.email', $request->email);
        }

        if (!empty($request->mobile)) {
            $result = $result->where('users.mobile', $request->mobile);
        }

        if (!empty($request->status)) {
            //$result = $result->where('role_id', 'like', '%'.$request->role.'%');

        }

        if (!empty($request->role_id)) {
          $result = $result->where('user_details.role_id', $request->role_id);
        }

        $user = $result->where('files.status', '=', '1')->where('files.file_type_id', '=', '1')->groupBy('users.id')->get();
         return view('user.index', ['user' => $user,'destinationPath' => $destinationPath]);
      }

      public function downloadfile()
      {
        $destinationPath = public_path('uploads');
          $filepath = public_path('uploads/demo.csv');
          return \Response::download($filepath); 
      }

      public function add()
      {
        $user = User::get();
        $age = Age::get();
        $height = Height::get();
        $weight = Weight::get();
        $manglik = ManglikType::get();
        $skintone = SkinTone::get();
        $religion = Religion::get();
        $caste = Caste::get();
        $gotra = Gotra::get();
        $bodytype = BodyType::get();
        $allerigic = AllergicType::get();
        $marragestatus = MaritalStatus::get();
        $diettype = DietType::get();
        $annualincome = AnnualIncome::get();
        $country = Country::get();
        $state = State::get();
        $district = District::get();
        $nationality = Nationality::get();
        $work_type = WorkType::get();
         return view('user.add', ['user' => $user,
         'age' => $age,
         'height' => $height,
         'weight' => $weight,
          'manglik' => $manglik,
          'skintone' => $skintone,
          'religion' => $religion,
          'caste' => $caste,
          'gotra' => $gotra,
          'bodytype' => $bodytype,
        'allerigic' => $allerigic,
        'marragestatus' => $marragestatus,
        'annualincome' => $annualincome,
        'diettype' => $diettype,
        'country' => $country,
        'state' => $state, 
        'nationality' => $nationality,
        'district'=> $district,
      'work_type' => $work_type]);
      }
      

      public function edit($id)
      {
        $user = User::where('id', $id)->first();
        $userDetail = UserDetails::where('user_id', $id)->first();
        // dd($id);
        $userBasicDetail = UserBasicDetail::where('user_id', $id)->first();
        $userSearching = UserSearching::where('user_id', $id)->first();
        $userCareer = UserCareer::where('user_id', $id)->first();
        $userContact = UserContact::where('user_id', $id)->first();
        $userFamily = UserFamily::where('user_id', $id)->first();
        $userLocation = UserLocation::where('user_id', $id)->first();

        $profileImage = File::select('file_path')->where('user_id', $id)->where('file_type_id', 1)->where('status', 1)->orderBy('file_type_id', 'ASC')->first();
        $coverImages = File::select('file_path')->where('user_id', $id)->where('file_type_id', 2)->get();

        // dd($userBasicDetail);

        $age = Age::get();
        $height = Height::get();
        $weight = Weight::get();
        $manglik = ManglikType::get();
        $skintone = SkinTone::get();
        $religion = Religion::get();
        $caste = Caste::get();
        $gotra = Gotra::get();
        $bodytype = BodyType::get();
        $allerigic = AllergicType::get();
        $marragestatus = MaritalStatus::get();
        $diettype = DietType::get();
        $annualincome = AnnualIncome::get();
        $country = Country::get();
        $state = State::get();
        $nationality = Nationality::get();
        $work_type = WorkType::get();
        $district = District::get();
        $qualification = Qualification::get();
        $eligility = Education::get();
        $profession = Profession::get();
         return view('user.edit', ['user' => $user, 'userDetail' => $userDetail, 'userBasicDetail' => $userBasicDetail, 'userSearching' => $userSearching ,'userCareer' => $userCareer, 'userContact' => $userContact,'userFamily' => $userFamily,'userLocation' => $userLocation,
         'age' => $age,
         'height' => $height,
         'weight' => $weight,
          'manglik' => $manglik,
          'skintone' => $skintone,
          'religion' => $religion,
          'caste' => $caste,
          'gotra' => $gotra,
          'bodytype' => $bodytype,
        'allerigic' => $allerigic,
        'marragestatus' => $marragestatus,
        'annualincome' => $annualincome,
        'diettype' => $diettype,
        'country' => $country,
        'state' => $state,
        'district' => $district,
        'nationality' => $nationality,
        'work_type' => $work_type,
      "eligility" => $eligility,
    "qualification" => $qualification,
  "profession" => $profession,"profileImage" => $profileImage, "coverImages" => $coverImages]);
      }

      public function saveEdit(Request $request)
        {
          // dd($request);
          $userId = $request->user_id;
          $checkUserBasicDetails = UserBasicDetail::where('user_id', $userId)->count();
          if($checkUserBasicDetails > 0){
            $getuserbasic = UserBasicDetail::where('user_id', $userId)
                    ->update(['address' => $request->address, 'marital_status' => $request->marital_status, 'age_id' => $request->age, 'height_id' => $request->height, 'weight_id' => $request->weight,'dob' => $request->dob,'birth_place' => $request->birth_place,'birth_time' => $request->birth_time,'skin_tone_id' => $request->skintone,'allergic_type_id' => $request->allergic,'manglik_type_id' => $request->manglik, 'beard_type_id' => $request->beard,'drink_type_id' => $request->drink,'body_type_id' => $request->bodytype,'nationality_id' => $request->nationality,'gotra_id' => $request->gotra, 'caste_id' => $request->caste, 'religion_id' => $request->religion]);
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
              'skin_tone_id' => $request->skintone,
              'allergic_type_id' => $request->allergic,
              'manglik_type_id' => $request->manglik,
              'beard_type_id' => $request->beard,
              'drink_type_id' => $request->drink,
              'body_type_id' => $request->bodytype,
              'religion_id' => $request->religion,
              'user_id' => $userId,
            ]);
          }
          $user = User::where('id', $userId)
                      ->update(['name' => $request->firstname.' '.$request->lastname,"email" => $request->email,"mobile" => $request->mobile]);
          
          $checkUserBasic = UserDetails::where('user_id', $userId)->count();
          if($checkUserBasic > 0){
            $userbasic = UserDetails::where('user_id', $userId)
                      ->update(['first_name' => $request->firstname, 'middle_name' => $request->middlename, 'last_name' => $request->lastname, 'gender' => $request->gender, 'created_by' => "Admin", 'refer_by' => $request->referBy]);
          
          }else{
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
              'refer_by' => $request->referBy,
            ]);
            
          }
          
          $checkLookingFor = UserSearching::where('user_id', $userId)->count();
          if($checkLookingFor > 0){
            $getusersearch = UserSearching::where('user_id', $userId)
                      ->update(['height_from' => $request->lookingfor_heightfrom, 'quality_id' => $request->lookingfor_qalities, 'height_to' => $request->lookingfor_heightTo, 'age_from' => $request->lookingfor_ageFrom, 'age_to' => $request->lookingfor_ageTo, 'work_type' => $request->lookingfor_worktype,'annual_income_id' => $request->lookingfor_annual_income,'diet_type_id' => $request->lookingfor_diet_type,'marital_status' => $request->lookingfor_marital_status,'caste_id' => $request->lookingfor_caste,'gotra_id' => $request->lookingfor_gotra]);

          }else{
            $getusersearch = UserSearching::create([
              'height_from' => $request->lookingfor_heightfrom,
              'height_to' => $request->lookingfor_heightTo,
              'age_from' => $request->lookingfor_ageFrom,
              'age_to' => $request->lookingfor_ageTo,
              'annual_income_id' => $request->lookingfor_annual_income,
              'diet_type_id' => $request->lookingfor_diet_type,
              'work_type' => $request->lookingfor_worktype,
              'marital_status' => $request->lookingfor_marital_status,
              'caste_id' => $request->lookingfor_caste,
              'gotra_id' => $request->lookingfor_gotra,
              'quality_id' => $request->lookingfor_qalities,
              'created_at' => now(),
              'updated_at' => now(),
              'user_id' => $userId,
            ]);
          }

          $checkContact = UserContact::where('user_id', $userId)->count();
          if($checkContact > 0){
            $getlooking = UserContact::where('user_id', $userId)
                      ->update(['mobile' => $request->contact_mobile, 'city' => $request->contact_city, 'alt_mobile' => $request->contact_alt_mobile, 'email' => $request->email,'address' => $request->contact_address, 'state' => $request->contact_state, 'pincode' => $request->contact_pincode,'country_id' => $request->contact_country,'district' => $request->contact_district]);
  
          }else{

            $addContact = UserContact::create([
              'mobile' => $request->contact_mobile,
              'alt_mobile' => $request->contact_alt_mobile,
              'email' => $request->email,
              'address' => $request->contact_address,
              'state' => $request->contact_state,
              'city' => $request->contact_city,
              'district' => $request->contact_district,
              'pincode' => $request->contact_pincode,
              'country_id' => $request->contact_country,
              'created_at' => now(),
              'updated_at' => now(),
              'user_id' => $userId,
            ]);
          }

          $checkLocation = UserLocation::where('user_id', $userId)->count();
          if($checkLocation > 0){
            $updateLocation = UserLocation::where('user_id', $userId)
                      ->update(['living_place' => $request->location_living_place,'city' => $request->location_city,'state_id' => $request->location_state,'district_id' => $request->location_district,'country_id' => $request->location_country]);
  
          }else{

            $addLocation = UserLocation::create([
              'living_place' => $request->location_living_place,
              'city' => $request->location_city,
              'state_id' => $request->location_state,
              'district_id' => $request->location_district,
              'country_id' => $request->location_country,
              'created_at' => now(),
              'updated_at' => now(),
              'user_id' => $userId,
            ]);
          }

          $checkusercareer = UserCareer::where('user_id', $userId)->count();
          if($checkusercareer > 0){
            $getusercareer = UserCareer::where('user_id', $userId)
                        ->update(['profession' => $request->career_profession, 'annual_income_id' => $request->career_annual_income, 'qualification_id' => $request->career_highest_qualification, 'education_fields' => $request->career_education_fields, 'university_name' => $request->career_university,'job_id' => $request->career_eligility_test]);

          }else{
            
            $getusercareer = UserCareer::create([
              'profession' => $request->career_profession,
              'annual_income_id' => $request->career_annual_income,
              'qualification_id' => $request->career_highest_qualification,
              'education_fields' => $request->career_education_fields,
              'university_name' => $request->career_university,
              'job_id' => $request->career_eligility_test,
              'created_at' => now(),
              'updated_at' => now(),
              'user_id' => $userId,
            ]);
          }


          $checkuserfamily = UserFamily::where('user_id', $userId)->count();
          if($checkuserfamily > 0){
            $getuserfamily = UserFamily::where('user_id', $userId)
                      ->update(['family_type' => $request->family_family_type, 'mother_tounge' => $request->family_mother_tounge, 'father_occupation' => $request->family_father_occupation, 'mother_occupation' => $request->family_mother_occupation, 'family_income' => $request->family_family_income, 'no_brothers' => $request->family_no_brothers, 'married_brothers' => $request->family_married_brothers, 'no_sisters' => $request->family_no_sisters, 'married_sisters' => $request->family_married_sisters, 'family_based_out' => $request->family_family_based]);
  
          }else{
            
            $getuserfamily = UserFamily::create([
              'family_type' => $request->family_family_type,
              'mother_tounge' => $request->family_mother_tounge,
              'father_occupation' => $request->family_father_occupation,
              'mother_occupation' => $request->family_mother_occupation,
              'family_income' => $request->family_family_income,
              'no_brothers' => $request->family_no_brothers,
              'married_brothers' => $request->family_married_brothers,
              'no_sisters' => $request->family_no_sisters,
              'married_sisters' => $request->family_married_sisters,
              'family_based_out' => $request->family_family_based,
              'created_at' => now(),
              'updated_at' => now(),
              'user_id' => $userId,
            ]);
          }
      if($request->image_type_id == 1){
            $getImage = $request->image;
            if($getImage){
              $imageName = time().'.'.$getImage->extension();
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
            }
      }else if($request->image_type_id == 2){

            $getImage = $request->image;
            if($getImage){
              $imageName = time().'.'.$getImage->extension();
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
            }
          }
          
          if($request->is_sms){
            $url="https://shorturl.at/1vLcE";
          \App\Services\Sms::sendWelcomeSms($request->mobile, $url);
          }
 //data save
          return redirect()->back()->with('message','Updated sucessfully.');
          
        }

  

        public function importUser(Request $request)
        {

         
          if($request->hasFile('upload')) {
            $file = $request->file('upload');
            
            if($file->isValid()) {
              $destinationPath = public_path('uploads');
              $extension = $file->getClientOriginalExtension();
              $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
              $fileName = $originalName . '-' . uniqid() . '.' . $extension;
              $file->move($destinationPath, $fileName);

              $handle = fopen($destinationPath."/".$fileName, "r");
              $c = 0;
              while(($filesop = fgetcsv($handle, 10000, ",")) !== false) {
               
                if($c>0){
                  $data = $filesop;
                  $user = ImportUser::create([
                    'first_name' => $data[0],
                    'middle_name' => $data[1],
                    'last_name' => $data[2],
                    'email' => $data[3],
                    'mobile' => $data[4],
                    'dob' => $data[5], 
                    'gender' => $data[6], 
                    'created_by' => $data[7], 
                    'refer_by' => $data[8], 
                    'height' => $data[9], 
                    'qualification' => $data[10], 
                    'alt_number' => $data[11], 
                    'address' => $data[12], 
                    'state' => $data[13], 
                    'country' => $data[14],
                    'pincode' => $data[15], 
                    'height_from' => $data[16], 
                    'height_to' => $data[17], 
                    'age_from' => $data[18], 
                    'age_to' => $data[19],
                    'annual_income' => $data[20],
                    'diet_type' => $data[21], 
                    'work_type' => $data[22],
                    'caste' => $data[23],
                    'gotra' => $data[24],
                    'marital_status' => $data[25],
                    'quality' => $data[26]
                  ]);
                  
                  
              }
              $c++;
              //  return redirect()->back()->with('message','File uploaded.');
              };
              return redirect('/getTempUser')->with('message','File uploaded Successfully.');
            }else{
              return redirect()->back()->with('message','File check');
            }
            
          }else{
            return redirect()->back()->with('message','please select csv file for upload.');
          }
          
        }

      public function getTempUser(Request $request)
      {
        $result = ImportUser::query();
        $user = $result->get();
        $destinationPath = public_path('uploads');
         return view('user.getTempUser', ['user' => $user,'destinationPath' => $destinationPath]);
      }

      public function editTempUser($id)
      {
        $user = ImportUser::where('id', $id)->first();
         return view('user.editTempUser', ['user' => $user]);
      }

      public function saveTempEdit(Request $request)
        {
          // dd($request);
          $id = $request->id;
          $user1 = ImportUser::where('id', $id)
          ->update(['first_name' => $request->firstname,
            'middle_name' => $request->middlename,
            'last_name' => $request->lastname,
            'dob' => $request->dob,
            'email' => $request->email,
            'mobile' =>$request->mobile,
            'gender' => $request->gender,
            'work_type' => $request->work_type,
            'created_by' => $request->created_by, 
            'refer_by' => $request->refer_by, 
            'height' => $request->height.'"', 
            'qualification' => $request->qualification, 
            'alt_number' => $request->alt_number, 
            'address' => $request->address, 
            'state' => $request->state, 
            'country' => $request->country,
            'pincode' => $request->pincode, 
            'height_from' => $request->height_from.'"', 
            'height_to' => $request->height_to.'"', 
            'age_from' => $request->age_from, 
            'age_to' => $request->age_to,
            'annual_income' => $request->annual_income,
            'diet_type' => $request->diet_type, 
            'caste' => $request->caste,
            'gotra' => $request->gotra,
            'marital_status' => $request->marital_status,
            'quality' => $request->quality,
            'is_sms' => $request->is_sms
          ]);
          
          return redirect()->back()->with('message','Updated sucessfully.');
          
        }

        public function saveTempMoveToMain(Request $request)
        {
          // dd($request);
          
          $id = $request->id;
          $request = ImportUser::where('id', $id)->first();
          if(!$request){
            return redirect()->back()->with('message','User Not Found.');  
          }
          $user1 = ImportUser::where('id', $id)
          ->update(['first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'email' => $request->email,
            'mobile' =>$request->mobile,
            'gender' => $request->gender,
            'work_type' => $request->work_type,
            'created_by' => $request->created_by, 
            'refer_by' => $request->refer_by, 
            'height' => $request->height, 
            'qualification' => $request->qualification, 
            'alt_number' => $request->alt_number, 
            'address' => $request->address, 
            'state' => $request->state, 
            'country' => $request->country,
            'pincode' => $request->pincode, 
            'height_from' => $request->height_from, 
            'height_to' => $request->height_to, 
            'age_from' => $request->age_from, 
            'age_to' => $request->age_to,
            'annual_income' => $request->annual_income,
            'diet_type' => $request->diet_type, 
            'caste' => $request->caste,
            'gotra' => $request->gotra,
            'marital_status' => $request->marital_status,
            'quality' => $request->quality,
            'is_sms' => $request->is_sms
          ]);
          $namedata = $request->first_name.' '.$request->last_name;

          $user = User::create([
                    'name' => $namedata,
                    'email' => $request->email,
                    'mobile' =>$request->mobile,
                    'password' => bcrypt(123456),
                    'profile_code' => $request->first_name.'_'.substr($request->mobile, 0, 5),
                    'profile_complete' => '20',
                    'refer_code' => substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 12),
                    'step_complete' => '1'
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
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'dob' => $request->dob,
                    'gender' => $request->gender,
                    'created_by' =>$request->created_by,
                    'refer_by' =>$request->refer_by,
                    'role_id' => 3,
                    'group_id' => 1
                  ]);
                
                  $birthday = new DateTime($request->dob);
                  $interval = $birthday->diff(new DateTime);
                  $agedata = $interval->y;
                  $getAgeId = Age::where('name', $agedata)->first();

                  if($request->height_from != ""){
                      $heightfrom = Height::where('height', 'like', "%$request->height_from%")->first();
                      if(isset($heightfrom)){
                        $height_from = $heightfrom->id;
                      }else {
                        $height_from = '';
                      }
                      
                    }else {
                      $height_from = '';
                    }
                    if($request->height_to != ""){
                      $heightto = Height::where('height', 'like', "%$request->height_to%")->first();
                      if(isset($heightto)){
                        $height_to = $heightto->id;
                      }else {
                        $height_to = '';
                      }
                      
                    }else {
                      $height_to = '';
                    }
                    if($request->age_from != ""){
                      $agefrom = Age::where('name', 'like', "%$request->age_from%")->first();
                      if(isset($heightto)){
                        $age_from = $agefrom->id;
                      }else {
                        $age_from = '';
                      }
                      
                    }else {
                      $age_from = '';
                    }
                    if($request->age_to != ""){
                      $ageto = Age::where('name', 'like', "%$request->age_to%")->first();
                      if(isset($ageto)){
                        $age_to = $ageto->id;
                      }else {
                        $age_to = '';
                      }
                      
                    }else {
                      $age_to = '';
                    }
                    if($request->annual_income != ""){
                      $annualincome = AnnualIncome::where('incomes', 'like', "%$request->annual_income%")->first();
                      if(isset($annualincome)){
                        $annual_income = $annualincome->id;
                      }else {
                        $annual_income = '';
                      }
                      
                    }else {
                      $annual_income = '';
                    }
                    if($request->diet_type != ""){
                      $diettype = DietType::where('diet', 'like', "%$request->diet_type%")->first();
                      if(isset($diettype)){
                        $diet_type = $diettype->id;
                      }else {
                        $diet_type = '';
                      }
                      
                    }else {
                      $diet_type = '';
                    }
                    if($request->work_type != ""){
                      $worktype = WorkType::where('name', 'like', "%$request->work_type%")->first();
                      if(isset($worktype)){
                        $work_type = $worktype->id;
                      }else {
                        $work_type = 1;
                      }
                      
                    }else {
                      $work_type = 1;
                    }
                    if($request->caste != ""){
                      $caste = Caste::where('name', 'like', "%$request->caste%")->first();
                      if(isset($caste)){
                        $caste = $caste->id;
                      }else {
                        $caste = 1;
                      }
                      
                    }else {
                      $caste = 1;
                    }
                    if($request->gotra != ""){
                      $gotra = Gotra::where('name', 'like', "%$request->gotra%")->first();
                      if(isset($gotra)){
                        $gotra = $gotra->id;
                      }else {
                        $gotra = 1;
                      }
                      
                    }else {
                      $gotra = 1;
                    }
                    if($request->marital_status != ""){
                      $maritalstatus = MaritalStatus::where('name', 'like', "%$request->marital_status%")->first();
                      if(isset($maritalstatus)){
                        $marital_status = $maritalstatus->id;
                      }else {
                        $marital_status = '';
                      }
                      
                    }else {
                      $marital_status = '';
                    }
                    if($request->quality != ""){
                      $Quality = Quality::where('name', 'like', "%$request->quality%")->first();
                      if(isset($Quality)){
                        $quality = $Quality->id;
                      }else {
                        $quality = 1;
                      }
                      
                    }else {
                      $quality = 1;
                    }

                    if($request->state != ""){
                      $stateData = State::where('name', 'like', "%$request->state%")->first();
                      if(isset($stateData)){
                        $state = $stateData->id;
                      }else {
                        $state = 1;
                      }
                      
                    }else {
                      $state = 1;
                    }

                    if($request->country != ""){
                      $Country = Country::where('name', 'like', "%$request->country%")->first();
                      if(isset($Country)){
                        $country = $Country->id;
                      }else {
                        $country = 1;
                      }
                      
                    }else {
                      $country = 1;
                    }
  
                  
                  $getusersearch = UserSearching::create([
                      'height_from' => $height_from,
                      'height_to' => $height_to,
                      'age_from' => $age_from,
                      'age_to' => $age_to,
                      'annual_income_id' => $annual_income,
                      'diet_type_id' => $diet_type,
                      'marital_status' => $marital_status,
                      'caste_id' => $caste,
                      'gotra_id' => $gotra,
                      'quality_id' => $quality,
                      'created_at' => now(),
                      'updated_at' => now(),
                      'user_id' => $user->id,
                    ]);
            
                    $user1 = UserBasicDetail::create([
                      'user_id' => $user->id,
                      'dob' => $request->dob,
                      'age_id' => $getAgeId->id,
                      'about_me_long' => 'I always look for natural ingredients or. grow the ingredients by self',
                      'about_me_short' => "I'm ".$request->first_name.", I am Obsessed with healthy foods. For me, all the ingredients should be as less processed as possible."
                    ]);

                    $user3 = UserContact::create([
                      'user_id' => $user->id,
                      'address' => $request->address,
                      'email' => $request->email,
                      'mobile' => $request->mobile,
                      'city' => "",
                      'district' => "",
                      'state' => $state,
                      'country_id' => $country,
                      'pincode' => $request->pincode
                    ]);

                    $getuserlocation = UserLocation::create([
                      'living_place' => $request->address,
                      'city' => "",
                      'state_id' => $state,
                      'country_id' => $country,
                      'district_id' => "",
                      'lat' => "",
                      'long' => "",
                      'created_at' => now(),
                      'updated_at' => now(),
                      'user_id' => $user->id,
                    ]);

                    if($request->gender == "Female"){
                      $imagepath = "https://mangalkaryam.s3.ap-south-1.amazonaws.com/userProfile/profile/Zj7AzElFBnTNpToul1EVdRaizARFlAcWWpxO5A6X.jpg";
                    }else{
                      $imagepath = "https://mangalkaryam.s3.ap-south-1.amazonaws.com/userProfile/profile/s7fKttPbIEuifgrk1xnZBob3ukpk2LBWJBlBJWXx.jpg";
                    }

                    $fileadd = File::create([
                      'user_id' => $user->id,
                      'file_type_id' => 1,
                      'file_name' => "default image",
                      'file_path' => $imagepath,
                      'file_origin' => "default image",
                      'status' => 1
                    ]);
            
                    $noti = Notification::create([
                      'user_id' => $user->id,
                      'content' => "Welcome to Mangal Karyam",
                      'created_by' => $user->id,
                      'status' => 0
                    ]);

                    if($request->is_sms){
                      $url="https://shorturl.at/1vLcE";
                    \App\Services\Sms::sendWelcomeSms($request->mobile, $url);
                    }
                    
            
            ImportUser::where('id', $id)->delete();
          
          return redirect("/getTempUser")->with('message','User Move To Main User sucessfully.');        
        }

        public function searchTempUser(Request $request)
        {
          $result = ImportUser::query();
  
          //print_r($request);
          // dd($request);
          $destinationPath = public_path('uploads');
  
          if (!empty($request->first_name)) {
              $result = $result->where('name', 'like', '%'.$request->first_name.'%');
              //dd($request);
          }
  
          if (!empty($request->email)) {
              $result = $result->where('email', $request->email);
          }
  
          if (!empty($request->mobile)) {
              $result = $result->where('mobile', $request->mobile);
          }
  
          if (!empty($request->status)) {
              //$result = $result->where('role_id', 'like', '%'.$request->role.'%');
  
          }
  
          $user = $result->get();
           return view('user.getTempUser', ['user' => $user,'destinationPath' => $destinationPath]);
        }


        

}