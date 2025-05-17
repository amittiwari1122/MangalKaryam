<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\DynamicContent;
use Mail;
use Illuminate\Support\Str;

class WebsiteController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function aboutus()
      {
        $dynamic = DynamicContent::where("user_type", "2")->where("page_wise_id", "1")->first();
         return view('website.aboutus', ['dynamic' => $dynamic]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function privacyAndPolicy()
      {
        $dynamic = DynamicContent::where("user_type", "2")->where("page_wise_id", "2")->first();
         return view('website.privacy', ['dynamic' => $dynamic]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function termsAndConditions()
      {
        $dynamic = DynamicContent::where("user_type", "2")->where("page_wise_id", "3")->first();
         return view('website.terms', ['dynamic' => $dynamic]);
      }

}
