<?php

namespace Gupo\MiddleOffice\Clients;

use Gupo\MiddleOffice\SDK;
use Gupo\MiddleOffice\Utils\Utils;
use Gupo\MiddleOffice\Config\Config;
use Gupo\MiddleOffice\Exception\ClientException;

/**
 * Class Client
 *
 * @author: Wumeng - wumeng@gupo.onaliyun.com
 * @since: 2023-06-15 16:22
 */
class Client
{
    protected $config;

    public function __construct(Config $config)
    {
        if (Utils::isUnset($config)) {
            throw new ClientException(SDK::CONFIG_ERROR);
        }

        if (Utils::empty_($config->accessKey) || Utils::empty_($config->accessSecret)) {
            throw new ClientException(SDK::MISSING_PARAMETER);
        }
        $this->config = $config;
    }

    /**
     * post请求
     *
     * @param $header
     * @param $body
     * @param $uri
     * @return mixed
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-16 15:17
     */
    protected function callApiPost($header, $body, $uri)
    {
        Utils::assertAsArray($body);
        Utils::assertAsString($uri);
        $client = new \Cloudladder\Http\Client();
        $response = $client->post($uri, [
            'form_params' => $body,
            'headers'     => $header,
        ]);
        $content = $response->getBody()->getContents();
        if (!$content) {
            throw new ClientException(SDK::RESPONSE_EMPTY);
        }

        return json_decode($content, true);
    }

    /**
     * get请求
     *
     * @param $header
     * @param $query
     * @param $uri
     * @return mixed
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-16 15:17
     */
    protected function callApiGet($header, $query, $uri)
    {
        Utils::assertAsArray($query);
        Utils::assertAsString($uri);
        $client = new \GuzzleHttp\Client();
        $response = $client->get($uri, [
            'query'   => $query,
            'headers' => $header,
        ]);
        $content = $response->getBody()->getContents();
        if (!$content) {
            throw new ClientException(SDK::RESPONSE_EMPTY);
        }

        return json_decode($content, true);
    }
}
