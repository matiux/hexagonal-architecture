<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step01;

use Doctrine\DBAL\Connection;
use Exception;
use HexagonalArchitecture\Request;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Single Responsibility Principle (SRP) completamente non rispettato.
 */
class IdeaController
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param Request $request
     *
     * @throws \Doctrine\DBAL\Exception
     *
     * @return UuidInterface
     */
    public function createAction(Request $request): UuidInterface
    {
        $idIdea = Uuid::uuid4();

        $this->connection->insert('ideas', [
            'id' => (string) $idIdea,
            'title' => $request->getParam('title'),
            'author' => $request->getParam('author'),
            'description' => $request->getParam('description'),
        ]);

        echo sprintf("Idea creata. ID: %s - Voti:\n", (string) $idIdea);

        return $idIdea;
    }

    /**
     * @param Request $request
     *
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function rateAction(Request $request): void
    {
        $idIdea = (string) $request->getParam('id');
        $punteggio = (float) $request->getParam('rating');

        $sql = 'SELECT * FROM ideas WHERE id = ?';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $idIdea);
        $result = $stmt->executeQuery();
        $row = $result->fetchAssociative();

        if (!$row) {
            throw new Exception('Idea does not exist');
        }

        $idea = new Idea();
        $idea->impostaId(Uuid::fromString((string) $row['id']));
        $idea->impostaTitolo((string) $row['title']);
        $idea->impostaDescrizione((string) $row['description']);
        $idea->impostaAutore((string) $row['author']);
        $idea->impostaVoti((int) $row['votes']);
        $idea->impostaPunteggio((float) $row['rating']);

        $idea->vota($punteggio);

        $data = [
            'rating' => $idea->punteggio(),
            'votes' => $idea->voti(),
        ];

        $this->connection->update('ideas', $data, ['id' => $idIdea]);

        echo sprintf("Idea with ID %s updated\n", $idIdea);
    }
}
