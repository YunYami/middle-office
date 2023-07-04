<?php

declare(strict_types=1);

namespace Gupo\MiddleOffice\VO;


use Gupo\MiddleOffice\Config\Config;

/**
 * Class Sign
 *
 * @author: Wumeng - wumeng@gupo.onaliyun.com
 * @since: 2023-07-03 17:41
 */
class Sign
{
    // 生成随机数 - 规则：md5(uniqid(mt_rand(), true)) ps:用于防止重放攻击
    public string $nonce;
    // 字符串日期 - 防止请求过期 规则：date(DATE_RFC3339)
    public string $datetime;
    // hash加密请求数据，通过hash-SHA256的方式加密，请求体以http_build_query处理，举例laravel框架：http_build_query($request->input())
    public string $hashBody;
    // key
    public string $accessKey;
    // secret
    public string $accessSecret;

    public function __construct($accessKey, $accessSecret, $nonce, $datetime, $hashBody)
    {
        $this->accessKey = $accessKey;
        $this->accessSecret = $accessSecret;
        $this->nonce = $nonce;
        $this->datetime = $datetime;
        $this->hashBody = $hashBody;
    }
}