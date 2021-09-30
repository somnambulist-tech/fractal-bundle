<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model;

/**
 * Class Author
 *
 * @package    Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model
 * @subpackage Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model\Author
 */
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
