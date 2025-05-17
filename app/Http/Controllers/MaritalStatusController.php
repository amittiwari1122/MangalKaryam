<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\MaritalStatus;
use Mail;
use Illuminate\Support\Str;

class MaritalStatusController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $maritalstatus = MaritalStatus::get();
         return view('marital_status.index', ['maritalstatus' => $maritalstatus]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('marital_status.add',['status' => $status]);
       }

      public function saveMaritalStatus(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('marital_statuses')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'status' => $request->status,
              'order' => $require->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getMaritalStatus')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showMaritalStatus($id) {
         $maritalstatus = MaritalStatus::where('id', $id)->first();
         $status = Status::get();
         return view('marital_status.show',['status' => $status, 'maritalstatus' => $maritalstatus]);
       }

       public function updateMaritalStatus($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $maritalstatus = MaritalStatus::where('id', $id)->first();
       $status = Status::get();
       return view('marital_status.edit',['status' => $status, 'maritalstatus' => $maritalstatus]);
       }

       public function saveUpdateMaritalStatus(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $diettype = MaritalStatus::find($id);
            $diettype->name = $request->name;
            $diettype->description = $request->description;
            $diettype->status = $request->status;
            $diettype->order = $request->order;
            $diettype->update();
            return redirect('/getMaritalStatus')->with('message','Height Updated Successfully');
        }
}
