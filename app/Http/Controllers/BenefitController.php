<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Benefit;
use Mail;
use Illuminate\Support\Str;

class BenefitController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $benefit = Benefit::get();
         return view('benefit.index', ['benefit' => $benefit]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('benefit.add',['status' => $status]);
       }

      public function saveBenefit(Request $request)
      {
          $request->validate([
              'question' => 'required',
              'status' => 'required',
          ]);
          DB::table('benefits')->insert([
              'question' => $request->question,
              'answer' => $request->answer,
              'type' => $request->type,
              'section' => $request->section,
              'status' => $request->status,
              'order' => $request->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getBenefit')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showBenefit($id) {
         $benefit = Benefit::where('id', $id)->first();
         $status = Status::get();
         return view('benefit.show',['status' => $status, 'benefit' => $benefit]);
       }

       public function updateBenefit($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $benefit = Benefit::where('id', $id)->first();
       $status = Status::get();
       return view('benefit.edit',['status' => $status, 'benefit' => $benefit]);
       }

       public function saveUpdateBenefit(Request $request, $id)
        {
          $request->validate([
              'question' => 'required',
              'status' => 'required',
          ]);

            $annualincome = Benefit::find($id);
            $annualincome->question = $request->question;
            $annualincome->answer = $request->answer;
            $annualincome->type = $request->type;
            $annualincome->section = $request->section;
            $annualincome->status = $request->status;
            $annualincome->order = $request->order;
            $annualincome->update();
            return redirect('/getBenefit')->with('message','Benefit Updated Successfully');
        }
}
