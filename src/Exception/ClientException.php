<?php

namespace Gupo\MiddleOffice\Exception;

use Exception;

/**
 * Class ClientException
 *
 * @author wm
 */
class ClientException extends Exception
{
    /**
     * ClientException constructor
     */
    public function __construct($errorMessage, $errorCode = 0, $previous = null)
    {
        parent::__construct($errorMessage, $errorCode, $previous);
    }
}
