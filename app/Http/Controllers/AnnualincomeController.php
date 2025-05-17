<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\AnnualIncome;
use Mail;
use Illuminate\Support\Str;

class AnnualincomeController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $annualincome = AnnualIncome::get();
         return view('annualincome.index', ['annualincome' => $annualincome]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('annualincome.add',['status' => $status]);
       }

      public function saveAnnualincome(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('annual_incomes')->insert([
              'incomes' => $request->name,
              'description' => $request->description,
              'status' => $request->status,
              'order' => $request->order,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getAnnualincome')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showAnnualincome($id) {
         $annualincome = AnnualIncome::where('id', $id)->first();
         $status = Status::get();
         return view('annualincome.show',['status' => $status, 'annualincome' => $annualincome]);
       }

       public function updateAnnualincome($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $annualincome = AnnualIncome::where('id', $id)->first();
       $status = Status::get();
       return view('annualincome.edit',['status' => $status, 'annualincome' => $annualincome]);
       }

       public function saveUpdateAnnualincome(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $annualincome = AnnualIncome::find($id);
            $annualincome->incomes = $request->name;
            $annualincome->description = $request->description;
            $annualincome->status = $request->status;
            $annualincome->order = $request->order;
            $annualincome->update();
            return redirect('/getAnnualincome')->with('message','Annualincome Updated Successfully');
        }
}
