<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model;

final class Author
{
    private string $id;
    private string $name;

    public function __construct(string $name)
    {
        $this->id   = uniqid('author_', true);
        $this->name = $name;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
