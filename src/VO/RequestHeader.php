<?php

namespace Gupo\MiddleOffice\VO;

use Gupo\MiddleOffice\Utils\Utils;
use Gupo\MiddleOffice\Config\Config;

/**
 * Class RequestHeader
 *
 * @author: Wumeng - wumeng@gupo.onaliyun.com
 * @since: 2023-06-16 10:42
 */
class RequestHeader
{
    protected $dateTime;

    protected $nonce;

    protected $hashBody;

    protected $tmpSign;

    protected $sign;

    protected $authorization;

    protected $appId;

    protected $body;

    /**
     * @var Config
     */
    protected $config;

    protected $alreadyGotHeader = false;

    public function __construct(Config $config, $body, $appId)
    {
        $this->body = $body;
        $this->appId = $appId;
        $this->config = $config;
        $this->dateTime = Utils::getDateTime();
        $this->nonce = Utils::getNonce();
        $this->hashBody = Utils::getHashBody($body);
        $this->tmpSign = Utils::getTmpSign($config->accessKey, $this->dateTime, $this->nonce, $this->hashBody);
        $this->sign = Utils::getSign($this->tmpSign, $config->accessSecret);
    }

    /**
     * 获取header，如果已经获取过，再次调用则刷新签名
     *
     * @return array
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-16 15:19
     */
    public function getHeader()
    {
        if ($this->alreadyGotHeader) {
            $this->refreshParameter();
        }
        $header = [
            "appId"         => $this->appId,
            "Authorization" => Utils::getAuthorization($this->config->accessKey, $this->dateTime, $this->nonce, $this->sign),
            "dateTime"      => $this->dateTime,
            "nonce"         => $this->nonce,
        ];
        $this->alreadyGotHeader = true;

        return $header;
    }

    /**
     * 刷新签名所需参数
     *
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-16 15:19
     */
    public function refreshParameter()
    {
        $this->dateTime = Utils::getDateTime();
        $this->nonce = Utils::getNonce();
        $this->hashBody = Utils::getHashBody($this->body);
        $this->tmpSign = Utils::getTmpSign($this->config->accessKey, $this->dateTime, $this->nonce, $this->hashBody);
        $this->sign = Utils::getSign($this->tmpSign, $this->config->accessSecret);
    }
}
