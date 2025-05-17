<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\AllergicType;
use Mail;
use Illuminate\Support\Str;

class AllergicTypeController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $allergicType = AllergicType::get();
         return view('allergic_type.index', ['allergicType' => $allergicType]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('allergic_type.add',['status' => $status]);
       }

      public function saveAllergicType(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('allergic_types')->insert([
              'name' => $request->name,
              'status' => $request->status,
              'order' => $request->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getAllergicType')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showAllergicType($id) {
         $allergictype = AllergicType::where('id', $id)->first();
         $status = Status::get();
         return view('allergic_type.show',['status' => $status, 'allergictype' => $allergictype]);
       }

       public function updateAllergicType($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $allergicType = AllergicType::where('id', $id)->first();
       $status = Status::get();
       return view('allergic_type.edit',['status' => $status, 'allergictype' => $allergicType]);
       }

       public function saveUpdateAllergicType(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = AllergicType::find($id);
            $annualincome->name = $request->name;
            $annualincome->status = $request->status;
            $annualincome->order = $request->order;
            $annualincome->update();
            return redirect('/getAllergicType')->with('message','Allergic Type Updated Successfully');
        }
}
