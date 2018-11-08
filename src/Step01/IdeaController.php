<?php

namespace HexagonalArchitecture\Step01;

use HexagonalArchitecture\Request;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Single Responsibility Principle (SRP) completamente non rispettato.
 */
class IdeaController
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function rateAction(Request $request)
    {
        $ideaId = $request->getParam('id');
        $rating = $request->getParam('rating');

        $sql = 'SELECT * FROM ideas WHERE id = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $ideaId);
        $stmt->execute();

        $row = $stmt->fetch();

        if (!$row) {
            throw new \Exception ('Idea does not exist');
        }

        $idea = new Idea();
        $idea->setId(Uuid::fromString($row['id']));
        $idea->setTitle($row['title']);
        $idea->setDescription($row['description']);
        $idea->setAuthor($row['author']);
        $idea->setVotes($row['votes']);
        $idea->setRating($row['rating']);

        $idea->addRating($rating);

        $data = [
            'rating' => $idea->getRating(),
            'votes' => $idea->getVotes(),
        ];

        $this->connection->update('ideas', $data, array('id' => $ideaId));

        echo sprintf("Idea with ID %s updated\n", $ideaId);
    }

    public function createAction(Request $request): UuidInterface
    {
        $ideaId = Uuid::uuid4();

        $this->connection->insert('ideas', [
            'id' => $ideaId->toString(),
            'title' => $request->getParam('title'),
            'author' => $request->getParam('author'),
            'description' => $request->getParam('description')
        ]);

        echo sprintf("Idea created with ID %s\n", $ideaId->toString());

        return $ideaId;
    }
}
