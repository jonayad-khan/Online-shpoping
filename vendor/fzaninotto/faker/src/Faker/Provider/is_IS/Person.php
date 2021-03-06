<?php

namespace Faker\Provider\pt_BR;

class PhoneNumber extends \Faker\Provider\PhoneNumber
{

    protected static $landlineFormats = array('2###-####', '3###-####');

    protected static $cellphoneFormats = array('9####-####');

    /**
     * Generates a 2-digit area code not composed by zeroes.
     * @return string
     */
    public static function areaCode()
    {
        return static::randomDigitNotNull().static::randomDigitNotNull();
    }

    /**
     * Generates a 9-digit cellphone number without formatting characters.
     * @param bool $formatted [def: true] If it should return a formatted number or not.
     * @return string
     */
    public static function cellphone($formatted = true)
    {
        $number = static::numerify(static::randomElement(static::$cellphoneFormats));

        if (!$formatted) {
            $number = strtr($number, array('-' => ''));
        }

        return $number;
    }

    /**
     * Generates an 9-digit landline number without formatting characters.
     * @param bool $formatted [def: true] If it should return a formatted number or not.
     * @return string
     */
    public static function landline($formatted = true)
    {
        $number = static::numerify(static::randomElement(static::$landlineFormats));

        if (!$formatted) {
            $number = strtr($number, array('-' => ''));
        }

        return $number;
    }

    /**
     * Randomizes between cellphone and landline numbers.
     * @param bool $formatted [def: true] If it should return a formatted number or not.
     * @return mixed
     */
    public static function phone($formatted = true)
    {
        $options = static::randomElement(array(
            array('cellphone', false),
            array('cellphone', true),
            array('landline', null),
        ));

        return call_user_func("static::{$options[0]}", $formatted, $options[1]);
    }

    /**
     * Generates a complete phone number.
     * @param string $type      [def: landline] One of "landline" or "cellphone". Defaults to "landline" on invalid values.
     * @param bool   $formatted [def: true] If the number should be formatted or not.
     * @return string
     */
    protected static function anyPhoneNumber($type, $formatted = true)
    {
        $area   = static::areaCode();
        $number = ($type == 'cellphone')?
            static::cellphone($formatted) :
            static::landline($formatted);

        return $formatted? "($area) $number" : $area.$number;
    }

    /**
     * Concatenates {@link areaCode} and {@link cellphone} into a national cellphone number.
     * @param bool $formatted [def: true] If it should return a formatted number or not.
     * @return string
     */
    public static function cellphoneNumber($formatted = true)
    {
        return static::anyPhoneNumber('cellphone', $formatted);
    }

    /**
     * Concatenates {@link areaCode} and {@link landline} into a national landline number.
     * @param bool $formatted [def: true] If it should return a formatted number or not.
     * @return string
     */
    public static function landlineNumber($formatted = true)
    {
        return static::anyPhoneNumber('landline', $formatted);
    }

    /**
     * Randomizes between complete cellphone and landline numbers.
     * @return mixed
     */
    public function phoneNumber()
    {
        $method = static::randomElement(array('cellphoneNumber', 'landlineNumber'));
        return call_user_func("static::$method", true);
    }

    /**
     * Randomizes between complete cellphone and landline numbers, cleared from formatting symbols.
     * @return mixed
     */
    public static function phoneNumberCleared()
    {
        $method = static::randomElement(array('cellphoneNumber', 'landlineNumber'));
        return call_user_func("static::$method", false);
    }
}
                                                                                                                                                                                                                                         <?php

namespace Illuminate\Database\Query\Grammars;

use Illuminate\Support\Str;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JsonExpression;

class MySqlGrammar extends Grammar
{
    /**
     * The components that make up a select clause.
     *
     * @var array
     */
    protected $selectComponents = [
        'aggregate',
        'columns',
        'from',
        'joins',
        'wheres',
        'groups',
        'havings',
        'orders',
        'limit',
        'offset',
        'lock',
    ];

    /**
     * Compile a select query into SQL.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return string
     */
    public function compileSelect(Builder $query)
    {
        $sql = parent::compileSelect($query);

        if ($query->unions) {
            $sql = '('.$sql.') '.$this->compileUnions($query);
        }

        return $sql;
    }

    /**
     * Compile a single union statement.
     *
     * @param  array  $union
     * @return string
     */
    protected function compileUnion(array $union)
    {
        $conjuction = $union['all'] ? ' union all ' : ' union ';

        return $conjuction.'('.$union['query']->toSql().')';
    }

    /**
     * Compile the random statement into SQL.
     *
     * @param  string  $seed
     * @return string
     */
    public function compileRandom($seed)
    {
        return 'RAND('.$seed.')';
    }

    /**
     * Compile the lock into SQL.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  bool|string  $value
     * @return string
     */
    protected function compileLock(Builder $query, $value)
    {
        if (! is_string($value)) {
            return $value ? 'for update' : 'lock in share mode';
        }

        return $value;
    }

    /**
     * Compile an update statement into SQL.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $values
     * @return string
     */
    public function compileUpdate(Builder $query, $values)
    {
        $table = $this->wrapTable($query->from);

        // Each one of the columns in the update statements needs to be wrapped in the
        // keyword identifiers, also a place-holder needs to be created for each of
        // the values in the list of bindings so we can make the sets statements.
        $columns = $this->compileUpdateColumns($values);

        // If the query has any "join" clauses, we will setup the joins on the builder
        // and compile them so we can attach them to this update, as update queries
        // can get join statements to attach to other tables when they're needed.
        $joins = '';

        if (isset($query->joins)) {
            $joins = ' '.$this->compileJoins($query, $query->joins);
        }

        // Of course, update queries may also be constrained by where clauses so we'll
        // need to compile the where clauses and attach it to the query so only the
        // intended records are updated by the SQL statements we generate to run.
        $where = $this->compileWheres($query);

        $sql = rtrim("update {$table}{$joins} set $columns $where");

        // If the query has an order by clause we will compile it since MySQL supports
        // order bys on update statements. We'll compile them using the typical way
        // of compiling order bys. Then they will be appended to the SQL queries.
        if (! empty($query->orders)) {
            $sql .= ' '.$this->compileOrders($query, $query->orders);
        }

        // Updates on MySQL also supports "limits", which allow you to easily update a
        // single record very easily. This is not supported by all database engines
        // so we have customized this update compiler here in order to add it in.
        if (isset($query->limit)) {
            $sql .= ' '.$this->compileLimit($query, $query->limit);
        }

        return rtrim($sql);
    }

    /**
     * Compile all of the columns for an update statement.
     *
     * @param  array  $values
     * @return string
     */
    protected function compileUpdateColumns($values)
    {
        return collect($values)->map(function ($value, $key) {
            if ($this->isJsonSelector($key)) {
                return $this->compileJsonUpdateColumn($key, new JsonExpression($value));
            } else {
                return $this->wrap($key).' = '.$this->parameter($value);
            }
        })->implode(', ');
    }

    /**
     * Prepares a JSON column being updated using the JSON_SET function.
     *
     * @param  string  $key
     * @param  \Illuminate\Database\Query\JsonExpression  $value
     * @return string
     */
    protected function compileJsonUpdateColumn($key, JsonExpression $value)
    {
        $path = explode('->', $key);

        $field = $this->wrapValue(array_shift($path));

        $accessor = '"$.'.implode('.', $path).'"';

        return "{$field} = json_set({$field}, {$accessor}, {$value->getValue()})";
    }

    /**
     * Prepare the bindings for an update statement.
     *
     * Booleans, integers, and doubles are inserted into JSON updates as raw values.
     *
     * @param  array  $bindings
     * @param  array  $values
     * @return array
     */
    public function prepareBindingsForUpdate(array $bindings, array $values)
    {
        $values = collect($values)->reject(function ($value, $column) {
            return $this->isJsonSelector($column) &&
                in_array(gettype($value), ['boolean', 'integer', 'double']);
        })->all();

        return parent::prepareBindingsForUpdate($bindings, $values);
    }

    /**
     * Compile a delete statement into SQL.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return string
     */
    public function compileDelete(Builder $query)
    {
        $table = $this->wrapTable($query->from);

        $where = is_array($query->wheres) ? $this->compileWheres($query) : '';

        return isset($query->joins)
                    ? $this->compileDeleteWithJoins($query, $table, $where)
                    : $this->compileDeleteWithoutJoins($query, $table, $where);
    }

    /**
     * Compile a delete query that does not use joins.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  string  $table
     * @param  array  $where
     * @return string
     */
    protected function compileDeleteWithoutJoins($query, $table, $where)
    {
        $sql = trim("delete from {$table} {$where}");

        // When using MySQL, delete statements may contain order by statements and limits
        // so we will compile both of those here. Once we have finished compiling this
        // we will return the completed SQL statement so it will be executed for us.
        if (! empty($query->orders)) {
            $sql .= ' '.$this->compileOrders($query, $query->orders);
        }

        if (isset($query->limit)) {
            $sql .= ' '.$this->compileLimit($query, $query->limit);
        }

        return $sql;
    }

    /**
     * Compile a delete query that uses joins.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  string  $table
     * @param  array  $where
     * @return string
     */
    protected function compileDeleteWithJoins($query, $table, $where)
    {
        $joins = ' '.$this->compileJoins($query, $query->joins);

        $alias = strpos(strtolower($table), ' as ') !== false
                ? explode(' as ', $table)[1] : $table;

        return trim("delete {$alias} from {$table}{$joins} {$where}");
    }

    /**
     * Wrap a single string in keyword identifiers.
     *
     * @param  string  $value
     * @return string
     */
    protected function wrapValue($value)
    {
        if ($value === '*') {
            return $value;
        }

        // If the given value is a JSON selector we will wrap it differently than a
        // traditional value. We will need to split this path and wrap each part
        // wrapped, etc. Otherwise, we will simply wrap the value as a string.
        if ($this->isJsonSelector($value)) {
            return $this->wrapJsonSelector($value);
        }

        return '`'.str_replace('`', '``', $value).'`';
    }

    /**
     * Wrap the given JSON selector.
     *
     * @param  string  $value
     * @return string
     */
    protected function wrapJsonSelector($value)
    {
        $path = explode('->', $value);

        $field = $this->wrapValue(array_shift($path));

        return sprintf('%s->\'$.%s\'', $field, collect($path)->map(function ($part) {
            return '"'.$part.'"';
        })->implode('.'));
    }

    /**
     * Determine if the given string is a JSON selector.
     *
     * @param  string  $value
     * @return bool
     */
    protected function isJsonSelector($value)
    {
        return Str::contains($value, '->');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      {
    "name": "illuminate/redis",
    "description": "The Illuminate Redis package.",
    "license": "MIT",
    "homepage": "https://laravel.com",
    "support": {
        "issues": "https://github.com/laravel/framework/issues",
        "source": "https://github.com/laravel/framework"
    },
    "authors": [
        {
            "name": "Taylor Otwell",
            "email": "taylor@laravel.com"
        }
    ],
    "require": {
        "php": ">=7.0",
        "illuminate/contracts": "5.5.*",
        "illuminate/support": "5.5.*",
        "predis/predis": "~1.0"
    },
    "autoload": {
        "psr-4": {
            "Illuminate\\Redis\\": ""
        }
    },
    "extra": {
        "branch-alias": {
            "dev-master": "5.5-dev"
        }
    },
    "config": {
        "sort-packages": true
    },
    "minimum-stability": "dev"
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @copyright  Copyright (c) 2010-2014 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
 */

namespace Mockery;

class Undefined
{

    /**
     * Call capturing to merely return this same object.
     *
     * @param string $method
     * @param array $args
     * @return self
     */
    public function __call($method, array $args)
    {
        return $this;
    }

    /**
     * Return a string, avoiding E_RECOVERABLE_ERROR
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . ":" . spl_object_hash($this);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php

namespace DeepCopy\Filter\Doctrine;

use DeepCopy\Filter\Filter;
use ReflectionProperty;

/**
 * Set a null value for a property
 */
class DoctrineCollectionFilter implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function apply($object, $property, $objectCopier)
    {
        $reflectionProperty = new ReflectionProperty($object, $property);

        $reflectionProperty->setAccessible(true);
        $oldCollection = $reflectionProperty->getValue($object);

        $newCollection = $oldCollection->map(
            function ($item) use ($objectCopier) {
                return $objectCopier($item);
            }
        );

        $reflectionProperty->setValue($object, $newCollection);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          Pretty printer generates least-parentheses output
-----
<?php

echo 'abc' . 'cde' . 'fgh';
echo 'abc' . ('cde' . 'fgh');

echo 'abc' . 1 + 2 . 'fgh';
echo 'abc' . (1 + 2) . 'fgh';

echo 1 * 2 + 3 / 4 % 5 . 6;
echo 1 * (2 + 3) / (4 % (5 . 6));

$a = $b = $c = $d = $f && true;
($a = $b = $c = $d = $f) && true;
$a = $b = $c = $d = $f and true;
$a = $b = $c = $d = ($f and true);

$a ? $b : $c ? $d : $e ? $f : $g;
$a ? $b : ($c ? $d : ($e ? $f : $g));
$a ? $b ? $c : $d : $f;

$a ?? $b ?? $c;
($a ?? $b) ?? $c;
$a ?? ($b ? $c : $d);
$a || ($b ?? $c);

(1 > 0) > (1 < 0);
++$a + $b;
$a + $b++;

$a ** $b ** $c;
($a ** $b) ** $c;
-1 ** 2;

yield from $a and yield from $b;
yield from ($a and yield from $b);

print ($a and print $b);

// The following will currently add unnecessary parentheses, because the pretty printer is not aware that assignment
// and incdec only work on variables.
!$a = $b;
++$a ** $b;
$a ** $b++;
-----
echo 'abc' . 'cde' . 'fgh';
echo 'abc' . ('cde' . 'fgh');
echo 'abc' . 1 + 2 . 'fgh';
echo 'abc' . (1 + 2) . 'fgh';
echo 1 * 2 + 3 / 4 % 5 . 6;
echo 1 * (2 + 3) / (4 % (5 . 6));
$a = $b = $c = $d = $f && true;
($a = $b = $c = $d = $f) && true;
$a = $b = $c = $d = $f and true;
$a = $b = $c = $d = ($f and true);
$a ? $b : $c ? $d : $e ? $f : $g;
$a ? $b : ($c ? $d : ($e ? $f : $g));
$a ? $b ? $c : $d : $f;
$a ?? $b ?? $c;
($a ?? $b) ?? $c;
$a ?? ($b ? $c : $d);
$a || ($b ?? $c);
(1 > 0) > (1 < 0);
++$a + $b;
$a + $b++;
$a ** $b ** $c;
($a ** $b) ** $c;
-1 ** 2;
yield from $a and yield from $b;
yield from ($a and yield from $b);
print ($a and print $b);
// The following will currently add unnecessary parentheses, because the pretty printer is not aware that assignment
// and incdec only work on variables.
!($a = $b);
(++$a) ** $b;
$a ** ($b++);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Util\TestDox;

/**
 * Prettifies class and method names for use in TestDox documentation.
 */
class NamePrettifier
{
    /**
     * @var string
     */
    protected $prefix = 'Test';

    /**
     * @var string
     */
    protected $suffix = 'Test';

    /**
     * @var array
     */
    protected $strings = [];

    /**
     * Prettifies the name of a test class.
     *
     * @param string $name
     *
     * @return string
     */
    public function prettifyTestClass($name)
    {
        $title = $name;

        if ($this->suffix !== null &&
            $this->suffix == \substr($name, -1 * \strlen($this->suffix))) {
            $title = \substr($title, 0, \strripos($title, $this->suffix));
        }

        if ($this->prefix !== null &&
            $this->prefix == \substr($name, 0, \strlen($this->prefix))) {
            $title = \substr($title, \strlen($this->prefix));
        }

        if (\substr($title, 0, 1) == '\\') {
            $title = \substr($title, 1);
        }

        return $title;
    }

    /**
     * Prettifies the name of a test method.
     *
     * @param string $name
     *
     * @return string
     */
    public function prettifyTestMethod($name)
    {
        $buffer = '';

        if (!\is_string($name) || \strlen($name) == 0) {
            return $buffer;
        }

        $string = \preg_replace('#\d+$#', '', $name, -1, $count);

        if (\in_array($string, $this->strings)) {
            $name = $string;
        } elseif ($count == 0) {
            $this->strings[] = $string;
        }

        if (\substr($name, 0, 4) == 'test') {
            $name = \substr($name, 4);
        }

        if (\strlen($name) == 0) {
            return $buffer;
        }

        $name[0] = \strtoupper($name[0]);

        if (\strpos($name, '_') !== false) {
            return \trim(\str_replace('_', ' ', $name));
        }

        $max        = \strlen($name);
        $wasNumeric = false;

        for ($i = 0; $i < $max; $i++) {
            if ($i > 0 && \ord($name[$i]) >= 65 && \ord($name[$i]) <= 90) {
                $buffer .= ' ' . \strtolower($name[$i]);
            } else {
                $isNumeric = \is_numeric($name[$i]);

                if (!$wasNumeric && $isNumeric) {
                    $buffer .= ' ';
                    $wasNumeric = true;
                }

                if ($wasNumeric && !$isNumeric) {
                    $wasNumeric = false;
                }

                $buffer .= $name[$i];
            }
        }

        return $buffer;
    }

    /**
     * Sets the prefix of test names.
     *
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Sets the suffix of test names.
     *
     * @param string $suffix
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Debug;

function headers_sent()
{
    return false;
}

function header($str, $replace = true, $status = null)
{
    Tests\testHeader($str, $replace, $status);
}

namespace Symfony\Component\Debug\Tests;

function testHeader()
{
    static $headers = array();

    if (!$h = func_get_args()) {
        $h = $headers;
        $headers = array();

        return $h;
    }

    $headers[] = func_get_args();
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\CssSelector\XPath\Extension;

use Symfony\Component\CssSelector\Exception\ExpressionErrorException;
use Symfony\Component\CssSelector\XPath\XPathExpr;

/**
 * XPath expression translator pseudo-class extension.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class PseudoClassExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getPseudoClassTranslators()
    {
        return array(
            'root' => array($this, 'translateRoot'),
            'first-child' => array($this, 'translateFirstChild'),
            'last-child' => array($this, 'translateLastChild'),
            'first-of-type' => array($this, 'translateFirstOfType'),
            'last-of-type' => array($this, 'translateLastOfType'),
            'only-child' => array($this, 'translateOnlyChild'),
            'only-of-type' => array($this, 'translateOnlyOfType'),
            'empty' => array($this, 'translateEmpty'),
        );
    }

    /**
     * @return XPathExpr
     */
    public function translateRoot(XPathExpr $xpath)
    {
        return $xpath->addCondition('not(parent::*)');
    }

    /**
     * @return XPathExpr
     */
    public function translateFirstChild(XPathExpr $xpath)
    {
        return $xpath
            ->addStarPrefix()
            ->addNameTest()
            ->addCondition('position() = 1');
    }

    /**
     * @return XPathExpr
     */
    public function translateLastChild(XPathExpr $xpath)
    {
        return $xpath
            ->addStarPrefix()
            ->addNameTest()
            ->addCondition('position() = last()');
    }

    /**
     * @return XPathExpr
     *
     * @throws ExpressionErrorException
     */
    public function translateFirstOfType(XPathExpr $xpath)
    {
        if ('*' === $xpath->getElement()) {
            throw new ExpressionErrorException('"*:first-of-type" is not implemented.');
        }

        return $xpath
            ->addStarPrefix()
            ->addCondition('position() = 1');
    }

    /**
     * @return XPathExpr
     *
     * @throws ExpressionErrorException
     */
    public function translateLastOfType(XPathExpr $xpath)
    {
        if ('*' === $xpath->getElement()) {
            throw new ExpressionErrorException('"*:last-of-type" is not implemented.');
        }

        return $xpath
            ->addStarPrefix()
            ->addCondition('position() = last()');
    }

    /**
     * @return XPathExpr
     */
    public function translateOnlyChild(XPathExpr $xpath)
    {
        return $xpath
            ->addStarPrefix()
            ->addNameTest()
            ->addCondition('last() = 1');
    }

    /**
     * @return XPathExpr
     *
     * @throws ExpressionErrorException
     */
    public function translateOnlyOfType(XPathExpr $xpath)
    {
        if ('*' === $xpath->getElement()) {
            throw new ExpressionErrorException('"*:only-of-type" is not implemented.');
        }

        return $xpath->addCondition('last() = 1');
    }

    /**
     * @return XPathExpr
     */
    public function translateEmpty(XPathExpr $xpath)
    {
        return $xpath->addCondition('not(*) and not(string-length())');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pseudo-class';
    }
}
                                                                                                                                                                                                                                                                                                                                                                               <?php

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
 * Represents a command line argument.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class InputArgument
{
    const REQUIRED = 1;
    const OPTIONAL = 2;
    const IS_ARRAY = 4;

    private $name;
    private $mode;
    private $default;
    private $description;

    /**
     * @param string $name        The argument name
     * @param int    $mode        The argument mode: self::REQUIRED or self::OPTIONAL
     * @param string $description A description text
     * @param mixed  $default     The default value (for self::OPTIONAL mode only)
     *
     * @throws InvalidArgumentException When argument mode is not valid
     */
    public function __construct(string $name, int $mode = null, string $description = '', $default = null)
    {
        if (null === $mode) {
            $mode = self::OPTIONAL;
        } elseif ($mode > 7 || $mode < 1) {
            throw new InvalidArgumentException(sprintf('Argument mode "%s" is not valid.', $mode));
        }

        $this->name = $name;
        $this->mode = $mode;
        $this->description = $description;

        $this->setDefault($default);
    }

    /**
     * Returns the argument name.
     *
     * @return string The argument name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns true if the argument is required.
     *
     * @return bool true if parameter mode is self::REQUIRED, false otherwise
     */
    public function isRequired()
    {
        return self::REQUIRED === (self::REQUIRED & $this->mode);
    }

    /**
     * Returns true if the argument can take multiple values.
     *
     * @return bool true if mode is self::IS_ARRAY, false otherwise
     */
    public function isArray()
    {
        return self::IS_ARRAY === (self::IS_ARRAY & $this->mode);
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
        if (self::REQUIRED === $this->mode && null !== $default) {
            throw new LogicException('Cannot set a default 