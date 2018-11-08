<?php

namespace HexagonalArchitecture\Step04\Application\Service\Idea;

use HexagonalArchitecture\Step04\Application\Service\Idea\Exception\IdeaNotFoundException;
use HexagonalArchitecture\Step04\Domain\Idea\IdeaRepository;
use Ramsey\Uuid\UuidInterface;

abstract class IdeaService
{
    protected $ideaRepository;

    /**
     * IdeaService constructor.
     * @param IdeaRepository $ideaRepository
     *
     * Qui non c'è nulla che parla di dettagli infrastrutturali come MySql o Redis,
     * si parla solo di buisiness logic
     */
    public function __construct(IdeaRepository $ideaRepository)
    {
        $this->ideaRepository = $ideaRepository;
    }

    protected function findIdeaOrFail(UuidInterface $ideaId)
    {
        if (!$idea = $this->ideaRepository->find($ideaId)) {

            throw new IdeaNotFoundException(sprintf('Idea not found with id %s', $ideaId));
        }

        return $idea;
    }
}
