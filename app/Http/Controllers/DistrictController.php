<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\State;
use App\Models\Status;
use App\Models\District;
use Mail;
use Illuminate\Support\Str;

class DistrictController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $citydetails = District::select(['districts.*','states.name as state_name'])->leftJoin('states', 'states.id', '=', 'districts.state_id')->get();

         return view('district.index', ['citydetails' => $citydetails]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
         $State = State::get();
           return view('district.add',['status' => $status, 'state' => $State]);
       }

      public function saveDistrict(Request $request)
      {
        $request->validate([
            'name' => 'required',
            'state_id' => 'required',
            'status' => 'required',
        ]);
          DB::table('districts')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'state_id' => $request->state_id,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getDistrict')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showDistrict($id) {
        $city = District::where('id', $id)->first();
        $status = Status::get();
        $state = State::get();
        return view('district.show',['status' => $status, 'city' => $city, 'state' => $state]);
      }

      public function updateDistrict($id) {

      // $user = User::where('email', $request->id)
      //             ->update(['password' => Hash::make($request->password)]);
      $city = District::where('id', $id)->first();
      $status = Status::get();
      $state = State::get();
      return view('district.edit',['status' => $status, 'city' => $city, 'state' => $state]);
      }

      public function saveUpdateDistrict(Request $request, $id)
       {
         $request->validate([
             'name' => 'required',
             'state_id' => 'required',
             'status' => 'required',
         ]);

           $state = District::find($id);
           $state->name = $request->name;
           $state->state_id = $request->state_id;
           $state->description = $request->description;
           $state->status = $request->status;
           $state->update();
           return redirect('/getDistrict')->with('message','District Updated Successfully');
       }

}
