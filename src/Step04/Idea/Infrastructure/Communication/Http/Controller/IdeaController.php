<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Infrastructure\Communication\Http\Controller;

use HexagonalArchitecture\Request;
use HexagonalArchitecture\Step04\Idea\Application\Service\CreaIdea;
use HexagonalArchitecture\Step04\Idea\Application\Service\CreaIdeaRequest;
use HexagonalArchitecture\Step04\Idea\Application\Service\VotaIdea;
use HexagonalArchitecture\Step04\Idea\Application\Service\VotaIdeaRequest;
use HexagonalArchitecture\Step04\Idea\Domain\Model\Idea;
use HexagonalArchitecture\Step04\Idea\Domain\Model\IdIdea;
use HexagonalArchitecture\Step04\Idea\Infrastructure\Domain\Model\MySql\MySqlIdee;

class IdeaController
{
    public function createAction(Request $request): IdIdea
    {
        $service = new CreaIdea(new MySqlIdee());

        $ideaId = $service->execute(new CreaIdeaRequest(
            (string) $request->getParam('title'),
            (string) $request->getParam('author'),
            (string) $request->getParam('description')
        ));

        echo sprintf("Idea created with ID %s\n", (string) $ideaId);

        return $ideaId;
    }

    public function rateAction(Request $request): void
    {
        $service = new VotaIdea(new MySqlIdee());

        $response = $service->execute(new VotaIdeaRequest(
            (string) $request->getParam('id'),
            (float) $request->getParam('rating')
        ));

        if ($response->isSuccess()) {
            /** @var Idea $idea */
            $idea = $response->body();

            echo sprintf("Idea with ID %s updated\nNew score: %s", (string) $idea->id(), (string) $idea->punteggio());

            return;
        }

        echo sprintf("Errore nell'aggiornamento dell'idea\n");
    }
}
