<?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\CodeCleaner;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\ConstFetch;
use Psy\Exception\FatalErrorException;

/**
 * Validate that namespaced constant references will succeed.
 *
 * This pass throws a FatalErrorException rather than letting PHP run
 * headfirst into a real fatal error and die.
 *
 * @todo Detect constants defined in the current code snippet?
 *       ... Might not be worth it, since it would need to both be defining and
 *       referencing a namespaced constant, which doesn't seem like that big of
 *       a target for failure
 */
class ValidConstantPass extends NamespaceAwarePass
{
    /**
     * Validate that namespaced constant references will succeed.
     *
     * Note that this does not (yet) detect constants defined in the current code
     * snippet. It won't happen very often, so we'll punt for now.
     *
     * @throws FatalErrorException if a constant reference is not defined
     *
     * @param Node $node
     */
    public function leaveNode(Node $node)
    {
        if ($node instanceof ConstFetch && count($node->name->parts) > 1) {
            $name = $this->getFullyQualifiedName($node->name);
            if (!defined($name)) {
                $msg = sprintf('Undefined constant %s', $name);
                throw new FatalErrorException($msg, 0, E_ERROR, null, $node->getLine());
            }
        } elseif ($node instanceof ClassConstFetch) {
            $this->validateClassConstFetchExpression($node);
        }
    }

    /**
     * Validate a class constant fetch expression.
     *
     * @throws FatalErrorException if a class constant is not defined
     *
     * @param ClassConstFetch $stmt
     */
    protected function validateClassConstFetchExpression(ClassConstFetch $stmt)
    {
        // give the `class` pseudo-constant a pass
        if ($stmt->name === 'class') {
            return;
        }

        // if class name is an expression, give it a pass for now
        if (!$stmt->class instanceof Expr) {
            $className = $this->getFullyQualifiedName($stmt->class);

            // if the class doesn't exist, don't throw an exception… it might be
            // defined in the same line it's used or something stupid like that.
            if (class_exists($className) || interface_exists($className)) {
                $refl = new \ReflectionClass($className);
                if (!$refl->hasConstant($stmt->name)) {
                    $constType = class_exists($className) ? 'Class' : 'Interface';
                    $msg = sprintf('%s constant \'%s::%s\' not found', $constType, $className, $stmt->name);
                    throw new FatalErrorException($msg, 0, E_ERROR, null, $stmt->getLine());
                }
            }
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php
/*
 * This file is part of Object Enumerator.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\ObjectEnumerator;

use SebastianBergmann\ObjectEnumerator\Fixtures\ExceptionThrower;
use PHPUnit\Framework\TestCase;

/**
 * @covers SebastianBergmann\ObjectEnumerator\Enumerator
 */
class EnumeratorTest extends TestCase
{
    /**
     * @var Enumerator
     */
    private $enumerator;

    protected function setUp()
    {
        $this->enumerator = new Enumerator;
    }

    public function testEnumeratesSingleObject()
    {
        $a = new \stdClass;

        $objects = $this->enumerator->enumerate($a);

        $this->assertCount(1, $objects);
        $this->assertSame($a, $objects[0]);
    }

    public function testEnumeratesArrayWithSingleObject()
    {
        $a = new \stdClass;

        $objects = $this->enumerator->enumerate([$a]);

        $this->assertCount(1, $objects);
        $this->assertSame($a, $objects[0]);
    }

    public function testEnumeratesArrayWithTwoReferencesToTheSameObject()
    {
        $a = new \stdClass;

        $objects = $this->enumerator->enumerate([$a, $a]);

        $this->assertCount(1, $objects);
        $this->assertSame($a, $objects[0]);
    }

    public function testEnumeratesArrayOfObjects()
    {
        $a = new \stdClass;
        $b = new \stdClass;

        $objects = $this->enumerator->enumerate([$a, $b, null]);

        $this->assertCount(2, $objects);
        $this->assertSame($a, $objects[0]);
        $this->assertSame($b, $objects[1]);
    }

    public function testEnumeratesObjectWithAggregatedObject()
    {
        $a = new \stdClass;
        $b = new \stdClass;

        $a->b = $b;
        $a->c = null;

        $objects = $this->enumerator->enumerate($a);

        $this->assertCount(2, $objects);
        $this->assertSame($a, $objects[0]);
        $this->assertSame($b, $objects[1]);
    }

    public function testEnumeratesObjectWithAggregatedObjectsInArray()
    {
        $a = new \stdClass;
        $b = new \stdClass;

        $a->b = [$b];

        $objects = $this->enumerator->enumerate($a);

        $this->assertCount(2, $objects);
        $this->assertSame($a, $objects[0]);
        $this->assertSame($b, $objects[1]);
    }

    public function testEnumeratesObjectsWithCyclicReferences()
    {
        $a = new \stdClass;
        $b = new \stdClass;

        $a->b = $b;
        $b->a = $a;

        $objects = $this->enumerator->enumerate([$a, $b]);

        $this->assertCount(2, $objects);
        $this->assertSame($a, $objects[0]);
        $this->assertSame($b, $objects[1]);
    }

    public function testEnumeratesClassThatThrowsException()
    {
        $thrower = new ExceptionThrower();

        $objects = $this->enumerator->enumerate($thrower);

        $this->assertSame($thrower, $objects[0]);
    }

    public function testExceptionIsRaisedForInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->enumerator->enumerate(null);
    }

    public function testExceptionIsRaisedForInvalidArgument2()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->enumerator->enumerate([], '');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             CHANGELOG
=========

3.3.0
-----

* added `ExceptionListener`
* added `AddConsoleCommandPass` (originally in FrameworkBundle)
* [BC BREAK] `Input::getOption()` no longer returns the default value for options
  with value optional explicitly passed empty
* added console.error event to catch exceptions thrown by other listeners
* deprecated console.exception event in favor of console.error
* added ability to handle `CommandNotFoundException` through the 
 `console.error` event

3.2.0
------

* added `setInputs()` method to CommandTester for ease testing of commands expecting inputs
* added `setStream()` and `getStream()` methods to Input (implement StreamableInputInterface)
* added StreamableInputInterface
* added LockableTrait

3.1.0
-----

 * added truncate method to FormatterHelper
 * added setColumnWidth(s) method to Table 

2.8.3
-----

 * remove readline support from the question helper as it caused issues

2.8.0
-----

 * use readline for user input in the question helper when available to allow
   the use of arrow keys

2.6.0
-----

 * added a Process helper
 * added a DebugFormatter helper

2.5.0
-----

 * deprecated the dialog helper (use the question helper instead)
 * deprecated TableHelper in favor of Table
 * deprecated ProgressHelper in favor of ProgressBar
 * added ConsoleLogger
 * added a question helper
 * added a way to set the process name of a command
 * added a way to set a default command instead of `ListCommand`

2.4.0
-----

 * added a way to force terminal dimensions
 * added a convenient method to detect verbosity level
 * [BC BREAK] made descriptors use output instead of returning a string

2.3.0
-----

 * added multiselect support to the select dialog helper
 * added Table Helper for tabular data rendering
 * added support for events in `Application`
 * added a way to normalize EOLs in `ApplicationTester::getDisplay()` and `CommandTester::getDisplay()`
 * added a way to set the progress bar progress via the `setCurrent` method
 * added support for multiple InputOption shortcuts, written as `'-a|-b|-c'`
 * added two additional verbosity levels, VERBOSITY_VERY_VERBOSE and VERBOSITY_DEBUG

2.2.0
-----

 * added support for colorization on Windows via ConEmu
 * add a method to Dialog Helper to ask for a question and hide the response
 * added support for interactive selections in console (DialogHelper::select())
 * added support for autocompletion as you type in Dialog Helper

2.1.0
-----

 * added ConsoleOutputInterface
 * added the possibility to disable a command (Command::isEnabled())
 * added suggestions when a command does not exist
 * added a --raw option to the list command
 * added support for STDERR in the console output class (errors are now sent
   to STDERR)
 * made the defaults (helper set, commands, input definition) in Application
   more easily customizable
 * added support for the shell even if readline is not available
 * added support for process isolation in Symfony shell via
   `--process-isolation` switch
 * added support for `--`, which disables options parsing after that point
   (tokens will be parsed as arguments)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher;

/**
 * The EventDispatcherInterface is the central point of Symfony's event listener system.
 *
 * Listeners are registered on the manager and events are dispatched through the
 * manager.
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 * @author Jonathan Wage <jonwage@gmail.com>
 * @author Roman Borschel <roman@code-factory.org>
 * @author Bernhard Schussek <bschussek@gmail.com>
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Jordi Boggiano <j.boggiano@seld.be>
 * @author Jordan Alliot <jordan.alliot@gmail.com>
 * @author Nicolas Grekas <p@tchwork.com>
 */
class EventDispatcher implements EventDispatcherInterface
{
    private $listeners = array();
    private $sorted = array();

    /**
     * {@inheritdoc}
     */
    public function dispatch($eventName, Event $event = null)
    {
        if (null === $event) {
            $event = new Event();
        }

        if ($listeners = $this->getListeners($eventName)) {
            $this->doDispatch($listeners, $eventName, $event);
        }

        return $event;
    }

    /**
     * {@inheritdoc}
     */
    public function getListeners($eventName = null)
    {
        if (null !== $eventName) {
            if (empty($this->listeners[$eventName])) {
                return array();
            }

            if (!isset($this->sorted[$eventName])) {
                $this->sortListeners($eventName);
            }

            return $this->sorted[$eventName];
        }

        foreach ($this->listeners as $eventName => $eventListeners) {
            if (!isset($this->sorted[$eventName])) {
                $this->sortListeners($eventName);
            }
        }

        return array_filter($this->sorted);
    }

    /**
     * {@inheritdoc}
     */
    public function getListenerPriority($eventName, $listener)
    {
        if (empty($this->listeners[$eventName])) {
            return;
        }

        if (is_array($listener) && isset($listener[0]) && $listener[0] instanceof \Closure) {
            $listener[0] = $listener[0]();
        }

        foreach ($this->listeners[$eventName] as $priority => $listeners) {
            foreach ($listeners as $k => $v) {
                if ($v !== $listener && is_array($v) && isset($v[0]) && $v[0] instanceof \Closure) {
                    $v[0] = $v[0]();
                    $this->listeners[$eventName][$priority][$k] = $v;
                }
                if ($v === $listener) {
                    return $priority;
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasListeners($eventName = null)
    {
        if (null !== $eventName) {
            return !empty($this->listeners[$eventName]);
        }

        foreach ($this->listeners as $eventListeners) {
            if ($eventListeners) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function addListener($eventName, $listener, $priority = 0)
    {
        $this->listeners[$eventName][$priority][] = $listener;
        unset($this->sorted[$eventName]);
    }

    /**
     * {@inheritdoc}
     */
    public function removeListener($eventName, $listener)
    {
        if (empty($this->listeners[$eventName])) {
            return;
        }

        if (is_array($listener) && isset($listener[0]) && $listener[0] instanceof \Closure) {
            $listener[0] = $listener[0]();
        }

        foreach ($this->listeners[$eventName] as $priority => $listeners) {
            foreach ($listeners as $k => $v) {
                if ($v !== $listener && is_array($v) && isset($v[0]) && $v[0] instanceof \Closure) {
                    $v[0] = $v[0]();
                }
                if ($v === $listener) {
                    unset($listeners[$k], $this->sorted[$eventName]);
                } else {
                    $listeners[$k] = $v;
                }
            }

            if ($listeners) {
                $this->listeners[$eventName][$priority] = $listeners;
            } else {
         