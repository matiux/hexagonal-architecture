<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step04\Idea\Infrastructure\Domain\Model\MySql;

use Doctrine\DBAL\Connection;
use HexagonalArchitecture\ConnectionFactory;
use HexagonalArchitecture\Step04\Idea\Domain\Model\Idea;
use HexagonalArchitecture\Step04\Idea\Domain\Model\Idee;
use HexagonalArchitecture\Step04\Idea\Domain\Model\IdIdea;

class MySqlIdee implements Idee
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = ConnectionFactory::create();
    }

    public function conId(IdIdea $id): ?Idea
    {
        $sql = 'SELECT * FROM ideas WHERE id = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, (string) $id);
        $result = $stmt->executeQuery();

        if (!$row = $result->fetchAssociative()) {
            return null;
        }

        $idea = Idea::crea(
            IdIdea::createFrom((string) $row['id']),
            (string) $row['title'],
            (string) $row['author'],
            (string) $row['description']
        );

        // TODO - Modello anemico
        $idea->setVoti((int) $row['votes']);
        $idea->setPunteggio((float) $row['rating']);

        return $idea;
    }

    public function aggiungi(Idea $idea): void
    {
//        try {
        $this->connection->insert('ideas', [
            'id' => (string) $idea->id(),
            'title' => $idea->titolo(),
            'author' => $idea->autore(),
            'description' => $idea->descrizione(),
        ]);
//        } catch (\Throwable $t) {
//            // TODO - Faccio qualcosa
//        }
    }

    public function aggiorna(Idea $idea): void
    {
//        try {
        $data = [
            'rating' => $idea->punteggio(),
            'votes' => $idea->voti(),
        ];

        $this->connection->update('ideas', $data, ['id' => (string) $idea->id()]);
//        } catch (\Throwable $t) {
//            // TODO - Faccio qualcosa
//        }
    }

    public function nextId(): IdIdea
    {
        return IdIdea::create();
    }
}
