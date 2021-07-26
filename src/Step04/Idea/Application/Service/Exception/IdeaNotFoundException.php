<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Application\Service\Exception;

use Exception;
use Throwable;

class IdeaNotFoundException extends Exception
{
    public function __construct(string $message = '', int $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
