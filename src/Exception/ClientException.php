<?php

namespace Gupo\MiddleOffice\Exception;

use Exception;

/**
 * Class ClientException
 *
 * @package AlibabaCloud\Client\Exception
 * @author wm
 */
class ClientException extends Exception
{
    /**
     * ClientException constructor
     *
     * @param $errorMessage
     * @param $errorCode
     * @param $previous
     */
    public function __construct($errorMessage, $errorCode = 0, $previous = null)
    {
        parent::__construct($errorMessage, $errorCode, $previous);
    }
}
