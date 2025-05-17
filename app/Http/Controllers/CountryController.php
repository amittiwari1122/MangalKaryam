<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\Status;
use Mail;
use Illuminate\Support\Str;

class CountryController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $countrydetails = Country::get();
         return view('country.index', ['countrydetails' => $countrydetails]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('country.add',['status' => $status]);
       }

      public function saveCountry(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('countries')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'status' => 1,
              'order' => $request->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getCountry')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      // public function showState() {
      //    return view('country.show');
      // }

      public function showCountry($id) {
        $country = Country::where('id', $id)->first();
        $status = Status::get();
        return view('country.show',['status' => $status, 'country' => $country]);
      }

      public function updateCountry($id) {

      // $user = User::where('email', $request->id)
      //             ->update(['password' => Hash::make($request->password)]);
      $country = Country::where('id', $id)->first();
      $status = Status::get();
      return view('country.edit',['status' => $status, 'country' => $country]);
      }

      public function saveUpdateCountry(Request $request, $id)
       {
         $request->validate([
             'name' => 'required',
             'status' => 'required',
         ]);

           $country = Country::find($id);
           $country->name = $request->name;
           $country->description = $request->description;
           $country->status = $request->status;
           $country->order = $request->order;
           $country->update();
           return redirect('/getCountry')->with('message','Country Updated Successfully');
       }
}
