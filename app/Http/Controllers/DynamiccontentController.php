<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\DynamicContent;
use App\Models\PageWise;
use Mail;
use Illuminate\Support\Str;

class DynamiccontentController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $diettype = DynamicContent::get();
         return view('dynamiccontent.index', ['dynamiccontent' => $diettype]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
         $page = PageWise::get();
           return view('dynamiccontent.add',['page' => $page,'status' => $status]);
       }

      public function saveDynamiccontent(Request $request)
      {
          $request->validate([
            'title' => 'required',
              'page_wise_id' => 'required',
              'status' => 'required',
          ]);
          DB::table('dynamic_contents')->insert([
              'title' => $request->name,
              'page_wise_id' => $request->page_wise_id,
              'content' => $request->description,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getDynamiccontent')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showDynamiccontent($id) {
         $dyncontent = DynamicContent::where('id', $id)->first();
         $status = Status::get();
         $page = PageWise::get();
         return view('dynamiccontent.show',['page' => $page,'status' => $status, 'dyncontent' => $dyncontent]);
       }

       public function updateDynamiccontent($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $dyncontent = DynamicContent::where('id', $id)->first();
       $status = Status::get();
       $page = PageWise::get();
       return view('dynamiccontent.edit',['page' => $page,'status' => $status, 'dyncontent' => $dyncontent]);
       }

       public function saveUpdateDynamiccontent(Request $request, $id)
        {
          //dd($request);
          $request->validate([
              'name' => 'required',
              'page_wise_id' => 'required',
              'status' => 'required',
          ]);

            $dyncontent = DynamicContent::find($id);
            $dyncontent->title = $request->name;
            $dyncontent->page_wise_id = $request->page_wise_id;
            $dyncontent->content = $request->description;
            $dyncontent->status = $request->status;
            $dyncontent->update();
            return redirect('/getDynamiccontent')->with('message','Dynamiccontent Updated Successfully');
        }
}
