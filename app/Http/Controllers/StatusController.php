<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use Mail;
use Illuminate\Support\Str;

class StatusController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $status = Status::get();
         return view('status.index', ['status' => $status]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('status.add',['status' => $status]);
       }

      public function saveStatus(Request $request)
      {
          $request->validate([
              'name' => 'required',
          ]);
          DB::table('status')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getStatus')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showStatus($id) {
         $status = Status::where('id', $id)->first();
         return view('status.show',['status' => $status]);
       }

       public function updateStatus($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $status = Status::where('id', $id)->first();
       return view('status.edit',['status' => $status]);
       }

       public function saveUpdateStatus(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
          ]);

            $diettype = Status::find($id);
            $diettype->name = $request->name;
            $diettype->description = $request->description;
            $diettype->update();
            return redirect('/getStatus')->with('message','Status Updated Successfully');
        }
}
