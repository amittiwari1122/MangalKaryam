<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Profession;
use App\Models\Status;
use Mail;
use Illuminate\Support\Str;

class ProfessionController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function getProfession()
      {
        $professiondetails = Profession::get();
         return view('profession.index', ['professiondetails' => $professiondetails]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('profession.add',['status' => $status]);
       }

      public function saveProfession(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('professions')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'status' => 1,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getProfession')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      // public function showState() {
      //    return view('country.show');
      // }

      public function showProfession($id) {
        $profession = Profession::where('id', $id)->first();
        $status = Status::get();
        return view('profession.show',['status' => $status, 'profession' => $profession]);
      }

      public function updateProfession($id) {

      // $user = User::where('email', $request->id)
      //             ->update(['password' => Hash::make($request->password)]);
      $profession = Profession::where('id', $id)->first();
      $status = Status::get();
      return view('profession.edit',['status' => $status, 'profession' => $profession]);
      }

      public function saveUpdateProfession(Request $request, $id)
       {
         $request->validate([
             'name' => 'required',
             'status' => 'required',
         ]);

           $country = Profession::find($id);
           $country->name = $request->name;
           $country->description = $request->description;
           $country->status = $request->status;
           $country->update();
           return redirect('/getProfession')->with('message','Profession Updated Successfully');
       }
}
