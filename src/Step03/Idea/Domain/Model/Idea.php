<?php

declare(strict_types=1);

namespace HexagonalArchitecture\Step03\Idea\Domain\Model;

use Ramsey\Uuid\UuidInterface;

/**
 * @psalm-suppress MissingConstructor
 */
class Idea
{
    private UuidInterface $id;
    private string $title;
    private string $description;
    private int $votes;
    private string $author;
    private float $rating;

    public function setId(UuidInterface $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function setVotes(int $votes): void
    {
        $this->votes = $votes;
    }

    public function setRating(float $rating): void
    {
        $this->rating = $rating;
    }

    public function addRating(float $rating): void
    {
        ++$this->votes;
        $this->rating = ($rating + $this->rating) / $this->votes;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function getVotes(): int
    {
        return $this->votes;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
