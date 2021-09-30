<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model;

use DateTime;

/**
 * Class Comment
 *
 * @package    Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model
 * @subpackage Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model\Comment
 */
class Comment
{
    private string   $id;
    private string   $message;
    private DateTime $addedAt;

    public function __construct(string $message)
    {
        $this->id      = uniqid('comm_');
        $this->message = $message;
        $this->addedAt = new DateTime();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function addedAt(): DateTime
    {
        return $this->addedAt;
    }
}
