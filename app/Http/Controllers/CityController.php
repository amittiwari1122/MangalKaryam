<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\State;
use App\Models\Status;
use App\Models\City;
use Mail;
use Illuminate\Support\Str;

class CityController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $citydetails = City::select(['cities.*','states.name as state_name'])->leftJoin('states', 'states.id', '=', 'cities.state_id')->get();

         return view('city.index', ['citydetails' => $citydetails]);
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
           return view('city.add',['status' => $status, 'state' => $State]);
       }

      public function saveCity(Request $request)
      {
        $request->validate([
            'name' => 'required',
            'state_id' => 'required',
            'status' => 'required',
        ]);
          DB::table('cities')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'state_id' => $request->state_id,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getCity')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showCity($id) {
        $city = City::where('id', $id)->first();
        $status = Status::get();
        $state = State::get();
        return view('city.show',['status' => $status, 'city' => $city, 'state' => $state]);
      }

      public function updateCity($id) {

      // $user = User::where('email', $request->id)
      //             ->update(['password' => Hash::make($request->password)]);
      $city = City::where('id', $id)->first();
      $status = Status::get();
      $state = State::get();
      return view('city.edit',['status' => $status, 'city' => $city, 'state' => $state]);
      }

      public function saveUpdateCity(Request $request, $id)
       {
         $request->validate([
             'name' => 'required',
             'state_id' => 'required',
             'status' => 'required',
         ]);

           $state = City::find($id);
           $state->name = $request->name;
           $state->state_id = $request->state_id;
           $state->description = $request->description;
           $state->status = $request->status;
           $state->update();
           return redirect('/getCity')->with('message','City Updated Successfully');
       }

}
