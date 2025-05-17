<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Height;
use Mail;
use Illuminate\Support\Str;

class HeightController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $height = Height::orderBy('order','ASC')->get();
         return view('height.index', ['height' => $height]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('height.add',['status' => $status]);
       }

      public function saveHeight(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('heights')->insert([
              'height' => $request->name,
              'description' => $request->description,
              'status' => $request->status,
              'order' => $request->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getHeight')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showHeight($id) {
         $height = Height::where('id', $id)->first();
         $status = Status::get();
         return view('height.show',['status' => $status, 'height' => $height]);
       }

       public function updateHeight($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $height = Height::where('id', $id)->first();
       $status = Status::get();
       return view('height.edit',['status' => $status, 'height' => $height]);
       }

       public function saveUpdateHeight(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $diettype = Height::find($id);
            $diettype->height = $request->name;
            $diettype->description = $request->description;
            $diettype->status = $request->status;
            $diettype->order = $request->order;
            $diettype->update();
            return redirect('/getHeight')->with('message','Height Updated Successfully');
        }
}
