<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\FileType;
use App\Models\File;
use Mail;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as Image;

class FileController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $file = File::where("file_type_id", '100')->get();
         return view('file.index', ['file' => $file]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('file.add',['status' => $status]);
       }

      public function saveFile(Request $request)
      {

        $image = new Image;
        $getImage = $request->image;
        // dd($getImage);
        $imageName = time().'.'.$getImage->extension();
        $imagePath = public_path(). '/images/banner';

        $image->path = $imagePath;
        $image->image = $imageName;

        $ddd = $getImage->move($imagePath, $imageName);

        $getsize = getimagesize($ddd);
        $width = $getsize[0];
        $height = $getsize[1];
        // dd($width);

        if($width < 1500 && $height < 1000){

        $imagepath = 'http://65.1.238.125:8080/public/images/banner/'.$imageName;

        // $upatefile = File::where('user_id', $userId)->where('file_type_id', 2)->update(['status' => 0]);


        $fileadd = File::create([
        'user_id' => 1,
        'file_type_id' => 100,
        'file_name' => $imageName,
        'file_path' => $imagepath,
        'file_origin' => $request->image,
        'status' => 1
        ]);
          return redirect('/getFile')->with('message', 'We have uploaded image');
      }else{
        return redirect('/addFile')->with('message', 'image size must be or less than 1300 X 1000');
      }
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showFile($id) {
         $file = File::where('id', $id)->first();
         $status = Status::get();
         return view('file.show',['status' => $status, 'file' => $file]);
       }

       public function updateFile($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $file = File::where('id', $id)->first();
       $status = Status::get();
       return view('file.edit',['status' => $status, 'file' => $file]);
       }



       public function saveUpdateFile(Request $request, $id)
        {

          if($request->image != ''){
            $file = File::where('id', $id)->delete();
              $image = new Image;
              $getImage = $request->image;
              // dd($getImage);
              $imageName = time().'.'.$getImage->extension();
              $imagePath = public_path(). '/images/banner';

              $image->path = $imagePath;
              $image->image = $imageName;

              $ddd = $getImage->move($imagePath, $imageName);

              $getsize = getimagesize($ddd);
              $width = $getsize[0];
              $height = $getsize[1];
              // dd($width);

              if($width < 1500 && $height < 1000){

              $imagepath = 'http://65.1.238.125:8080/public/images/banner/'.$imageName;

              // $upatefile = File::where('user_id', $userId)->where('file_type_id', 2)->update(['status' => 0]);


              $fileadd = File::create([
              'user_id' => 1,
              'file_type_id' => 100,
              'file_name' => $imageName,
              'file_path' => $imagepath,
              'file_origin' => $request->image,
              'status' => 1
              ]);
                return redirect('/getFile')->with('message', 'We have uploaded image');
            }else{
              return redirect('/addFile')->with('message', 'image size must be or less than 1300 X 1000');
            }
          }else{
            $file = File::where('id', $id)->update(['status' => $request->status]);
            return redirect('/getFile')->with('message', 'We have uploaded image');
          }
          
      }


  }
