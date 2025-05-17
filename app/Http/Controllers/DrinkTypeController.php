<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\DrinkType;
use Mail;
use Illuminate\Support\Str;

class DrinkTypeController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $drinkType = DrinkType::get();
         return view('drink_type.index', ['drinkType' => $drinkType]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('drink_type.add',['status' => $status]);
       }

      public function saveDrinkType(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('drink_types')->insert([
              'name' => $request->name,
              'status' => $request->status,
              'order' => $request->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getDrinkType')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showDrinkType($id) {
         $drinkType = DrinkType::where('id', $id)->first();
         $status = Status::get();
         return view('drink_type.show',['status' => $status, 'drinkType' => $drinkType]);
       }

       public function updateDrinkType($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $drinkType = DrinkType::where('id', $id)->first();
       $status = Status::get();
       return view('drink_type.edit',['status' => $status, 'drinkType' => $drinkType]);
       }

       public function saveUpdateDrinkType(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = DrinkType::find($id);
            $annualincome->name = $request->name;
            $annualincome->status = $request->status;
            $annualincome->order = $request->order;
            $annualincome->update();
            return redirect('/getDrinkType')->with('message','Drink Type Updated Successfully');
        }
}
