<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\SecurityQuestion;
use App\Models\PageWise;
use Mail;
use Illuminate\Support\Str;

class SecurityController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $diettype = SecurityQuestion::get();
         return view('security.index', ['securitydetails' => $diettype]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('security.add',['status' => $status]);
       }

      public function saveSecurityQuestion(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('security_questions')->insert([
              'question' => $request->name,
              'description' => $request->description,
              'type' => $request->type,
              'order' => $request->order,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getSecurity')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showSecurityQuestion($id) {
         $dyncontent = SecurityQuestion::where('id', $id)->first();
         $status = Status::get();
         return view('security.show',['status' => $status, 'security' => $dyncontent]);
       }

       public function updateSecurityQuestion($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $dyncontent = SecurityQuestion::where('id', $id)->first();
       $status = Status::get();
       return view('security.edit',['status' => $status, 'security' => $dyncontent]);
       }

       public function saveUpdateSecurityQuestion(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $dyncontent = SecurityQuestion::find($id);
            $dyncontent->question = $request->name;
            $dyncontent->description = $request->description;
            $dyncontent->status = $request->status;
            $dyncontent->type = $request->type;
            $dyncontent->order = $request->order;
            $dyncontent->update();
            return redirect('/getSecurity')->with('message','SecurityQuestion Updated Successfully');
        }
}
