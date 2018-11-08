<?php

namespace HexagonalArchitecture\Step04\Application\Service\Idea;

use HexagonalArchitecture\Step04\Domain\Idea\Idea;

class RateIdeaResponse
{
    private $idea;

    public function __construct(Idea $idea)
    {
        $this->idea = $idea;
    }
}
