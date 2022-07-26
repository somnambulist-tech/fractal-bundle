<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Transformer;

use League\Fractal\ParamBag;
use League\Fractal\TransformerAbstract;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model\Author;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model\BookShelf;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Services;

class AuthorTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['books'];

    public function __construct(private BookShelf $booksShelf)
    {
    }

    public function transform(Author $author)
    {
        return [
            'id' => $author->id(),
            'name' => $author->name(),
        ];
    }

    public function includeBooks(Author $author, ParamBag $params = null)
    {
        if (null === $params) {
            $params = new ParamBag(['limit' => []]);
        }

        [$limit] = $params->get('limit');
        $books = $this->booksShelf->getBooksOfTheAuthor($author, (int)$limit);

        return $this->collection($books, Services::BOOKS_TRANSFORMER);
    }
}
