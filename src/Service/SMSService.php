<?php

namespace App\Service;

class SMSService {

    public function sendSMS($phone, $message) {
        $response = file_get_contents("https://smsc.ru/sys/send.php?login=rosroddomru&psw=4:u>=s*{HGmR'1wi&phones=".$phone."&mes=".$message);
        return $response;
    }
}