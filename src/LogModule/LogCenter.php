<?php

namespace Gupo\MiddleOffice\LogModule;

use Gupo\MiddleOffice\Meta\RequestData;
use GuzzleHttp\Client as GuzzleHttpClient;

/**
 * Class ErrorInfo
 */
class LogCenter
{
    /**
     * Author: chenyifan
     * Des: -记录操作日志-
     */
    public static function recordAction(string $content, string $action_module = '', string $action_object = '')
    {
        if (! function_exists('env')) {
            return false;
        }
        if (! $url = env('LOG_URL')) {
            return false;
        }
        $arr = [
            'system_code' => RequestData::getAppName(),
            'route_url' => RequestData::getRoute(),
            'host_url' => RequestData::getHost(),
            'x_gp_trace_id' => RequestData::getRequestId(),
            'type' => 'action',  //日志类型
            'action_module' => $action_module,
            'action_object' => $action_object,
            'content' => $content,
            'request_input' => RequestData::getInputRequest(),
            'jwt' => RequestData::getToken(),
        ];

        $options = [
            'json' => $arr,
            'headers' => ['Content-Type' => 'application/json'],
        ];
        $client = new GuzzleHttpClient();
        $client->request('post', $url, $options); //记录日志

        return true;
    }
}
