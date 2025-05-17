<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Education;
use Mail;
use Illuminate\Support\Str;

class EducationController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $education = Education::get();
         return view('education.index', ['education' => $education]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('education.add',['status' => $status]);
       }

      public function saveEducation(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('education')->insert([
              'name' => $request->name,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getEducation')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showEducation($id) {
         $education = Education::where('id', $id)->first();
         $status = Status::get();
         return view('education.show',['status' => $status, 'education' => $education]);
       }

       public function updateEducation($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $education = Education::where('id', $id)->first();
       $status = Status::get();
       return view('education.edit',['status' => $status, 'education' => $education]);
       }

       public function saveUpdateEducation(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = Education::find($id);
            $annualincome->name = $request->name;
            $annualincome->status = $request->status;
            $annualincome->update();
            return redirect('/getEducation')->with('message','Education Updated Successfully');
        }
}
