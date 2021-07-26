<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step03\Idea\Infrastructure\Domain\Model\MySql;

use Doctrine\DBAL\Connection;
use HexagonalArchitecture\ConnectionFactory;
use HexagonalArchitecture\Step03\Idea\Domain\Model\Idea;
use HexagonalArchitecture\Step03\Idea\Domain\Model\Idee;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class MySqlIdee implements Idee
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = ConnectionFactory::create();
    }

    public function conId(UuidInterface $id): ?Idea
    {
        $sql = 'SELECT * FROM ideas WHERE id = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $id->toString());
        $result = $stmt->executeQuery();

        if (!$row = $result->fetchAssociative()) {
            return null;
        }

        $idea = new Idea();
        $idea->setId(Uuid::fromString((string) $row['id']));
        $idea->setTitle((string) $row['title']);
        $idea->setDescription((string) $row['description']);
        $idea->setAuthor((string) $row['author']);
        $idea->setVotes((int) $row['votes']);
        $idea->setRating((float) $row['rating']);

        return $idea;
    }

    public function aggiungi(UuidInterface $ideaId, string $title, string $author, string $description): bool
    {
        $insered = $this->connection->insert('ideas', [
            'id' => $ideaId->toString(),
            'title' => $title,
            'author' => $author,
            'description' => $description,
        ]);

        return $insered > 1;
    }

    public function aggiorna(Idea $idea): bool
    {
        $data = [
            'rating' => $idea->getRating(),
            'votes' => $idea->getVotes(),
        ];

        $updated = $this->connection->update('ideas', $data, ['id' => (string) $idea->getId()]);

        return $updated > 0;
    }
}
