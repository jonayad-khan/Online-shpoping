--TEST--
phpunit --colors=never --coverage-text=php://stdout --disable-coverage-ignore IgnoreCodeCoverageClassTest tests/_files/IgnoreCodeCoverageClassTest.php --whitelist ../../tests/_files/IgnoreCodeCoverageClass.php
--SKIPIF--
<?php
if (!extension_loaded('xdebug')) {
    print 'skip: Extension xdebug is required.';
}
?>
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--colors=never';
$_SERVER['argv'][3] = '--coverage-text=php://stdout';
$_SERVER['argv'][4] = '--disable-coverage-ignore';
$_SERVER['argv'][5] = __DIR__ . '/../_files/IgnoreCodeCoverageClassTest.php';
$_SERVER['argv'][6] = '--whitelist';
$_SERVER['argv'][7] = __DIR__ . '/../_files/IgnoreCodeCoverageClass.php';

require __DIR__ . '/../bootstrap.php';
PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

..                                                                  2 / 2 (100%)

Time: %s, Memory: %s

OK (2 tests, 2 assertions)


Code Coverage Report:%w
%s
%w
 Summary:%w
  Classes: 100.00% (1/1)%w
  Methods: 100.00% (2/2)%w
  Lines:%s

IgnoreCodeCoverageClass
  Methods: 100.00% ( 2/ 2)   Lines: 100.00% (  2/  2)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Reflection;

/**
 * Somehow the standard reflection library doesn't include constants.
 *
 * ReflectionConstant corrects that omission.
 */
class ReflectionConstant implements \Reflector
{
    private $class;
    private $name;
    private $value;

    /**
     * Construct a ReflectionConstant object.
     *
     * @param mixed  $class
     * @param string $name
     */
    public function __construct($class, $name)
    {
        if (!$class instanceof \ReflectionClass) {
            $class = new \ReflectionClass($class);
        }

        $this->class = $class;
        $this->name  = $name;

        $constants = $class->getConstants();
        if (!array_key_exists($name, $constants)) {
            throw new \InvalidArgumentException('Unknown constant: ' . $name);
        }

        $this->value = $constants[$name];
    }

    /**
     * Gets the declaring class.
     *
     * @return string
     */
    public function getDeclaringClass()
    {
        $parent = $this->class;

        // Since we don't have real reflection constants, we can't see where
        // it's actually defined. Let's check for a constant that is also
        // available on the parent class which has exactly the same value.
        //
        // While this isn't _technically_ correct, it's prolly close enough.
        do {
            $class = $parent;
            $parent = $class->getParentClass();
        } while ($parent && $parent->hasConstant($this->name) && $parent->getConstant($this->name) === $this->value);

        return $class;
    }

    /**
     * Gets the constant name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the value of the constant.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Gets the constant's file name.
     *
     * Currently returns null, because if it returns a file name the signature
     * formatter will barf.
     */
    public function getFileName()
    {
        return;
        // return $this->class->getFileName();
    }

    /**
     * Get the code start line.
     *
     * @throws \RuntimeException
     */
    public function getStartLine()
    {
        throw new \RuntimeException('Not yet implemented because it\'s unclear what I should do here :)');
    }

    /**
     * Get the code end line.
     *
     * @throws \RuntimeException
     */
    public function getEndLine()
    {
        return $this->getStartLine();
    }

    /**
     * Get the constant's docblock.
     *
     * @return false
     */
    public function getDocComment()
    {
        return false;
    }

    /**
     * Export the constant? I don't think this is possible.
     *
     * @throws \RuntimeException
     */
    public static function export()
    {
        throw new \RuntimeException('Not yet implemented because it\'s unclear what I should do here :)');
    }

    /**
     * To string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Swift Mailer class.
 *
 * @author Chris Corbyn
 */
class Swift_Mailer
{
    /** The Transport used to send messages */
    private $transport;

    /**
     * Create a new Mailer using $transport for delivery.
     *
     * @param Swift_Transport $transport
     */
    public function __construct(Swift_Transport $transport)
    {
        $this->transport = $transport;
    }

    /**
     * Create a new class instance of one of the message services.
     *
     * For example 'mimepart' would create a 'message.mimepart' instance
     *
     * @param string $service
     *
     * @return object
     */
    public function createMessage($service = 'message')
    {
        return Swift_DependencyContainer::getInstance()
            ->lookup('message.'.$service);
    }

    /**
     * Send the given Message like it would be sent in a mail client.
     *
     * All recipients (with the exception of Bcc) will be able to see the other
     * recipients this message was sent to.
     *
     * Recipient/sender data will be retrieved from the Message object.
     *
     * The return value is the number of recipients who were accepted for
     * delivery.
     *
     * @param Swift_Mime_SimpleMessage $message
     * @param array                    $failedRecipients An array of failures by-reference
     *
     * @return int The number of successful recipients. Can be 0 which indicates failure
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $failedRecipients = (array) $failedRecipients;

        if (!$this->transport->isStarted()) {
            $this->transport->start();
        }

        $sent = 0;

        try {
            $sent = $this->transport->send($message, $failedRecipients);
        } catch (Swift_RfcComplianceException $e) {
            foreach ($message->getTo() as $address => $name) {
                $failedRecipients[] = $address;
            }
        }

        return $sent;
    }

    /**
     * Register a plugin using a known unique key (e.g. myPlugin).
     *
     * @param Swift_Events_EventListener $plugin
     */
    public function registerPlugin(Swift_Events_EventListener $plugin)
    {
        $this->transport->registerPlugin($plugin);
    }

    /**
     * The Transport used to send messages.
     *
     * @return Swift_Transport
     */
    public function getTransport()
    {
        return $this->transport;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Input;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Represents a command line option.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class InputOption
{
    const VALUE_NONE = 1;
    const VALUE_REQUIRED = 2;
    const VALUE_OPTIONAL = 4;
    const VALUE_IS_ARRAY = 8;

    private $name;
    private $shortcut;
    private $mode;
    private $default;
    private $description;

    /**
     * Constructor.
     *
     * @param string       $name        The option name
     * @param string|array $shortcut    The shortcuts, can be null, a string of shortcuts delimited by | or an array of shortcuts
     * @param int          $mode        The option mode: One of the VALUE_* constants
     * @param string       $description A description text
     * @param mixed        $default     The default value (must be null for self::VALUE_NONE)
     *
     * @throws InvalidArgumentException If option mode is invalid or incompatible
     */
    public function __construct($name, $shortcut = null, $mode = null, $description = '', $default = null)
    {
        if (0 === strpos($name, '--')) {
            $name = substr($name, 2);
        }

        if (empty($name)) {
            throw new InvalidArgumentException('An option name cannot be empty.');
        }

        if (empty($shortcut)) {
            $shortcut = null;
        }

        if (null !== $shortcut) {
            if (is_array($shortcut)) {
                $shortcut = implode('|', $shortcut);
            }
            $shortcuts = preg_split('{(\|)-?}', ltrim($shortcut, '-'));
            $shortcuts = array_filter($shortcuts);
            $shortcut = implode('|', $shortcuts);

            if (empty($shortcut)) {
                throw new InvalidArgumentException('An option shortcut cannot be empty.');
            }
        }

        if (null === $mode) {
            $mode = self::VALUE_NONE;
        } elseif (!is_int($mode) || $mode > 15 || $mode < 1) {
            throw new InvalidArgumentException(sprintf('Option mode "%s" is not valid.', $mode));
        }

        $this->name = $name;
        $this->shortcut = $shortcut;
        $this->mode = $mode;
        $this->description = $description;

        if ($this->isArray() && !$this->acceptValue()) {
            throw new InvalidArgumentException('Impossible to have an option mode VALUE_IS_ARRAY if the option does not accept a value.');
        }

        $this->setDefault($default);
    }

    /**
     * Returns the option shortcut.
     *
     * @return string The shortcut
     */
    public function getShortcut()
    {
        return $this->shortcut;
    }

    /**
     * Returns the option name.
     *
     * @return string The name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns true if the option accepts a value.
     *
     * @return bool true if value mode is not self::VALUE_NONE, false otherwise
     */
    public function acceptValue()
    {
        return $this->isValueRequired() || $this->isValueOptional();
    }

    /**
     * Returns true if the option requires a value.
     *
     * @return bool true if value mode is self::VALUE_REQUIRED, false otherwise
     */
    public function isValueRequired()
    {
        return self::VALUE_REQUIRED === (self::VALUE_REQUIRED & $this->mode);
    }

    /**
     * Returns true if the option takes an optional value.
     *
     * @return bool true if value mode is self::VALUE_OPTIONAL, false otherwise
     */
    public function isValueOptional()
    {
        return self::VALUE_OPTIONAL === (self::VALUE_OPTIONAL & $this->mode);
    }

    /**
     * Returns true if the option can take multiple values.
     *
     * @return bool true if mode is self::VALUE_IS_ARRAY, false otherwise
     */
    public function isArray()
    {
        return self::VALUE_IS_ARRAY === (self::VALUE_IS_ARRAY & $this->mode);
    }

    /**
     * Sets the default value.
     *
     * @param mixed $default The default value
     *
     * @throws LogicException When incorrect default value is given
     */
    public function setDefault($default = null)
    {
        if (self::VALUE_NONE === (self::VALUE_NONE & $this->mode) && null !== $default) {
            throw new LogicException('Cannot set a default value when using InputOption::VALUE_NONE mode.');
        }

        if ($this->isArray()) {
            if (null === $default) {
                $default = array();
            } elseif (!is_array($default)) {
                throw new LogicException('A default value for an array option must be an array.');
            }
        }

        $this->default = $this->acceptValue() ? $default : false;
    }

    /**
     * Returns the default value.
     *
     * @return mixed The default value
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Returns the description text.
     *
     * @return string The description text
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Checks whether the given option equals this one.
     *
     * @param InputOption $option option to compare
     *
     * @return bool
     */
    public function equals(InputOption $option)
    {
        return $option->getName() === $this->getName()
            && $option->getShortcut() === $this->getShortcut()
            && $option->getDefault() === $this->getDefault()
            && $option->isArray() === $this->isArray()
            && $option->isValueRequired() === $this->isValueRequired()
            && $option->isValueOptional() === $this->isValueOptional()
        ;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Finder\Tests\Iterator;

use Symfony\Component\Finder\Iterator\DateRangeFilterIterator;
use Symfony\Component\Finder\Comparator\DateComparator;

class DateRangeFilterIteratorTest extends RealIteratorTestCase
{
    /**
     * @dataProvider getAcceptData
     */
    public function testAccept($size, $expected)
    {
        $files = self::$files;
        $files[] = self::toAbsolute('doesnotexist');
        $inner = new Iterator($files);

        $iterator = new DateRangeFilterIterator($inner, $size);

        $this->assertIterator($expected, $iterator);
    }

    public function getAcceptData()
    {
        $since20YearsAgo = array(
            '.git',
            'test.py',
            'foo',
            'foo/bar.tmp',
            'test.php',
            'toto',
            'toto/.git',
            '.bar',
            '.foo',
            '.foo/.bar',
            'foo bar',
            '.foo/bar',
        );

        $since2MonthsAgo = array(
            '.git',
            'test.py',
            'foo',
            'toto',
            'toto/.git',
            '.bar',
            '.foo',
            '.foo/.bar',
            'foo bar',
            '.foo/bar',
        );

        $untilLastMonth = array(
            'foo