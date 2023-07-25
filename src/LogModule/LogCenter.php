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
     * 记录操作日志
     *
     * @param string $biz_code 业务代码
     * @param string $content 业务自定义JSON内容
     * @param string $action_module 操作模块
     * @param string $action_object 操作对象
     * @param string $action_behavior 操作行为
     *
     * @return bool
     */
    public static function recordAction(string $biz_code, string $content, string $action_module = '', string $action_object = '',  string $action_behavior = '')
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
            'biz_code' => $biz_code,
            'type' => 'action',  //日志类型
            'action_module' => $action_module,
            'action_object' => $action_object,
            'action_behavior' => $action_behavior,
            'content' => $content,
            'request_input' => RequestData::getInputRequest(),
            'jwt' => RequestData::getToken(),
        ];

        $options = [
            'json' => $arr,
            'headers' => ['Content-Type' => 'application/json'],
        ];
        $client = new GuzzleHttpClient();

        try {
            $client->request('post', $url, $options); //记录日志
        }catch (\Exception $e){
            return false;
        }

        return true;
    }
}
