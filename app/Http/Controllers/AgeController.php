<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Age;
use Mail;
use Illuminate\Support\Str;

class AgeController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $agedetails = Age::get();
         return view('age.index', ['agedetails' => $agedetails]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('age.add',['status' => $status]);
       }

      public function saveAge(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('ages')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'status' => $request->status,
              'order' => $request->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getAge')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showAge($id) {
         $age = Age::where('id', $id)->first();
         $status = Status::get();
         return view('age.show',['status' => $status, 'age' => $age]);
       }

       public function updateAge($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $age = Age::where('id', $id)->first();
       $status = Status::get();
       return view('age.edit',['status' => $status, 'age' => $age]);
       }

       public function saveUpdateAge(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $age = Age::find($id);
            $age->name = $request->name;
            $age->description = $request->description;
            $age->status = $request->status;
            $age->order = $request->order;
            $age->update();
            return redirect('/getAge')->with('message','Age Updated Successfully');
        }
}
