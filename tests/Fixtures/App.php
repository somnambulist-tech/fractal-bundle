<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures;

use Somnambulist\Bundles\FractalBundle\SomnambulistFractalBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model\Author;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model\Book;

/**
 * Class App
 *
 * @package    Somnambulist\Bundles\FractalBundle\Tests\Fixtures
 * @subpackage Somnambulist\Bundles\FractalBundle\Tests\Fixtures\App
 */
class App extends Kernel
{
    protected function buildContainer()
    {
        $container = parent::buildContainer();

        return $container;
    }

    public function boot()
    {
        parent::boot();

        $this->populateData();
    }

    public function registerBundles()
    {
        $bundles = [
            new FrameworkBundle(),
            new SomnambulistFractalBundle(),
            new AppBundle(),
        ];

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/Resources/config.yml');
    }

    private function populateData()
    {
        $shelf = $this->getContainer()->get(Services::BOOK_SHELF);

        $author = new Author('Some Author 1');
        $shelf->put($this->fakeBook($author, 'Book 1'));
        $shelf->put($this->fakeBook($author, 'Book 2'));
        $shelf->put($this->fakeBook($author, 'Book 3'));
        $shelf->put($this->fakeBook($author, 'Book 4'));
        $shelf->put($this->fakeBook($author, 'Book 5'));
        $shelf->put($this->fakeBook($author, 'Book 6'));
        $shelf->put($this->fakeBook($author, 'Book 7'));

        $author = new Author('Some Author 2');
        $shelf->put($this->fakeBook($author, 'Book 8'));
        $shelf->put($this->fakeBook($author, 'Book 9'));
        $shelf->put($this->fakeBook($author, 'Book 10'));
        $shelf->put($this->fakeBook($author, 'Book 11'));
        $shelf->put($this->fakeBook($author, 'Book 12'));
        $shelf->put($this->fakeBook($author, 'Book 13'));
        $shelf->put($this->fakeBook($author, 'Book 14'));
    }

    private function fakeBook(Author $author, $name)
    {
        $book = new Book($name, $author);
        $book->comment('Some Comment 1');
        $book->comment('Some Comment 2');
        $book->comment('Some Comment 3');
        $book->comment('Some Comment 4');
        $book->comment('Some Comment 5');

        return $book;
    }
}
