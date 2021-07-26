<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Infrastructure\Domain\Model\Redis;

use HexagonalArchitecture\Step04\Idea\Domain\Model\Idea;
use HexagonalArchitecture\Step04\Idea\Domain\Model\Idee;
use HexagonalArchitecture\Step04\Idea\Domain\Model\IdIdea;

class RedisIdee implements Idee
{
    public function conId(IdIdea $id): ?Idea
    {
        return null;
    }

    public function aggiungi(Idea $idea): void
    {
    }

    public function aggiorna(Idea $idea): void
    {
    }

    public function nextId(): IdIdea
    {
        return IdIdea::create();
    }
}
