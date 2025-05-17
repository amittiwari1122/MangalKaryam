<?php

namespace App\Services;

class Sms
{
    public static function sendLoginOtpSms($mobile, $otp) {

        $curl = curl_init();
        $YOUR_API_KEY = "9RR8JDhGAtxJOXQXbF9LMwf46jsfZsg1Q0clWSw9UTheAvR4QgDzre5HWCTq";
        $route = "dlt";
        $senderId = "MK0116";
        $message = 171998;
        $varValues = $otp;
        $mobile = $mobile;
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=".$YOUR_API_KEY."&route=".$route."&sender_id=".$senderId."&message=".$message."&variables_values=".$varValues."&flash=0&numbers=".$mobile,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
    }

    public static function sendWelcomeSms($mobile, $url) {

        $curl = curl_init();
        $YOUR_API_KEY = "9RR8JDhGAtxJOXQXbF9LMwf46jsfZsg1Q0clWSw9UTheAvR4QgDzre5HWCTq";
        $route = "dlt";
        $senderId = "MK0116";
        $message = 171999;
        $varValues = $url;
        $mobile = $mobile;
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=".$YOUR_API_KEY."&route=".$route."&sender_id=".$senderId."&message=".$message."&variables_values=".$varValues."&flash=0&numbers=".$mobile,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
    }
}


