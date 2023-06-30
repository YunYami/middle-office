<?php

namespace Gupo\MiddleOffice\LogModule;

use Gupo\MiddleOffice\Meta\RequestData;
use GuzzleHttp\Client as GuzzleHttpClient;

/**
 * Class ErrorInfo
 *
 * @package Gupo\MiddleOffice
 */
class Logs
{
    public static function writeLog(string $content)
    {
        $arr = [
            'system_code' => RequestData::getAppName(),
            'route_url' => RequestData::getRoute(),
            'host_url' => RequestData::getHost(),
            'x_gp_trace_id' => RequestData::getRequestId(),
            'content' => $content,
            'type' => 'bur_point',  //埋点类型
            'request_input' => RequestData::getInputRequest(),
            'jwt' => RequestData::getToken()
        ];
        if(function_exists("env") && env("log_url")){
            $url = env("log_url");
            $options = [
                'json' => $arr,
                'headers' => ['Content-Type' => 'application/json']
            ];
            $client = new GuzzleHttpClient();
            $res = $client->request("post", $url, $options); //记录日志
        }
    }
}
