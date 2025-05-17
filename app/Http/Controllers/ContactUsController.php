<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\ContactUs;
use Mail;
use Illuminate\Support\Str;

class ContactUsController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function index()
      {
        $contactus = ContactUs::orderBy('created_at', 'DESC')->get();
         return view('contactus.index', ['contactus' => $contactus]);
      }

     
      /**
       * Write code on Method
       *
       * @return response()
       */

      public function showContactUs($id) {
        $contactus = ContactUs::where('id', $id)->first();
        return view('contactus.show',['contactus' => $contactus]);
      }
}
