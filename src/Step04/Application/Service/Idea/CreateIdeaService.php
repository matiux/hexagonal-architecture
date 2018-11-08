<?php

namespace HexagonalArchitecture\Step04\Application\Service\Idea;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class CreateIdeaService extends IdeaService
{
    public function execute(CreateIdeaRequest $createIdeaRequest): UuidInterface
    {
        $title = $createIdeaRequest->getTitle();
        $author = $createIdeaRequest->getAuthor();
        $description = $createIdeaRequest->getDescription();

        $ideaId = Uuid::uuid4();

        $this->ideaRepository->create(
            $ideaId,
            $title,
            $author,
            $description
        );

        return $ideaId;
    }
}
