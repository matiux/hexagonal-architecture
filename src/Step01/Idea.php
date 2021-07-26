<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step01;

use Ramsey\Uuid\UuidInterface;

/**
 * @psalm-suppress MissingConstructor
 */
class Idea
{
    private UuidInterface $id;
    private string $titolo;
    private string  $descrizione;
    private int $voti;
    private string $autore;
    private float $punteggio;

    public function impostaId(UuidInterface $id): void
    {
        $this->id = $id;
    }

    public function impostaTitolo(string $titolo): void
    {
        $this->titolo = $titolo;
    }

    public function impostaDescrizione(string $descrizione): void
    {
        $this->descrizione = $descrizione;
    }

    public function impostaAutore(string $autore): void
    {
        $this->autore = $autore;
    }

    public function impostaVoti(int $voti): void
    {
        $this->voti = $voti;
    }

    public function impostaPunteggio(float $punteggio): void
    {
        $this->punteggio = $punteggio;
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

    public function id(): UuidInterface
    {
        return $this->id;
    }
}
