<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Controller;

use League\Fractal\Manager;
use Symfony\Component\HttpFoundation\Request;

trait FractalTrait
{
    protected Manager $fractal;

    protected function fractal(Request $request): Manager
    {
        if ($request->query->has('include')) {
            $this->fractal->parseIncludes($request->query->get('include'));
        }

        return $this->fractal;
    }
}
