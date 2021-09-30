<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Controller;

use League\Fractal\Manager;
use Symfony\Component\HttpFoundation\Request;

/**
 * Trait FractalTrait
 *
 * @package    Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Controller
 * @subpackage Somnambulist\Bundles\FractalBundle\Tests\Fixtures\Controller\FractalTrait
 */
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
