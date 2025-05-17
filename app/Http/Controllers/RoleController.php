<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Role;
use Mail;
use Illuminate\Support\Str;

class RoleController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $role = Role::get();
         return view('role.index', ['role' => $role]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('role.add',['status' => $status]);
       }

      public function saveRole(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);
          DB::table('roles')->insert([
              'name' => $request->name,
              'description' => $request->description,
              'status' => $request->status,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getRole')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showRole($id) {
         $role = Role::where('id', $id)->first();
         $status = Status::get();
         return view('role.show',['status' => $status, 'role' => $role]);
       }

       public function updateRole($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $role = Role::where('id', $id)->first();
       $status = Status::get();
       return view('role.edit',['status' => $status, 'role' => $role]);
       }

       public function saveUpdateRole(Request $request, $id)
        {
          $request->validate([
              'name' => 'required',
              'status' => 'required',
          ]);

            $diettype = Role::find($id);
            $diettype->name = $request->name;
            $diettype->description = $request->description;
            $diettype->status = $request->status;
            $diettype->update();
            return redirect('/getRole')->with('message','Role Updated Successfully');
        }
}
