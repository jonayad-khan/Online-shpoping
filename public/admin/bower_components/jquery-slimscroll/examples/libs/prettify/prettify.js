NGTH)) {
            if (function_exists('mb_substr')) {
                $dataArray['message'] = mb_substr($dataArray['message'], 0, static::MAXIMUM_MESSAGE_LENGTH).' [truncated]';
            } else {
                $dataArray['message'] = substr($dataArray['message'], 0, static::MAXIMUM_MESSAGE_LENGTH).' [truncated]';
            }
        }

        // if we are using the legacy API then we need to send some additional information
        if ($this->version == self::API_V1) {
            $dataArray['room_id'] = $this->room;
        }

        // append the sender name if it is set
        // always append it if we use the v1 api (it is required in v1)
        if ($this->version == self::API_V1 || $this->name !== null) {
            $dataArray['from'] = (string) $this->name;
        }

        return http_build_query($dataArray);
    }

    /**
     * Builds the header of the API Call
     *
     * @param  string $content
     * @return string
     */
    private function buildHeader($content)
    {
        if ($this->version == self::API_V1) {
            $header = "POST /v1/rooms/message?format=json&auth_token={$this->token} HTTP/1.1\r\n";
        } else {
            // needed for rooms with special (spaces, etc) characters in the name
            $room = rawurlencode($this->room);
            $header = "POST /v2/room/{$room}/notification?auth_token={$this->token} HTTP/1.1\r\n";
        }

        $header .= "Host: {$this->host}\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($content) . "\r\n";
        $header .= "\r\n";

        return $header;
    }

    /**
     * Assigns a color to each level of log records.
     *
     * @param  int    $level
     * @return string
     */
    protected function getAlertColor($level)
    {
        switch (true) {
            case $level >= Logger::ERROR:
                return 'red';
            case $level >= Logger::WARNING:
                return 'yellow';
            case $level >= Logger::INFO:
                return 'green';
            case $level == Logger::DEBUG:
                return 'gray';
            default:
                return 'yellow';
        }
    }

    /**
     * {@inheritdoc}
     *
     * @param array $record
     */
    protected function write(array $record)
    {
        parent::write($record);
        $this->closeSocket();
    }

    /**
     * {@inheritdoc}
     */
    public function handleBatch(array $records)
    {
        if (count($records) == 0) {
            return true;
        }

        $batchRecords = $this->combineRecords($records);

        $handled = false;
        foreach ($batchRecords as $batchRecord) {
            if ($this->isHandling($batchRecord)) {
                $this->write($batchRecord);
                $handled = true;
            }
        }

        if (!$handled) {
            return false;
        }

        return false === $this->bubble;
    }

    /**
     * Combines multiple records into one. Error level of the combined record
     * will be the highest level from the given records. Datetime will be taken
     * from the first record.
     *
     * @param $records
     * @return array
     */
    private function combineRecords($records)
    {
        $batchRecord = null;
        $batchRecords = array();
        $messages = array();
        $formattedMessages = array();
        $level = 0;
        $levelName = null;
        $datetime = null;

        foreach ($records as $record) {
            $record = $this->processRecord($record);

            if ($record['level'] > $level) {
                $level = $record['level'];
                $levelName = $record['level_name'];
            }

            if (null === $datetime) {
                $datetime = $record['datetime'];
            }

            $messages[] = $record['message'];
            $messageStr = implode(PHP_EOL, $messages);
            $formattedMessages[] = $this->getFormatter()->format($record);
            $formattedMessageStr = implode('', $formattedMessages);

            $batchRecord = array(
                'message'   => $messageStr,
                'formatted' => $formattedMessageStr,
                'context'   => array(),
                'extra'     => array(),
            );

            if (!$this->validateStringLength($batchRecord['formatted'], static::MAXIMUM_MESSAGE_LENGTH)) {
                // Pop the last message and implode the remaining messages
                $lastMessage = array_pop($messages);
                $lastFormattedMessage = array_pop($formattedMessages);
                $batchRecord['message'] = implode(PHP_EOL, $messages);
                $batchRecord['formatted'] = implode('', $formattedMessages);

                $batchRecords[] = $batchRecord;
                $messages = array($lastMessage);
                $formattedMessages = array($lastFormattedMessage);

                $batchRecord = null;
            }
        }

        if (null !== $batchRecord) {
            $batchRecords[] = $batchRecord;
        }

        // Set the max level and datetime for all records
        foreach ($batchRecords as &$batchRecord) {
            $batchRecord = array_merge(
                $batchRecord,
                array(
                    'level'      => $level,
                    'level_name' => $levelName,
                    'datetime'   => $datetime,
                )
            );
        }

        return $batchRecords;
    }

    /**
     * Validates the length of a string.
     *
     * If the `mb_strlen()` function is available, it will use that, as HipChat
     * allows UTF-8 characters. Otherwise, it will fall back to `strlen()`.
     *
     * Note that this might cause false failures in the specific case of using
     * a valid name with less than 16 characters, but 16 or more bytes, on a
     * system where `mb_strlen()` is unavailable.
     *
     * @param string $str
     * @param int    $length
     *
     * @return bool
     */
    private function validateStringLength($str, $length)
    {
        if (function_exists('mb_strlen')) {
            return (mb_strlen($str) <= $length);
        }

        return (strlen($str) <= $length);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     Yield operator precedence
-----
<?php

function gen() {
    yield "a" . "b";
    yield "a" or die;
    yield "k" => "a" . "b";
    yield "k" => "a" or die;
    var_dump([yield "k" => "a" . "b"]);
    yield yield "k1" => yield "k2" => "a" . "b";
    yield yield "k1" => (yield "k2") => "a" . "b";
    var_dump([yield "k1" => yield "k2" => "a" . "b"]);
    var_dump([yield "k1" => (yield "k2") => "a" . "b"]);
}
-----
!!php7
array(
    0: Stmt_Function(
        byRef: false
        name: gen
        params: array(
        )
        returnType: null
        stmts: array(
            0: Expr_Yield(
                key: null
                value: Expr_BinaryOp_Concat(
                    left: Scalar_String(
                        value: a
                    )
                    right: Scalar_String(
                        value: b
                    )
                )
            )
            1: Expr_BinaryOp_LogicalOr(
                left: Expr_Yield(
                    key: null
                    value: Scalar_String(
                        value: a
                    )
                )
                right: Expr_Exit(
                    expr: null
                )
            )
            2: Expr_Yield(
                key: Scalar_String(
                    value: k
                )
                value: Expr_BinaryOp_Concat(
                    left: Scalar_String(
                        value: a
                    )
                    right: Scalar_String(
                        value: b
                    )
                )
            )
            3: Expr_BinaryOp_LogicalOr(
                left: Expr_Yield(
                    key: Scalar_String(
                        value: k
                    )
                    value: Scalar_String(
                        value: a
                    )
                )
                right: Expr_Exit(
                    expr: null
                )
            )
            4: Expr_FuncCall(
                name: Name(
                    parts: array(
                        0: var_dump
                    )
                )
                args: array(
                    0: Arg(
                        value: Expr_Array(
                            items: array(
                                0: Expr_ArrayItem(
                                    key: null
                                    value: Expr_Yield(
                                        key: Scalar_String(
                                            value: k
                                        )
                                        value: Expr_BinaryOp_Concat(
                                            left: Scalar_String(
                                                value: a
                                            )
                                            right: Scalar_String(
                                                value: b
                                            )
                                        )
                                    )
                                    byRef: false
                                )
                            )
                        )
                        byRef: false
                        unpack: false
                    )
                )
            )
            5: Expr_Yield(
                key: null
                value: Expr_Yield(
                    key: Scalar_String(
                        value: k1
                    )
                    value: Expr_Yield(
                        key: Scalar_String(
                            value: k2
                        )
                        value: Expr_BinaryOp_Concat(
                            left: Scalar_String(
                                value: a
                            )
                            right: Scalar_String(
                                value: b
                            )
                        )
                    )
                )
            )
            6: Expr_Yield(
                key: Expr_Yield(
                    key: Scalar_String(
                        value: k1
                    )
                    value: Expr_Yield(
                        key: null
                        value: Scalar_String(
                            value: k2
                        )
                    )
                )
                value: Expr_BinaryOp_Concat(
                    left: Scalar_String(
                        value: a
                    )
                    right: Scalar_String(
                        value: b
                    )
                )
            )
            7: Expr_FuncCall(
                name: Name(
                    parts: array(
                        0: var_dump
                    )
                )
                args: array(
                    0: Arg(
                        value: Expr_Array(
                            items: array(
                                0: Expr_ArrayItem(
                                    key: null
                                    value: Expr_Yield(
                                        key: Scalar_String(
                                            value: k1
                                        )
                                        value: Expr_Yield(
                                            key: Scalar_String(
                                                value: k2
                                            )
                                            value: Expr_BinaryOp_Concat(
                                                left: Scalar_String(
                                                    value: a
                                                )
                                                right: Scalar_String(
                                                    value: b
                                                )
                                            )
                                        )
                                    )
                                    byRef: false
                                )
                            )
                        )
                        byRef: false
                        unpack: false
                    )
                )
            )
            8: Expr_FuncCall(
                name: Name(
                    parts: array(
                        0: var_dump
                    )
                )
                args: array(
                    0: Arg(
                        value: Expr_Array(
                            items: array(
                                0: Expr_ArrayItem(
                                    key: Expr_Yield(
                                        key: Scalar_String(
                                            value: k1
                                        )
                                        value: Expr_Yield(
                                            key: null
                                            value: Scalar_String(
                                                value: k2
                                            )
                                        )
                                    )
                                    value: Expr_BinaryOp_Concat(
                                        left: Scalar_String(
                                            value: a
                                        )
                                        right: Scalar_String(
                                            value: b
                                        )
                                    )
                                    byRef: false
                                )
                            )
                        )
                        byRef: false
                        unpack: false
                    )
                )
            )
        )
    )
)
                                                                                                                                                                                            INDX( 	                 (   �  �                            �    h X     �    �r�b� ��F��-r�b��r�b�                       A d d r e s s . p h p �    h T     �    <r�b� ��F��yZr�b�<r�b�       �              	 C o l o r . p h p     �    h X     �    #hr�b� ��F����r�b� hr�b� 0      �%               C o m p a n y . p h p �    p Z     �    �r�b� ��F����r�b��r�b�       6               D a t e T i m e . p h p       �    p Z     �    ��r�b� ��F����r�b���r�b�       �               I n t e r n e t . p h p       �    h X     �    x�r�b� ��F����r�b�x�r�b�       �               P a y m e n t . p h p �    h V     �    z�r�b� ��F��cs�b�z�r�b�        �              
 P e r s o n . p h p   �    p `     �    2s�b� ��F��+s�b�0s�b�       #               P h o n e N u m b e r . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                .. index::
    single: Mocking; Partial Mocks

Creating Partial Mocks
======================

Partial mocks are useful when we only need to mock several methods of an
object leaving the remainder free to respond to calls normally (i.e.  as
implemented). Mockery implements three distinct strategies for creating
partials. Each has specific advantages and disadvantages so which strategy we
use will depend on our own preferences and the source code in need of
mocking.

We have previously talked a bit about :ref:`creating-test-doubles-partial-test-doubles`,
but we'd like to expand on the subject a bit here.

#. Runtime partial test doubles
#. Generated partial test doubles
#. Proxied Partial Mock

Runtime partial test doubles
----------------------------

A runtime partial test double, also known as a passive partial mock, is a kind
of a default state of being for a mocked object.

.. code-block:: php

    $mock = \Mockery::mock('MyClass')->makePartial();

With a generated partial, we assume that all methods will simply defer to the
parent class (``MyClass``) original methods unless a method call matches a
known expectation. If we have no matching expectation for a specific method
call, that call is deferred to the class being mocked. Since the division
between mocked and unmocked calls depends entirely on the expectations we
define, there is no need to define which methods to mock in advance.

See the cookbook entry on :doc:`../cookbook/big_parent_class` for an example
usage of runtime partial test doubles.

.. note::

    The ``makePartial()`` method is identical to the original ``shouldDeferMissing()``
    method which first introduced this Partial Mock type. To know more about
    ``shouldDeferMissing()`` method - see the chapter on
    :ref:`creating-test-doubles-behavior-modifiers`.

Generated Partial Test Doubles
------------------------------

A generated partial test double, also known as a traditional partial mock,
defines ahead of time which methods of a class are to be mocked and which are
to be left unmocked (i.e. callable as normal). The syntax for creating
traditional mocks is:

.. code-block:: php

    $mock = \Mockery::mock('MyClass[foo,bar]');

In the above example, the ``foo()`` and ``bar()`` methods of MyClass will be
mocked but no other MyClass methods are touched. We will need to define
expectations for the ``foo()`` and ``bar()`` methods to dictate their mocked
behaviour.

Don't forget that we can pass in constructor arguments since unmocked methods
may rely on those!

.. code-block:: php

    $mock = \Mockery::mock('MyNamespace\MyClass[foo]', array($arg1, $arg2));

See the :ref:`creating-test-doubles-constructor-arguments` section to read up
on them.

.. note::

    Even though we support generated partial test doubles, we do not recommend
    using them.

Proxied Partial Mock
--------------------

A proxied partial mock is a partial of last resort. We may encounter a class
which is simply not capable of being mocked because it has been marked as
final. Similarly, we may find a class with methods marked as final. In such a
scenario, we cannot simply extend the class and override methods to mock - we
need to get creative.

.. code-block:: php

    $mock = \Mockery::mock(new MyClass);

Yes, the new mock is a Proxy. It intercepts calls and reroutes them to the
proxied object (which we construct and pass in) for methods which are not
subject to any expectations. Indirectly, this allows we to mock methods
marked final since the Proxy is not subject to those limitations. The tradeoff
should be obvious - a proxied partial will fail any typehint checks for the
class being mocked since it cannot extend that class.

Special Internal Cases
----------------------

All mock objects, with the exception of Proxied Partials, allows us to make
any expectation call to the underlying real class method using the ``passthru()``
expectation call. This will return values from the real call and bypass any
mocked return queue (which can simply be omitted obviously).

There is a fourth kind of partial mock reserved for internal use. This is
automatically generated when we attempt to mock a class containing methods
marked final. Since we cannot override such methods, they are simply left
unmocked. Typically, we don't need to worry about this but if we really
really must mock a final method, the only possible means is through a Proxied
Partial Mock. SplFileInfo, for example, is a common class subject to this form
of automatic internal partial since it contains public final methods used
internally.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Util;

use PHPUnit\Framework\Error\Deprecated;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\Error\Notice;
use PHPUnit\Framework\Error\Warning;

/**
 * Error handler that converts PHP errors and warnings to exceptions.
 */
final class ErrorHandler
{
    private static $errorStack = [];

    /**
     * Returns the error stack.
     *
     * @return array
     */
    public static function getErrorStack(): array
    {
        return self::$errorStack;
    }

    public static function handleError(int $errorNumber, string $errorString, string $errorFile, int $errorLine): bool
    {
        if (!($errorNumber & \error_reporting())) {
            return false;
        }

        self::$errorStack[] = [$errorNumber, $errorString, $errorFile, $errorLine];

        $trace = \debug_backtrace();
        \array_shift($trace);

        foreach ($trace as $frame) {
            if ($frame['function'] === '__toString') {
                return false;
            }
        }

        if ($errorNumber === E_NOTICE || $errorNumber === E_USER_NOTICE || $errorNumber === E_STRICT) {
            if (Notice::$enabled !== true) {
                return false;
            }

            $exception = Notice::class;
        } elseif ($errorNumber === E_WARNING || $errorNumber === E_USER_WARNING) {
            if (Warning::$enabled !== true) {
                return false;
            }

            $exception = Warning::class;
        } elseif ($errorNumber === E_DEPRECATED || $errorNumber === E_USER_DEPRECATED) {
            if (Deprecated::$enabled !== true) {
                return false;
            }

            $exception = Deprecated::class;
        } else {
            $exception = Error::class;
        }

        throw new $exception($errorString, $errorNumber, $errorFile, $errorLine);
    }

    /**
     * Registers an error handler and returns a function that will restore
     * the previous handler when invoked
     *
     * @param int $severity PHP predefined error constant
     *
     * @throws \Exception if event of specified severity is emitted
     *
     * @return \Closure
     */
    public static function handleErrorOnce($severity = E_WARNING): callable
    {
        $terminator = function () {
            static $expired = false;

            if (!$expired) {
                $expired = true;

                return \restore_error_handler();
            }
        };

        \set_error_handler(
            function ($errorNumber, $errorString) use ($severity) {
                if ($errorNumber === $severity) {
                    return;
                }

                return false;
            }
        );

        return $terminator;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

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
 * Object state-checker token.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class ObjectStateToken implements TokenInterface
{
    private $name;
    private $value;
    private $util;
    private $comparatorFactory;

    /**
     * Initializes token.
     *
     * @param string            $methodName
     * @param mixed             $value             Expected return value
     * @param null|StringUtil   $util
     * @param ComparatorFactory $comparatorFactory
     */
    public function __construct(
        $methodName,
        $value,
        StringUtil $util = null,
        ComparatorFactory $comparatorFactory = null
    ) {
        $this->name  = $methodName;
        $this->value = $value;
        $this->util  = $util ?: new StringUtil;

        $this->comparatorFactory = $comparatorFactory ?: ComparatorFactory::getInstance();
    }

    /**
     * Scores 8 if argument is an object, which method returns expected value.
     *
     * @param mixed $argument
     *
     * @return bool|int
     */
    public function scoreArgument($argument)
    {
        if (is_object($argument) && method_exists($argument, $this->name)) {
            $actual = call_user_func(array($argument, $this->name));

            $comparator = $this->comparatorFactory->getComparatorFor(
                $this->value, $actual
            );

            try {
                $comparator->assertEquals($this->value, $actual);
                return 8;
            } catch (ComparisonFailure $failure) {
                return false;
            }
        }

        if (is_object($argument) && property_exists($argument, $this->name)) {
            return $argument->{$this->name} === $this->value ? 8 : false;
        }

        return false;
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
        return sprintf('state(%s(), %s)',
            $this->name,
            $this->util->stringify($this->value)
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       ���� JFIF   d d  �� Ducky     <  �� &Adobe d�    
  ~  �  �  	��� � 		



��  G G �� �                                   01!A"#34         1AQ!a"B q�2�3��#               `        !1AQaq� ��������    Sk��<�
]��*8`����������'[��F�zSJ%�iy�9Fi:�E��R�4�h[H�0�W&Q�
J���zJ�[��Bu�Wb�Q�yux��;�0
�l�����i!]tkTE����[	���	�^5[;��Y�f7c�͝y���W�o��  Rb�5��6���Skl�Vpvvm���f��^�� �o����_ܳ��uٖ�ש��m�%���O�6�,���Z�oo����]J��WL�r`c��a&}'��Tե�\��Zl1�]3;b{��m�Υ,G�W���k5���?Y� +N]�k��e��^�۶���?���jC��;	�mk%�Z�vݨ�i��ϰ*A?l��RfLܡ� �{> O�L$���  ��'�fx�ςy�q ���}Ls>���  �r�D���d�x�gcdz��D>��@����FD�42�?�� ?#�� ?#�� ?�����5Q8����6��N�?{)r,�O��:w�ҺάZp�p|���*�\D�����|�����e������=��fp��H��?Y�n{��\��f��^��eO��Bh��b��������Q�2��.\M󕫴�(��J�}%)L����XI���Cm�o�XR��+1� ?��4��H�S3������қ�P��&��|ǀ���01SAU�Smֳ���q�G���r�� �� ?!���Nخ��*�� ��(�l"�̟�L�$<�S]נK�����~"S��b|���PN��=!Z� y�ζ_�|J��3���(��?������S->z�2u����fg8�>JA�b1�%ߩ���Qg+��:�+��]5��s�����>�b���s.Um} ����D�O�7o�,��,*|�<��^qx���{F�x�T.��L̓5��:���K:%_��<�����G�W�2-vb��*�F�V4�`~e���x��Z�֝K6"b-0� nͽ̗y��_����f�V�׉T^�!~��)Z�j!�g����=!���O�e�٦���bU�}ù@ĵ<O�L3�� ?!�c�Ń*��b}��s���n�ľXrgQ3+�h<�Y�7�._ƒ��5��� ?!��D��H�u5�q�\=Hs}��⾰�7�ȶ��"�7�l�L#�Ԩ�	}JE���j����    Ηy#�Z|D��=c�Pܷ��G\�t�?�� ?�s��Ai�.ւW]`'�D�*�`�X�����PDb��xc �v��,� ���^���~
wU�Fn��l�K���wմ�����ZE:�� �R�=f7V'�h�Z%V��3��/*��Xc)F/���S{א�ё�"��ݐ�6F-q-M_�f���9)�ܘk��#�̮��&�v��\X(nۏ_���o@1���w|A-� B�glu�UW�ڳm;[�핕uDi�mY�e����� �k�Z�^i�]��@��v{n�1�������4nM�
��à�0����Q"��B���-���N�e�D_$[����Š4 ��;�C�A ]j�m�o1�0 :.S/z��l�WT`�Q�c^i�.�|Cɵ�e�=|�ZL61I	��ܤx�_"����j��.�8 ��m�ڽ��2��;���U�?��2��*��������E�]��V@�*����G؄� POI��)T�������8V,�t2acdT�P��%W��m�C�3�A���� ?H�a._ �6x���_��\T1�:T0��L��Z�w���(��DM�Ce�u�UQN�,ܫ(�.P,Q���Q����+b0&�������`�q�z�oq\��Y�\aw.,�M	�<�� ?�P�eYAS;���/B+R��[7w2�HZ��k�f��V�S�2J�BTUT��ٓp���qS*��7R�x��T�їP-��5,�K���7������񄶷(�d��|� ��                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

namespace Faker\Provider\ro_MD;

class PhoneNumber extends \Faker\Provider\PhoneNumber
{
    protected static $formats = array(
        'a## # ## ##',
        '(022) ### ###',
        '+373 60 ### ###',
        '+373 65 0## ###',
        '+373 67 ### ###',
        '+373 68 ### ###',
        '+373 69 ### ###',
        '+373 78 ### ###',
        '+373 79 ### ###',
        '+373 77 4## ###',
        '+373 77 7## ###',
        '+373 77 8## ###',
        '+373 77 9## ###',
        '(373) 60 ### ###',
        '(373) 65 0## ###',
        '(373) 67 ### ###',
        '(373) 68 ### ###',
        '(373) 69 ### ###',
        '(373) 78 ### ###',
        '(373) 79 ### ###',
        '(373) 77 4## ###',
        '(373) 77 7## ###',
        '(373) 77 8## ###',
        '(373) 77 9## ###',
    );
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   INDX( 	                 (     �       �.                   !    � l          G�C�b����f=��C�b�@�C�b�       �               I s E m p t y S t r i n g T e s t . p h p     "    � x          �C�b����f=��C�b�~�C�b�       |               I s E q u a l I g n o r i n g C a s e T e s t . p h p #    � �          j�C�b����f=�D�b�j�C�b�       k              ! I s E q u a l I g n o r i n g W h i t e S p a c e T e s t . p h p     $    � n          SD�b ���f=�7;D�b�LD�b�       [               M a t c h e s P a t t e r n T e s t . p h p   %    � �          �KD�b����f=��hD�b��KD�b�       �	              " S t r i n g C o n t a i n s I g n o r i n g C a s e T e s t . p h p   &    � |          	wD�b����f=���D�b�wD�b�       �               S t r i n g C o n t a i n s I n O r d e r T e s t . p h p     '    � n          ˠD�b����f=���D�b�ƠD�b�       W
               S t r i n g C o n t a i n s T e s t  p h p   (    � n          ��D�b����f=���D�b���D�b�       g               S t r i n g E n d s W i t h T e s t . p h p   )    � r          ��D�b����f=��E�b���D�b�       r               S t r i n g S t a r t s W i t h T e s t . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

namespace Illuminate\Database\Schema;

use Closure;
use LogicException;
use Illuminate\Database\Connection;

class Builder
{
    /**
     * The database connection instance.
     *
     * @var \Illuminate\Database\Connection
     */
    protected $connection;

    /**
     * The schema grammar instance.
     *
     * @var \Illuminate\Database\Schema\Grammars\Grammar
     */
    protected $grammar;

    /**
     * The Blueprint resolver callback.
     *
     * @var \Closure
     */
    protected $resolver;

    /**
     * The default string length for migrations.
     *
     * @var int
     */
    public static $defaultStringLength = 255;

    /**
     * Create a new database Schema manager.
     *
     * @param  \Illuminate\Database\Connection  $connection
     * @return void
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->grammar = $connection->getSchemaGrammar();
    }

    /**
     * Set the default string length for migrations.
     *
     * @param  int  $length
     * @return void
     */
    public static function defaultStringLength($length)
    {
        static::$defaultStringLength = $length;
    }

    /**
     * Determine if the given table exists.
     *
     * @param  string  $table
     * @return bool
     */
    public function hasTable($table)
    {
        $table = $this->connection->getTablePrefix().$table;

        return count($this->connection->select(
            $this->grammar->compileTableExists(), [$table]
        )) > 0;
    }

    /**
     * Determine if the given table has a given column.
     *
     * @param  string  $table
     * @param  string  $column
     * @return bool
     */
    public function hasColumn($table, $column)
    {
        return in_array(
            strtolower($column), array_map('strtolower', $this->getColumnListing($table))
        );
    }

    /**
     * Determine if the given table has given columns.
     *
     * @param  string  $table
     * @param  array   $columns
     * @return bool
     */
    public function hasColumns($table, array $columns)
    {
        $tableColumns = array_map('strtolower', $this->getColumnListing($table));

        foreach ($columns as $column) {
            if (! in_array(strtolower($column), $tableColumns)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the data type for the given column name.
     *
     * @param  string  $table
     * @param  string  $column
     * @return string
     */
    public function getColumnType($table, $column)
    {
        $table = $this->connection->getTablePrefix().$table;

        return $this->connection->getDoctrineColumn($table, $column)->getType()->getName();
    }

    /**
     * Get the column listing for a given table.
     *
     * @param  string  $table
     * @return array
     */
    public function getColumnListing($table)
    {
        $results = $this->connection->select($this->grammar->compileColumnListing(
            $this->connection->getTablePrefix().$table
        ));

        return $this->connection->getPostProcessor()->processColumnListing($results);
    }

    /**
     * Modify a table on the schema.
     *
     * @param  string    $table
     * @param  \Closure  $callback
     * @return void
     */
    public function table($table, Closure $callback)
    {
        $this->build($this->createBlueprint($table, $callback));
    }

    /**
     * Create a new table on the schema.
     *
     * @param  string    $table
     * @param  \Closure  $callback
     * @return void
     */
    public function create($table, Closure $callback)
    {
        $this->build(tap($this->createBlueprint($table), function ($blueprint) use ($callback) {
            $blueprint->create();

            $callback($blueprint);
        }));
    }

    /**
     * Drop a table from the schema.
     *
     * @param  string  $table
     * @return void
     */
    public function drop($table)
    {
        $this->build(tap($this->createBlueprint($table), function ($blueprint) {
            $blueprint->drop();
        }));
    }

    /**
     * Drop a table from the schema if it exists.
     *
     * @param  string  $table
     * @return void
     */
    public function dropIfExists($table)
    {
        $this->build(tap($this->createBlueprint($table), function ($blueprint) {
            $blueprint->dropIfExists();
        }));
    }

    /**
     * Drop all tables from the database.
     *
     * @return void
     *
     * @throws \LogicException
     */
    public function dropAllTables()
    {
        throw new LogicException('This database driver does not support dropping all tables.');
    }

    /**
     * Rename a table on the schema.
     *
     * @param  string  $from
     * @param  string  $to
     * @return void
     */
    public function rename($from, $to)
    {
        $this->build(tap($this->createBlueprint($from), function ($blueprint) use ($to) {
            $blueprint->rename($to);
        }));
    }

    /**
     * Enable foreign key constraints.
     *
     * @return bool
     */
    public function enableForeignKeyConstraints()
    {
        return $this->connection->statement(
            $this->grammar->compileEnableForeignKeyConstraints()
        );
    }

    /**
     * Disable foreign key constraints.
     *
     * @return bool
     */
    public function disableForeignKeyConstraints()
    {
        return $this->connection->statement(
            $this->grammar->compileDisableForeignKeyConstraints()
        );
    }

    /**
     * Execute the blueprint to build / modify the table.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @return void
     */
    protected function build(Blueprint $blueprint)
    {
        $blueprint->build($this->connection, $this->grammar);
    }

    /**
     * Create a new command set with a Closure.
     *
     * @param  string  $table
     * @param  \Closure|null  $callback
     * @return \Illuminate\Database\Schema\Blueprint
     */
    protected function createBlueprint($table, Closure $callback = null)
    {
        if (isset($this->resolver)) {
            return call_user_func($this->resolver, $table, $callback);
        }

        return new Blueprint($table, $callback);
    }

    /**
     * Get the database connection instance.
     *
     * @return \Illuminate\Database\Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Set the database connection instance.
     *
     * @param  \Illuminate\Database\Connection  $connection
     * @return $this
     */
    public function setConnection(Connection $connect