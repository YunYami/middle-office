<?php

namespace Gupo\MiddleOffice\Clients;

use Gupo\MiddleOffice\Config\Config;
use Gupo\MiddleOffice\Error\ErrorInfo;
use Gupo\MiddleOffice\Exception\ClientException;
use Gupo\MiddleOffice\Utils\Utils;

/**
 * Class Client
 *
 * @author: Wumeng - wumeng@gupo.onaliyun.com
 *
 * @since: 2023-06-15 16:22
 */
class Client
{
    protected $config;

    public function __construct(Config $config = null, bool $needSignCheck = true)
    {
        if ($needSignCheck) {
            if (Utils::isUnset($config)) {
                throw new ClientException(ErrorInfo::CONFIG_ERROR);
            }

            if (Utils::empty_($config->accessKey) || Utils::empty_($config->accessSecret)) {
                throw new ClientException(ErrorInfo::MISSING_PARAMETER);
            }
            $this->config = $config;
        }
    }

    /**
     * post请求
     *
     * @return mixed
     *
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @author Wumeng wumeng@gupo.onaliyun.com
     *
     * @since 2023-06-16 15:17
     */
    protected function callApiPost($header, $body, $uri)
    {
        Utils::assertAsArray($body);
        Utils::assertAsString($uri);
        $client = new \Cloudladder\Http\Client();
        $response = $client->post($uri, [
            'form_params' => $body,
            'headers' => $header,
        ]);
        $content = $response->getBody()->getContents();
        if (! $content) {
            throw new ClientException(ErrorInfo::RESPONSE_EMPTY);
        }

        return json_decode($content, true);
    }

    /**
     * get请求
     *
     * @return mixed
     *
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @author Wumeng wumeng@gupo.onaliyun.com
     *
     * @since 2023-06-16 15:17
     */
    protected function callApiGet($header, $query, $uri)
    {
        Utils::assertAsArray($query);
        Utils::assertAsString($uri);
        $client = new \GuzzleHttp\Client();
        $response = $client->get($uri, [
            'query' => $query,
            'headers' => $header,
        ]);
        $content = $response->getBody()->getContents();
        if (! $content) {
            throw new ClientException(ErrorInfo::RESPONSE_EMPTY);
        }

        return json_decode($content, true);
    }
}
