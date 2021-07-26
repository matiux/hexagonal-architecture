<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Domain\Model;

interface Idee
{
    public function conId(IdIdea $id): ?Idea;

    public function aggiungi(Idea $idea): void;

    public function aggiorna(Idea $idea): void;

    public function nextId(): IdIdea;
}
