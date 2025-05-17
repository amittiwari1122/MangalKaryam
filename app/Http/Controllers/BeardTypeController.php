<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\BeardType;
use Mail;
use Illuminate\Support\Str;

class BeardTypeController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $beardType = BeardType::get();
         return view('beard_type.index', ['beardType' => $beardType]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('beard_type.add',['status' => $status]);
       }

      public function saveBeardType(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('beard_types')->insert([
              'name' => $request->name,
              'status' => $request->status,
              'order' => $request->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getBeardType')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showBeardType($id) {
         $beardType = BeardType::where('id', $id)->first();
         $status = Status::get();
         return view('beard_type.show',['status' => $status, 'beardType' => $beardType]);
       }

       public function updateBeardType($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $beardType = BeardType::where('id', $id)->first();
       $status = Status::get();
       return view('beard_type.edit',['status' => $status, 'beardType' => $beardType]);
       }

       public function saveUpdateBeardType(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = BeardType::find($id);
            $annualincome->name = $request->name;
            $annualincome->status = $request->status;
            $annualincome->order = $request->order;
            $annualincome->update();
            return redirect('/getBeardType')->with('message','Beard Type Updated Successfully');
        }
}
