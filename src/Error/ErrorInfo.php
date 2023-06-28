<?php

namespace Gupo\MiddleOffice\Error;

/**
 * Class ErrorInfo
 *
 * @package Gupo\MiddleOffice
 */
class ErrorInfo
{
    /**
     * 缺少config
     */
    public const CONFIG_ERROR = 'config error';

    /**
     * 缺少必要参数
     */
    public const MISSING_PARAMETER = 'missing necessary parameter';

    /**
     * Response Empty
     */
    public const RESPONSE_EMPTY = 'the response is empty';
}
