<?php

namespace Gupo\MiddleOffice\MessageCenter;

use Gupo\MiddleOffice\Route\Route;
use Gupo\MiddleOffice\Config\Config;
use Gupo\MiddleOffice\Clients\Client;
use Gupo\MiddleOffice\VO\RequestHeader;
use Gupo\MiddleOffice\Exception\ClientException;

/**
 * Class MessageCenter
 *
 * @author: Wumeng - wumeng@gupo.onaliyun.com
 * @since: 2023-06-15 16:42
 */
class MessageCenter extends Client
{
    /**
     * @param  Config  $config
     * @throws ClientException
     */
    public function __construct(Config $config)
    {
        parent::__construct($config);
    }

    /**
     * 发送短信
     *
     * @param $body
     * @param $appId
     * @param $endpoint
     * @return mixed
     * @throws ClientException
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-16 13:58
     */
    public function sendSms($body, $appId, $endpoint)
    {
        $header = new RequestHeader($this->config, $body, $appId);

        return $this->callApiPost($header->getHeader(), $body, $endpoint . Route::$route['message_center_sms_send']);
    }

    /**
     * 通用get调用
     *
     * @param $query
     * @param $appId
     * @param $fullUri
     * @return mixed
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-16 15:18
     */
    public function callOpenApiGet($query, $appId, $fullUri)
    {
        $header = new RequestHeader($this->config, $query, $appId);

        return $this->callApiGet($header->getHeader(), $query, $fullUri);
    }

    /**
     * 通用post调用
     *
     * @param $body
     * @param $appId
     * @param $fullUri
     * @return mixed
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-16 15:18
     */
    public function callOpenApiPost($body, $appId, $fullUri)
    {
        $header = new RequestHeader($this->config, $body, $appId);

        return $this->callApiPost($header->getHeader(), $body, $fullUri);
    }
}
