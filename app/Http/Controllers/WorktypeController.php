<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\WorkType;
use Mail;
use Illuminate\Support\Str;

class WorktypeController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $gotradetails = WorkType::get();
         return view('worktype.index', ['worktypedetails' => $gotradetails]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('worktype.add',['status' => $status]);
       }

      public function saveWorktype(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('work_types')->insert([
              'name' => $request->name,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getWorktype')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showWorktype($id) {
         $worktype = WorkType::where('id', $id)->first();
         $status = Status::get();
         return view('worktype.show',['status' => $status, 'worktype' => $worktype]);
       }

       public function updateWorktype($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $worktype = WorkType::where('id', $id)->first();
       $status = Status::get();
       return view('worktype.edit',['status' => $status, 'worktype' => $worktype]);
       }

       public function saveUpdateWorktype(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $diettype = WorkType::find($id);
            $diettype->name = $request->name;
            $diettype->status = $request->status;
            $diettype->update();
            return redirect('/getWorktype')->with('message','Weight Updated Successfully');
        }


}
