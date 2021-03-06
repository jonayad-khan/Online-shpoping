quals('a@[1.2.3.4]', $header->getId());
        $this->assertEquals('<a@[1.2.3.4]>', $header->getFieldBody());
    }

    public function testIdRigthIsIdnEncoded()
    {
        $header = $this->getHeader('References');
        $header->setId('a@ä');
        $this->assertEquals('a@ä', $header->getId());
        $this->assertEquals('<a@xn--4ca>', $header->getFieldBody());
    }

    /**
     * @expectedException \Exception
     * @expectedMessageException "b c d" is not valid id-right
     */
    public function testInvalidIdRightThrowsException()
    {
        $header = $this->getHeader('References');
        $header->setId('a@b c d');
    }

    /**
     * @expectedException \Exception
     * @expectedMessageException "abc" is does not contain @
     */
    public function testMissingAtSignThrowsException()
    {
        /* -- RFC 2822, 3.6.4.
     msg-id          =       [CFWS] "<" id-left "@" id-right ">" [CFWS]
     */
        $header = $this->getHeader('References');
        $header->setId('abc');
    }

    public function testSetBodyModel()
    {
        $header = $this->getHeader('Message-ID');
        $header->setFieldBodyModel('a@b');
        $this->assertEquals(['a@b'], $header->getIds());
    }

    public function testGetBodyModel()
    {
        $header = $this->getHeader('Message-ID');
        $header->setId('a@b');
        $this->assertEquals(['a@b'], $header->getFieldBodyModel());
    }

    public function testStringValue()
    {
        $header = $this->getHeader('References');
        $header->setIds(['a@b', 'x@y']);
        $this->assertEquals('References: <a@b> <x@y>'."\r\n", $header->toString());
    }

    private function getHeader($name)
    {
        return new Swift_Mime_Headers_IdentificationHeader($name, new EmailValidator(), new Swift_AddressEncoder_IdnAddressEncoder());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

namespace Illuminate\Contracts\Queue;

interface QueueableCollection
{
    /**
     * Get the type of the entities being queued.
     *
     * @return string|null
     */
    public function getQueueableClass();

    /**
     * Get the identifiers for all of the entities.
     *
     * @return array
     */
    public function getQueueableIds();

    /**
     * Get the relationships of the entities being queued.
     *
     * @return array
     */
    public function getQueueableRelations();

    /**
     * Get the connection of the entities being queued.
     *
     * @return string|null
     */
    public function getQueueableConnection();
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

namespace Illuminate\Http\Resources\Json;

use IteratorAggregate;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Http\Resources\CollectsResources;

class ResourceCollection extends JsonResource implements IteratorAggregate
{
    use CollectsResources;

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects;

    /**
     * The mapped collection instance.
     *
     * @var \Illuminate\Support\Collection
     */
    public $collection;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource)
    {
        parent::__construct($resource);

        $this->resource = $this->collectResource($resource);
    }

    /**
     * Transform the resource into a JSON array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map->toArray($request)->all();
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return $this->resource instanceof AbstractPaginator
                    ? (new PaginatedResourceResponse($this))->toResponse($request)
                    : parent::toResponse($request);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2018 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Test\CodeCleaner;

use PhpParser\NodeTraverser;
use Psy\CodeCleaner\CodeCleanerPass;
use Psy\Test\ParserTestCase;

class CodeCleanerTestCase extends ParserTestCase
{
    protected $pass;

    public function tearDown()
    {
        $this->pass = null;
        parent::tearDown();
    }

    protected function setPass(CodeCleanerPass $pass)
    {
        $this->pass = $pass;
        if (!isset($this->traverser)) {
            $this->traverser = new NodeTraverser();
        }
        $this->traverser->addVisitor($this->pass);
    }

    protected function parseAndTraverse($code, $prefix = '<?php ')
    {
        return $this->traverse($this->parse($code, $prefix));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php
namespace Hamcrest\Core;

/*
 Copyright (c) 2010 hamcrest.org
 */
use Hamcrest\BaseMatcher;
use Hamcrest\Description;

/**
 * Tests whether the value has a built-in type.
 */
class IsTypeOf extends BaseMatcher
{

    private $_theType;

    /**
     * Creates a new instance of IsTypeOf
     *
     * @param string $theType
     *   The predicate evaluates to true for values with this built-in type.
     */
    public function __construct($theType)
    {
        $this->_theType = strtolower($theType);
    }

    public function matches($item)
    {
        return strtolower(gettype($item)) == $this->_theType;
    }

    public function describeTo(Description $description)
    {
        $description->appendText(self::getTypeDescription($this->_theType));
    }

    public function describeMismatch($item, Description $description)
    {
        if ($item === null) {
            $description->appendText('was null');
        } else {
            $description->appendText('was ')
                                    ->appendText(self::getTypeDescription(strtolower(gettype($item))))
                                    ->appendText(' ')
                                    ->appendValue($item)
                                    ;
        }
    }

    public static function getTypeDescription($type)
    {
        if ($type == 'null') {
            return 'null';
        }

        return (strpos('aeiou', substr($type, 0, 1)) === false ? 'a ' : 'an ')
                . $type;
    }

    /**
     * Is the value a particular built-in type?
     *
     * @factory
     */
    public static function typeOf($theType)
    {
        return new self($theType);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php
/*
 * This file is part of the php-code-coverage package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\CodeCoverage\Node;

use SebastianBergmann\CodeCoverage\Util;

/**
 * Base class for nodes in the code coverage information tree.
 */
abstract class AbstractNode implements \Countable
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $pathArray;

    /**
     * @var AbstractNode
     */
    private $parent;

    /**
     * @var string
     */
    private $id;

    public function __construct(string $name, self $parent = null)
    {
        if (\substr($name, -1) == '/') {
            $name = \substr($name, 0, -1);
        }

        $this->name   = $name;
        $this->parent = $parent;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        if ($this->id === null) {
            $parent = $this->getParent();

            if ($parent === null) {
                $this->id = 'index';
            } else {
                $parentId = $parent->getId();

                if ($parentId === 'index') {
                    $this->id = \str_replace(':', '_', $this->name);
                } else {
                    $this->id = $parentId . '/' . $this->name;
                }
            }
        }

        return $this->id;
    }

    public function getPath(): string
    {
        if ($this->path === null) {
            if ($this->parent === null || $this->parent->getPath() === null || $this->parent->getPath() === false) {
                $this->path = $this->name;
            } else {
                $this->path = $this->parent->getPath() . '/' . $this->name;
            }
        }

        return $this->path;
    }

    public function getPathAsArray(): array
    {
        if ($this->pathArray === null) {
            if ($this->parent === null) {
                $this->pathArray = [];
            } else {
                $this->pathArray = $this->parent->getPathAsArray();
            }

            $this->pathArray[] = $this;
        }

        return $this->pathArray;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    /**
     * Returns the percentage of classes that has been tested.
     *
     * @return int|string
     */
    public function getTestedClassesPercent(bool $asString = true)
    {
        return Util::percent(
            $this->getNumTestedClasses(),
            $this->getNumClasses(),
            $asString
        );
    }

    /**
     * Returns the percentage of traits that has been tested.
     *
     * @return int|string
     */
    public function getTestedTraitsPercent(bool $asString = true)
    {
        return Util::percent(
            $this->getNumTestedTraits(),
            $this->getNumTraits(),
            $asString
        );
    }

    /**
     * Returns the percentage of classes and traits that has been tested.
     *
     * @return int|string
     */
    public function getTestedClassesAndTraitsPercent(bool $asString = true)
    {
        return Util::percent(
            $this->getNumTestedClassesAndTraits(),
            $this->getNumClassesAndTraits(),
            $asString
        );
    }

    /**
     * Returns the percentage of functions that has been tested.
     *
     * @return int|string
     */
    public function getTestedFunctionsPercent(bool $asString = true)
    {
        return Util::percent(
            $this->getNumTestedFunctions(),
            $this->getNumFunctions(),
            $asString
        );
    }

    /**
     * Returns the percentage of methods that has been tested.
     *
     * @return int|string
     */
    public function getTestedMethodsPercent(bool $asString = true)
    {
        return Util::percent(
            $this->getNumTestedMethods(),
            $this->getNumMethods(),
            $asString
        );
    }

    /**
     * Returns the percentage of functions and methods that has been tested.
     *
     * @return int|string
     */
    public function getTestedFunctionsAndMethodsPercent(bool $asString = true)
    {
        return Util::percent(
            $this->getNumTestedFunctionsAndMethods(),
            $this->getNumFunctionsAndMethods(),
            $asString
        );
    }

    /**
     * Returns the percentage of executed lines.
     *
     * @return int|string
     */
    public function getLineExecutedPercent(bool $asString = true)
    {
        return Util::percent(
            $this->getNumExecutedLines(),
            $this->getNumExecutableLines(),
            $asString
        );
    }

    /**
     * Returns the number of classes and traits.
     */
    public function getNumClassesAndTraits(): int
    {
        return $this->getNumClasses() + $this->getNumTraits();
    }

    /**
     * Returns the number of tested classes and traits.
     */
    public function getNumTestedClassesAndTraits(): int
    {
        return $this->getNumTestedClasses() + $this->getNumTestedTraits();
    }

    /**
     * Returns the classes and traits of this node.
     */
    public function getClassesAndTraits(): array
    {
        return \array_merge($this->getClasses(), $this->getTraits());
    }

    /**
     * Returns the number of functions and methods.
     */
    public function getNumFunctionsAndMethods(): int
    {
        return $this->getNumFunctions() + $this->getNumMethods();
    }

    /**
     * Returns the number of tested functions and methods.
     */
    public function getNumTestedFunctionsAndMethods(): int
    {
        return $this->getNumTestedFunctions() + $this->getNumTestedMethods();
    }

    /**
     * Returns the functions and methods of this node.
     */
    public function getFunctionsAndMethods(): array
    {
        return \array_merge($this->getFunctions(), $this->getMethods());
    }

    /**
     * Returns the classes of this node.
     */
    abstract public function getClasses(): array;

    /**
     * Returns the traits of this node.
     */
    abstract public function getTraits(): array;

    /**
     * Returns the functions of this node.
     */
    abstract public function getFunctions(): array;

    /**
     * Returns the LOC/CLOC/NCLOC of this node.
     */
    abstract public function getLinesOfCode(): array;

    /**
     * Returns the number of executable lines.
     */
    abstract public function getNumExecutableLines(): int;

    /**
     * Returns the number of executed lines.
     */
    abstract public function getNumExecutedLines(): int;

    /**
     * Returns the number of classes.
     */
    abstract public function getNumClasses(): int;

    /**
     * Returns the number of tested classes.
     */
    abstract public function getNumTestedClasses(): int;

    /**
     * Returns the number of traits.
     */
    abstract public function getNumTraits(): int;

    /**
     * Returns the number of tested traits.
     */
    abstract public function getNumTestedTraits(): int;

    /**
     * Returns the number of methods.
     */
    abstract public function getNumMethods(): int;

    /**
     * Returns the number of tested methods.
     */
    abstract public function getNumTestedMethods(): int;

    /**
     * Returns the number of functions.
     */
    abstract public function getNumFunctions(): int;

    /**
     * Returns the number of tested functions.
     */
    abstract public function getNumTestedFunctions(): int;
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\HttpCache;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Ssi implements the SSI capabilities to Request and Response instances.
 *
 * @author Sebastian Krebs <krebs.seb@gmail.com>
 */
class Ssi extends AbstractSurrogate
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ssi';
    }

    /**
     * {@inheritdoc}
     */
    public function addSurrogateControl(Response $response)
    {
        if (false !== strpos($response->getContent(), '<!--#include')) {
            $response->headers->set('Surrogate-Control', 'content="SSI/1.0"');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renderIncludeTag($uri, $alt = null, $ignoreErrors = true, $comment = '')
    {
        return sprintf('<!--#include virtual="%s" -->', $uri);
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, Response $response)
    {
        $type = $response->headers->get('Content-Type');
        if (empty($type)) {
            $type = 'text/html';
        }

        $parts = explode(';', $type);
        if (!\in_array($parts[0], $this->contentTypes)) {
            return $response;
        }

        // we don't use a proper XML parser here as we can have SSI tags in a plain text response
        $content = $response->getContent();

        $chunks = preg_split('#<!--\#include\s+(.*?)\s*-->#', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
        $chunks[0] = str_replace($this->phpEscapeMap[0], $this->phpEscapeMap[1], $chunks[0]);

        $i = 1;
        while (isset($chunks[$i])) {
            $options = array();
            preg_match_all('/(virtual)="([^"]*?)"/', $chunks[$i], $matches, PREG_SET_ORDER);
            foreach ($matches as $set) {
                $options[$set[1]] = $set[2];
            }

            if (!isset($options['virtual'])) {
                throw new \RuntimeException('Unable to process an SSI tag without a "virtual" attribute.');
            }

            $chunks[$i] = sprintf('<?php echo $this->surrogate->handle($this, %s, \'\', false) ?>'."\n",
                var_export($options['virtual'], true)
            );
            ++$i;
            $chunks[$i] = str_replace($this->phpEscapeMap[0], $this->phpEscapeMap[1], $chunks[$i]);
            ++$i;
        }
        $content = implode('', $chunks);

        $response->setContent($content);
        $response->headers->set('X-Body-Eval', 'SSI');

        // remove SSI/1.0 from the Surrogate-Control header
        $this->removeFromControl($response);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
[39;49m // [39;49mLorem ipsum dolor sit [33mamet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et             [39m
[39;49m // [39;49m[33mdolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea       [39m
[39;49m // [39;49m[33mcommodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla     [39m
[39;49m // [39;49m[33mpariatur.[39m Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim            
[39;49m // [39;49mid est laborum                                                                                                      

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * The minimum interface for an Event.
 *
 * @author Chris Corbyn
 */
interface Swift_Events_Event
{
    /**
     * Get the source object of this event.
     *
     * @return object
     */
    public function getSource();

    /**
     * Prevent this Event from bubbling any further up the stack.
     *
     * @param bool $cancel, optional
     */
    public function cancelBubble($cancel = true);

    /**
     * Returns true if this Event will not bubble any further up the stack.
     *
     * @return bool
     */
    public function bubbleCancelled();
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            