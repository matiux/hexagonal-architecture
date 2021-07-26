<?php

namespace HexagonalArchitecture\Step03\Idea\Domain\Model;

use Ramsey\Uuid\UuidInterface;

interface Idee
{
    public function conId(UuidInterface $id): ?Idea;

    public function aggiungi(UuidInterface $ideaId, string $title, string $author, string $description): bool;

    public function aggiorna(Idea $idea): bool;
}
