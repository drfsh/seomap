<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use Melipayamak;

trait Smstrait
{
    public function Sendsms($text, $to, $bodyId)
    {

        $data = array(
            'username' => Config::get('melipayamak.username'),
            'password' => Config::get('melipayamak.password'),
            'text' => $text,
            'to' => $to,
            "bodyId" => $bodyId);

        $post_data = http_build_query($data);
        $handle = curl_init('https://rest.payamak-panel.com/api/SendSMS/BaseServiceNumber');
        curl_setopt($handle, CURLOPT_HTTPHEADER, array(
            'content-type' => 'application/x-www-form-urlencoded'
        ));
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        $response = curl_exec($handle);

    }
}
