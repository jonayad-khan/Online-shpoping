order in
relation to similarly marked methods.

.. code-block:: php

    ordered()

The order is dictated by the order in which this modifier is actually used when
setting up mocks.

Declares the method as belonging to an order group (which can be named or
numbered). Methods within a group can be called in any order, but the ordered
calls from outside the group are ordered in relation to the group:

.. code-block:: php

    ordered(group)

We can set up so that method1 is called before group1 which is in turn called
before method2.

When called prior to ``ordered()`` or ``ordered(group)``, it declares this
ordering to apply across all mock objects (not just the current mock):

.. code-block:: php

    globally()

This allows for dictating order expectations across multiple mocks.

The ``byDefault()`` marks an expectation as a default. Default expectations are
applied unless a non-default expectation is created:

.. code-block:: php

    byDefault()

These later expectations immediately replace the previously defined default.
This is useful so we can setup default mocks in our unit test ``setup()`` and
later tweak them in specific tests as needed.

Returns the current mock object from an expectation chain:

.. code-block:: php

    getMock()

Useful where we prefer to keep mock setups as a single statement, e.g.:

.. code-block:: php

    $mock = \Mockery::mock('foo')->shouldReceive('foo')->andReturn(1)->getMock();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prophecy\Argument\Token;

use SebastianBergmann\Comparator\ComparisonFailure;
use Prophecy\Comparator\Factory as ComparatorFactory;
use Prophecy\Util\StringUtil;

/**
 * Exact value token.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class ExactValueToken implements TokenInterface
{
    private $value;
    private $string;
    private $util;
    private $comparatorFactory;

    /**
     * Initializes token.
     *
     * @param mixed             $value
     * @param StringUtil        $util
     * @param ComparatorFactory $comparatorFactory
     */
    public function __construct($value, StringUtil $util = null, ComparatorFactory $comparatorFactory = null)
    {
        $this->value = $value;
        $this->util  = $util ?: new StringUtil();

        $this->comparatorFactory = $comparatorFactory ?: ComparatorFactory::getInstance();
    }

    /**
     * Scores 10 if argument matches preset value.
     *
     * @param $argument
     *
     * @return bool|int
     */
    public function scoreArgument($argument)
    {
        if (is_object($argument) && is_object($this->value)) {
            $comparator = $this->comparatorFactory->getComparatorFor(
                $argument, $this->value
            );

            try {
                $comparator->assertEquals($argument, $this->value);
                return 10;
            } catch (ComparisonFailure $failure) {}
        }

        // If either one is an object it should be castable to a string
        if (is_object($argument) xor is_object($this->value)) {
            if (is_object($argument) && !method_exists($argument, '__toString')) {
                return false;
            }

            if (is_object($this->value) && !method_exists($this->value, '__toString')) {
                return false;
            }
        } elseif (is_numeric($argument) && is_numeric($this->value)) {
            // noop
        } elseif (gettype($argument) !== gettype($this->value)) {
            return false;
        }

        return $argument == $this->value ? 10 : false;
    }

    /**
     * Returns preset value against which token checks arguments.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns false.
     *
     * @return bool
     */
    public function isLast()
    {
        return false;
    }

    /**
     * Returns string representation for token.
     *
     * @return string
     */
    public function __toString()
    {
        if (null === $this->string) {
            $this->string = sprintf('exact(%s)', $this->util->stringify($this->value));
        }

        return $this->string;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ���� JFIF   d d  �� Ducky     <  �� &Adobe d�    
  �  	  F  
m�� � 		



��  P < �� �                                    !1"A#0$%         !1Q aq�"2A���r�BRb�C              0Aa@`!       !1AQaq �����������    iʠWg��v�N�l�e�'�Nb"�Ğ���a=;^�r�1�f����-5�1}I9�j:׋�gVz�6,39��	ʺ�Qr����V(Az��'<�/F��>�c��>D�Z��>Z�t.�^�'B����bX�}�(>�:���JI�;L����=����f����[˒=��Y������q����  Y��4����9p�rE���3�6