<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Tests\Idea\Application\Service;

use HexagonalArchitecture\Step04\Idea\Application\Service\Exception\IdeaNotFoundException;
use HexagonalArchitecture\Step04\Idea\Application\Service\VotaIdea;
use HexagonalArchitecture\Step04\Idea\Application\Service\VotaIdeaRequest;
use HexagonalArchitecture\Step04\Idea\Domain\Model\Idea;
use HexagonalArchitecture\Step04\Idea\Domain\Model\Idee;
use HexagonalArchitecture\Step04\Idea\Domain\Model\IdIdea;
use Mockery;
use PHPUnit\Framework\TestCase;

class VotaIdeaTest extends TestCase
{
    /**
     * @test
     */
    public function when_idea_does_not_exist_an_exception_should_be_thrown_v1(): void
    {
        self::expectException(IdeaNotFoundException::class);

        $ideaRepository = Mockery::mock(Idee::class)
            ->shouldReceive('conId')
            ->with(Mockery::type(IdIdea::class))
            ->andReturn(null)
            ->getMock();

        $service = new VotaIdea($ideaRepository);

        $service->execute(
            new VotaIdeaRequest(
                (string) IdIdea::create(),
                4.0
            )
        );
    }

    /**
     * @test
     */
    public function when_idea_does_not_exist_an_exception_should_be_thrown_v2(): void
    {
        self::expectException(IdeaNotFoundException::class);

        $service = new VotaIdea(new EmptyIdee());

        $service->execute(
            new VotaIdeaRequest(
                (string) IdIdea::create(),
                4.0
            )
        );
    }
}

class EmptyIdee implements Idee
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
