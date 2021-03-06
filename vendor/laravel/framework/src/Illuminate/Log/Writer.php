<?php

namespace Illuminate\Support;

use Countable;
use Illuminate\Contracts\Support\MessageBag as MessageBagContract;

/**
 * @mixin \Illuminate\Contracts\Support\MessageBag
 */
class ViewErrorBag implements Countable
{
    /**
     * The array of the view error bags.
     *
     * @var array
     */
    protected $bags = [];

    /**
     * Checks if a named MessageBag exists in the bags.
     *
     * @param  string  $key
     * @return bool
     */
    public function hasBag($key = 'default')
    {
        return isset($this->bags[$key]);
    }

    /**
     * Get a MessageBag instance from the bags.
     *
     * @param  string  $key
     * @return \Illuminate\Contracts\Support\MessageBag
     */
    public function getBag($key)
    {
        return Arr::get($this->bags, $key) ?: new MessageBag;
    }

    /**
     * Get all the bags.
     *
     * @return array
     */
    public function getBags()
    {
        return $this->bags;
    }

    /**
     * Add a new MessageBag instance to the bags.
     *
     * @param  string  $key
     * @param  \Illuminate\Contracts\Support\MessageBag  $bag
     * @return $this
     */
    public function put($key, MessageBagContract $bag)
    {
        $this->bags[$key] = $bag;

        return $this;
    }

    /**
     * Determine if the default message bag has any messages.
     *
     * @return bool
     */
    public function any()
    {
        return $this->count() > 0;
    }

    /**
     * Get the number of messages in the default bag.
     *
     * @return int
     */
    public function count()
    {
        return $this->getBag('default')->count();
    }

    /**
     * Dynamically call methods on the default bag.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->getBag('default')->$method(...$parameters);
    }

    /**
     * Dynamically access a view error bag.
     *
     * @param  string  $key
     * @return \Illuminate\Contracts\Support\MessageBag
     */
    public function __get($key)
    {
        return $this->getBag($key);
    }

    /**
     * Dynamically set a view error bag.
     *
     * @param  string  $key
     * @param  \Illuminate\Contracts\Support\MessageBag  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->put($key, $value);
    }

    /**
     * Convert the default bag to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getBag('default');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2018 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Test\CodeCleaner;

use Psy\CodeCleaner\CalledClassPass;

class CalledClassPassTest extends CodeCleanerTestCase
{
    public function setUp()
    {
        $this->setPass(new CalledClassPass());
    }

    /**
     * @dataProvider invalidStatements
     * @expectedException \Psy\Exception\ErrorException
     */
    public function testProcessStatementFails($code)
    {
        $this->parseAndTraverse($code);
    }

    public function invalidStatements()
    {
        return [
            ['get_class()'],
            ['get_class(null)'],
            ['get_called_class()'],
            ['get_called_class(null)'],
            ['function foo() { return get_class(); }'],
            ['function foo() { return get_class(null); }'],
            ['function foo() { return get_called_class(); }'],
            ['function foo() { return get_called_class(null); }'],
        ];
    }

    /**
     * @dataProvider validStatements
     */
    public function testProcessStatementPasses($code)
    {
        $this->parseAndTraverse($code);
        $this->assertTrue(true);
    }

    public function validStatements()
    {
        return [
            ['get_class($foo)'],
            ['get_class(bar())'],
            ['get_called_class($foo)'],
            ['get_called_class(bar())'],
            ['function foo($bar) { return get_class($bar); }'],
            ['function foo($bar) { return get_called_class($bar); }'],
            ['class Foo { function bar() { return get_class(); } }'],
            ['class Foo { function bar() { return get_class(null); } }'],
            ['class Foo { function bar() { return get_called_class(); } }'],
            ['class Foo { function bar() { return get_called_class(null); } }'],
            ['$foo = function () {}; $foo()'],
        ];
    }

    /**
     * @dataProvider validTraitStatements
     */
    public function testProcessTraitStatementPasses($code)
    {
        $this->parseAndTraverse($code);
        $this->assertTrue(true);
    }

    public function validTraitStatements()
    {
        return [
            ['trait Foo { function bar() { return get_class(); } }'],
            ['trait Foo { function bar() { return get_class(null); } }'],
            ['trait Foo { function bar() { return get_called_class(); } }'],
            ['trait Foo { function bar() { return get_called_class(null); } }'],
        ];
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php
namespace Hamcrest\Core;

/*
 Copyright (c) 2009 hamcrest.org
 */
use Hamcrest\BaseMatcher;
use Hamcrest\Description;

/**
 * Is the value the same object as another value?
 * In PHP terms, does $a === $b?
 */
class IsSame extends BaseMatcher
{

    private $_object;

    public function __construct($object)
    {
        $this->_object = $object;
    }

    public function matches($object)
    {
        return ($object === $this->_object) && ($this->_object === $object);
    }

    public function describeTo(Description $description)
    {
        $description->appendText('sameInstance(')
                                ->appendValue($this->_object)
                                ->appendText(')')
                                ;
    }

    /**
     * Creates a new instance of IsSame.
     *
     * @param mixed $object
     *   The predicate evaluates to true only when the argument is
     *   this object.
     *
     * @return \Hamcrest\Core\IsSame
     * @factory
     */
    public static function sameInstance($object)
    {
        return new self($object);
    }
}
                                                                                                                                                                                                                                                                               