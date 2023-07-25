<?php

namespace Gupo\MiddleOffice\Config;

use Gupo\MiddleOffice\Error\ErrorInfo;
use Gupo\MiddleOffice\Exception\ClientException;
use Gupo\MiddleOffice\Utils\Utils;

/**
 * Class Config
 *
 * @author: Wumeng - wumeng@gupo.onaliyun.com
 *
 * @since: 2023-06-15 16:20
 */
class Config
{
    public string $accessKey;

    public string $accessSecret;

    public string $appId;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $outerConfigPath = __DIR__.'/../../../../../config/middleoffice.php';
        $innerConfigPath = __DIR__.'/configfile.php';
        if (! file_exists($outerConfigPath)) {
            $this->appId = $_ENV['AUTH_CENTER_APP_ID'] ?? 0;
            $this->accessKey = $_ENV['AUTH_CENTER_APP_KEY'] ?? '';
            $this->accessSecret = $_ENV['AUTH_CENTER_APP_SECRET'] ?? '';
        } else {
            // 将该配置文件复制到当前目录下的configfile中
            copy($outerConfigPath, $innerConfigPath);
            $config = include $innerConfigPath;
            if (Utils::empty_($config) || ! Utils::assertAsArray($config)) {
                throw new ClientException(ErrorInfo::CONFIG_ERROR.'1');
            }
            if (Utils::isUnset($config['id'])
                || Utils::isUnset($config['app_id'])
                || Utils::isUnset($config['app_secret'])
            ) {
                throw new ClientException(ErrorInfo::CONFIG_ERROR.'2');
            }
            $this->appId = $config['id'];
            $this->accessKey = $config['app_id'];
            $this->accessSecret = $config['app_secret'];
        }
    }
}
