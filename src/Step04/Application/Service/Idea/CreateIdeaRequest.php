<?php

namespace HexagonalArchitecture\Step04\Application\Service\Idea;

class CreateIdeaRequest
{
    private $title;
    private $author;
    private $description;

    public function __construct(string $title, string $author, string $description)
    {
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
