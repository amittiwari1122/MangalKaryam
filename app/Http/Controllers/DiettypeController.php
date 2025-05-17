<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\DietType;
use Mail;
use Illuminate\Support\Str;

class DiettypeController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $diettype = DietType::get();
         return view('diettype.index', ['diettype' => $diettype]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('diettype.add',['status' => $status]);
       }

      public function saveDiettype(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('diet_types')->insert([
              'diet' => $request->name,
              'description' => $request->description,
              'status' => $request->status,
              'order' => $require->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getDiettype')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showDiettype($id) {
         $diettype = DietType::where('id', $id)->first();
         $status = Status::get();
         return view('diettype.show',['status' => $status, 'diettype' => $diettype]);
       }

       public function updateDiettype($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $diettype = DietType::where('id', $id)->first();
       $status = Status::get();
       return view('diettype.edit',['status' => $status, 'diettype' => $diettype]);
       }

       public function saveUpdateDiettype(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $diettype = DietType::find($id);
            $diettype->diet = $request->name;
            $diettype->description = $request->description;
            $diettype->status = $request->status;
            $diettype->order = $request->order;
            $diettype->update();
            return redirect('/getDiettype')->with('message','Diettype Updated Successfully');
        }
}
