<?php

namespace HexagonalArchitecture\Step02;

use HexagonalArchitecture\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Disaccopiamo la gestione del database usando un Repository.
 * In questo modo il controller parla delle regole di business dove il repository è un concetto
 * di business:
 * Il repository è un posto da cui prendere o in cui mettere le idee
 *
 * Repository by Martin Fowler:
 * mediates between the domain and data mapping layers using a collection-like interface
 * for accessing domain objects.
 *
 * Con il repository vediamo uno dei lati dell'esagono, il lato "persistenza" che però
 * non è ancora ben disegnato in quanto c'è ancora qualche relazione tra ciò che un
 * IdeaRepository è e come è implementato.
 *
 * Nello Step03 vedremo come separare realmente il limite dell'applicazione da
 * quello dell'infrastruttura disaccoppiando il comportamento dall'implementazione
 */
class IdeaController
{
    public function rateAction(Request $request)
    {
        $ideaId = $request->getParam('id');
        $rating = $request->getParam('rating');

        $ideaRepository = new IdeaRepository();
        $idea = $ideaRepository->find(Uuid::fromString($ideaId));

        if (!$idea) {
            throw new \Exception ('Idea does not exist');
        }

        $idea->addRating($rating);
        $ideaRepository->update($idea);

        echo sprintf("Idea with ID %s updated\n", $ideaId);
    }

    public function createAction(Request $request): UuidInterface
    {
        $ideaRepository = new IdeaRepository();

        $ideaId = Uuid::uuid4();

        $ideaRepository->create(
            $ideaId,
            $request->getParam('title'),
            $request->getParam('author'),
            $request->getParam('description')
        );

        echo sprintf("Idea created with ID %s\n", $ideaId->toString());

        return $ideaId;
    }
}
