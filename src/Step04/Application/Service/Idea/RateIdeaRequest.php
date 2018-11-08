<?php

namespace HexagonalArchitecture\Step04\Application\Service\Idea;

class RateIdeaRequest
{
    private $ideaId;
    private $rating;

    public function __construct(string $ideaId, float $rating)
    {
        $this->ideaId = $ideaId;
        $this->rating = $rating;
    }

    public function getIdeaId(): string
    {
        return $this->ideaId;
    }

    public function getRating(): float
    {
        return $this->rating;
    }


}
