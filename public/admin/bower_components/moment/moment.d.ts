<?xml version="1.0"?>
<source xmlns="custom:xml:namespace">
 <line no="1">
  <token name="T_OPEN_TAG">&lt;?php </token>
  <token name="T_DECLARE">declare</token>
  <token name="T_OPEN_BRACKET">(</token>
  <token name="T_STRING">strict_types</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_EQUAL">=</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_LNUMBER">1</token>
  <token name="T_CLOSE_BRACKET">)</token>
  <token name="T_SEMICOLON">;</token>
 </line>
 <line no="2">
  <token name="T_NAMESPACE">namespace</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_STRING">foo</token>
  <token name="T_SEMICOLON">;</token>
 </line>
 <line no="3"/>
 <line no="4">
  <token name="T_CLASS">class</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_STRING">bar</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_OPEN_CURLY">{</token>
 </line>
 <line no="5">
  <token name="T_WHITESPACE">    </token>
  <token name="T_CONST">const</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_STRING">x</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_EQUAL">=</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_CONSTANT_ENCAPSED_STRING">'abc'</token>
  <token name="T_SEMICOLON">;</token>
 </line>
 <line no="6"/>
 <line no="7">
  <token name="T_WHITESPACE">    </token>
  <token name="T_DOC_COMMENT">/** @var int */</token>
 </line>
 <line no="8">
  <token name="T_WHITESPACE">    </token>
  <token name="T_PRIVATE">private</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_VARIABLE">$y</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_EQUAL">=</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_LNUMBER">1</token>
  <token name="T_SEMICOLON">;</token>
 </line>
 <line no="9"/>
 <line no="10">
  <token name="T_WHITESPACE">    </token>
  <token name="T_PUBLIC">public</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_FUNCTION">function</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_STRING">__construct</token>
  <token name="T_OPEN_BRACKET">(</token>
  <token name="T_CLOSE_BRACKET">)</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_OPEN_CURLY">{</token>
 </line>
 <line no="11">
  <token name="T_WHITESPACE">        </token>
  <token name="T_COMMENT">// do something</token>
 </line>
 <line no="12">
  <token name="T_WHITESPACE">    </token>
  <token name="T_CLOSE_CURLY">}</token>
 </line>
 <line no="13"/>
 <line no="14">
  <token name="T_WHITESPACE">    </token>
  <token name="T_PUBLIC">public</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_FUNCTION">function</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_STRING">getY</token>
  <token name="T_OPEN_BRACKET">(</token>
  <token name="T_CLOSE_BRACKET">)</token>
  <token name="T_COLON">:</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_STRING">int</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_OPEN_CURLY">{</token>
 </line>
 <line no="15">
  <token name="T_WHITESPACE">        </token>
  <token name="T_RETURN">return</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_VARIABLE">$this</token>
  <token name="T_OBJECT_OPERATOR">-&gt;</token>
  <token name="T_STRING">y</token>
  <token name="T_SEMICOLON">;</token>
 </line>
 <line no="16">
  <token name="T_WHITESPACE">    </token>
  <token name="T_CLOSE_CURLY">}</token>
 </line>
 <line no="17"/>
 <line no="18">
  <token name="T_WHITESPACE">    </token>
  <token name="T_PUBLIC">public</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_FUNCTION">function</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_STRING">getSomeX</token>
  <token name="T_OPEN_BRACKET">(</token>
  <token name="T_CLOSE_BRACKET">)</token>
  <token name="T_COLON">:</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_STRING">string</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_OPEN_CURLY">{</token>
 </line>
 <line no="19">
  <token name="T_WHITESPACE">        </token>
  <token name="T_RETURN">return</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_STRING">self</token>
  <token name="T_DOUBLE_COLON">::</token>
  <token name="T_STRING">x</token>
  <token name="T_SEMICOLON">;</token>
 </line>
 <line no="20">
  <token name="T_WHITESPACE">    </token>
  <token name="T_CLOSE_CURLY">}</token>
 </line>
 <line no="21"/>
 <line no="22">
  <token name="T_WHITESPACE">    </token>
  <token name="T_PUBLIC">public</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_FUNCTION">function</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_STRING">some</token>
  <token name="T_OPEN_BRACKET">(</token>
  <token name="T_STRING">bar</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_VARIABLE">$b</token>
  <token name="T_CLOSE_BRACKET">)</token>
  <token name="T_COLON">:</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_STRING">string</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_OPEN_CURLY">{</token>
 </line>
 <line no="23">
  <token name="T_WHITESPACE">        </token>
  <token name="T_RETURN">return</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_VARIABLE">$b</token>
  <token name="T_OBJECT_OPERATOR">-&gt;</token>
  <token name="T_STRING">getSomeX</token>
  <token name="T_OPEN_BRACKET">(</token>
  <token name="T_CLOSE_BRACKET">)</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_DOT">.</token>
  <token name="T_WHITESPACE"> </token>
  <token name="T_CONSTANT_ENCAPSED_STRING">'-def'</token>
  <token name="T_SEMICOLON">;</token>
 </line>
 <line no="24">
  <token name="T_WHITESPACE">    </token>
  <token name="T_CLOSE_CURLY">}</token>
 </line>
 <line no="25">
  <token name="T_CLOSE_CURLY">}</token>
 </line>
 <line no="26"/>
</source>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel;

/**
 * Allows the Kernel to be rebooted using a temporary cache directory.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
interface RebootableInterface
{
    /**
     * Reboots a kernel.
     *
     * The getCacheDir() method of a rebootable kernel should not be called
     * while building the container. Use the %kernel.cache_dir% parameter instead.
     *
     * @param string|null $warmupDir pass null to reboot in the regular cache directory
     */
    public function reboot($warmupDir);
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Monolog\Formatter\FormatterInterface;

/**
 * Interface that all Monolog Handlers must implement
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
interface HandlerInterface
{
    /**
     * Checks whether the given record will be handled by this handler.
     *
     * This is mostly done for performance reasons, to avoid calling processors for nothing.
     *
     * Handlers should still check the record levels within handle(), returning false in isHandling()
     * is no guarantee that handle() will not be called, and isHandling() might not be called
     * for a given record.
     *
     * @param array $record Partial log record containing only a level key
     *
     * @return Boolean
     */
    public function isHandling(array $record);

    /**
     * Handles a record.
     *
     * All records may be passed to this method, and the handler should discard
     * those that it does not want to handle.
     *
     * The return value of this function controls the bubbling process of the handler stack.
     * Unless the bubbling is interrupted (by returning true), the Logger class will keep on
     * calling further handlers in the stack with a given log record.
     *
     * @param  array   $record The record to handle
     * @return Boolean true means that this handler handled the record, and that bubbling is not permitted.
     *                        false means the record was either not processed or that this handler allows bubbling.
     */
    public function handle(array $record);

    /**
     * Handles a set of records at once.
     *
     * @param array $records The records to handle (an array of record arrays)
     */
    public function handleBatch(array $records);

    /**
     * Adds a processor in the stack.
     *
     * @param  callable $callback
     * @return self
     */
    public function pushProcessor($callback);

    /**
     * Removes the processor on top of the stack and returns it.
     *
     * @return callable
     */
    public function popProcessor();

    /**
     * Sets the formatter.
     *
     * @param  FormatterInterface $formatter
     * @return self
     */
    public function setFormatter(FormatterInterface $formatter);

    /**
     * Gets the formatter.
     *
     * @return FormatterInterface
     */
    public function getFormatter();
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

namespace Illuminate\Validation\Rules;

class Unique
{
    use DatabaseRule;

    /**
     * The ID that should be ignored.
     *
     * @var mixed
     */
    protected $ignore;

    /**
     * The name of the ID column.
     *
     * @var string
     */
    protected $idColumn = 'id';

    /**
     * Ignore the given ID during the unique check.
     *
     * @param  mixed  $id
     * @param  string  $idColumn
     * @return $this
     */
    public function ignore($id, $idColumn = 'id')
    {
        $this->ignore = $id;
        $this->idColumn = $idColumn;

        return $this;
    }

    /**
     * Convert the rule to a validation string.
     *
     * @return string
     */
    public function __toString()
    {
        return rtrim(sprintf('unique:%s,%s,%s,%s,%s',
            $this->table,
            $this->column,
            $this->ignore ? '"'.$this->ignore.'"' : 'NULL',
            $this->idColumn,
            $this->formatWheres()
        ), ',');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 Variadic function