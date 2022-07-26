<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model;

use DateTime;

class Book
{
    private string   $id;
    private string   $name;
    private Author   $author;
    private array    $comments;
    private DateTime $addedAt;

    public function __construct(string $name, Author $author)
    {
        $this->id       = uniqid('book_');
        $this->name     = $name;
        $this->author   = $author;
        $this->comments = [];
        $this->addedAt  = new DateTime();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function author(): Author
    {
        return $this->author;
    }

    public function isWrittenBy(Author $author): bool
    {
        return $this->author->id() === $author->id();
    }

    public function comment($message): void
    {
        array_unshift($this->comments, new Comment($message));
    }

    /**
     * @return Comment[]
     */
    public function comments($limit = 0): array
    {
        if ($limit > 0) {
            return array_slice($this->comments, 0, $limit);
        }

        return $this->comments;
    }

    public function addedAt(): DateTime
    {
        return $this->addedAt;
    }
}
