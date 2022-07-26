<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Transformer;

use DateTime;
use Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Model\Comment;

class CommentTransformer
{
    public function transform(Comment $comment)
    {
        return [
            'id'         => $comment->id(),
            'message'    => $comment->message(),
            'created_at' => $comment->addedAt()->format(DateTime::ATOM),
        ];
    }
}
