<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Religion;
use Mail;
use Illuminate\Support\Str;

class ReligionController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $religion = Religion::get();
         return view('religion.index', ['religion' => $religion]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('religion.add',['status' => $status]);
       }

      public function saveReligion(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('religions')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getReligion')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showReligion($id) {
         $religion = Religion::where('id', $id)->first();
         $status = Status::get();
         return view('religion.show',['status' => $status, 'religion' => $religion]);
       }

       public function updateReligion($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $religion = Religion::where('id', $id)->first();
       $status = Status::get();
       return view('religion.edit',['status' => $status, 'religion' => $religion]);
       }

       public function saveUpdateReligion(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $diettype = Religion::find($id);
            $diettype->name = $request->name;
            $diettype->description = $request->description;
            $diettype->status = $request->status;
            $diettype->update();
            return redirect('/getReligion')->with('message','Religion Updated Successfully');
        }
}
