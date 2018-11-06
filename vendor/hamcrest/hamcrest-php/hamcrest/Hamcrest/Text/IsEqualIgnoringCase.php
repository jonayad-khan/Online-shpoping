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
use Symfony\Component\HttpKernel\DependencyInjection\AddAnnotatedClassesToCachePass;

class AddAnnotatedClassesToCachePassTest extends TestCase
{
    public function testExpandClasses()
    {
        $r = new \ReflectionClass(AddAnnotatedClassesToCachePass::class);
        $pass = $r->newInstanceWithoutConstructor();
        $r = new \ReflectionMethod(AddAnnotatedClassesToCachePass::class, 'expandClasses');
        $r->setAccessible(true);
        $expand = $r->getClosure($pass);

        $this->assertSame('Foo', $expand(array('Foo'), array())[0]);
        $this->assertSame('Foo', $expand(array('\\Foo'), array())[0]);
        $this->assertSame('Foo', $expand(array('Foo'), array('\\Foo'))[0]);
        $this->assertSame('Foo', $expand(array('Foo'), array('Foo'))[0]);
        $this->assertSame('Foo', $expand(array('\\Foo'), array('\\Foo\\Bar'))[0]);
        $thi