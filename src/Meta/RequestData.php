<?php

namespace Gupo\MiddleOffice\Meta;

/**
 * Class ErrorInfo
 */
class RequestData
{
    public static function getToken()
    {
        //只考虑laravel框架中使用
        if (function_exists('request')) {
            $jwtHeader = request()->header('Authorization');
            if (! empty($jwtHeader) && preg_match('/^Bearer\\s+(.*?)$/', $jwtHeader, $matches)) {
                $jwt = $matches[1];
            }
        }

        return $jwt ?? '';
    }

    public static function getAppName()
    {
        if (function_exists('config')) {
            $app_name = config('app.name');
        }

        return $app_name ?? '';
    }

    public static function getRoute()
    {
        if (function_exists('request')) {
            $route_url = request()->path();
        }

        return $route_url ?? '';
    }

    public static function getHost()
    {
        if (function_exists('request')) {
            $host_url = request()->getHost().request()->getPort();
        }

        return $host_url ?? '';
    }

    public static function getRequestId()
    {
        return Trace::getValue();
    }

    public static function getInputRequest()
    {
        if (function_exists('request')) {
            $input_request = request()->all();
            $input_request_str = json_encode($input_request, true);
        }

        return $input_request_str ?? '';
    }
}
