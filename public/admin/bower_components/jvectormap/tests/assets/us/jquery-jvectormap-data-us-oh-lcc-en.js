le path to edit, null if the input was null, or the value of the referenced variable
     *
     * @throws \InvalidArgumentException If the variable is not found in the current context
     */
    private function extractFilePath($fileArgument)
    {
        // If the file argument was a variable, get it from the context
        if ($fileArgument !== null &&
            strlen($fileArgument) > 0 &&
            $fileArgument[0] === '$') {
            $fileArgument = $this->context->get(preg_replace('/^\$/', '', $fileArgument));
        }

        return $fileArgument;
    }

    /**
     * @param string $filePath
     * @param string $shouldRemoveFile
     *
     * @return string
     *
     * @throws \UnexpectedValueException if file_get_contents on $filePath returns false instead of a string
     */
    private function editFile($filePath, $shouldRemoveFile)
    {
        $escapedFilePath = escapeshellarg($filePath);

        $pipes = array();
        $proc = proc_open((getenv('EDITOR') ?: 'nano') . " {$escapedFilePath}", array(STDIN, STDOUT, STDERR), $pipes);
        proc_close($proc);

        $editedContent = @file_get_contents($filePath);

        if ($shouldRemoveFile) {
            @unlink($filePath);
        }

        if ($editedContent === false) {
            throw new \UnexpectedValueException("Reading {$filePath} returned false");
        }

        return $editedContent;
    }

    /**
     * Set the Context reference.
     *
     * @param Context $context
     */
    public function setContext(Context $context)
    {
        $this->context = $context;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               # sebastian/diff

Diff implementation for PHP, factored out of PHPUnit into a stand-alone component.

## Installation

You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/):

    composer require sebastian/diff

If you only need this library during development, for instance to run your project's test suite, then you should add it as a development-time dependency:

    composer require --dev sebastian/diff

### Usage

The `Differ` class can be used to generate a textual representation of the difference between two strings:

```php
use SebastianBergmann\Diff\Differ;

$differ = new Differ;
print $differ->diff('foo', 'bar');
```

The code above yields the output below:

    --- Original
    +++ New
    @@ @@
    -foo
    +bar

The `Parser` class can be used to parse a unified diff into an object graph:

```php
use SebastianBergmann\Diff\Parser;
use SebastianBergmann\Git;

$git = new Git('/usr/local/src/money');

$diff = $git->getDiff(
  '948a1a07768d8edd10dcefa8315c1cbeffb31833',
  'c07a373d2399f3e686234c4f7f088d635eb9641b'
);

$parser = new Parser;

print_r($parser->parse($diff));
```

The code above yields the output below:

    Array
    (
        [0] => SebastianBergmann\Diff\Diff Object
            (
                [from:SebastianBergmann\Diff\Diff:private] => a/tests/MoneyTest.php
                [to:SebastianBergmann\Diff\Diff:private] => b/tests/MoneyTest.php
                [chunks:SebastianBergmann\Diff\Diff:private] => Array
                    (
                        [0] => SebastianBergmann\Diff\Chunk Object
                            (
                                [start:SebastianBergmann\Diff\Chunk:private] => 87
                                [startRange:SebastianBergmann\Diff\Chunk:private] => 7
                                [end:SebastianBergmann\Diff\Chunk:private] => 87
                                [endRange:SebastianBergmann\Diff\Chunk:private] => 7
                                [lines:SebastianBergmann\Diff\Chunk:private] => Array
                                    (
                                        [0] => SebastianBergmann\Diff\Line Object
                                            (
                                                [type:SebastianBergmann\Diff\Line:private] => 3
                                                [content:SebastianBergmann\Diff\Line:private] =>      * @covers SebastianBergmann\Money\Money::add
                                            )

                                        [1] => SebastianBergmann\Diff\Line Object
                                            (
                                                [type:SebastianBergmann\Diff\Line:private] => 3
                                                [content:SebastianBergmann\Diff\Line:private] =>      * @covers SebastianBergmann\Money\Money::newMoney
                                            )

                                        [2] => SebastianBergmann\Diff\Line Object
                                            (
                                                [type:SebastianBergmann\Diff\Line:private] => 3
                                                [content:SebastianBergmann\Diff\Line:private] =>      */
                                            )

                                        [3] => SebastianBergmann\Diff\Line Object
                                            (
                                                [type:SebastianBergmann\Diff\Line:private] => 2
                                                [content:SebastianBergmann\Diff\Line:private] =>     public function testAnotherMoneyWithSameCurrencyObjectCanBeAdded()
                                            )

                                        [4] => SebastianBergmann\Diff\Line Object
                                            (
                                                [type:SebastianBergmann\Diff\Line:private] => 1
                                                [content:SebastianBergmann\Diff\Line:private] =>     public function testAnotherMoneyObjectWithSameCurrencyCanBeAdded()
                                            )

                                        [5] => SebastianBergmann\Diff\Line Object
                                            (
                                                [type:SebastianBergmann\Diff\Line:private] => 3
                                                [content:SebastianBergmann\Diff\Line:private] =>     {
                                            )

                                        [6] => SebastianBergmann\Diff\Line Object
                                            (
                                                [type:SebastianBergmann\Diff\Line:private] => 3
                                                [content:SebastianBergmann\Diff\Line:private] =>         $a = new Money(1, new Currency('EUR'));
                                            )

                                        [7] => SebastianBergmann\Diff\Line Object
                                            (
                                                [type:SebastianBergmann\Diff\Line:private] => 3
                                                [content:SebastianBergmann\Diff\Line:private] =>         $b = new Money(2, new Currency('EUR'));
                                            )

                                    )

                            )

                    )

            )

    )
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Generated when a message is being sent.
 *
 * @author Chris Corbyn
 */
class Swift_Events_SendEvent extends Swift_Events_EventObject
{
    /** Sending has yet to occur */
    const RESULT_PENDING = 0x0001;

    /** Email is spooled, ready to be sent */
    const RESULT_SPOOLED = 0x0011;

    /** Sending was successful */
    const RESULT_SUCCESS = 0x0010;

    /** Sending worked, but there were some failures */
    const RESULT_TENTATIVE = 0x0100;

    /** Sending failed */
    const RESULT_FAILED = 0x1000;

    /**
     * The Message being sent.
     *
     * @var Swift_Mime_SimpleMessage
     */
    private $message;

    /**
     * Any recipients which failed after sending.
     *
     * @var string[]
     */
    private $failedRecipients = array();

    /**
     * The overall result as a bitmask from the class constants.
     *
     * @var int
     */
    private $result;

    /**
     * Create a new SendEvent for $source and $message.
     *
     * @param Swift_Transport          $source
     * @param Swift_Mime_SimpleMessage $message
     */
    public function __construct(Swift_Transport $source, Swift_Mime_SimpleMessage $message)
    {
        parent::__construct($source);
        $this->message = $message;
        $this->result = self::RESULT_PENDING;
    }

    /**
     * Get the Transport used to send the Message.
     *
     * @return Swift_Transport
     */
    public function getTransport()
    {
        return $this->getSource();
    }

    /**
     * Get the Message being sent.
     *
     * @return Swift_Mime_SimpleMessage
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the array of addresses that failed in sending.
     *
     * @param array $recipients
     */
    public function setFailedRecipients($recipients)
    {
        $this->failedRecipients = $recipients;
    }

    /**
     * Get an recipient addresses which were not accepted for delivery.
     *
     * @return string[]
     */
    public function getFailedRecipients()
    {
        return $this->failedRecipients;
    }

    /**
     * Set the result of sending.
     *
     * @param int $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * Get the result of this Event.
     *
     * The return value is a bitmask from
     * {@see RESULT_PENDING, RESULT_SUCCESS, RESULT_TENTATIVE, RESULT_FAILED}
     *
     * @return int
     */
    public function getResult()
    {
        return $this->result;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\CssSelector\Tests\Node;

use Symfony\Component\CssSelector\Node\AttributeNode;
use Symfony\Component\CssSelector\Node\ElementNode;

class AttributeNodeTest extends AbstractNodeTest
{
    public function getToStringConversionTestData()
    {
        return array(
            array(new AttributeNode(new ElementNode(), null, 'attribute', 'exists', null), 'Attribute[Element[*][attribute]]'),
            array(new AttributeNode(new ElementNode(), null, 'attribute', '$=', 'value'), "Attribute[Element[*][attribute $= 'value']]"),
            array(new AttributeNode(new ElementNode(), 'namespace', 'attribute', '$=', 'value'), "Attribute[Element[*][namespace|attribute $= 'value']]"),
        );
    }

    public function getSpecificityValueTestData()
    {
        return array(
            array(new AttributeNode(new ElementNode(), null, 'attribute', 'exists', null), 10),
            array(new AttributeNode(new ElementNode(null, 'element'), null, 'attribute', 'exists', null), 11),
            array(new AttributeNode(new ElementNode(), null, 'attribute', '$=', 'value'), 10),
            array(new AttributeNode(new ElementNode(), 'namespace', 'attribute', '$=', 'value'), 10),
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Config;

use Symfony\Component\Config\FileLocator as BaseFileLocator;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * FileLocator uses the KernelInterface to locate resources in bundles.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class FileLocator extends BaseFileLocator
{
    private $kernel;
    private $path;

    /**
     * @param KernelInterface $kernel A KernelInterface instance
     * @param null|string     $path   The path the global resource directory
     * @param array           $paths  An array of paths where to look for resources
     */
    public function __construct(KernelInterface $kernel, $path = null, array $paths = array())
    {
        $this->kernel = $kernel;
        if (null !== $path) {
            $this->path = $path;
            $paths[] = $path;
        }

        parent::__construct($paths);
    }

    /**
     * {@inheritdoc}
     */
    public function locate($file, $currentPath = null, $first = true)
    {
        if (isset($file[0]) && '@' === $file[0]) {
            return $this->kernel->locateResource($file, $this->path, $first);
        }

        return parent::locate($file, $currentPath, $first);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Generator;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Psr\Log\LoggerInterface;

/**
 * UrlGenerator can generate a URL or a path for any route in the RouteCollection
 * based on the passed parameters.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Tobias Schultze <http://tobion.de>
 */
class UrlGenerator implements UrlGeneratorInterface, ConfigurableRequirementsInterface
{
    /**
     * @var RouteCollection
     */
    protected $routes;

    /**
     * @var RequestContext
     */
    protected $context;

    /**
     * @var bool|null
     */
    protected $strictRequirements = true;

    /**
     * @var LoggerInterface|null
     */
    protected $logger;

    /**
     * This array defines the characters (besides alphanumeric ones) that will not be percent-encoded in the path segment of the generated URL.
     *
     * PHP's rawurlencode() encodes all chars except "a-zA-Z0-9-._~" according to RFC 3986. But we want to allow some chars
     * to be used in their literal form (reasons below). Other chars inside the path must of course be encoded, e.g.
     * "?" and "#" (would be interpreted wrongly as query and fragment identifier),
     * "'" and """ (are used as delimiters in HTML).
     */
    protected $decodedChars = array(
        // the slash can be used to designate a hierarchical structure and we want allow using it with this meaning
        // some webservers don't allow the slash in encoded form in the path for security reasons anyway
        // see http://stackoverflow.com/questions/4069002/http-400-if-2f-part-of-get-url-in-jboss
        '%2F' => '/',
        // the following chars are general delimiters in the URI specification but have only special meaning in the authority component
        // so they can safely be used in the path in unencoded form
        '%40' => '@',
        '%3A' => ':',
        // these chars are only sub-delimiters that have no predefined meaning and can therefore be used literally
        // so URI producing applications can use these chars to delimit subcomponents in a path segment without being encoded for better readability
        '%3B' => ';',
        '%2C' => ',',
        '%3D' => '=',
        '%2B' => '+',
        '%21' => '!',
        '%2A' => '*',
        '%7C' => '|',
    );

    /**
     * @param RouteCollection      $routes  A RouteCollection instance
     * @param RequestContext       $context The context
     * @param LoggerInterface|null $logger  A logger instance
     */
    public function __construct(RouteCollection $routes, RequestContext $context, LoggerInterface $logger = null)
    {
        $this->routes = $routes;
        $this->context = $context;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function setContext(RequestContext $context)
    {
        $this->context = $context;
    }

    /**
     * {@inheritdoc}
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * {@inheritdoc}
     */
    public function setStrictRequirements($enabled)
    {
        $this->strictRequirements = null === $enabled ? null : (bool) $enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function isStrictRequirements()
    {
        return $this->strictRequirements;
    }

    /**
     * {@inheritdoc}
     */
    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (null === $route = $this->routes->get($name)) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        // the Route has a cache of its own and is not recompiled as long as it does not get modified
        $compiledRoute = $route->compile();

        return $this->doGenerate($compiledRoute->getVariables(), $route->getDefaults(), $route->getRequirements(), $compiledRoute->getTokens(), $parameters, $name, $referenceType, $compiledRoute->getHostTokens(), $route->getSchemes());
    }

    /**
     * @throws MissingMandatoryParametersException When some parameters are missing that are mandatory for the route
     * @throws InvalidParameterException           When a parameter value for a placeholder is not correct because
     *                                             it does not match the requirement
     */
    protected function doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, array $requiredSchemes = array())
    {
        $variables = array_flip($variables);
        $mergedParams = array_replace($defaults, $this->context->getParameters(), $parameters);

        // all params must be given
        if ($diff = array_diff_key($variables, $mergedParams)) {
            throw new MissingMandatoryParametersException(sprintf('Some mandatory parameters are missing ("%s") to generate a URL for route "%s".', implode('", "', array_keys($diff)), $name));
        }

        $url = '';
        $optional = true;
        $message = 'Parameter "{parameter}" for route "{route}" must match "{expected}" ("{given}" given) to generate a corresponding URL.';
        foreach ($tokens as $token) {
            if ('variable' === $token[0]) {
                if (!$optional || !array_key_exists($token[3], $defaults) || null !== $mergedParams[$token[3]] && (string) $mergedParams[$token[3]] !== (string) $defaults[$token[3]]) {
                    // check requirement
                    if (null !== $this->strictRequirements && !preg_match('#^'.$token[2].'$#'.(empty($token[4]) ? '' : 'u'), $mergedParams[$token[3]])) {
                        if ($this->strictRequirements) {
                            throw new InvalidParameterException(strtr($message, array('{parameter}' => $token[3], '{route}' => $name, '{expected}' => $token[2], '{given}' => $mergedParams[$token[3]])));
                        }

                        if ($this->logger) {
                            $this->logger->error($message, array('parameter' => $token[3], 'route' => $name, 'expected' => $token[2], 'given' => $mergedParams[$token[3]]));
                        }

                        return;
                    }

                    $url = $token[1].$mergedParams[$token[3]].$url;
                    $optional = false;
                }
            } else {
                // static text
                $url = $token[1].$url;
                $optional = false;
            }
        }

        if ('' === $url) {
            $url = '/';
        }

        // the contexts base URL is already encoded (see Symfony\Component\HttpFoundation\Request)
        $url = strtr(rawurlencode($url), $this->decodedChars);

        // the path segments "." and ".." are interpreted as relative reference when resolving a URI; see http://tools.ietf.org/html/rfc3986#section-3.3
        // so we need to encode them as they are not used for this purpose here
        // otherwise we would generate a URI that, when followed by a user agent (e.g. browser), does not match this route
        $url = strtr($url, array('/../' => '/%2E%2E/', '/./' => '/%2E/'));
        if ('/..' === substr($url, -3)) {
            $url = substr($url, 0, -2).'%2E%2E';
        } elseif ('/.' === substr($url, -2)) {
            $url = substr($url, 0, -1).'%2E';
        }

        $schemeAuthority = '';
        if ($host = $this->context->getHost()) {
            $scheme = $this->context->getScheme();

            if ($requiredSchemes) {
                if (!in_array($scheme, $requiredSchemes, true)) {
                    $referenceType = self::ABSOLUTE_URL;
                    $scheme = current($requiredSchemes);
                }
            }

            if ($hostTokens) {
                $routeHost = '';
                foreach ($hostTokens as $token) {
                    if ('variable' === $token[0]) {
                        if (null !== $this->strictRequirements && !preg_match('#^'.$token[2].'$#i'.(empty($token[4]) ? '' : 'u'), $mergedParams[$token[3]])) {
                            if ($this->strictRequirements) {
                                throw new InvalidParameterException(strtr($message, array('{parameter}' => $token[3], '{route}' => $name, '{expected}' => $token[2], '{given}' => $mergedParams[$token[3]])));
                            }

                            if ($this->logger) {
                                $this->logger->error($message, array('parameter' => $token[3], 'route' => $name, 'expected' => $token[2], 'given' => $mergedParams[$token[3]]));
                            }

                            return;
                        }

                        $routeHost = $token[1].$mergedParams[$token[3]].$routeHost;
                    } else {
                        $routeHost = $token[1].$routeHost;
                    }
                }

                if ($routeHost !== $host) {
                    $host = $routeHost;
                    if (self::ABSOLUTE_URL !== $referenceType) {
                        $referenceType = self::NETWORK_PATH;
                    }
                }
            }

            if (self::ABSOLUTE_URL === $referenceType || self::NETWORK_PATH === $referenceType) {
                $port = '';
                if ('http' === $scheme && 80 != $this->context->getHttpPort()) {
                    $port = ':'.$this->context->getHttpPort();
                } elseif ('https' === $scheme && 443 != $this->context->getHttpsPort()) {
                    $port = ':'.$this->context->getHttpsPort();
                }

                $schemeAuthority = self::NETWORK_PATH === $referenceType ? '//' : "$scheme://";
                $schemeAuthority .= $host.$port;
            }
        }

        if (self::RELATIVE_PATH === $referenceType) {
            $url = self::getRelativePath($this->context->getPathInfo(), $url);
        } else {
            $url = $schemeAuthority.$this->context->getBaseUrl().$url;
        }

        // add a query string if needed
        $extra = array_udiff_assoc(array_diff_key($parameters, $variables), $defaults, function ($a, $b) {
            return $a == $b ? 0 : 1;
        });

        // extract fragment
        $fragment = '';
        if (isset($defaults['_fragment'])) {
            $fragment = $defaults['_fragment'];
        }

        if (isset($extra['_fragment'])) {
            $fragment = $extra['_fragment'];
            unset($extra['_fragment']);
        }

        if ($extra && $query = http_build_query($extra, '', '&', PHP_QUERY_RFC3986)) {
            // "/" and "?" can be left decoded for better user experience, see
            // http://tools.ietf.org/html/rfc3986#section-3.4
            $url .= '?'.strtr($query, array('%2F' => '/'));
        }

        if ('' !== $fragment) {
            $url .= '#'.strtr(rawurlencode($fragment), array('%2F' => '/', '%3F' => '?'));
        }

        return $url;
    }

    /**
     * Returns the target path as relative reference from the base path.
     *
     * Only the URIs path component (no schema, host etc.) is relevant and must be given, starting with a slash.
     * Both paths must be absolute and not contain relative parts.
     * Relative URLs from one resource to another are useful when generating self-contained downloadable document archives.
     * Furthermore, they can be used to reduce the link size in documents.
     *
     * Example target paths, given a base path of "/a/b/c/d":
     * - "/a/b/c/d"     -> ""
     * - "/a/b/c/"      -> "./"
     * - "/a/b/"        -> "../"
     * - "/a/b/c/other" -> "other"
     * - "/a/x/y"       -> "../../x/y"
     *
     * @param string $basePath   The base path
     * @param string $targetPath The target path
     *
     * @return string The relative target path
     */
    public static function getRelativePath($basePath, $targetPath)
    {
        if ($basePath === $targetPath) {
            return '';
        }

        $sourceDirs = explode('/', isset($basePath[0]) && '/' === $basePath[0] ? substr($basePath, 1) : $basePath);
        $targetDirs = explode('/', isset($targetPath[0]) && '/' === $targetPath[0] ? substr($targetPath, 1) : $targetPath);
        array_pop($sourceDirs);
        $targetFile = array_pop($targetDirs);

        foreach ($sourceDirs as $i => $dir) {
            if (isset($targetDirs[$i]) && $dir === $targetDirs[$i]) {
                unset($sourceDirs[$i], $targetDirs[$i]);
            } else {
                break;
            }
        }

        $targetDirs[] = $targetFile;
        $path = str_repeat('../', count($sourceDirs)).implode('/', $targetDirs);

        // A reference to the same base directory or an empty subdirectory must be prefixed with "./".
        // This also applies to a segment with a colon character (e.g., "file:colon") that cannot be used
        // as the first segment of a relative-path reference, as it would be mistaken for a scheme name
        // (see http://tools.ietf.org/html/rfc3986#section-4.2).
        return '' === $path || '/' === $path[0]
            || false !== ($colonPos = strpos($path, ':')) && ($colonPos < ($slashPos = strpos($path, '/')) || false === $slashPos)
            ? "./$path" : $path;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php

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
 * Represents a "<selector>:not(<identifier>)" node.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class NegationNode extends AbstractNode
{
    private $selector;
    private $subSelector;

    public function __construct(NodeInterface $selector, NodeInterface $subSelector)
    {
        $this->selector = $selector;
        $this->subSelector = $subSelector;
    }

    /**
     * @return NodeInterface
     */
    public function getSelector()
    {
        return $this->selector;
    }

    /**
     * @return NodeInterface
     */
    public function getSubSelector()
    {
        return $this->subSelector;
    }

    /**
     * {@inheritdoc}
     */
    public function getSpecificity(): Specificity
    {
        return $this->selector->getSpecificity()->plus($this->subSelector->getSpecificity());
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return sprintf('%s[%s:not(%s)]', $this->getNodeName(), $this->selector, $this->subSelector);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Runs a PHP script that can be stopped only with a SIGKILL (9) signal for 3 seconds.
 *
 * @args duration Run this script with a custom duration
 *
 * @example `php NonStopableProcess.php 42` will run the script for 42 seconds
 */
function handleSignal($signal)
{
    switch ($signal) {
        case SIGTERM:
            $name = 'SIGTERM';
            break;
        case SIGINT:
            $name = 'SIGINT';
            break;
        default:
            $name = $signal.' (unknown)';
            break;
    }

    echo "signal $name\n";
}

pcntl_signal(SIGTERM, 'handleSignal');
pcntl_signal(SIGINT, 'handleSignal');

echo 'received ';

$duration = isset($argv[1]) ? (int) $argv[1] : 3;
$start = microtime(true);

while ($duration > (microtime(true) - $start)) {
    usleep(10000);
    pcntl_signal_dispatch();
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Tests\ControllerMetadata;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class ArgumentMetadataTest extends TestCase
{
    public function testWithBcLayerWithDefault()
    {
        $argument = new ArgumentMetadata('foo', 'string', false, true, 'default value');

        $this->assertFalse($argument->isNullable());
    }

    public function testDefaultValueAvailable()
    {
        $argument = new ArgumentMetadata('foo', 'string', false, true, 'default value', true);

        $this->assertTrue($argument->isNullable());
    