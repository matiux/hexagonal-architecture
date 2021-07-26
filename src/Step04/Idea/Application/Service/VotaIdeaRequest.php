<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Application\Service;

class VotaIdeaRequest
{
    public function __construct(
        private string $ideaId,
        private float $punteggio,
    ) {
    }

    public function idIdea(): string
    {
        return $this->ideaId;
    }

    public function punteggio(): float
    {
        return $this->punteggio;
    }
}
