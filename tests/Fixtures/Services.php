<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures;

use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model\BookShelf;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Transformer\AuthorTransformer;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Transformer\BookTransformer;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Transformer\CommentTransformer;

class Services
{
    // fractal transformers
    const BOOKS_TRANSFORMER = BookTransformer::class;
    const AUTHORS_TRANSFORMER = AuthorTransformer::class;
    const COMMENTS_TRANSFORMER = CommentTransformer::class;

    // repositories
    const BOOK_SHELF = BookShelf::class;
}
