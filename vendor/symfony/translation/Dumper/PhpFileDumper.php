<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\DependencyInjection\LazyLoadingFragmentHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LazyLoadingFragmentHandlerTest extends TestCase
{
    /**
     * @group legacy
     * @expectedDeprecation The Symfony\Component\HttpKernel\DependencyInjection\LazyLoadingFragmentHandler::addRendererService() method is deprecated since version 3.3 and will be removed in 4.0.
     */
    public function testRenderWithLegacyMappin