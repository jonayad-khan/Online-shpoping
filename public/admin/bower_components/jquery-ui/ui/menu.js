<?php declare(strict_types = 1);
namespace TheSeer\Tokenizer;

use  PHPUnit\Framework\TestCase;

/**
 * @covers \TheSeer\Tokenizer\XMLSerializer
 */
class XMLSerializerTest extends TestCase {

    /** @var TokenCollection $tokens */
    private $tokens;

    protected function setUp() {
        $this->tokens = unserialize(
            file_get_contents(__DIR__ . '/_files/test.php.tokens'),
            [TokenCollection::class]
        );
    }

    public function testCanBeSerializedToXml() {
        $expected = file_get_contents(__DIR__ . '/_files/test.php.xml');

        $serializer = new XMLSerializer();
        $this->assertEquals($expected, $serializer->toXML($this->tokens));
    }

    public function testCanBeSerializedToDomDocument() {
        $serializer = new XMLSerializer();
        $result = $serializer->toDom($this->tokens);

        $this->assertInstanceOf(\DOMDocument::class, $result);
        $this->assertEquals('source', $result->documentElement->localName);
    }

    public function testCanBeSerializedToXmlWithCustomNamespace() {
        $expected = file_get_contents(__DIR__ . '/_files/customns.xml');

        $serializer = new XMLSerializer(new NamespaceUri('custom:xml:namespace'));
        $this->assertEquals($expected, $serializer->toXML($this->tokens));
    }

}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\CssSelector\Node;

/**
 * Represents a "<selector>[<namespace>|<attribute> <operator> <value>]" node.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class AttributeNode extends AbstractNode
{
    private $selector;
    private $namespace;
    private $attribute;
    private $operator;
    private $value;

    public function __construct(NodeInterface $selector, ?string $namespace, string $attribute, string $operator, ?string $value)
    {
        $this->selector = $selector;
        $this->namespace = $namespace;
        $this->attribute = $attribute;
        $this->operator = $operator;
        $this->value = $value;
    }

    public function getSelector(): NodeInterface
    {
        return $this->selector;
    }

    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function getSpecificity(): Specificity
    {
        return $this->selector->getSpecificity()->plus(new Specificity(0, 1, 0));
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        $attribute = $this->namespace ? $this->namespace.'|'.$this->attribute : $this->attribute;

        return 'exists' === $this->operator
            ? sprintf('%s[%s[%s]]', $this->getNodeName(), $this->selector, $attribute)
            : sprintf("%s[%s[%s %s '%s']]", $this->getNodeName(), $this->selector, $attribute, $this->operator, $this->value);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Process;

use Symfony\Component\Process\Exception\RuntimeException;

/**
 * PhpProcess runs a PHP script in an independent process.
 *
 * $p = new PhpProcess('<?php echo "foo"; ?>');
 * $p->run();
 * print $p->getOutput()."\n";
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class PhpProcess extends Process
{
    /**
     * @param string      $script  The PHP script to run (as a string)
     * @param string|null $cwd     The working directory or null to use the working dir of the current PHP process
     * @param array|null  $env     The environment variables or null to use the same environment as the current PHP process
     * @param int         $timeout The timeout in seconds
     */
    public function __construct(string $script, string $cwd = null, array $env = null, int $timeout = 60)
    {
        $executableFinder = new PhpExecutableFinder();
        if (false === $php = $executableFinder->find(false)) {
            $php = null;
        } else {
            $php = array_merge(array($php), $executableFinder->findArguments());
        }
        if ('phpdbg' === PHP_SAPI) {
            $file = tempnam(sys_get_temp_dir(), 'dbg');
            file_put_contents($file, $script);
            register_shutdown_function('unlink', $file);
            $php[] = $file;
            $script = null;
        }

        parent::__construct($php, $cwd, $env, $script, $timeout);
    }

    /**
     * Sets the path to the PHP binary to use.
     */
    public function setPhpBinary($php)
    {
        $this->setCommandLine($php);
    }

    /**
     * {@inheritdoc}
     */
    public function start(callable $callback = null, array $env = array())
    {
        if (null === $this->getCommandLine()) {
            throw new RuntimeException('Unable to find the PHP executable.');
        }

        parent::start($callback, $env);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

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
use Symfony\Component\HttpKernel\Config\FileLocator;

class FileLocatorTest extends TestCase
{
    public function testLocate()
    {
        $kernel = $this->getMockBuilder('Symfony\Component\HttpKernel\KernelInterface')->getMock();
        $kernel
            ->expects($this->atLeastOnce())
            ->method('locateResource')
            ->with('@BundleName/some/path', null, true)
            ->will($this->returnValue('/bundle-name/some/path'));
        $locator = new FileLocator($kernel);
        $this->assertEquals('/bundle-name/some/path', $locator->locate('@BundleName/some/path'));

        $kernel
            ->expects($this->never())
            ->method('locateResource');
        $this->{method_exists($this, $_ = 'expectException') ? $_ : 'setExpectedException'}('LogicException');
        $locator->locate('/some/path');
    }

    public function testLocateWithGlobalResourcePath()
    {
        $kernel = $this->getMockBuilder('Symfony\Component\HttpKernel\KernelInterface')->getMock();
        $kernel
            ->expects($this->atLeastOnce())
            ->method('locateResource')
            ->with('@BundleName/some/path', '/global/resource/path', false);

        $locator = new FileLocator($kernel, '/global/resource/path');
        $locator->locate('@BundleName/some/path', null, false);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

namespace Psr\Log\Test;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Provides a base test class for ensuring compliance with the LoggerInterface.
 *
 * Implementors can extend the class and implement abstract methods to run this
 * as part of their test suite.
 */
abstract class LoggerInterfaceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return LoggerInterface
     */
    abstract public function getLogger();

    /**
     * This must return the log messages in order.
     *
     * The simple formatting of the messages is: "<LOG LEVEL> <MESSAGE>".
     *