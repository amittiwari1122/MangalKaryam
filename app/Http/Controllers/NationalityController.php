<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Nationality;
use Mail;
use Illuminate\Support\Str;

class NationalityController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $nationality = Nationality::get();
         return view('nationality.index', ['nationality' => $nationality]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('nationality.add',['status' => $status]);
       }

      public function saveNationality(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('nationalities')->insert([
              'name' => $request->name,
              'status' => $request->status,
              'order' => $request->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getNationality')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showNationality($id) {
         $nationality  = Nationality::where('id', $id)->first();
         $status = Status::get();
         return view('nationality.show',['status' => $status, 'nationality' => $nationality]);
       }

       public function updateNationality($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $nationality = Nationality::where('id', $id)->first();
       $status = Status::get();
       return view('nationality.edit',['status' => $status, 'nationality' => $nationality]);
       }

       public function saveUpdateNationality(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = Nationality::find($id);
            $annualincome->name = $request->name;
            $annualincome->status = $request->status;
            $annualincome->order = $request->order;
            $annualincome->update();
            return redirect('/getNationality')->with('message','Nationality Updated Successfully');
        }
}
