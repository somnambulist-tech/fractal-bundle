Change Log
==========

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
