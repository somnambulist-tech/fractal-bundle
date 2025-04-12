Change Log
==========

2025-04-12
----------

 * fix additional deprecations
 * switch to PHPUnit 11.X
 * drop PHP 8.1 from test suite

2024-12-01
----------

 * fix PHP 8.4 deprecations

2024-02-24
----------

 * require Symfony 6.4+
 * add support for Symfony 7

2022-07-11
----------

 * remove unnecessary docblock comments

2022-03-10
----------

 * update to league/fractal 0.20.0, note this is a BC break 0.20 adds type hints

2021-12-14
----------

 * allow Symfony 6.0
 * require Symfony 5.3+

2021-09-30
----------

Initial commit forked from https://github.com/samjarrett/FractalBundle

 * require PHP 8+
 * require Symfony 5.2+
 * add ScopeFactory with tagged locator instead of service container
 * remove ContainerAwareManager (not needed due to ScopeFactory)
