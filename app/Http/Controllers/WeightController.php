<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Weight;
use Mail;
use Illuminate\Support\Str;

class WeightController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $weight = Weight::get();
         return view('weight.index', ['weight' => $weight]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('weight.add',['status' => $status]);
       }

      public function saveWeight(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('weights')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getWeight')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showWeight($id) {
         $weight = Weight::where('id', $id)->first();
         $status = Status::get();
         return view('weight.show',['status' => $status, 'weight' => $weight]);
       }

       public function updateWeight($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $weight = Weight::where('id', $id)->first();
       $status = Status::get();
       return view('weight.edit',['status' => $status, 'weight' => $weight]);
       }

       public function saveUpdateWeight(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $diettype = Weight::find($id);
            $diettype->name = $request->name;
            $diettype->description = $request->description;
            $diettype->status = $request->status;
            $diettype->update();
            return redirect('/getWeight')->with('message','Weight Updated Successfully');
        }
}
