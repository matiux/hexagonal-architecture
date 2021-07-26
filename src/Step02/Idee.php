<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step02;

use Doctrine\DBAL\Connection;
use HexagonalArchitecture\ConnectionFactory;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Idee
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
        $idea->impostaId(Uuid::fromString((string) $row['id']));
        $idea->impostaTitolo((string) $row['title']);
        $idea->impostaDescrizione((string) $row['description']);
        $idea->impostaAutore((string) $row['author']);
        $idea->impostaVoti((int) $row['votes']);
        $idea->impostaPunteggio((float) $row['rating']);

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

    public function update(Idea $idea): bool
    {
        $data = [
            'rating' => $idea->punteggio(),
            'votes' => $idea->voti(),
        ];

        $updated = $this->connection->update('ideas', $data, ['id' => (string) $idea->id()]);

        return $updated > 0;
    }
}
