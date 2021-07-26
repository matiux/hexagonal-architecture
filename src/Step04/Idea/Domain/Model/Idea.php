<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Domain\Model;

use DDDStarterPack\Domain\Aggregate\IdentifiableDomainObject;

/**
 * @psalm-suppress MissingConstructor
 */
final class Idea implements IdentifiableDomainObject
{
    private int $voti = 0;
    private float $punteggio = 0.0;

    private function __construct(
        private IdIdea $id,
        private string $titolo,
        private string $autore,
        private string $descrizione,
    ) {
    }

    public static function crea(IdIdea $id, string $titolo, string $autore, string $descrizione): self
    {
        return new self($id, $titolo, $autore, $descrizione);
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

    public function vota(float $punteggio): void
    {
        ++$this->voti;
        $this->punteggio = ($punteggio + $this->punteggio) / $this->voti;
    }

    public function punteggio(): float
    {
        return $this->punteggio;
    }

    public function voti(): int
    {
        return $this->voti;
    }

    public function id(): IdIdea
    {
        return $this->id;
    }

    public function setVoti(int $voti): void
    {
        $this->voti = $voti;
    }

    public function setPunteggio(float $punteggio): void
    {
        $this->punteggio = $punteggio;
    }
}
