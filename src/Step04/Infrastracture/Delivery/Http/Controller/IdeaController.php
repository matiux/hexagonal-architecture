<?php

namespace HexagonalArchitecture\Step04\Infrastracture\Delivery\Http\Controller;

use HexagonalArchitecture\Request;
use HexagonalArchitecture\Step04\Application\Service\Idea\CreateIdeaRequest;
use HexagonalArchitecture\Step04\Application\Service\Idea\CreateIdeaService;
use HexagonalArchitecture\Step04\Application\Service\Idea\RateIdeaRequest;
use HexagonalArchitecture\Step04\Application\Service\Idea\RateIdeaService;
use HexagonalArchitecture\Step04\Infrastracture\Domain\Idea\MySql\MySqlIdeaRepository;
use Ramsey\Uuid\UuidInterface;

/**
 *
 */
class IdeaController
{
    public function rateAction(Request $request)
    {
        $service = new RateIdeaService(new MySqlIdeaRepository());

        $updatedIdeaId = $service->execute(new RateIdeaRequest(
            $request->getParam('id'),
            $request->getParam('rating')
        ));

        echo sprintf("Idea with ID %s updated\n", $updatedIdeaId);
    }

    public function createAction(Request $request): UuidInterface
    {
        $service = new CreateIdeaService(new MySqlIdeaRepository());

        $ideaId = $service->execute(new CreateIdeaRequest(
            $request->getParam('title'),
            $request->getParam('author'),
            $request->getParam('description')
        ));

        echo sprintf("Idea created with ID %s\n", $ideaId);

        return $ideaId;
    }
}
