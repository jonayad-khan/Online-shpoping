y is loaded before other filters are applied!**

```php
use DeepCopy\DeepCopy;
use DeepCopy\Filter\Doctrine\DoctrineProxyFilter;
use DeepCopy\Matcher\Doctrine\DoctrineProxyMatcher;

$deepCopy = new DeepCopy();
$deepCopy->addFilter(new DoctrineProxyFilter(), new DoctrineProxyMatcher());
$myCopy = $deepCopy->copy($myObject);

// $myCopy should now contain a clone of all entities, including those that were not yet fully loaded.
```

## Contributing

DeepCopy is distributed under the MIT license.

### Tests

Running the tests is simple:

```php
phpunit
```
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prophecy\Exception\Prophecy;

use Prophecy\Prophecy\MethodProphecy;

class MethodProphecyException extends ObjectProphecyException
{
    private $methodProphecy;

    public function __construct($message, MethodProphecy $methodProphecy)
    {
        parent::__construct($message, $methodProphecy->getObjectProphecy());

        $this->methodProphecy = $methodProphecy;
    }

    /**
     * @return MethodProphecy
     */
    public function getMethodProphecy()
    {
        return $this->methodProphecy;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Util;

use DOMCharacterData;
use DOMDocument;
use DOMElement;
use DOMNode;
use DOMText;
use PHPUnit\Framework\Exception;
use ReflectionClass;

/**
 * XML helpers.
 */
class Xml
{
    /**
     * Load an $actual document into a DOMDocument.  This is called
     * from the selector assertions.
     *
     * If $actual is already a DOMDocument, it is returned with
     * no changes.  Otherwise, $actual is loaded into a new DOMDocument
     * as either HTML or XML, depending on the value of $isHtml. If $isHtml is
     * false and $xinclude is true, xinclude is performed on the loaded
     * DOMDocument.
     *
     * Note: prior to PHPUnit 3.3.0, this method loaded a file and
     * not a string as it currently does.  To load a file into a
     * DOMDocument, use loadFile() instead.
     *
     * @param string|DOMDocument $actual
     * @param bool               $isHtml
     * @param string             $filename
     * @param bool               $xinclude
     * @param bool               $strict
     *
     * @return DOMDocument
     */
    public static function load($actual, $isHtml = false, $filename = '', $xinclude = false, $strict = false)
    {
        if ($actual instanceof DOMDocument) {
            return $actual;
        }

        if (!\is_string($actual)) {
            throw new Exception('Could not load XML from ' . \gettype($actual));
        }

        if ($actual === '') {
            throw new Exception('Could not load XML from empty string');
        }

        // Required for XInclude on Windows.
        if ($xinclude) {
           