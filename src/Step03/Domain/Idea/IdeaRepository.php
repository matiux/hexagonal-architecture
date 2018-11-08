<?php

namespace HexagonalArchitecture\Step03\Domain\Idea;

use Ramsey\Uuid\UuidInterface;

interface IdeaRepository
{
    public function find(UuidInterface $id): ?Idea;

    public function create(UuidInterface $ideaId, string $title, string $author, string $description): bool;

    public function update(Idea $idea): bool;
}
