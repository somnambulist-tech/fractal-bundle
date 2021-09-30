<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Controller;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model\BookShelf;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Services;

/**
 * Class AuthorsController
 *
 * @package    Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Controller
 * @subpackage Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Controller\AuthorsController
 */
class AuthorsController extends AbstractController
{
    use FractalTrait;

    private BookShelf $bookShelf;

    public function __construct(BookShelf $bookShelf, Manager $manager)
    {
        $this->bookShelf = $bookShelf;
        $this->fractal   = $manager;
    }

    public function listOfAuthorsAction(Request $request)
    {
        $authors = $this->bookShelf->getAvailableAuthors();

        $resource = new Collection($authors, Services::AUTHORS_TRANSFORMER);

        return new JsonResponse(
            $this->fractal($request)->createData($resource)->toArray()
        );
    }
}
