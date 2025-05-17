<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Qualification;
use Mail;
use Illuminate\Support\Str;

class QualificationController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $qualification = Qualification::get();
         return view('qualification.index', ['qualification' => $qualification]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('qualification.add',['status' => $status]);
       }

      public function saveQualification(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('qualifications')->insert([
              'qualification' => $request->name,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getQualification')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showQualification($id) {
         $qualification = Qualification::where('id', $id)->first();
         $status = Status::get();
         return view('qualification.show',['status' => $status, 'qualification' => $qualification]);
       }

       public function updateQualification($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $qualification = Qualification::where('id', $id)->first();
       $status = Status::get();
       return view('qualification.edit',['status' => $status, 'qualification' => $qualification]);
       }

       public function saveUpdateQualification(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = Qualification::find($id);
            $annualincome->qualification = $request->name;
            $annualincome->status = $request->status;
            $annualincome->update();
            return redirect('/getQualification')->with('message','Qualification Updated Successfully');
        }
}
