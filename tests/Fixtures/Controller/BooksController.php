<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Controller;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model\BookShelf;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Services;

class BooksController extends AbstractController
{
    use FractalTrait;

    private BookShelf $bookShelf;

    public function __construct(BookShelf $bookShelf, Manager $manager)
    {
        $this->bookShelf = $bookShelf;
        $this->fractal   = $manager;
    }

    public function listOfBooksAction(Request $request)
    {
        $resource = new Collection($this->bookShelf->books(), Services::BOOKS_TRANSFORMER);

        return new JsonResponse(
            $this->fractal($request)->createData($resource)->toArray()
        );
    }
}
