<?php

namespace App\Traits;
use Kavenegar;
// use Log;
trait Smstrait {
    public function Sendsms($phone, $template, $token,$token2=null,$token3=null,$token10=null,$token20=null) {
        try{
            $receptor = $phone;
            $template =  $template;
            $type =  "sms";
            $token =  $token;
            $token2 = $token2;
            $token3 =  $token3;
            $token10 =  $token10;

            $result = Kavenegar::VerifyLookup($receptor,$token,$token2,$token3,$template,$type,$token10,$token20);
        }
        catch(ApiException $e){

        }
        catch(HttpException $e){

        }

        // Log::info($phone.' - '.$token);
    }
    public function send($receptor,$message){
        $sender = "0018018949161";		//This is the Sender number

        return Kavenegar::Send($sender,$receptor,$message);
    }
}
