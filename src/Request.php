<?php

namespace HexagonalArchitecture;

class Request
{
    private $params = [];

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function getParam(string $key)
    {
        return array_key_exists($key, $this->params) ? $this->params[$key] : null;
    }
}
