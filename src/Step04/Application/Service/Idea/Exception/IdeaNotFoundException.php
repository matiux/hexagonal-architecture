<?php

namespace HexagonalArchitecture\Step04\Application\Service\Idea\Exception;

use Throwable;

class IdeaNotFoundException extends \Exception
{
    public function __construct(string $message = "", int $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
