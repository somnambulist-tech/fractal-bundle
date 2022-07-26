<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model;

final class BookShelf
{
    private array $books = [];

    public function __construct()
    {
    }

    public function books(): array
    {
        return $this->books;
    }

    public function put(Book $book): void
    {
        $this->books[] = $book;
    }

    public function take(Book $book): void
    {
        $bookIndex = array_search($book, $this->books, true);

        if (false === $bookIndex) {
            throw new \RuntimeException('There are no requested book on the shelf');
        }

        array_splice($this->books, $bookIndex, 1);
    }

    public function getAvailableAuthors(): array
    {
        return array_unique(array_map(function (Book $book) {

            return $book->author();
        }, $this->books), SORT_REGULAR);
    }

    public function getBooksOfTheAuthor(Author $author, int $limit = 0): array
    {
        $filtered = array_values(
            array_filter($this->books(), function (Book $book) use ($author) {
                return $book->isWrittenBy($author);
            })
        );

        if ($limit > 0) {
            return array_slice($filtered, 0, $limit);
        }

        return $filtered;
    }
}
