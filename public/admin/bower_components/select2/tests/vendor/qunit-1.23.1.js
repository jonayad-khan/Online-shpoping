<?php

if (!is_callable('random_int')) {
    /**
     * Random_* Compatibility Library
     * for using the new PHP 7 random_* API in PHP 5 projects
     *
     * The MIT License (MIT)
     *
     * Copyright (c) 2015 - 2017 Paragon Initiative Enterprises
     *
     * Permission is hereby granted, free of charge, to any person obtaining a copy
     * of this software and associated documentation files (the "Software"), to deal
     * in the Software without restriction, including without limitation the rights
     * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
     * copies of the Software, and to permit persons to whom the Software is
     * furnished to do so, subject to the following conditions:
     *
     * The above copyright notice and this permission notice shall be included in
     * all copies or substantial portions of the Software.
     *
     * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
     * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
     * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
     * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
     * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
     * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
     * SOFTWARE.
     */

    /**
     * Fetch a random integer between $min and $max inclusive
     *
     * @param int $min
     * @param int $max
     *
     * @throws Exception
     *
     * @return int
     */
    function random_int($min, $max)
    {
        /**
         * Type and input logic checks
         *
         * If you pass it a float in the range (~PHP_INT_MAX, PHP_INT_MAX)
         * (non-inclusive), it will sanely cast it to an int. If you it's equal to
         * ~PHP_INT_MAX or PHP_INT_MAX, we let it fail as not an integer. Floats
         * lose precision, so the <= and => operators might accidentally let a float
         * through.
         */

        try {
            $min = RandomCompat_intval($min);
        } catch (TypeError $ex) {
            throw new TypeError(
                'random_int(): $min must be an integer'
            );
        }

        try {
            $max = RandomCompat_intval($max);
        } catch (TypeError $ex) {
            throw new TypeError(
                'random_int(): $max must be an integer'
            );
        }

        /**
         * Now that we've verified our weak typing system has given us an integer,
         * let's validate the logic then we can move forward with generating random
         * integers along a given range.
         */
        if ($min > $max) {
            throw new Error(
                'Minimum value must be less than or equal to the maximum value'
            );
        }

        if ($max === $min) {
            return (int) $min;
        }

        /**
         * Initialize variables to 0
         *
         * We want to store:
         * $bytes => the number of random bytes we need
         * $mask => an integer bitmask (for use with the &) operator
         *          so we can minimize the number of discards
         */
        $attempts = $bits = $bytes = $mask = $valueShift = 0;

        /**
         * At this point, $range is a positive number greater than 0. It might
         * overflow, however, if $max - $min > PHP_INT_MAX. PHP will cast it to
         * a float and we will lose some precision.
         */
        $range = $max - $min;

        /**
         * Test for integer overflow:
         */
        if (!is_int($range)) {

            /**
             * Still safely calculate wider ranges.
             * Provided by @CodesInChaos, @oittaa
             *
             * @ref https://gist.github.com/CodesInChaos/03f9ea0b58e8b2b8d435
             *
             * We use ~0 as a mask in this case because it generates all 1s
             *
             * @ref https://eval.in/400356 (32-bit)
             * @ref http://3v4l.org/XX9r5  (64-bit)
             */
            $bytes = PHP_INT_SIZE;
            $mask = ~0;

        } else {

            /**
             * $bits is effectively ceil(log($range, 2)) without dealing with
             * type juggling
             */
            while ($range > 0) {
                if ($bits % 8 === 0) {
                    ++$bytes;
                }
                ++$bits;
                $range >>= 1;
                $mask = $mask << 1 | 1;
            }
            $valueShift = $min;
        }

        $val = 0;
        /**
         * Now that we have our parameters set up, let's begin generating
         * random integers until one falls between $min and $max
         */
        do {
            /**
             * The rejection probability is at most 0.5, so this corresponds
             * to a failure probability of 2^-128 for a working RNG
             */
            if ($attempts > 128) {
                throw new Exception(
                    'random_int: RNG is broken - too many rejections'
                );
            }

            /**
             * Let's grab the necessary number of random bytes
             */
            $randomByteString = random_bytes($bytes);

            /**
             * Let's turn $randomByteString into an integer
             *
             * This uses bitwise operators (<< and |) to build an integer
             * out of the values extracted from ord()
             *
             * Example: [9F] | [6D] | [32] | [0C] =>
             *   159 + 27904 + 3276800 + 201326592 =>
             *   204631455
             */
            $val &= 0;
            for ($i = 0; $i < $bytes; ++$i) {
                $val |= ord($randomByteString[$i]) << ($i * 8);
            }

            /**
             * Apply mask
             */
            $val &= $mask;
            $val += $valueShift;

            ++$attempts;
            /**
             * If $val overflows to a floating point number,
             * ... or is larger than $max,
             * ... or smaller than $min,
             * then try again.
             */
        } while (!is_int($val) || $val > $max || $val < $min);

        return (int) $val;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Helper;

/**
 * HelperInterface is the interface all helpers must implement.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface HelperInterface
{
    /**
     * Sets the helper set associated with this helper.
     *
     * @param HelperSet $helperSet A HelperSet instance
     */
    public function setHelperSet(HelperSet $helperSet = null);

    /**
     * Gets the helper set associated with this helper.
     *
     * @return HelperSet A HelperSet instance
     */
    public function getHelperSet();

    /**
     * Returns the canonical name of this helper.
     *
     * @return string The canonical name
     */
    public function getName();
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Tests\Config;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Config\EnvParametersResource;

class EnvParametersResourceTest extends TestCase
{
    protected $prefix = '__DUMMY_';
    protected $initialEnv;
    protected $resource;

    protected function setUp()
    {
        $this->initialEnv = array(
            $this->prefix.'1' => 'foo',
            $this->prefix.'2' => 'bar',
        );

        foreach ($this->initialEnv as $key => $value) {
            $_SERVER[$key] = $value;
        }

        $this->resource = new EnvParametersResource($this->prefix);
    }

    protected function tearDown()
    {
        foreach ($_SERVER as $key => $value) {
            if (0 === strpos($key, $this->prefix)) {
                unset($_SERVER[$key]);
            }
        }
    }

    public function testGetResource()
    {
        $this->assertSame(
            array('prefix' => $this->prefix, 'variables' => $this->initialEnv),
            $this->resource->getResource(),
            '->getResource() returns the resource'
        );
    }

    public function testToString()
    {
        $this->assertSame(
            serialize(array('prefix' => $this->prefix, 'variables' => $this->initialEnv)),
            (string) $this->resource
        );
    }

    public function testIsFreshNotChanged()
    {
        $this->assertTrue(
            $this->resource->isFresh(time()),
            '->isFresh() returns true if the variables have not changed'
        );
    }

    public function testIsFreshValueChanged()
    {
        reset($this->initialEnv);
        $_SERVER[key($this->initialEnv)] = 'baz';

        $this->assertFalse(
            $this->resource->isFresh(time()),
            '->isFresh() returns false if a variable has been changed'
        );
    }

    public function testIsFreshValueRemoved()
    {
        reset($this->initialEnv);
        unset($_SERVER[key($this->initialEnv)]);

        $this->assertFalse(
            $this->resource->isFresh(time()),
            '->isFresh() returns false if a variable has been removed'
        );
    }

    public function testIsFreshValueAdded()
    {
        $_SERVER[$this->prefix.'3'] = 'foo';

        $this->assertFalse(
            $this->resource->isFresh(time()),
            '->isFresh() returns false if a variable has been added'
        );
    }

    public function testSerializeUnserialize()
    {
        $this->assertEquals($this->resource, unserialize(serialize($this->resource)));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?xml version="1.0" encoding="utf-8"?>
<xliff xmlns="urn:oasis:names:tc:xliff:document:1.2" version="1.2">
  <file source-language="fr-FR" target-language="en-US" datatype="plaintext" original="file.ext">
    <header>
      <tool tool-id="symfony" tool-name="Symfony"/>
    </header>
    <body>
      <trans-unit id="acbd18db4cc2f85cedef654fccc4a4d8" resname="foo">
        <source>foo</source>
        <target>bar</target>
        <note priority="1" from="bar">baz</note>
      </trans-unit>
      <trans-unit id="3c6e0b8a9c15224a8228b9a98ca1531d" resname="key">
        <source>key</source>
        <target></target>
        <note>baz</note>
        <note>qux</note>
      </trans-unit>
      <trans-unit id="18e6a493872558d949b4c16ea1fa6ab6" resname="key.with.cdata">
        <source>key.with.cdata</source>
        <target><![CDATA[<source> & <target>]]></target>
      </trans-unit>
    </body>
  </file>
</xliff>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Caster;

use Symfony\Component\VarDumper\Cloner\Stub;

/**
 * Represents a backtrace as returned by debug_backtrace() or Exception->getTrace().
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class TraceStub extends Stub
{
    public $keepArgs;
    public $sliceOffset;
    public $sliceLength;
    public $numberingOffset;

    public function __construct(array $trace, bool $keepArgs = true, int $sliceOffset = 0, int $sliceLength = null, int $numberingOffset = 0)
    {
        $this->value = $trace;
        $this->keepArgs = $keepArgs;
        $this->sliceOffset = $sliceOffset;
        $this->sliceLength = $sliceLength;
        $this->numberingOffset = $numberingOffset;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Fragment;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Implements the inline rendering strategy where the Request is rendered by the current HTTP kernel.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class InlineFragmentRenderer extends RoutableFragmentRenderer
{
    private $kernel;
    private $dispatcher;

    public function __construct(HttpKernelInterface $kernel, EventDispatcherInterface $dispatcher = null)
    {
        $this->kernel = $kernel;
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     *
     * Additional available options:
     *
     *  * alt: an alternative URI to render in case of an error
     */
    public function render($uri, Request $request, array $options = array())
    {
        $reference = null;
        if ($uri instanceof ControllerReference) {
            $reference = $uri;

            // Remove attributes from the generated URI because if not, the Symfony
            // routing system will use them to populate the Request attributes. We don't
            // want that as we want to preserve objects (so we manually set Request attributes
            // below instead)
            $attributes = $reference->attributes;
            $reference->attributes = array();

            // The request format and locale might have been overridden by the user
            foreach (array('_format', '_locale') as $key) {
                if (isset($attributes[$key])) {
                    $reference->attributes[$key] = $attributes[$key];
                }
            }

            $uri = $this->generateFragmentUri($uri, $request, false, false);

            $reference->attributes = array_merge($attributes, $reference->attributes);
        }

        $subRequest = $this->createSubRequest($uri, $request);

        // override Request attributes as they can be objects (which are not supported by the generated URI)
        if (null !== $reference) {
            $subRequest->attributes->add($reference->attributes);
        }

        $level = ob_get_level();
        try {
            return $this->kernel->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);
        } catch (\Exception $e) {
            // we dispatch the exception event to trigger the logging
            // the response that comes back is simply ignored
            if (isset($options['ignore_errors']) && $options['ignore_errors'] && $this->dispatcher) {
                $event = new GetResponseForExceptionEvent($this->kernel, $request, HttpKernelInterface::SUB_REQUEST, $e);

                $this->dispatcher->dispatch(KernelEvents::EXCEPTION, $event);
            }

            // let's clean up the output buffers that were created by the sub-request
            Response::closeOutputBuffers($level, false);

            if (isset($options['alt'])) {
                $alt = $options['alt'];
                unset($options['alt']);

                return $this->render($alt, $request, $options);
            }

            if (!isset($options['ignore_errors']) || !$options['ignore_errors']) {
                throw $e;
            }

            return new Response();
        }
    }

    protected function createSubRequest($uri, Request $request)
    {
        $cookies = $request->cookies->all();
        $server = $request->server->all();

        if (Request::HEADER_X_FORWARDED_FOR & Request::getTrustedHeaderSet()) {
            $currentXForwardedFor = $request->headers->get('X_FORWARDED_FOR', '');

            $server['HTTP_X_FORWARDED_FOR'] = ($currentXForwardedFor ? $currentXForwardedFor.', ' : '').$request->getClientIp();
        }

        $trustedProxies = Request::getTrustedProxies();
        $server['REMOTE_ADDR'] = $trustedProxies ? reset($trustedProxies) : '127.0.0.1';

        unset($server['HTTP_IF_MODIFIED_SINCE']);
        unset($server['HTTP_IF_NONE_MATCH']);

        $subRequest = Request::create($uri, 'get', array(), $cookies, array(), $server);
        if ($request->headers->has('Surrogate-Capability')) {
            $subRequest->headers->set('Surrogate-Capability', $request->headers->get('Surrogate-Capability'));
        }

        static $setSession;

        if (null === $setSession) {
            $setSession = \Closure::bind(function ($subRequest, $request) { $subRequest->session = $request->session; }, null, Request::class);
        }
        $setSession($subRequest, $request);

        return $subRequest;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'inline';
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Formatter;

use Monolog\TestCase;

class LogglyFormatterTest extends TestCase
{
    /**
     * @covers Monolog\Formatter\LogglyFormatter::__construct
     */
    public function testConstruct()
    {
        $formatter = new LogglyFormatter();
        $this->assertEquals(LogglyFormatter::BATCH_MODE_NEWLINES, $formatter->getBatchMode());
        $formatter = new LogglyFormatter(LogglyFormatter::BATCH_MODE_JSON);
        $this->assertEquals(LogglyFormatter::BATCH_MODE_JSON, $formatter->getBatchMode());
    }

    /**
     * @covers Monolog\Formatter\LogglyFormatter::format
     */
    public function testFormat()
    {
        $formatter = new LogglyFormatter();
        $record = $this->getRecord();
        $formatted_decoded = json_decode($formatter->format($record), true);
        $this->assertArrayHasKey("timestamp", $formatted_decoded);
        $this->assertEquals(new \DateTime($formatted_decoded["timestamp"]), $record["datetime"]);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

namespace Illuminate\Contracts\Queue;

interface Queue
{
    /**
     * Get the size of the queue.
     *
     * @param  string  $queue
     * @return int
     */
    public function size($queue = null);

    /**
     * Push a new job onto the queue.
     *
     * @param  string|object  $job
     * @param  mixed   $data
     * @param  string  $queue
     * @return mixed
     */
    public function push($job, $data = '', $queue = null);

    /**
     * Push a new job onto the queue.
     *
     * @param  string  $queue
     * @param  string|object  $job
     * @param  mixed   $data
     * @return mixed
     */
    public function pushOn($queue, $job, $data = '');

    /**
     * Push a raw payload onto the queue.
     *
     * @param  string  $payload
     * @param  string  $queue
     * @param  array   $options
     * @return mixed
     */
    public function pushRaw($payload, $queue = null, array $options = []);

    /**
     * Push a new job onto the queue after a delay.
     *
     * @param  \DateTimeInterface|\DateInterval|int  $delay
     * @param  string|object  $job
     * @param  mixed   $data
     * @param  string  $queue
     * @return mixed
     */
    public function later($delay, $job, $data = '', $queue = null);

    /**
     * Push a new job onto the queue after a delay.
     *
     * @param  string  $queue
     * @param  \DateTimeInterface|\DateInterval|int  $delay
     * @param  string|object  $job
     * @param  mixed   $data
     * @return mixed
     */
    public function laterOn($queue, $delay, $job, $data = '');

    /**
     * Push an array of jobs onto the queue.
     *
     * @param  array   $jobs
     * @param  mixed   $data
     * @param  string  $queue
     * @return mixed
     */
    public function bulk($jobs, $data = '', $queue = null);

    /**
     * Pop the next job off of the queue.
     *
     * @param  string  $queue
     * @return \Illuminate\Contracts\Queue\Job|null
     */
    public function pop($queue = null);

    /**
     * Get the connection name for the queue.
     *
     * @return string
     */
    public function getConnectionName();

    /**
     * Set the connection name for the queue.
     *
     * @param  string  $name
     * @return $this
     */
    public function setConnectionName($name);
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          INDX( 	                 (   @  �       �                    ZE    � �     YE    8y�b������*y�b�8y�b�                     A n o n y m o u s R e s o u r c e C o l l e c t i o n . p h p [E    x b     YE    6y�b������My�b�6y�b�        �               J s o n R e s o u r c e . p h p       \E    � |     YE    Zy�b�����py�b�Zy�b�       �               P a g i n a t e d R e s o u r c e R e s p o n s e . p h p     ]E    p Z     YE    �|y�b���� J�y�b��|y�b�h       a                R e s o u r c e . p h p       ^E    � n     YE    %�y�b�������y�b��y�b�       �               R e s o u r c e C o l l e c t i o n . p h p   _E    � j     YE    ��y�b�������y�b���y�b�       ]               R e s o u r c e R e s p o n s e . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <?php declare(strict_types=1);

namespace PhpParser\NodeVisitor;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\NodeTraverser;
use PHPUnit\Framework\TestCase;

class FindingVisitorTest extends TestCase
{
    public function testFindVariables() {
        $traverser = new NodeTraverser();
        $visitor = new FindingVisitor(function(Node $node) {
            return $node instanceof Node\Expr\Variable;
        });
        $traverser->addVisitor($visitor);

        $assign = new Expr\Assign(new Expr\Variable('a'), new Expr\BinaryOp\Concat(
            new Expr\Variable('b'), new Expr\Variable('c')
        ));
        $stmts = [new Node\Stmt\Expression($assign)];

        $traverser->traverse($stmts);
        $this->assertSame([
            $assign->var,
            $assign->expr->left,
            $assign->expr->right,
        ], $visitor->getFoundNodes());
    }

    public function testFindAll() {
        $traverser = new NodeTraverser();
        $visitor = new FindingVisitor(function(Node $node) {
            return true; // All nodes
        });
        $traverser->addVisitor($visitor);

        $assign = new Expr\Assign(new Expr\Variable('a'), new Expr\BinaryOp\Concat(
            new Expr\Variable('b'), new Expr\Variable('c')
        ));
        $stmts = [new Node\Stmt\Expression($assign)];

        $traverser->traverse($stmts);
        $this->assertSame([
            $stmts[0],
            $assign,
            $assign->var,
            $assign->expr,
            $assign->expr->left,
            $assign->expr->right,
        ], $visitor->getFoundNodes());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

namespace Faker\Provider\ja_JP;

class Address extends \Faker\Provider\Address
{
    protected static $country = array(
        'アフガニスタン', 'アルバニア', 'アルジェリア', 'アメリカ領サモア', 'アンドラ', 'アンゴラ', 'アンギラ', '南極大陸', 'アンティグアバーブーダ', 'アルゼンチン', 'アルメニア', 'アルバ', 'オーストラリア', 'オーストリア', 'アゼルバイジャン',
        'バハマ', 'バーレーン', 'バングラデシュ', 'バルバドス', 'ベラルーシ', 'ベルギー', 'ベリーズ', 'ベナン', 'バミューダ島', 'ブータン', 'ボリビア', 'ボスニア・ヘルツェゴビナ', 'ボツワナ', 'ブーベ島', 'ブラジル', 'イギリス領インド洋地域', 'イギリス領ヴァージン諸島', 'ブルネイ', 'ブルガリア', 'ブルキナファソ', 'ブルンジ',
        'カンボジア', 'カメルーン', 'カナダ', 'カーボベルデ', 'ケイマン諸島', '中央アフリカ共和国', 'チャド', 'チリ', '中国', 'クリスマス島', 'ココス諸島', 'コロンビア', 'コモロ', 'コンゴ共和国', 'クック諸島', 'コスタリカ', 'コートジボワール', 'クロアチア', 'キューバ', 'キプロス共和国', 'チェコ共和国',
        'デンマーク', 'ジブチ共和国', 'ドミニカ国', 'ドミニカ共和国',
        'エクアドル', 'エジプト', 'エルサルバドル', '赤道ギニア共和国', 'エリトリア', 'エストニア', 'エチオピア',
        'フェロー諸島', 'フォークランド諸島', 'フィジー共和国', 'フィンランド', 'フランス', 'フランス領ギアナ', 'フランス領ポリネシア', 'フランス領極南諸島',
        'ガボン', 'ガンビア', 'グルジア', 'ドイツ', 'ガーナ', 'ジブラルタル', 'ギリシャ', 'グリーンランド', 'グレナダ', 'グアドループ', 'グアム', 'グアテマラ', 'ガーンジー', 'ギニア', 'ギニアビサウ', 'ガイアナ',
        'ハイチ', 'ハード島とマクドナルド諸島', 'バチカン市国', 'ホンジュラス', '香港', 'ハンガリー',
        'アイスランド', 'インド', 'インドネシア', 'イラン', 'イラク', 'アイルランド共和国', 'マン島', 'イスラエル', 'イタリア',
        'ジャマイカ', '日本', 'ジャージー島', 'ヨルダン',
        'カザフスタン', 'ケニア', 'キリバス', '朝鮮', '韓国', 'クウェート', 'キルギス共和国',
        'ラオス人民民主共和国', 'ラトビア', 'レバノン', 'レソト', 'リベリア', 'リビア国', 'リヒテンシュタイン', 'リトアニア', 'ルクセンブルク',
        'マカオ', 'マケドニア共和国', 'マダガスカル', 'マラウィ', 'マレーシア', 'モルディブ', 'マリ', 'マルタ共和国', 'マーシャル諸島', 'マルティニーク', 'モーリタニア・イスラム共和国', 'モーリシャス', 'マヨット', 'メキシコ', 'ミクロネシア連邦', 'モルドバ共和国', 'モナコ公国', 'モンゴル', 'モンテネグロ共和国', 'モントセラト', 'モロッコ', 'モザンビーク', 'ミャンマー',
        'ナミビア', 'ナウル', 'ネパール', 'オランダ領アンティル', 'オランダ', 'ニューカレドニア', 'ニュージーランド', 'ニカラグア', 'ニジェール', 'ナイジェリア', 'ニース', 'ノーフォーク島', '北マリアナ諸島', 'ノルウェー',
        'オマーン',
        'パキスタン', 'パラオ', 'パレスチナ自治区', 'パナマ', 'パプアニューギニア', 'パラグアイ', 'ペルー', 'フィリピン', 'ピトケアン諸島', 'ポーランド', 'ポルトガル', 'プエルトリコ',
        'カタール',
        'レユニオン', 'ルーマニア', 'ロシア', 'ルワンダ',
        'サン・バルテルミー島', 'セントヘレナ', 'セントクリストファー・ネイビス連邦', 'セントルシア', 'セント・マーチン島', 'サンピエール島・ミクロン島', 'セントビンセント・グレナディーン', 'サモア', 'サンマリノ', 'サントメプリンシペ', 'サウジアラビア', 'セネガル', 'セルビア', 'セイシェル', 'シエラレオネ', 'シンガポール', 'スロバキア', 'スロベニア', 'ソロモン諸島', 'ソマリア', '南アフリカ共和国', 'サウスジョージア・サウスサンドウィッチ諸島', 'スペイン', 'スリランカ', 'スーダン', 'スリナム', 'スヴァールバル諸島およびヤンマイエン島', 'スワジランド王国', 'スウェーデン', 'スイス', 'シリア',
        '台湾', 'タジキスタン共和国', 'タンザニア', 'タイ', '東ティモール', 'トーゴ', 'トケラウ', 'トンガ', 'トリニダード・トバゴ', 'チュニジア', 'トルコ', 'トルクメニスタン', 'タークス・カイコス諸島', 'ツバル',
        'ウガンダ', 'ウクライナ', 'アラブ首長国連邦', 'イギリス', 'アメリカ合衆国', '合衆国領有小離島', 'アメリカ領ヴァージン諸島', 'ウルグアイ', 'ウズベキスタン',
        'バヌアツ', 'ベネズエラ', 'ベトナム',
        'ウォリス・フツナ', '西サハラ',
        'イエメン',
        'ザンビア', 'ジンバブエ'
    );
    protected static $prefecture = array(
        '北海道',
        '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
        '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県',
        '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県',
        '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県',
        '鳥取県', '島根県', '岡山県', '広島県', '山口県',
        '徳島県', '香川県', '愛媛県', '高知県',
        '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県',
        '沖縄県'
    );
    protected static $ward = array('中央', '北', '東', '南', '西');

    protected static $citySuffix = array('市');
    protected static $wardSuffix = array('区');
    protected static $streetSuffix = array('町');

    protected static $postcodeFormats = array('{{postcode1}}{{postcode2}}');
    protected static $cityFormats = array(
        '{{lastName}}{{citySuffix}}',
    );
    protected static $streetNameFormats = array(
        '{{lastName}}{{streetSuffix}}'
    );
    protected static $streetAddressFormats = array(
        '{{streetName}}{{lastName}}{{areaNumber}}-{{areaNumber}}-{{areaNumber}}'
    );
    protected static $addressFormats = array(
        '{{postcode}}  {{prefecture}}{{city}}{{ward}}{{streetAddress}}',
        '{{postcode}}  {{prefecture}}{{city}}{{ward}}{{streetAddress}} {{secondaryAddress}}'
    );
    protected static $secondaryAddressFormats = array(
        'ハイツ{{lastName}}{{buildingNumber}}号',
        'コーポ{{lastName}}{{buildingNumber}}号'
    );

    /**
     * @example 111
     */
    public static function postcode1()
    {
        return static::numberBetween(100, 999);
    }

    /**
     * @example 2222
     */
    public static function postcode2()
    {
        return static::numberBetween(1000, 9999);
    }

    /**
     * @example 1112222
     */
    public static function postcode()
    {
        $postcode1 = static::postcode1();
        $postcode2 = static::postcode2();

        return $postcode1 . $postcode2;
    }

    /**
     * @example '東京都'
     */
    public static function prefecture()
    {
        return static::randomElement(static::$prefecture);
    }

    /**
     * @example '北区'
     */
    public static function ward()
    {
        $ward = static::randomElement(static::$ward);
        $suffix = static::randomElement(static::$wardSuffix);

        return $ward . $suffix;
    }

    /**
     * 丁、番地、号
     *
     * @return int
     */
    public static function areaNumber()
    {
        return static::numberBetween(1, 10);
    }

    public static function buildingNumber()
    {
        return static::numberBetween(101, 110);
    }

    public function secondaryAddress()
    {
        $format = static::randomElement(static::$secondaryAddressFormats);

        return $this->generator->parse($format);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     INDX( 	                 (   H  �                            X    p \     X    ��@�b��Ӹ�-�x�@�b���@�b�       >               b o o t s t r a p . p h p     X    p \     X    ͵@�b��Ӹ�-���@�b�̵@�b�       4               c o m p o s e r . j s o n     X    ` P     X    �@�b��Ӹ�-�b5@�b��@�b�       )               L I C E N S E X    h T     X    �B@�b��Ӹ�-�c^@�b��B@�b�        �              	 P h p 7 2 . p h p     X    h T     X     k@�b��Ӹ�-��@�b��j@�b�       *              	 R E A D M E . m d                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

//Ensure questions do not output anything when input is non-interactive
return function (InputInterface $input, OutputInterface $output) {
    $output = new SymfonyStyle($input, $output);
    $output->title('Title');
    $output->askHidden('Hidden question');
    $output->choice('Choice question with default', array('choice1', 'choice2'), 'choice1');
    $output->confirm('Confirmation with yes default', true);
    $output->text('Duis aute irure dolor in reprehenderit in voluptate velit esse');
};
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Handles Quoted Printable (QP) Encoding in Swift Mailer.
 *
 * Possibly the most accurate RFC 2045 QP implementation found in PHP.
 *
 * @author     Chris Corbyn
 */
class Swift_Encoder_QpEncoder implements Swift_Encoder
{
    /**
     * The CharacterStream used for reading characters (as opposed to bytes).
     *
     * @var Swift_CharacterStream
     */
    protected $charStream;

    /**
     * A filter used if input should be canonicalized.
     *
     * @var Swift_StreamFilter
     */
    protected $filter;

    /**
     * Pre-computed QP for HUGE optimization.
     *
     * @var string[]
     */
    protected static $qpMap = [
        0 => '=00', 1 => '=01', 2 => '=02', 3 => '=03', 4 => '=04',
        5 => '=05', 6 => '=06', 7 => '=07', 8 => '=08', 9 => '=09',
        10 => '=0A', 11 => '=0B', 12 => '=0C', 13 => '=0D', 14 => '=0E',
        15 => '=0F', 16 => '=10', 17 => '=11', 18 => '=12', 19 => '=13',
        20 => '=14', 21 => '=15', 22 => '=16', 23 => '=17', 24 => '=18',
        25 => '=19', 26 => '=1A', 27 => '=1B', 28 => '=1C', 29 => '=1D',
        30 => '=1E', 31 => '=1F', 32 => '=20', 33 => '=21', 34 => '=22',
        35 => '=23', 36 => '=24', 37 => '=25', 38 => '=26', 39 => '=27',
        40 => '=28', 41 => '=29', 42 => '=2A', 43 => '=2B', 44 => '=2C',
        45 => '=2D', 46 => '=2E', 47 => '=2F', 48 => '=30', 49 => '=31',
        50 => '=32', 51 => '=33', 52 => '=34', 53 => '=35', 54 => '=36',
        55 => '=37', 56 => '=38', 57 => '=39', 58 => '=3A', 59 => '=3B',
        60 => '=3C', 61 => '=3D', 62 => '=3E', 63 => '=3F', 64 => '=40',
        65 => '=41', 66 => '=42', 67 => '=43', 68 => '=44', 69 => '=45',
        70 => '=46', 71 => '=47', 72 => '=48', 73 => '=49', 74 => '=4A',
        75 => '=4B', 76 => '=4C', 77 => '=4D', 78 => '=4E', 79 => '=4F',
        80 => '=50', 81 => '=51', 82 => '=52', 83 => '=53', 84 => '=54',
        85 => '=55', 86 => '=56', 87 => '=57', 88 => '=58', 89 => '=59',
        90 => '=5A', 91 => '=5B', 92 => '=5C', 93 => '=5D', 94 => '=5E',
        95 => '=5F', 96 => '=60', 97 => '=61', 98 => '=62', 99 => '=63',
        100 => '=64', 101 => '=65', 102 => '=66', 103 => '=67', 104 => '=68',
        105 => '=69', 106 => '=6A', 107 => '=6B', 108 => '=6C', 109 => '=6D',
        110 => '=6E', 111 => '=6F', 112 => '=70', 113 => '=71', 114 => '=72',
        115 => '=73', 116 => '=74', 117 => '=75', 118 => '=76', 119 => '=77',
        120 => '=78', 121 => '=79', 122 => '=7A', 123 => '=7B', 124 => '=7C',
        125 => '=7D', 126 => '=7E', 127 => '=7F', 128 => '=80', 129 => '=81',
        130 => '=82', 131 => '=83', 132 => '=84', 133 => '=85', 134 => '=86',
        135 => '=87', 136 => '=88', 137 => '=89', 138 => '=8A', 139 => '=8B',
        140 => '=8C', 141 => '=8D', 142 => '=8E', 143 => '=8F', 144 => '=90',
        145 => '=91', 146 => '=92', 147 => '=93', 148 => '=94', 149 => '=95',
        150 => '=96', 151 => '=97', 152 => '=98', 153 => '=99', 154 => '=9A',
        155 => '=9B', 156 => '=9C', 157 => '=9D', 158 => '=9E', 159 => '=9F',
        160 => '=A0', 161 => '=A1', 162 => '=A2', 163 => '=A3', 164 => '=A4',
        165 => '=A5', 166 => '=A6', 167 => '=A7', 168 => '=A8', 169 => '=A9',
        170 => '=AA', 171 => '=AB', 172 => '=AC', 173 => '=AD', 174 => '=AE',
        175 => '=AF', 176 => '=B0', 177 => '=B1', 178 => '=B2', 179 => '=B3',
        180 => '=B4', 181 => '=B5', 182 => '=B6', 183 => '=B7', 184 => '=B8',
        185 => '=B9', 186 => '=BA', 187 => '=BB', 188 => '=BC', 189 => '=BD',
        190 => '=BE', 191 => '=BF', 192 => '=C0', 193 => '=C1', 194 => '=C2',
        195 => '=C3', 196 => '=C4', 197 => '=C5', 198 => '=C6', 199 => '=C7',
        200 => '=C8', 201 => '=C9', 202 => '=CA', 203 => '=CB', 204 => '=CC',
        205 => '=CD', 206 => '=CE', 207 => '=CF', 208 => '=D0', 209 => '=D1',
        210 => '=D2', 211 => '=D3', 212 => '=D4', 213 => '=D5', 214 => '=D6',
        215 => '=D7', 216 => '=D8', 217 => '=D9', 218 => '=DA', 219 => '=DB',
        220 => '=DC', 221 => '=DD', 222 => '=DE', 223 => '=DF', 224 => '=E0',
        225 => '=E1', 226 => '=E2', 227 => '=E3', 228 => '=E4', 229 => '=E5',
        230 => '=E6', 231 => '=E7', 232 => '=E8', 233 => '=E9', 234 => '=EA',
        235 => '=EB', 236 => '=EC', 237 => '=ED', 238 => '=EE', 239 => '=EF',
        240 => '=F0', 241 => '=F1', 242 => '=F2', 243 => '=F3', 244 => '=F4',
        245 => '=F5', 246 => '=F6', 247 => '=F7', 248 => '=F8', 249 => '=F9',
        250 => '=FA', 251 => '=FB', 252 => '=FC', 253 => '=FD', 254 => '=FE',
        255 => '=FF',
        ];

    protected static $safeMapShare = [];

    /**
     * A map of non-encoded ascii characters.
     *
     * @var string[]
     */
    protected $safeMap = [];

    /**
     * Creates a new QpEncoder for the given CharacterStream.
     *
     * @param Swift_CharacterStream $charStream to use for reading characters
     * @param Swift_StreamFilter    $filter     if input should be canonicalized
     */
    public function __construct(Swift_CharacterStream $charStream, Swift_StreamFilter $filter = null)
    {
        $this->charStream = $charStream;
        if (!isset(self::$safeMapShare[$this->getSafeMapShareId()])) {
            $this->initSafeMap();
            self::$safeMapShare[$this->getSafeMapShareId()] = $this->safeMap;
        } else {
            $this->safeMap = self::$safeMapShare[$this->getSafeMapShareId()];
        }
        $this->filter = $filter;
    }

    public function __sleep()
    {
        return ['charStream', 'filter'];
    }

    public function __wakeup()
    {
        if (!isset(self::$safeMapShare[$this->getSafeMapShareId()])) {
            $this->initSafeMap();
            self::$safeMapShare[$this->getSafeMapShareId()] = $this->safeMap;
        } else {
            $this->safeMap = self::$safeMapShare[$this->getSafeMapShareId()];
        }
    }

    protected function getSafeMapShareId()
    {
        return get_class($this);
    }

    protected function initSafeMap()
    {
        foreach (array_merge(
            [0x09, 0x20], range(0x21, 0x3C), range(0x3E, 0x7E)) as $byte) {
            $this->safeMap[$byte] = chr($byte);
        }
    }

    /**
     * Takes an unencoded string and produces a QP encoded string from it.
     *
     * QP encoded strings have a maximum line length of 76 characters.
     * If the first line needs to be shorter, indicate the difference with
     * $firstLineOffset.
     *
     * @param string $string          to encode
     * @param int    $firstLineOffset optional
     * @param int    $maxLineLength   optional 0 indicates the default of 76 chars
     *
     * @return string
     */
    public function encodeString($string, $firstLineOffset = 0, $maxLineLength = 0)
    {
        if ($maxLineLength > 76 || $maxLineLength <= 0) {
            $maxLineLength = 76;
        }

        $thisLineLength = $maxLineLength - $firstLineOffset;

        $lines = [];
        $lNo = 0;
        $lines[$lNo] = '';
        $currentLine = &$lines[$lNo++];
        $size = $lineLen = 0;

        $this->charStream->flushContents();
        $this->charStream->importString($string);

        // Fetching more than 4 chars at one is slower, as is fetching fewer bytes
        // Conveniently 4 chars is the UTF-8 safe number since UTF-8 has up to 6
        // bytes per char and (6 * 4 * 3 = 72 chars per line) * =NN is 3 bytes
        while (false !== $bytes = $this->nextSequence()) {
            // If we're filtering the input
            if (isset($this->filter)) {
                // If we can't filter because we need more bytes
                while ($this->filter->shouldBuffer($bytes)) {
                    // Then collect bytes into the buffer
                    if (false === $moreBytes = $this->nextSequence(1)) {
                        break;
                    }

                    foreach ($moreBytes as $b) {
                        $bytes[] = $b;
                    }
                }
                // And filter them
                $bytes = $this->filter->filter($bytes);
            }

            $enc = $this->encodeByteSequence($bytes, $size);

            $i = strpos($enc, '=0D=0A');
            $newLineLength = $lineLen + (false === $i ? $size : $i);

            if ($currentLine && $newLineLength >= $thisLineLength) {
                $lines[$lNo] = '';
                $currentLine = &$lines[$lNo++];
                $thisLineLength = $maxLineLength;
                $lineLen = 0;
            }

            $currentLine .= $enc;

            if (false === $i) {
                $lineLen += $size;
            } else {
                // 6 is the length of '=0D=0A'.
                $lineLen = $size - strrpos($enc, '=0D=0A') - 6;
            }
        }

        return $this->standardize(implode("=\r\n", $lines));
    }

    /**
     * Updates the charset used.
     *
     * @param string $charset
     */
    public function charsetChanged($charset)
    {
        $this->charStream->setCharacterSet($charset);
    }

    /**
     * Encode the given byte array into a verbatim QP form.
     *
     * @param int[] $bytes
     * @param int   $size
     *
     * @return string
     */
    protected function encodeByteSequence(array $bytes, &$size)
    {
        $ret = '';
        $size = 0;
        foreach ($bytes as $b) {
            if (isset($this->safeMap[$b])) {
                $ret .= $this->safeMap[$b];
                ++$size;
            } else {
                $ret .= self::$qpMap[$b];
                $size += 3;
            }
        }

        return $ret;
    }

    /**
     * Get the next sequence of bytes to read from the char stream.
     *
     * @param int $size number of bytes to read
     *
     * @return int[]
     */
    protected function nextSequence($size = 4)
    {
        return $this->charStream->readBytes($size);
    }

    /**
     * Make sure CRLF is correct and HT/SPACE are in valid places.
     *
     * @param string $string
     *
     * @return string
     */
    protected function standardize($string)
    {
        $string = str_replace(["\t=0D=0A", ' =0D=0A', '=0D=0A'],
            ["=09\r\n", "=20\r\n", "\r\n"], $string
            );
        switch ($end = ord(substr($string, -1))) {
            case 0x09:
            case 0x20:
                $string = substr_replace($string, self::$qpMap[$end], -1);
        }

        return $string;
    }

    /**
     * Make a deep copy of object.
     */
    public function __clone()
    {
        $this->charStream = clone $this->charStream;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       INDX( 	                 (   p  �      $ i  o                 �h    p \     �h    ؍��b� FհO�N���b�Ѝ��b�       �               a b s t r a c t . t e s t     �h    p ^     �h    	���b� FհO�-ŧ�b� ���b�        �               a n o n y m o u s . t e s t   �h    x b     �h    $Ч�b� FհO�n槬b�$Ч�b�p      p               c o n d i t i o n a l . t e s t       �h    � r     �h    K�b� FհO�k��b�D�b�       v               c o n s t M o d i f $ e r E r r o r s . t e s t       �h    x h     �h    &��b� FհO�~'��b�$��b�       �               c o n s t M o d i f i e r s . t e s t �h    h V     �h    t2��b� FհO�5G��b�l2��b�                    
 f i n a l . t e s t   �h    x h     �h    >R��b� FհO��g��b�8R��b�       �
               i m p l i c i t P u b l i c . t e s t �h    p ^     �h    �r��b� FհO�M���b��r��b�       �               i n t e r f a c e . t e s t   �h    p \     �h   $ ����b� FհO�Ь��b�����b�        �               m o d i f i e r . t e s t     �h    h T     �h    ɷ��b� FհO��Ϩ�b�ȷ��b�        �              	 n a m e . t e s t     �h    p ^     �h    tۨ�b� FհO���b�rۨ�b�       0               p h p 4 S t y l e . t e s t   �h    h X     �h    ����b� FհO���b�����b�        w               s i m p l e . t e s t �h    x d     �h    ���b� FհO�5��b����b�       �               s t a t i c M e t h $ d . t e s t     �h    h V     �h    6@��b� FհO�QW��b�0@��b�        T              
 t r a i t . t e s t                                                                                                                                                                                                                                                                                                                                                                                                       $                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               $                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               $                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               $                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               $ <?php
namespace Hamcrest\Core;

class AllOfTest extends \Hamcrest\AbstractMatcherTest
{

    protected function createMatcher()
    {
        return \Hamcrest\Core\AllOf::allOf('irrelevant');
    }

    public function testEvaluatesToTheLogicalConjunctionOfTwoOtherMatchers()
    {
        assertThat('good', allOf('good', 'good'));

        assertThat('good', not(allOf('bad', 'good')));
        assertThat('good', not(allOf('good', 'bad')));
        assertThat('good', not(allOf('bad', 'bad')));
    }

    public function testEvaluatesToTheLogicalConjunctionOfManyOtherMatchers()
    {
        assertThat('good', allOf('good', 'good', 'good', 'good', 'good'));
        assertThat('good', not(allOf('good', endsWith('d'), 'bad', 'good', 'good')));
    }

    public function testSupportsMixedTypes()
    {
        $all = allOf(
            equalTo(new \Hamcrest\Core\SampleBaseClass('good')),
            equalTo(new \Hamcrest\Core\SampleBaseClass('good')),
            equalTo(new \Hamcrest\Core\SampleSubClass('ugly'))
        );

        $negated = not($all);

        assertThat(new \Hamcrest\Core\SampleSubClass('good'), $negated);
    }

    public function testHasAReadableDescription()
    {
        $this->assertDescription(
            '("good" and "bad" and "ugly")',
            allOf('good', 'bad', 'ugly')
        );
    }

    public function testMismatchDescriptionDescribesFirstFailingMatch()
    {
        $this->assertMismatchDescription(
            '"good" was "bad"',
            allOf('bad', 'good'),
            'bad'
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Test;

use PHPUnit\Framework\RiskyTestError;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Warning;

final class HookTest extends TestCase
{
    public function testSuccess(): void
    {
        $this->assertTrue(true);
    }

    public function testFailure(): void
    {
        $this->assertTrue(false);
    }

    public function testError(): void
    {
        throw new \Exception('message');
    }

    public function testIncomplete(): void
    {
        $this->markTestIncomplete('message');
    }

    public function testRisky(): void
    {
        throw new RiskyTestError('message');
    }

    public function testSkipped(): void
    {
        $this->markTestSkipped('message');
    }

    public function testWarning(): void
    {
        throw new Warning('message');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?xml version="1.0" encoding="UTF-8"?>
<phpunit backupGlobals="false"
         backupStaticAttributes="false"
         bootstrap="vendor/autoload.php"
         colors="true"
         convertErrorsToExceptions="true"
         convertNoticesToExceptions="true"
         convertWarningsToExceptions="true"
         processIsolation="false"
         stopOnFailure="false">
    <testsuites>
        <testsuite name="Feature">
            <directory suffix="Test.php">./tests/Feature</directory>
        </testsuite>

        <testsuite name="Unit">
            <directory suffix="Test.php">./tests/Unit</directory>
        </testsuite>
    </testsuites>
    <filter>
        <whitelist processUncoveredFilesFromWhitelist="true">
            <directory suffix=".php">./app</directory>
        </whitelist>
    </filter>
    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="CACHE_DRIVER" value="array"/>
        <env name="SESSION_DRIVER" value="array"/>
        <env name="QUEUE_DRIVER" value="sync"/>
    </php>
</phpunit>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php

namespace Illuminate\Auth\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

class AuthenticateWithBasicAuth
{
    /**
     * The guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        return $this->auth->guard($guard)->basic() ?: $next($request);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php

namespace Illuminate\Queue;

use Aws\Sqs\SqsClient;
use Illuminate\Queue\Jobs\SqsJob;
use Illuminate\Contracts\Queue\Queue as QueueContract;

class SqsQueue extends Queue implements QueueContract
{
    /**
     * The Amazon SQS instance.
     *
     * @var \Aws\Sqs\SqsClient
     */
    protected $sqs;

    /**
     * The name of the default queue.
     *
     * @var string
     */
    protected $default;

    /**
     * The queue URL prefix.
     *
     * @var string
     */
    protected $prefix;

    /**
     * Create a new Amazon SQS queue instance.
     *
     * @param  \Aws\Sqs\SqsClient  $sqs
     * @param  string  $default
     * @param  string  $prefix
     * @return void
     */
    public function __construct(SqsClient $sqs, $default, $prefix = '')
    {
        $this->sqs = $sqs;
        $this->prefix = $prefix;
        $this->default = $default;
    }

    /**
     * Get the size of the queue.
     *
     * @param  string  $queue
     * @return int
     */
    public function size($queue = null)
    {
        $response = $this->sqs->getQueueAttributes([
            'QueueUrl' => $this->getQueue($queue),
            'AttributeNames' => ['ApproximateNumberOfMessages'],
        ]);

        $attributes = $response->get('Attributes');

        return (int) $attributes['ApproximateNumberOfMessages'];
    }

    /**
     * Push a new job onto the queue.
     *
     * @param  string  $job
     * @param  mixed   $data
     * @param  string  $queue
     * @return mixed
     */
    public function push($job, $data = '', $queue = null)
    {
        return $this->pushRaw($this->createPayload($job, $data), $queue);
    }

    /**
     * Push a raw payload onto the queue.
     *
     * @param  string  $payload
     * @param  string  $queue
     * @param  array   $options
     * @return mixed
     */
    public function pushRaw($payload, $queue = null, array $options = [])
    {
        return $this->sqs->sendMessage([
            'QueueUrl' => $this->getQueue($queue), 'MessageBody' => $payload,
        ])->get('MessageId');
    }

    /**
     * Push a new job onto the queue after a delay.
     *
     * @param  \DateTimeInterface|\DateInterval|int  $delay
     * @param  string  $job
     * @param  mixed   $data
     * @param  string  $queue
     * @return mixed
     */
    public function later($delay, $job, $data = '', $queue = null)
    {
        return $this->sqs->sendMessage([
            'QueueUrl' => $this->getQueue($queue),
            'MessageBody' => $this->createPayload($job, $data),
            'DelaySeconds' => $this->secondsUntil($delay),
        ])->get('MessageId');
    }

    /**
     * Pop the next job off of the queue.
     *
     * @param  string  $queue
     * @return \Illuminate\Contracts\Queue\Job|null
     */
    public function pop($queue = null)
    {
        $response = $this->sqs->receiveMessage([
            'QueueUrl' => $queue = $this->getQueue($queue),
            'AttributeNames' => ['ApproximateReceiveCount'],
        ]);

        if (count($response['Messages']) > 0) {
            return new SqsJob(
                $this->container, $this->sqs, $response['Messages'][0],
                $this->connectionName, $queue
            );
        }
    }

    /**
     * Get the queue or return the default.
     *
     * @param  string|null  $queue
     * @return string
     */
    public function getQueue($queue)
    {
        $queue = $queue ?: $this->default;

        return filter_var($queue, FILTER_VALIDATE_URL) === false
                        ? rtrim($this->prefix, '/').'/'.$queue : $queue;
    }

    /**
     * Get the underlying SQS instance.
     *
     * @return \Aws\Sqs\SqsClient
     */
    public function getSqs()
    {
        return $this->sqs;
    }
}
                                                                                                                                                                                                                                                                                                                                       <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Monolog\TestCase;
use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\Slack\SlackRecord;

/**
 * @author Haralan Dobrev <hkdobrev@gmail.com>
 * @see    https://api.slack.com/incoming-webhooks
 * @coversDefaultClass Monolog\Handler\SlackWebhookHandler
 */
class SlackWebhookHandlerTest extends TestCase
{
    const WEBHOOK_URL = 'https://hooks.slack.com/services/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E';

    /**
     * @covers ::__construct
     * @covers ::getSlackRecord
     */
    public function testConstructorMinimal()
    {
        $handler = new SlackWebhookHandler(self::WEBHOOK_URL);
        $record = $this->getRecord();
        $slackRecord = $handler->getSlackRecord();
        $this->assertInstanceOf('Monolog\Handler\Slack\SlackRecord', $slackRecord);
        $this->assertEquals(array(
            'attachments' => array(
                array(
                    'fallback' => 'test',
                    'text' => 'test',
                    'color' => SlackRecord::COLOR_WARNING,
                    'fields' => array(
                        array(
                            'title' => 'Level',
                            'value' => 'WARNING',
                            'short' => false,
                        ),
                    ),
                    'title' => 'Message',
                    'mrkdwn_in' => array('fields'),
                    'ts' => $record['datetime']->getTimestamp(),
                ),
            ),
        ), $slackRecord->getSlackData($record));
    }

    /**
     * @covers ::__construct
     * @covers ::getSlackRecord
     */
    public function testConstructorFull()
    {
        $handler = new SlackWebhookHandler(
            self::WEBHOOK_URL,
            'test-channel',
            'test-username',
            false,
            ':ghost:',
            false,
            false,
            Logger::DEBUG,
            false
        );

        $slackRecord = $handler->getSlackRecord();
        $this->assertInstanceOf('Monolog\Handler\Slack\SlackRecord', $slackRecord);
        $this->assertEquals(array(
            'username' => 'test-username',
            'text' => 'test',
            'channel' => 'test-channel',
            'icon_emoji' => ':ghost:',
        ), $slackRecord->getSlackData($this->getRecord()));
    }

    /**
     * @covers ::getFormatter
     */
    public function testGetFormatter()
    {
        $handler = new SlackWebhookHandler(self::WEBHOOK_URL);
        $formatter = $handler->getFormatter();
        $this->assertInstanceOf('Monolog\Formatter\FormatterInterface', $formatter);
    }

    /**
     * @covers ::setFormatter
     */
    public function testSetFormatter()
    {
        $handler = new SlackWebhookHandler(self::WEBHOOK_URL);
        $formatter = new LineFormatter();
        $handler->setFormatter($formatter);
        $this->assertSame($formatter, $handler->getFormatter());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            New
-----
<?php

new A;
new A($b);

// class name variations
new $a();
new $a['b']();
new A::$b();
// DNCR object access
new $a->b();
new $a->b->c();
new $a->b['c']();
new $a->b{'c'}();

// test regression introduces by new dereferencing syntax
(new A);
-----
array(
    0: Expr_New(
        class: Name(
            parts: array(
                0: A
            )
        )
        args: array(
        )
    )
    1: Expr_New(
        class: Name(
            parts: array(
                0: A
            )
        )
        args: array(
            0: Arg(
                value: Expr_Variable(
                    name: b
                )
                byRef: false
                unpack: false
            )
        )
    )
    2: Expr_New(
        class: Expr_Variable(
            name: a
        )
        args: array(
        )
        comments: array(
            0: // class name variations
        )
    )
    3: Expr_New(
        class: Expr_ArrayDimFetch(
            var: Expr_Variable(
                name: a
            )
            dim: Scalar_String(
                value: b
            )
        )
        args: array(
        )
    )
    4: Expr_New(
        class: Expr_StaticPropertyFetch(
            class: Name(
                parts: array(
                    0: A
                )
            )
            name: b
        )
        args: array(
        )
    )
    5: Expr_New(
        class: Expr_PropertyFetch(
            var: Expr_Variable(
                name: a
            )
            name: b
        )
        args: array(
        )
        comments: array(
            0: // DNCR object access
        )
    )
    6: Expr_New(
        class: Expr_PropertyFetch(
            var: Expr_PropertyFetch(
                var: Expr_Variable(
                    name: a
                )
                name: b
            )
            name: c
        )
        args: array(
        )
    )
    7: Expr_New(
        class: Expr_ArrayDimFetch(
            var: Expr_PropertyFetch(
                var: Expr_Variable(
                    name: a
                )
                name: b
            )
            dim: Scalar_String(
                value: c
            )
        )
        args: array(
        )
    )
    8: Expr_New(
        class: Expr_ArrayDimFetch(
            var: Expr_PropertyFetch(
                var: Expr_Variable(
                    name: a
                )
                name: b
            )
            dim: Scalar_String(
                value: c
            )
        )
        args: array(
        )
    )
    9: Expr_New(
        class: Name(
            parts: array(
                0: A
            )
        )
        args: array(
        )
    )
)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Constraint;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Util\InvalidArgumentHelper;
use SebastianBergmann;