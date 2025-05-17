<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Caste;
use Mail;
use Illuminate\Support\Str;

class CasteController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $castedetails = Caste::get();
         return view('caste.index', ['castedetails' => $castedetails]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('caste.add',['status' => $status]);
       }

      public function saveCaste(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('castes')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'order' => $request->order,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getCaste')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showCaste($id) {
         $caste = Caste::where('id', $id)->first();
         $status = Status::get();
         return view('caste.show',['status' => $status, 'caste' => $caste]);
       }

       public function updateCaste($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $caste = Caste::where('id', $id)->first();
       $status = Status::get();
       return view('caste.edit',['status' => $status, 'caste' => $caste]);
       }

       public function saveUpdateCaste(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $caste = Caste::find($id);
            $caste->name = $request->name;
            $caste->description = $request->description;
            $caste->status = $request->status;
            $caste->update();
            return redirect('/getCaste')->with('message','Caste Updated Successfully');
        }


}
