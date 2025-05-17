<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Banner;
use App\Models\File;
use Mail;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as Image;

class LandingBannerController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $banner = Banner::get();
         return view('landing_banner.index', ['banner' => $banner]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('landing_banner.add',['status' => $status]);
       }

      public function savebanner(Request $request)
      {
          $request->validate([
              'title' => 'required',
              'image' => 'required',
          ]);

          $image = new Image;
          $getImage = $request->image;
          $imageName = time().'.'.$getImage->extension();
          $imagePath = public_path(). '/images/banner';
  
          $image->path = $imagePath;
          $image->image = $imageName;
  
          $ddd = $getImage->move($imagePath, $imageName);
  
        //   $getsize = getimagesize($getImage);
        //   $width = $getsize[0];
        //   $height = $getsize[1];
  
          $imagepath = 'http://65.1.238.125:8080/public/images/banner/'.$imageName;

          $fileadd = File::create([
            'user_id' => 1,
            'file_type_id' => 101,
            'file_name' => $imageName,
            'file_path' => $imagepath,
            'file_origin' => $request->image,
            'status' => 1
            ]);

          DB::table('banners')->insert([
              'title' => $request->title,
              'filename' => $imageName,
              'file_path' => $imagepath,
              'user_type' => $request->user_type,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getLandingBanner')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showBanner($id) {
         $banner = Banner::where('id', $id)->first();
         $status = Status::get();
         return view('landing_banner.show',['status' => $status, 'banner' => $banner]);
       }

       public function updateBanner($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $banner = Banner::where('id', $id)->first();
       $status = Status::get();
       return view('landing_banner.edit',['status' => $status, 'banner' => $banner]);
       }

       public function saveUpdateBanner(Request $request, $id)
        {
            $request->validate([
                'title' => 'required',
            ]);


            $annualincome = Banner::find($id);
            if($request->image != ''){
              $image = new Image;
              $getImage = $request->image;
              $imageName = time().'.'.$getImage->extension();
              $imagePath = public_path(). '/images/banner';
      
              $image->path = $imagePath;
              $image->image = $imageName;
              $ddd = $getImage->move($imagePath, $imageName);
              $imagepath = 'http://65.1.238.125:8080/public/images/banner/'.$imageName;
    
              $fileadd = File::create([
                'user_id' => 1,
                'file_type_id' => 101,
                'file_name' => $imageName,
                'file_path' => $imagepath,
                'file_origin' => $request->image,
                'status' => 1
                ]);
                $annualincome->title = $request->title;
                $annualincome->filename = $imageName;
                $annualincome->file_path = $imagepath;
                $annualincome->user_type = $request->user_type;
            }else{
              $annualincome->title = $request->title;
              $annualincome->user_type = $request->user_type;
            }
            $annualincome->update();
            return redirect('/getLandingBanner')->with('message','Banner Updated Successfully');
        }
}
