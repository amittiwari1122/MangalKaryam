<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\State;
use App\Models\Status;
use App\Models\Country;
use Mail;
use Illuminate\Support\Str;

class StateController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $statedetails = State::select(['states.*','countries.name as country_name'])->leftJoin('countries', 'countries.id', '=', 'states.country_id')->get();

         return view('state.index', ['statedetails' => $statedetails]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
         $country = Country::get();
           return view('state.add',['status' => $status, 'country' => $country]);
       }

      public function saveState(Request $request)
      {
        $request->validate([
            'name' => 'required',
            'country_id' => 'required',
            'status' => 'required',
        ]);
          DB::table('states')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'country_id' => $request->country_id,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getState')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showState($id) {
        $state = State::where('id', $id)->first();
        $status = Status::get();
        $country = Country::get();
        return view('state.show',['status' => $status, 'country' => $country, 'state' => $state]);
      }

      public function updateState($id) {

      // $user = User::where('email', $request->id)
      //             ->update(['password' => Hash::make($request->password)]);
      $state = State::where('id', $id)->first();
      $status = Status::get();
      $country = Country::get();
      return view('state.edit',['status' => $status, 'country' => $country, 'state' => $state]);
      }

      public function saveUpdateState(Request $request, $id)
       {
         $request->validate([
             'name' => 'required',
             'country_id' => 'required',
             'status' => 'required',
         ]);

           $state = State::find($id);
           $state->name = $request->name;
           $state->country_id = $request->country_id;
           $state->description = $request->description;
           $state->status = $request->status;
           $state->update();
           return redirect('/getState')->with('message','State Updated Successfully');
       }

}
