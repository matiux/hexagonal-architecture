<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step03\Idea\Infrastructure\Communication\Http\Controller;

use Exception;
use HexagonalArchitecture\Request;
use HexagonalArchitecture\Step03\Idea\Infrastructure\Domain\Model\MySql\MySqlIdee;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class IdeaController
{
    public function createAction(Request $request): UuidInterface
    {
        $ideaRepository = new MySqlIdee();

        $ideaId = Uuid::uuid4();

        $ideaRepository->aggiungi(
            $ideaId,
            (string) $request->getParam('title'),
            (string) $request->getParam('author'),
            (string) $request->getParam('description')
        );

        echo sprintf("Idea created with ID %s\n", $ideaId->toString());

        return $ideaId;
    }

    public function rateAction(Request $request): void
    {
        $ideaId = (string) $request->getParam('id');
        $rating = (float) $request->getParam('rating');

        $ideaRepository = new MySqlIdee();

        if (!$idea = $ideaRepository->conId(Uuid::fromString($ideaId))) {
            throw new Exception('Idea does not exist');
        }

        $idea->addRating($rating);
        $ideaRepository->aggiorna($idea);

        echo sprintf("Idea with ID %s updated\n", $ideaId);
    }
}
