<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Job;
use Mail;
use Illuminate\Support\Str;

class JobController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $job = Job::get();
         return view('job.index', ['job' => $job]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('job.add',['status' => $status]);
       }

      public function saveJob(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('jobs')->insert([
              'name' => $request->name,
              'status' => $request->status,
              'order' => $request->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getJob')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showJob($id) {
         $job = Job::where('id', $id)->first();
         $status = Status::get();
         return view('job.show',['status' => $status, 'job' => $job]);
       }

       public function updateJob($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $job = Job::where('id', $id)->first();
       $status = Status::get();
       return view('job.edit',['status' => $status, 'job' => $job]);
       }

       public function saveUpdateJob(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = Job::find($id);
            $annualincome->name = $request->name;
            $annualincome->status = $request->status;
            $annualincome->order = $request->order;
            $annualincome->update();
            return redirect('/getJob')->with('message','Job Updated Successfully');
        }
}
