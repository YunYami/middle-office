<?php

namespace Gupo\MiddleOffice;

/**
 * Class SDK
 *
 * @package AlibabaCloud\Client
 */
class SDK
{
    /**
     * 缺少config
     */
    public const CONFIG_ERROR = 'SDK.ConfigError';

    /**
     * 缺少必要参数
     */
    public const MISSING_PARAMETER = 'SDK.MissingNecessaryParameter';

    /**
     * Server Unreachable
     */
    public const SERVER_UNREACHABLE = 'SDK.ServerUnreachable';

    /**
     * Invalid RegionId
     */
    public const INVALID_REGION_ID = 'SDK.InvalidRegionId';

    /**
     * Invalid Argument
     */
    public const INVALID_ARGUMENT = 'SDK.InvalidArgument';

    /**
     * Service Not Found
     */
    public const SERVICE_NOT_FOUND = 'SDK.ServiceNotFound';

    /**
     * Service Unknown Error
     */
    public const SERVICE_UNKNOWN_ERROR = 'SDK.UnknownError';

    /**
     * Response Empty
     */
    public const RESPONSE_EMPTY = 'The response is empty';
}
