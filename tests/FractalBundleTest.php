<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Controller\BooksController;
use Symfony\Component\HttpFoundation\Request;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\App;

class FractalBundleTest extends TestCase
{
    private ?App $app;

    public function setUp(): void
    {
        $this->app = new App('test', true);
    }

    public function tearDown(): void
    {
        $this->app->shutdown();
        $this->app = null;
    }

    public function test_authors_list()
    {
        $json = $this->request('/authors');

        $this->assertCount(2, $json['data']);
        $this->assertArrayNotHasKey('books', $json['data'][0]);
    }

    public function test_authors_list_with_limited_amount_of_books()
    {
        $json = $this->request('/authors?include=books:limit(3)');

        $this->assertCount(2, $json['data']);
        foreach ($json['data'] as $author) {
            $this->assertCount(3, $author['books']['data']);
        }
    }

    public function test_books_list()
    {
        $json = $this->request('/books');

        $this->assertCount(14, $json['data']);
    }

    public function test_books_list_with_authors()
    {
        $json = $this->request('/books?include=author');

        $this->assertCount(14, $json['data']);
        $this->arrayHasKey('author', $json['data'][0]['author']);
    }

    public function test_missing_transformers_raises_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Transformer "Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Transformer\CommentTransformer" is not a callable or instance of League\Fractal\TransformerAbstract; did you optionally tag as a service using "somnambulist.fractal_bundle.transformer"');

        $this->app->boot();
        $this->app->getContainer()->get(BooksController::class)->listOfBooksAction(Request::create('/books', 'GET', ['include' => 'comments']));
    }

    private function request(string $uri): array
    {
        $response = $this->app->handle(Request::create($uri, 'GET'));
        $json     = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(JSON_ERROR_NONE, json_last_error());

        return $json;
    }
}
