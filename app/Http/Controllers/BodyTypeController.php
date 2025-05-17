<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\BodyType;
use Mail;
use Illuminate\Support\Str;

class BodyTypeController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $bodyType = BodyType::get();
         return view('body_type.index', ['bodyType' => $bodyType]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('body_type.add',['status' => $status]);
       }

      public function saveBodyType(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('body_types')->insert([
              'name' => $request->name,
              'status' => $request->status,
              'order' => $request->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getBodyType')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showBodyType($id) {
         $bodyType = BodyType::where('id', $id)->first();
         $status = Status::get();
         return view('body_type.show',['status' => $status, 'bodyType' => $bodyType]);
       }

       public function updateBodyType($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $bodyType = BodyType::where('id', $id)->first();
       $status = Status::get();
       return view('body_type.edit',['status' => $status, 'bodyType' => $bodyType]);
       }

       public function saveUpdateBodyType(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = BodyType::find($id);
            $annualincome->name = $request->name;
            $annualincome->status = $request->status;
            $annualincome->order = $request->order;
            $annualincome->update();
            return redirect('/getBodyType')->with('message','Body Type Updated Successfully');
        }
}
