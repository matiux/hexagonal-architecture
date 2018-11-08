<?php

namespace HexagonalArchitecture\Step01;

use Ramsey\Uuid\UuidInterface;

class Idea
{
    private $id;
    private $title;
    private $description;
    private $votes;
    private $author;
    private $rating;

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
        $this->votes++;
        $this->rating = ($rating + $this->rating) / $this->votes;
    }

    public function getRating(): int
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
