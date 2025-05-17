<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\State;
use App\Models\Status;
use App\Models\CommonQuestion;
use Mail;
use Illuminate\Support\Str;

class CommonQuestionController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $commonQdetails = CommonQuestion::get();

         return view('common_question.index', ['commonQdetails' => $commonQdetails]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
         $State = State::get();
           return view('common_question.add',['status' => $status, 'state' => $State]);
       }

      public function saveCommonQuestion(Request $request)
      {
        $request->validate([
            'question' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);
          DB::table('common_question')->insert([
              'question' => $request->question,
              'answer' => $request->answer,
              'type' => $request->type,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getCommonQuestion')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showCommonQuestion($id) {
        $city = CommonQuestion::where('id', $id)->first();
        $status = Status::get();
        $state = State::get();
        return view('common_question.show',['status' => $status, 'commonQ' => $city, 'state' => $state]);
      }

      public function updateCommonQuestion($id) {

      // $user = User::where('email', $request->id)
      //             ->update(['password' => Hash::make($request->password)]);
      $city = CommonQuestion::where('id', $id)->first();
      $status = Status::get();
      $state = State::get();
      return view('common_question.edit',['status' => $status, 'commonQ' => $city, 'state' => $state]);
      }

      public function saveUpdateCommonQuestion(Request $request, $id)
       {
         $request->validate([
             'question' => 'required',
             'type' => 'required',
             'status' => 'required',
         ]);

           $state = CommonQuestion::find($id);
           $state->question = $request->question;
           $state->type = $request->type;
           $state->answer = $request->answer;
           $state->status = $request->status;
           $state->update();
           return redirect('/getCommonQuestion')->with('message','Common Question Updated Successfully');
       }

}
