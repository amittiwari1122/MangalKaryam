<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\NotificationMsg;
use Mail;
use Illuminate\Support\Str;

class NotificationMsgController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $notification = NotificationMsg::get();
         return view('notification_msg.index', ['notification' => $notification]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */

       public function add(Request $request)
       {
         $status = Status::get();
           return view('notification_msg.add',['status' => $status]);
       }

      public function saveNotificationMsg(Request $request)
      {
          $request->validate([
              'title' => 'required',
              'discription' => 'required',
              'notification_type' => 'required',
          ]);
          DB::table('notification_msgs')->insert([
              'title' => $request->title,
              'discription' => $request->discription,
              'notification_type' => $request->notification_type,
              'created_at' => Carbon::now()
            ]);

          return redirect('/getNotificationMsg')->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
       public function showNotificationMsg($id) {
         $notification  = NotificationMsg::where('id', $id)->first();
         $status = Status::get();
         return view('notification_msg.show',['status' => $status, 'notification' => $notification]);
       }

       public function updateNotificationMsg($id) {

       // $user = User::where('email', $request->id)
       //             ->update(['password' => Hash::make($request->password)]);
       $notification = NotificationMsg::where('id', $id)->first();
       $status = Status::get();
       return view('notification_msg.edit',['status' => $status, 'notification' => $notification]);
       }

       public function saveUpdateNotificationMsg(Request $request, $id)
        {
          $request->validate([
              'title' => 'required',
              'discription' => 'required',
              'notification_type' => 'required',
          ]);

            $annualincome = NotificationMsg::find($id);
            $annualincome->title = $request->title;
            $annualincome->discription = $request->discription;
            $annualincome->notification_type = $request->notification_type;
            $annualincome->update();
            return redirect('/getNotificationMsg')->with('message','notification Updated Successfully');
        }
}
