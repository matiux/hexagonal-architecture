<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Application\Service;

use HexagonalArchitecture\Step04\Idea\Domain\Model\Idea;
use HexagonalArchitecture\Step04\Idea\Domain\Model\IdIdea;

class CreaIdea extends IdeaService
{
    public function execute(CreaIdeaRequest $createIdeaRequest): IdIdea
    {
        $titolo = $createIdeaRequest->titolo();
        $autore = $createIdeaRequest->autore();
        $descrizione = $createIdeaRequest->descrizione();

        $ideaId = $this->idee->nextId();

        $idea = Idea::crea(
            $ideaId,
            $titolo,
            $autore,
            $descrizione
        );

        $this->idee->aggiungi($idea);

        return $ideaId;
    }
}
