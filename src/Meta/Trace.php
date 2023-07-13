<?php

namespace Gupo\MiddleOffice\Meta;

// 链路追踪id
use Illuminate\Support\Str;

/**
 * Class ErrorInfo
 */
class Trace
{
    public const KEY = 'x-gp-trace-id';

    public static function getKey(): string
    {
        return self::KEY;
    }

    public static function getValue(): string
    {
        // 上游已传直接透传
        if (function_exists('request')) {
            $hv = request()->header(self::KEY);
            if (! is_null($hv)) {
                return $hv;
            }
        }
        // laravel自带的uuid方法
        if (class_exists(Str::class, false) && method_exists(Str::class, 'uuid')) {
            $request_id = Str::uuid()->toString();
            Request()->headers->set(self::KEY, $request_id);  //注册到head头部

            return $request_id;
        }

        // 保底自己生成
        return \Cloudladder\Http\Support\Str::uuid();
    }
}
