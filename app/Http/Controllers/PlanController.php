<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Plan;
use Mail;
use Illuminate\Support\Str;

class PlanController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $job = Plan::get();
         return view('plan.index', ['plan' => $job]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('plan.add',['status' => $status]);
       }

      public function savePlan(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('plans')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'price' => $request->price,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getPlan')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showPlan($id) {
         $job = Job::where('id', $id)->first();
         $status = Status::get();
         return view('job.show',['status' => $status, 'job' => $job]);
       }

       public function updatePlan($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $job = Plan::where('id', $id)->first();
       $status = Status::get();
       return view('plan.edit',['status' => $status, 'plan' => $job]);
       }

       public function saveUpdatePlan(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = Plan::find($id);
            $annualincome->name = $request->name;
            $annualincome->description = $request->description;
            $annualincome->price = $request->price;
            $annualincome->status = $request->status;
            $annualincome->update();
            return redirect('/getPlan')->with('message','plan Updated Successfully');
        }
}
