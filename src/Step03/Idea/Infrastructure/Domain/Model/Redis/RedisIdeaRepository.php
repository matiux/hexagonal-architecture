<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step03\Idea\Infrastructure\Domain\Model\Redis;

use HexagonalArchitecture\Step03\Idea\Domain\Model\Idea;
use HexagonalArchitecture\Step03\Idea\Domain\Model\Idee;
use Ramsey\Uuid\UuidInterface;

class RedisIdeaRepository implements Idee
{
    public function conId(UuidInterface $id): ?Idea
    {
        return null;
    }

    public function aggiungi(UuidInterface $ideaId, string $title, string $author, string $description): bool
    {
        return true;
    }

    public function aggiorna(Idea $idea): bool
    {
        return true;
    }
}
