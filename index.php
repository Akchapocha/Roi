<?php

$obj = New Index();

/** Варианты работы функции: */

$result = $obj->isIpInRange('31.173.80.80', '31.173.80.0/21'); // true
$result = $obj->isIpInRange('31.173.79.255', '31.173.80.0/21'); // false

var_dump($result);


class Index
{
    public function isIpInRange($ip, $IpRange)
    {
        $ipLength = 255;
        $err = [];

        if (preg_match('/^\d+\.\d+\.\d+\.\d+$/', $ip, $isIp)){
            $isIp = explode('.', $isIp[0]);

            foreach ($isIp as $item => $value){
                if (intval($value) > $ipLength){
                    $err[] = 'Введен не корректный IP-адрес.';
                }
            }

        } else {
            $err[] = 'Введен не корректный IP-адрес.';
        }

        if (preg_match('/^\d+\.\d+\.\d+\.\d\/\d{2}$/', $IpRange, $isIpRange)){
            $isIpRange = explode('.', $isIpRange[0]);

            foreach ($isIpRange as $item => $value){
                if ($item <= 2){
                    if (intval($value) > $ipLength){
                        $err[] = 'Введен не корректный диапазон IP-адресов.';
                    }
                }

            }

        } else {
            $err[] = 'Введен не корректный диапазон IP-адресов.';
        }

        if ($err !== []){
            echo $err[0];
            exit();
        } else {
            foreach ($isIp as $keyIp => $valIp){
                if ($keyIp <= 2){
                    if (intval($valIp) !== intval($isIpRange[$keyIp]) ){
                        return false;
                    }
                }
            }
        }

        return true;
    }
    
}
