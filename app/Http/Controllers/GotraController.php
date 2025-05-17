<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Gotra;
use App\Models\Caste;
use Mail;
use Illuminate\Support\Str;

class GotraController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $gotradetails = Gotra::select('gotras.*','castes.name as caste')->join('castes', 'gotras.caste_id', '=', 'castes.id')->get();
         return view('gotra.index', ['gotradetails' => $gotradetails]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
         $caste = Caste::get();
           return view('gotra.add',['status' => $status, 'caste' => $caste]);
       }

      public function saveGotra(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'caste_id' => 'required',
              'status' => 'required',
          ]);
          DB::table('gotras')->insert([
              'name' => $request->name,
              'caste_id' => $request->caste_id,
              'description' => $request->description,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getGotra')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showGotra($id) {
         $gotra = Gotra::where('id', $id)->first();
         $status = Status::get();
         $caste = Caste::get();
         return view('gotra.show',['status' => $status, 'gotra' => $gotra, 'caste' => $caste]);
       }

       public function updateGotra($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $gotra = Gotra::where('id', $id)->first();
       $status = Status::get();
       $caste = Caste::get();
       return view('gotra.edit',['status' => $status, 'gotra' => $gotra, 'caste' => $caste]);
       }



       public function saveUpdateGotra(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'caste_id' => 'required',
              'status' => 'required',
          ]);

            $gotra = Gotra::find($id);
            $gotra->name = $request->name;
            $gotra->caste_id = $request->caste_id;
            $gotra->description = $request->description;
            $gotra->status = $request->status;
            $gotra->update();
            return redirect('/getGotra')->with('message','Gotra Updated Successfully');
        }


}
