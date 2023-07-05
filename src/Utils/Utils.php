<?php

namespace Gupo\MiddleOffice\Utils;

use Gupo\MiddleOffice\VO\Sign;

class Utils
{
    /**
     * Parse it by JSON format.
     *
     * @param  string  $jsonString
     * @return array the parsed result
     */
    public static function parseJSON($jsonString)
    {
        return json_decode($jsonString, true);
    }

    /**
     * Generate a nonce string.
     *
     * @return string the nonce string
     */
    public static function getNonce()
    {
        return md5(uniqid(mt_rand(), true));
    }

    /**
     * Generate a hash body string
     *
     * @param array $body
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-15 16:07
     */
    public static function getHashBody($body)
    {
        return hash("sha256", http_build_query($body));
    }

    /**
     * Generate a date time string
     *
     * @return false|string
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-15 16:13
     */
    public static function getDateTime()
    {
        return date(DATE_RFC3339);
    }

    /**
     * Generate a temporary sign string
     *
     * @param string $accessKey
     * @param string $dateTime
     * @param string $nonce
     * @param string $hashBody
     * @return string
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-15 16:14
     */
    public static function getTmpSign($accessKey, $dateTime, $nonce, $hashBody)
    {
        return sprintf("%s:%s:%s:%s", $accessKey, $dateTime, $nonce, $hashBody);
    }

    /**
     * Generate a real sign string
     *
     * @param string $tmpSign
     * @param string $accessSecret
     * @return string
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-15 16:13
     */
    public static function getSign($tmpSign, $accessSecret)
    {
        return hash_hmac("sha256", $tmpSign, $accessSecret);
    }

    /**
     * Generate a authorization string
     *
     * @param string $accessKey
     * @param string $dateTime
     * @param string $nonce
     * @param string $sign
     * @return string
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-15 16:16
     */
    public static function getAuthorization($accessKey, $dateTime, $nonce, $sign)
    {
        return sprintf("AccessKey=%s,DateTime=%s,Nonce=%s,Signature=%s", $accessKey, $dateTime, $nonce, $sign);
    }

    /**
     * If not set the real, use default value.
     *
     * @param  array  $object
     * @return string the return string
     */
    public static function toJSONString($object)
    {
        if (is_string($object)) {
            return $object;
        }

        return json_encode($object, JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES);
    }

    /**
     * Check the string is empty?
     *
     * @param  string  $val
     * @return bool if string is null or zero length, return true
     */
    public static function empty_($val)
    {
        return empty($val);
    }

    /**
     * Check one value is unset.
     *
     * @param  mixed  $value
     * @return bool if unset, return true
     */
    public static function isUnset(&$value = null)
    {
        return !isset($value) || null === $value;
    }

    /**
     * Assert a value, if it is a string, return it, otherwise throws.
     *
     * @param  mixed  $value
     * @return string the string value
     */
    public static function assertAsString($value)
    {
        if (\is_string($value)) {
            return $value;
        }

        throw new \InvalidArgumentException('It is not a string value.');
    }

    /**
     * Assert a value, if it is a number, return it, otherwise throws.
     *
     * @param  mixed  $value
     * @return bool the number value
     */
    public static function assertAsNumber($value)
    {
        if (\is_numeric($value)) {
            return $value;
        }

        throw new \InvalidArgumentException('It is not a number value.');
    }

    /**
     * 断言为数组
     *
     * @param $any
     * @return array
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-07-03 17:55
     */
    public static function assertAsArray($any)
    {
        if (\is_array($any)) {
            return $any;
        }

        throw new \InvalidArgumentException('It is not a array value.');
    }
}
