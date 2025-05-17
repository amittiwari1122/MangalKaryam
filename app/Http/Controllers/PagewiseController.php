<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\PageWise;
use Mail;
use Illuminate\Support\Str;

class PagewiseController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $pagewise = PageWise::get();
         return view('pagewise.index', ['pagewise' => $pagewise]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('pagewise.add',['status' => $status]);
       }

      public function savePageWise(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('page_wises')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getPagewise')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showPageWise($id) {
         $pagewise = PageWise::where('id', $id)->first();
         $status = Status::get();
         return view('pagewise.show',['status' => $status, 'pagewise' => $pagewise]);
       }

       public function updatePageWise($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $pagewise = PageWise::where('id', $id)->first();
       $status = Status::get();
       return view('pagewise.edit',['status' => $status, 'pagewise' => $pagewise]);
       }

       public function saveUpdatePageWise(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $diettype = PageWise::find($id);
            $diettype->name = $request->name;
            $diettype->application = $request->application;
            $diettype->description = $request->description;
            $diettype->status = $request->status;
            $diettype->update();
            return redirect('/getPagewise')->with('message','PageWise Updated Successfully');
        }
}
