<?php

namespace Gupo\MiddleOffice\Config;

/**
 * Class Config
 *
 * @author: Wumeng - wumeng@gupo.onaliyun.com
 * @since: 2023-06-15 16:20
 */
class Config
{
    public string $accessKey;
    public string $accessSecret;

    public function __construct($accessKey, $accessSecret)
    {
        $this->accessKey = $accessKey;
        $this->accessSecret = $accessSecret;
    }
}
