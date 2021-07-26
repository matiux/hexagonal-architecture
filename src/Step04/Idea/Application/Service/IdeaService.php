<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Application\Service;

use HexagonalArchitecture\Step04\Idea\Application\Service\Exception\IdeaNotFoundException;
use HexagonalArchitecture\Step04\Idea\Domain\Model\Idea;
use HexagonalArchitecture\Step04\Idea\Domain\Model\Idee;
use HexagonalArchitecture\Step04\Idea\Domain\Model\IdIdea;

abstract class IdeaService
{
    /**
     * @param Idee $idee
     *
     * Qui non c'è nulla che parla di dettagli infrastrutturali come MySql o Redis,
     * si parla solo di business logic
     */
    public function __construct(
        protected Idee $idee
    ) {
    }

    /**
     * @param IdIdea $ideaId
     *
     * @throws IdeaNotFoundException
     *
     * @return Idea
     */
    protected function findIdeaOrFail(IdIdea $ideaId): Idea
    {
        if (!$idea = $this->idee->conId($ideaId)) {
            throw new IdeaNotFoundException(sprintf('Idea not found with id %s', (string) $ideaId));
        }

        return $idea;
    }
}
