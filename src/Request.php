<?php

declare(strict_types=1);

namespace HexagonalArchitecture;

class Request
{
    private array $params = [];

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function getParam(string $key): mixed
    {
        return $this->params[$key] ?? null;
    }
}
