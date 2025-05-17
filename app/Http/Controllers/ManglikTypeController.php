<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\ManglikType;
use Mail;
use Illuminate\Support\Str;

class ManglikTypeController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $manglikType = ManglikType::get();
         return view('manglik_type.index', ['manglikType' => $manglikType]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('manglik_type.add',['status' => $status]);
       }

      public function saveManglikType(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('manglik_types')->insert([
              'name' => $request->name,
              'status' => $request->status,
              'order' => $request->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getManglikType')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showManglikType($id) {
         $manglikType = ManglikType::where('id', $id)->first();
         $status = Status::get();
         return view('manglik_type.show',['status' => $status, 'manglikType' => $manglikType]);
       }

       public function updateManglikType($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $manglikType = ManglikType::where('id', $id)->first();
       $status = Status::get();
       return view('manglik_type.edit',['status' => $status, 'manglikType' => $manglikType]);
       }

       public function saveUpdateManglikType(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = ManglikType::find($id);
            $annualincome->name = $request->name;
            $annualincome->status = $request->status;
            $annualincome->order = $request->order;
            $annualincome->update();
            return redirect('/getManglikType')->with('message','Manglam Type Updated Successfully');
        }
}
