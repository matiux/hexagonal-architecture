<?php

namespace HexagonalArchitecture\Step04\Application\Service\Idea;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class RateIdeaService extends IdeaService
{
    public function execute(RateIdeaRequest $rateIdeaRequest): UuidInterface
    {
        $ideaId = $rateIdeaRequest->getIdeaId();
        $rating = $rateIdeaRequest->getRating();

        $idea = $this->findIdeaOrFail(Uuid::fromString($ideaId));

        $idea->addRating($rating);
        $this->ideaRepository->update($idea);

        return $idea->getId();
    }
}
