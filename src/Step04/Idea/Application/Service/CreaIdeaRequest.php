<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Application\Service;

class CreaIdeaRequest
{
    public function __construct(
        private string $titolo,
        private string $autore,
        private string $descrizione,
    ) {
    }

    public function titolo(): string
    {
        return $this->titolo;
    }

    public function autore(): string
    {
        return $this->autore;
    }

    public function descrizione(): string
    {
        return $this->descrizione;
    }
}
