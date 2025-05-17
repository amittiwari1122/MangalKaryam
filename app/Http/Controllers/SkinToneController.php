<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\SkinTone;
use Mail;
use Illuminate\Support\Str;

class SkinToneController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $skinTone = SkinTone::get();
         return view('skin_tone.index', ['skinTone' => $skinTone]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('skin_tone.add',['status' => $status]);
       }

      public function saveSkinTone(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('skin_tones')->insert([
              'name' => $request->name,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getSkinTone')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showSkinTone($id) {
         $skinTone = SkinTone::where('id', $id)->first();
         $status = Status::get();
         return view('skin_tone.show',['status' => $status, 'skinTone' => $skinTone]);
       }

       public function updateSkinTone($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $skinTone = SkinTone::where('id', $id)->first();
       $status = Status::get();
       return view('skin_tone.edit',['status' => $status, 'skinTone' => $skinTone]);
       }

       public function saveUpdateSkinTone(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = SkinTone::find($id);
            $annualincome->name = $request->name;
            $annualincome->status = $request->status;
            $annualincome->update();
            return redirect('/getSkinTone')->with('message','Skin Tone Updated Successfully');
        }
}
