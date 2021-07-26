<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Application\Service;

use HexagonalArchitecture\Step04\Idea\Domain\Model\IdIdea;

class VotaIdea extends IdeaService
{
    public function execute(VotaIdeaRequest $rateIdeaRequest): VotaIdeaResponse
    {
        $ideaId = $rateIdeaRequest->idIdea();
        $rating = $rateIdeaRequest->punteggio();

        $idea = $this->findIdeaOrFail(IdIdea::createFrom($ideaId));

        $idea->vota($rating);
        $this->idee->aggiorna($idea);

        return VotaIdeaResponse::success($idea);
    }
}
