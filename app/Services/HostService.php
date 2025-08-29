<?php

namespace App\Services;


class HostService
{
    
    public function GetUrl($cc){
        // dump(env('APP_ENV'));
        $hostViller="";
        $hostMakarios="";
        if(env('APP_ENV')=="DEV"){
            $hostViller=env('HOST_VILLAGER_DEV');
            $hostMakarios=env('HOST_MAKARIOS_DEV');
        }else{
            $hostViller=env('HOST_VILLAGER_PROD');
            $hostMakarios=env('HOST_MAKARIOS_PROD');
        }  
        if ($cc=="v"){
            return $hostViller;
        }else{
            return $hostMakarios;
        }
    }
}
