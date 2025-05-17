<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Quality;
use Mail;
use Illuminate\Support\Str;

class QualityController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $quality = Quality::get();
         return view('quality.index', ['quality' => $quality]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('quality.add',['status' => $status]);
       }

      public function saveQuality(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('qualities')->insert([
              'name' => $request->name,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getQuality')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showQuality($id) {
         $quality = Quality::where('id', $id)->first();
         $status = Status::get();
         return view('quality.show',['status' => $status, 'quality' => $quality]);
       }

       public function updateQuality($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $quality = Quality::where('id', $id)->first();
       $status = Status::get();
       return view('quality.edit',['status' => $status, 'quality' => $quality]);
       }

       public function saveUpdateQuality(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = Quality::find($id);
            $annualincome->name = $request->name;
            $annualincome->status = $request->status;
            $annualincome->update();
            return redirect('/getQuality')->with('message','Quality Updated Successfully');
        }
}
