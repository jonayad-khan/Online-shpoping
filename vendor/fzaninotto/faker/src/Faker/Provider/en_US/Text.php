<?php
namespace Hamcrest\Core;

class IsSameTest extends \Hamcrest\AbstractMatcherTest
{

    protected function createMatcher()
    {
        return \Hamcrest\Core\IsSame::sameInstance(new \stdClass());
    }

    public function testEvaluatesToTrueIfArgumentIsReferenceToASpecifiedObject()
    {
        $o1 = new \stdClass();
        $o2 = new \stdClass();

        assertThat($o1, sameInstance($o1));
        assertThat($o2, not(sameInstance($o1)));
    }

    public function testReturnsReadableDescriptionFromToString()
    {
        $this->assertDescription('sameInstance("ARG")', sameInstance('ARG'));
    }

    public function testReturnsReadableDescriptionFromToStringWhenInitialisedWithNull()
    {
        $this->assertDescription('sameInstance(null)', sameInstance(null));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

namespace Illuminate\Database\Query\Grammars;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Query\Builder;

class PostgresGrammar extends Grammar
{
    /**
     * All of the available clause operators.
     *
     * @var array
     */
    protected $operators = [
        '=', '<', '>', '<=', '>=', '<>', '!=',
        'like', 'not like', 'between', 'ilike',
        '&', '|', '#', '<<', '>>',
        '@>', '<@', '?', '?|', '?&', '||', '-', '-', '#-',
    ];

    /**
     * Compile a "where date" clause.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $where
     * @return string
     */
    protected function whereDate(Builder $query, $where)
    {
        $value = $this->parameter($where['value']);

        return $this->wrap($where['column']).'::date '.$where['operator'].' '.$value;
    }

    /**
     * Compile a date based where clause.
     *
     * @param  string  $type
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $where
     * @return string
     */
    protected function dateBasedWhere($type, Builder $query, $where)
    {
        $value = $this->parameter($where['value']);

        return 'extract('.$type.' from '.$this->wrap($where['column']).') '.$where['operator'].' '.$value;
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
            return $value ? 'for update' : 'for share';
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function compileInsert(Builder $query, array $values)
    {
        $table = $this->wrapTable($query->from);

        return empty($values)
                ? "insert into {$table} DEFAULT VALUES"
                : parent::compileInsert($query, $values);
    }

    /**
     * Compile an insert and get ID statement into SQL.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array   $values
     * @param  string  $sequence
     * @return string
     */
    public function compileInsertGetId(Builder $query, $values, $sequence)
    {
        if (is_null($sequence)) {
            $sequence = 'id';
        }

        return $this->compileInsert($query, $values).' returning '.$this->wrap($sequence);
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

        $from = $this->compileUpdateFrom($query);

        $where = $this->compileUpdateWheres($query);

        return trim("update {$table} set {$columns}{$from} {$where}");
    }

    /**
     * Compile the columns for the update statement.
     *
     * @param  array   $values
     * @return string
     */
    protected function compileUpdateColumns($values)
    {
        // When gathering the columns for an update statement, we'll wrap each of the
        // columns and convert it to a parameter value. Then we will concatenate a
        // list of the columns that can be added into this update query clauses.
        return collect($values)->map(function ($value, $key) {
            return $this->wrap($key).' = '.$this->parameter($value);
        })->implode(', ');
    }

    /**
     * Compile the "from" clause for an update with a join.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return string|null
     */
    protected function compileUpdateFrom(Builder $query)
    {
        if (! isset($query->joins)) {
            return '';
        }

        // When using Postgres, updates with joins list the joined tables in the from
        // clause, which is different than other systems like MySQL. Here, we will
        // compile out the tables that are joined and add them to a from clause.
        $froms = collect($query->joins)->map(function ($join) {
            return $this->wrapTable($join->table);
        })->all();

        if (count($froms) > 0) {
            return ' from '.implode(', ', $froms);
        }
    }

    /**
     * Compile the additional where clauses for updates with joins.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return string
     */
    protected function compileUpdateWheres(Builder $query)
    {
        $baseWheres = $this->compileWheres($query);

        if (! isset($query->joins)) {
            return $baseWheres;
        }

        // Once we compile the join constraints, we will either use them as the where
        // clause or append them to the existing base where clauses. If we need to
        // strip the leading boolean we will do so when using as the only where.
        $joinWheres = $this->compileUpdateJoinWheres($query);

        if (trim($baseWheres) == '') {
            return 'where '.$this->removeLeadingBoolean($joinWheres);
        }

        return $baseWheres.' '.$joinWheres;
    }

    /**
     * Compile the "join" clause where clauses for an update.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return string
     */
    protected function compileUpdateJoinWheres(Builder $query)
    {
        $joinWheres = [];

        // Here we will just loop through all of the join constraints and compile them
        // all out then implode them. This should give us "where" like syntax after
        // everything has been built and then we will join it to the real wheres.
        foreach ($query->joins as $join) {
            foreach ($join->wheres as $where) {
                $method = "where{$where['type']}";

                $joinWheres[] = $where['boolean'].' '.$this->$method($query, $where);
            }
        }

        return implode(' ', $joinWheres);
    }

    /**
     * Prepare the bindings for an update statement.
     *
     * @param  array  $bindings
     * @param  array  $values
     * @return array
     */
    public function prepareBindingsForUpdate(array $bindings, array $values)
    {
        // Update statements with "joins" in Postgres use an interesting syntax. We need to
        // take all of the bindings and put them on the end of this array since they are
        // added to the end of the "where" clause statements as typical where clauses.
        $bindingsWithoutJoin = Arr::except($bindings, 'join');

        return array_values(
            array_merge($values, $bindings['join'], Arr::flatten($bindingsWithoutJoin))
        );
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

        return isset($query->joins)
            ? $this->compileDeleteWithJoins($query, $table)
            : parent::compileDelete($query);
    }

    /**
     * Compile a delete query that uses joins.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  string  $table
     * @param  array  $where
     * @return string
     */
    protected function compileDeleteWithJoins($query, $table)
    {
        $using = ' USING '.collect($query->joins)->map(function ($join) {
            return $this->wrapTable($join->table);
        })->implode(', ');

        $where = count($query->wheres) > 0 ? ' '.$this->compileUpdateWheres($query) : '';

        return trim("delete from {$table}{$using}{$where}");
    }

    /**
     * Compile a truncate table statement into SQL.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return array
     */
    public function compileTruncate(Builder $query)
    {
        return ['truncate '.$this->wrapTable($query->from).' restart identity' => []];
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
        if (Str::contains($value, '->')) {
            return $this->wrapJsonSelector($value);
        }

        return '"'.str_replace('"', '""', $value).'"';
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

        $wrappedPath = $this->wrapJsonPathAttributes($path);

        $attribute = array_pop($wrappedPath);

        if (! empty($wrappedPath)) {
            return $field.'->'.implode('->', $wrappedPath).'->>'.$attribute;
        }

        return $field.'->>'.$attribute;
    }

    /**
     * Wrap the attributes of the give JSON path.
     *
     * @param  array  $path
     * @return array
     */
    protected function wrapJsonPathAttributes($path)
    {
        return array_map(function ($attribute) {
            return "'$attribute'";
        }, $path);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

namespace Illuminate\Redis;

use InvalidArgumentException;
use Illuminate\Contracts\Redis\Factory;

/**
 * @mixin \Illuminate\Redis\Connections\Connection
 */
class RedisManager implements Factory
{
    /**
     * The name of the default driver.
     *
     * @var string
     */
    protected $driver;

    /**
     * The Redis server configurations.
     *
     * @var array
     */
    protected $config;

    /**
     * The Redis connections.
     *
     * @var mixed
     */
    protected $connections;

    /**
     * Create a new Redis manager instance.
     *
     * @param  string  $driver
     * @param  array  $config
     */
    public function __construct($driver, array $config)
    {
        $this->driver = $driver;
        $this->config = $config;
    }

    /**
     * Get a Redis connection by name.
     *
     * @param  string|null  $name
     * @return \Illuminate\Redis\Connections\Connection
     */
    public function connection($name = null)
    {
        $name = $name ?: 'default';

        if (isset($this->connections[$name])) {
            return $this->connections[$name];
        }

        return $this->connections[$name] = $this->resolve($name);
    }

    /**
     * Resolve the given connection by name.
     *
     * @param  string|null  $name
     * @return \Illuminate\Redis\Connections\Connection
     *
     * @throws \InvalidArgumentException
     */
    public function resolve($name = null)
    {
        $name = $name ?: 'default';

        $options = $this->config['options'] ?? [];

        if (isset($this->config[$name])) {
            return $this->connector()->connect($this->config[$name], $options);
        }

        if (isset($this->config['clusters'][$name])) {
            return $this->resolveCluster($name);
        }

        throw new InvalidArgumentException(
            "Redis connection [{$name}] not configured."
        );
    }

    /**
     * Resolve the given cluster connection by name.
     *
     * @param  string  $name
     * @return \Illuminate\Redis\Connections\Connection
     */
    protected function resolveCluster($name)
    {
        $clusterOptions = $this->config['clusters']['options'] ?? [];

        return $this->connector()->connectToCluster(
            $this->config['clusters'][$name], $clusterOptions, $this->config['options'] ?? []
        );
    }

    /**
     * Get the connector instance for the current driver.
     *
     * @return \Illuminate\Redis\Connectors\PhpRedisConnector|\Illuminate\Redis\Connectors\PredisConnector
     */
    protected function connector()
    {
        switch ($this->driver) {
            case 'predis':
                return new Connectors\PredisConnector;
            case 'phpredis':
                return new Connectors\PhpRedisConnector;
        }
    }

    /**
     * Return all of the created connections.
     *
     * @return array
     */
    public function connections()
    {
        return $this->connections;
    }

    /**
     * Pass methods onto the default Redis connection.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->connection()->{$method}(...$parameters);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

namespace Mockery;

class VerificationDirector
{
    private $receivedMethodCalls;
    private $expectation;

    public function __construct(ReceivedMethodCalls $receivedMethodCalls, VerificationExpectation $expectation)
    {
        $this->receivedMethodCalls = $receivedMethodCalls;
        $this->expectation = $expectation;
    }

    public function verify()
    {
        return $this->receivedMethodCalls->verify($this->expectation);
    }

    public function with()
    {
        return $this->cloneApplyAndVerify("with", func_get_args());
    }

    public function withArgs(array $args)
    {
        return $this->cloneApplyAndVerify("withArgs", array($args));
    }

    public function withNoArgs()
    {
        return $this->cloneApplyAndVerify("withNoArgs", array());
    }

    public function withAnyArgs()
    {
        return $this->cloneApplyAndVerify("withAnyArgs", array());
    }

    public function times($limit = null)
    {
        return $this->cloneWithoutCountValidatorsApplyAndVerify("times", array($limit));
    }

    public function once()
    {
        return $this->cloneWithoutCountValidatorsApplyAndVerify("once", array());
    }

    public function twice()
    {
        return $this->cloneWithoutCountValidatorsApplyAndVerify("twice", array());
    }

    public function atLeast()
    {
        return $this->cloneWithoutCountValidatorsApplyAndVerify("atLeast", array());
    }

    public function atMost()
    {
        return $this->cloneWithoutCountValidatorsApplyAndVerify("atMost", array());
    }

    public function between($minimum, $maximum)
    {
        return $this->cloneWithoutCountValidatorsApplyAndVerify("between", array($minimum, $maximum));
    }

    protected function cloneWithoutCountValidatorsApplyAndVerify($method, $args)
    {
        $expectation = clone $this->expectation;
        $expectation->clearCountValidators();
        call_user_func_array(array($expectation, $method), $args);
        $director = new VerificationDirector($this->receivedMethodCalls, $expectation);
        $director->verify();
        return $director;
    }

    protected function cloneApplyAndVerify($method, $args)
    {
        $expectation = clone $this->expectation;
        call_user_func_array(array($expectation, $method), $args);
        $director = new VerificationDirector($this->receivedMethodCalls, $expectation);
        $director->verify();
        return $director;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

namespace DeepCopy\Filter\Doctrine;

use DeepCopy\Filter\Filter;
use Doctrine\Common\Collections\ArrayCollection;

class DoctrineEmptyCollectionFilter implements Filter
{
    /**
     * Apply the filter to the object.
     *
     * @param object   $object
     * @param string   $property
     * @param callable $objectCopier
     */
    public function apply($object, $property, $objectCopier)
    {
        $reflectionProperty = new \ReflectionProperty($object, $property);
        $reflectionProperty->setAccessible(true);

        $reflectionProperty->setValue($object, new ArrayCollection());
    }
}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Variables
-----
<?php

$a;
$$a;
${$a};
$a->b;
$a->b();
$a->b($c);
$a->$b();
$a->{$b}();
$a->$b[$c]();
$$a->b;
$a[$b];
$a[$b]();
$$a[$b];
$a::B;
$a::$b;
$a::b();
$a::b($c);
$a::$b();
$a::$b[$c];
$a::$b[$c]($d);
$a::{$b[$c]}($d);
$a::{$b->c}();
A::$$b[$c]();
a();
$a();
$a()[$b];
$a->b()[$c];
$a::$b()[$c];
(new A)->b;
(new A())->b();
(new $$a)[$b];
(new $a->b)->c;

global $a, $$a, $$a[$b], $$a->b;
-----
!!php5
$a;
${$a};
${$a};
$a->b;
$a->b();
$a->b($c);
$a->{$b}();
$a->{$b}();
$a->{$b[$c]}();
${$a}->b;
$a[$b];
$a[$b]();
${$a[$b]};
$a::B;
$a::$b;
$a::b();
$a::b($c);
$a::$b();
$a::$b[$c];
$a::{$b[$c]}($d);
$a::{$b[$c]}($d);
$a::{$b->c}();
A::${$b[$c]}();
a();
$a();
$a()[$b];
$a->b()[$c];
$a::$b()[$c];
(new A())->b;
(new A())->b();
(new ${$a}())[$b];
(new $a->b())->c;
global $a, ${$a}, ${$a[$b]}, ${$a->b};
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\CodeCleaner;

use PhpParser\Node;
use PhpParser\Node\Expr\Empty_;
use PhpParser\Node\Expr\Variable;
use Psy\Exception\ParseErrorException;

/**
 * Validate that the user did not call the language construct `empty()` on a
 * statement in PHP < 5.5.
 */
class LegacyEmptyPass extends CodeCleanerPass
{
    /**
     * Validate use of empty in PHP < 5.5.
     *
     * @throws ParseErrorException if the user used empty with anything but a variable
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        if (version_compare(PHP_VERSION, '5.5', '>=')) {
            return;
        }

        if (!$node instanceof Empty_) {
            return;
        }

        if (!$node->expr instanceof Variable) {
            $msg = sprintf('syntax error, unexpected %s', $this->getUnexpectedThing($node->expr));

            throw new ParseErrorException($msg, $node->expr->getLine());
        }
    }

    private function getUnexpectedThing(Node $node)
    {
        switch ($node->getType()) {
            case 'Scalar_String':
            case 'Scalar_LNumber':
            case 'Scalar_DNumber':
                return json_encode($node->value);

            case 'Expr_ConstFetch':
                return (string) $node->name;

            default:
                return $node->getType();
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Debug\Tests\Exception;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\GoneHttpException;
use Symfony\Component\HttpKernel\Exception\LengthRequiredHttpException;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;
use Symfony\Component\HttpKernel\Exception\PreconditionRequiredHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;

class FlattenExceptionTest extends TestCase
{
    public function testStatusCode()
    {
        $flattened = FlattenException::create(new \RuntimeException(), 403);
        $this->assertEquals('403', $flattened->getStatusCode());

        $flattened = FlattenException::create(new \RuntimeException());
        $this->assertEquals('500', $flattened->getStatusCode());

        $flattened = FlattenException::create(new NotFoundHttpException());
        $this->assertEquals('404', $flattened->getStatusCode());

        $flattened = FlattenException::create(new UnauthorizedHttpException('Basic realm="My Realm"'));
        $this->assertEquals('401', $flattened->getStatusCode());

        $flattened = FlattenException::create(new BadRequestHttpException());
        $this->assertEquals('400', $flattened->getStatusCode());

        $flattened = FlattenException::create(new NotAcceptableHttpException());
        $this->assertEquals('406', $flattened->getStatusCode());

        $flattened = FlattenException::create(new ConflictHttpException());
        $this->assertEquals('409', $flattened->getStatusCode());

        $flattened = FlattenException::create(new MethodNotAllowedHttpException(array('POST')));
        $this->assertEquals('405', $flattened->getStatusCode());

        $flattened = FlattenException::create(new AccessDeniedHttpException());
        $this->assertEquals('403', $flattened->getStatusCode());

        $flattened = FlattenException::create(new GoneHttpException());
        $this->assertEquals('410', $flattened->getStatusCode());

        $flattened = FlattenException::create(new LengthRequiredHttpException());
        $this->assertEquals('411', $flattened->getStatusCode());

        $flattened = FlattenException::create(new PreconditionFailedHttpException());
        $this->assertEquals('412', $flattened->getStatusCode());

        $flattened = FlattenException::create(new PreconditionRequiredHttpException());
        $this->assertEquals('428', $flattened->getStatusCode());

        $flattened = FlattenException::create(new ServiceUnavailableHttpException());
        $this->assertEquals('503', $flattened->getStatusCode());

        $flattened = FlattenException::create(new TooManyRequestsHttpException());
        $this->assertEquals('429', $flattened->getStatusCode());

        $flattened = FlattenException::create(new UnsupportedMediaTypeHttpException());
        $this->assertEquals('415', $flattened->getStatusCode());

        if (class_exists(SuspiciousOperationException::class)) {
            $flattened = FlattenException::create(new SuspiciousOperationException());
            $this->assertEquals('400', $flattened->getStatusCode());
        }
    }

    public function testHeadersForHttpException()
    {
        $flattened = FlattenException::create(new MethodNotAllowedHttpException(array('POST')));
        $this->assertEquals(array('Allow' => 'POST'), $flattened->getHeaders());

        $flattened = FlattenException::create(new UnauthorizedHttpException('Basic realm="My Realm"'));
        $this->assertEquals(array('WWW-Authenticate' => 'Basic realm="My Realm"'), $flattened->getHeaders());

        $flattened = FlattenException::create(new ServiceUnavailableHttpException('Fri, 31 Dec 1999 23:59:59 GMT'));
        $this->assertEquals(array('Retry-After' => 'Fri, 31 Dec 1999 23:59:59 GMT'), $flattened->getHeaders());

        $flattened = FlattenException::create(new ServiceUnavailableHttpException(120));
        $this->assertEquals(array('Retry-After' => 120), $flattened->getHeaders());

        $flattened = FlattenException::create(new TooManyRequestsHttpException('Fri, 31 Dec 1999 23:59:59 GMT'));
        $this->assertEquals(array('Retry-After' => 'Fri, 31 Dec 1999 23:59:59 GMT'), $flattened->getHeaders());

        $flattened = FlattenException::create(new TooManyRequestsHttpException(120));
        $this->assertEquals(array('Retry-After' => 120), $flattened->getHeaders());
    }

    /**
     * @dataProvider flattenDataProvider
     */
    public function testFlattenHttpException(\Exception $exception, $statusCode)
    {
        $flattened = FlattenException::create($exception);
        $flattened2 = FlattenException::create($exception);

        $flattened->setPrevious($flattened2);

        $this->assertEquals($exception->getMessage(), $flattened->getMessage(), 'The message is copied from the original exception.');
        $this->assertEquals($exception->getCode(), $flattened->getCode(), 'The code is copied from the original exception.');
        $this->assertInstanceOf($flattened->getClass(), $exception, 'The class is set to the class of the original exception');
    }

    /**
     * @dataProvider flattenDataProvider
     */
    public function testPrevious(\Exception $exception, $statusCode)
    {
        $flattened = FlattenException::create($exception);
        $flattened2 = FlattenException::create($exception);

        $flattened->setPrevious($flattened2);

        $this->assertSame($flattened2, $flattened->getPrevious());

        $this->assertSame(array($flattened2), $flattened->getAllPrevious());
    }

    /**
     * @requires PHP 7.0
     */
    public function testPreviousError()
    {
        $exception = new \Exception('test', 123, new \ParseError('Oh noes!', 42));

        $flattened = FlattenException::create($exception)->getPrevious();

        $this->assertEquals($flattened->getMessage(), 'Parse error: Oh noes!', 'The message is copied from the original exception.');
        $this->assertEquals($flattened->getCode(), 42, 'The code is copied from the original exception.');
        $this->assertEquals($flattened->getClass(), 'Symfony\Component\Debug\Exception\FatalThrowableError', 'The class is set to the class of the original exception');
    }

    /**
     * @dataProvider flattenDataProvider
     */
    public function testLine(\Exception $exception)
    {
        $flattened = FlattenException::create($exception);
        $this->assertSame($exception->getLine(), $flattened->getLine());
    }

    /**
     * @dataProvider flattenDataProvider
     */
    public function testFile(\Exception $exception)
    {
        $flattened = FlattenException::create($exception);
        $this->assertSame($exception->getFile(), $flattened->getFile());
    }

    /**
     * @dataProvider flattenDataProvider
     */
    public function testToArray(\Exception $exception, $statusCode)
    {
        $flattened = FlattenException::create($exception);
        $flattened->setTrace(array(), 'foo.php', 123);

        $this->assertEquals(array(
            array(
                'message' => 'test',
                'class' => 'Exception',
                'trace' => array(array(
                    'namespace' => '', 'short_class' => '', 'class' => '', 'type' => '', 'function' => '', 'file' => 'foo.php', 'line' => 123,
                    'args' => array(),
                )),
            ),
        ), $flattened->toArray());
    }

    public function flattenDataProvider()
    {
        return array(
            array(new \Exception('test', 123), 500),
        );
    }

    public function testArguments()
    {
        $dh = opendir(__DIR__);
        $fh = tmpfile();

        $incomplete = unserialize('O:14:"BogusTestClass":0:{}');

        $exception = $this->createException(array(
            (object) array('foo' => 1),
            new NotFoundHttpException(),
            $incomplete,
            $dh,
            $fh,
            function () {},
            array(1, 2),
            array('foo' => 123),
            null,
            true,
            false,
            0,
            0.0,
            '0',
            '',
            INF,
            NAN,
        ));

        $flattened = FlattenException::create($exception);
        $trace = $flattened->getTrace();
        $args = $trace[1]['args'];
        $array = $args[0][1];

        closedir($dh);
        fclose($fh);

        $i = 0;
        $this->assertSame(array('object', 'stdClass'), $array[$i++]);
        $this->assertSame(array('object', 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException'), $array[$i++]);
        $this->assertSame(array('incomplete-object', 'BogusTestClass'), $array[$i++]);
        $this->assertSame(array('resource', defined('HHVM_VERSION') ? 'Directory' : 'stream'), $array[$i++]);
        $this->assertSame(array('resource', 'stream'), $array[$i++]);

        $args = $array[$i++];
        $this->assertSame($args[0], 'object');
        $this->assertTrue('Closure' === $args[1] || is_subclass_of($args[1], '\Closure'), 'Expect object class name to be Closure or a subclass of Closure.');

        $this->assertSame(array('array', array(array('integer', 1), array('integer', 2))), $array[$i++]);
        $this->assertSame(array('array', array('foo' => array('integer', 123))), $array[$i++]);
        $this->assertSame(array('null', null), $array[$i++]);
        $this->assertSame(array('boolean', true), $array[$i++]);
        $this->assertSame(array('boolean', false), $array[$i++]);
        $this->assertSame(array('integer', 0), $array[$i++]);
        $this->assertSame(array('float', 0.0), $array[$i++]);
        $this->assertSame(array('string', '0'), $array[$i++]);
        $this->assertSame(array('string', ''), $array[$i++]);
        $this->assertSame(array('float', INF), $array[$i++]);

        // assertEquals() does not like NAN values.
        $this->assertEquals($array[$i][0], 'float');
        $this->assertTrue(is_nan($array[$i++][1]));
    }

    public function testRecursionInArguments()
    {
        $a = array('foo', array(2, &$a));
        $exception = $this->createException($a);

        $flattened = FlattenException::create($exception);
        $trace = $flattened->getTrace();
        $this->assertContains('*DEEP NESTED ARRAY*', serialize($trace));
    }

    public function testTooBigArray()
    {
        $a = array();
        for ($i = 0; $i < 20; ++$i) {
            for ($j = 0; $j < 50; ++$j) {
                for ($k = 0; $k < 10; ++$k) {
                    $a[$i][$j][$k] = 'value';
                }
            }
        }
        $a[20] = 'value';
        $a[21] = 'value1';
        $exception = $this->createException($a);

        $flattened = FlattenException::create($exception);
        $trace = $flattened->getTrace();

        $this->assertSame($trace[1]['args'][0], array('array', array('array', '*SKIPPED over 10000 entries*')));

        $serializeTrace = serialize($trace);

        $this->assertContains('*SKIPPED over 10000 entries*', $serializeTrace);
        $this->assertNotContains('*value1*', $serializeTrace);
    }

    private function createException($foo)
    {
        return new \Exception();
    }
}
                                                                                                         <?php

namespace Illuminate\Foundation\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\AggregateServiceProvider;

class FoundationServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        FormRequestServiceProvider::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->registerRequestValidation();
        $this->registerRequestSignatureValidation();
    }

    /**
     * Register the "validate" macro on the request.
     *
     * @return void
     */
    public function registerRequestValidation()
    {
        Request::macro('validate', function (array $rules, ...$params) {
            return validator()->validate($this->all(), $rules, ...$params);
        });
    }

    /**
     * Register the "hasValidSignature" macro on the request.
     *
     * @return void
     */
    public function registerRequestSignatureValidation()
    {
        Request::macro('hasValidSignature', function () {
            return URL::hasValidSignature($this);
        });
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            INDX( 	                 (      �                             *H    x f     )H    v��b� �=�.��i���b�v��b��      �               C l o n i n g V i s i t o r . p h p   +H    x f     )H    ْ��b� �=�.������b�Ғ��b�       b               F i n d i n g V i s i t o r . p h p   ,H    � p     )H    ����b� �=�.��n���b�����b�       �               F i r s t F i n d i n g V i s i t o r . p h p -H    x b     )H    ���b� �=�.������b����b�        �              N a m e R e s o l v e r . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      INDX( 	                 (      �      �                      �K    h X     �K    Tꨦb� ��F��8��b�Pꨦb� 0      �&               A d d r e s s . p h p �K    h X     �K    ���b� ��F���)��b����b� @      4               C o m p a n y . p h p �K    p Z     �K    4��b� ��F��%I��b�4��b��      �               I n t e r n e t . p h p       �K    h X     �K    \S��b� ��F���h��b�ZS��b�       9               P a y m e n t . p h p �K    h V     �K   � u��b� ��F��鎩�b��t��b� 0      �'              
 P e r s o n . p h p   �K    p `     �K    ����b� ��F�����b�x���b�       h	               P h o n e N u m b e r . p h p �K    h R     �K    g���b� ��F��,��b�b���b�      _              T e x t . p h p                                                                                                                                                                                                                           �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               �                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               � <?php
/*
 * This file is part of php-file-iterator.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\FileIterator;

class Facade
{
    /**
     * @param array|string $paths
     * @param array|string $suffixes
     * @param array|string $prefixes
     * @param array        $exclude
     * @param bool         $commonPath
     *
     * @return array
     */
    public function getFilesAsArray($paths, $suffixes = '', $prefixes = '', array $exclude = [], bool $commonPath = false): array
    {
        if (\is_string($paths)) {
            $paths = [$paths];
        }

        $factory = new Factory;

        $iterator = $factory->getFileIterator($paths, $suffixes, $prefixes, $exclude);

        $files = [];

        foreach ($iterator as $file) {
            $file = $file->getRealPath();

            if ($file) {
                $files[] = $file;
            }
        }

        foreach ($paths as $path) {
            if (\is_file($path)) {
                $files[] = \realpath($path);
            }
        }

        $files = \array_unique($files);
        \sort($files);

        if ($commonPath) {
            return [
              'commonPath' => $this->getCommonPath($files),
              'files'      => $files
            ];
        }

        return $files;
    }

    protected function getCommonPath(array $files): string
    {
        $count = \count($files);

        if ($count === 0) {
            return '';
        }

        if ($count === 1) {
            return \dirname($files[0]) . DIRECTORY_SEPARATOR;
        }

        $_files = [];

        foreach ($files as $file) {
            $_files[] = $_fileParts = \explode(DIRECTORY_SEPARATOR, $file);

            if (empty($_fileParts[0])) {
                $_fileParts[0] = DIRECTORY_SEPARATOR;
            }
        }

        $common = '';
        $done   = false;
        $j      = 0;
        $count--;

        while (!$done) {
            for ($i = 0; $i < $count; $i++) {
                if ($_files[$i][$j] != $_files[$i + 1][$j]) {
                    $done = true;

                    break;
                }
            }

            if (!$done) {
                $common .= $_files[0][$j];

                if ($j > 0) {
                    $common .= DIRECTORY_SEPARATOR;
                }
            }

            $j++;
        }

        return DIRECTORY_SEPARATOR . $common;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use PHPUnit\Framework\TestCase;

class ExceptionInAssertPreConditionsTest extends TestCase
{
    public $setUp                = false;

    public $assertPreConditions  = false;

    public $assertPostConditions = false;

    public $tearDown             = false;

    public $testSomething        = false;

    protected function setUp(): void
    {
        $this->setUp = true;
    }

    protected function tearDown(): void
    {
        $this->tearDown = true;
    }

    public function testSomething(): void
    {
        $this->testSomething = true;
    }

    protected function assertPreConditions(): void
    {
        $this->assertPreConditions = true;

        throw new Exception;
    }

    protected function assertPostConditions(): void
    {
        $this->assertPostConditions = true;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php
/*
 * This file is part of PharIo\Manifest.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PharIo\Manifest;

class CopyrightElement extends ManifestElement {
    public function getAuthorElements() {
        return new AuthorElementCollection(
            $this->getChildrenByName('author')
        );
    }

    public function getLicenseElement() {
        return new LicenseElement(
            $this->getChildByName('license')
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

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

namespace Symfony\Component\Process\Pipes;

use Symfony\Component\Process\Exception\InvalidArgumentException;

/**
 * @author Romain Neutron <imprec@gmail.com>
 *
 * @internal
 */
abstract class AbstractPipes implements PipesInterface
{
    public $pipes = array();

    private $inputBuffer = '';
    private $input;
    private $blocked = true;
    private $lastError;

    /**
     * @param resource|string|int|float|bool|\Iterator|null $input
     */
    public function __construct($input)
    {
        if (\is_resource($input) || $input instanceof \Iterator) {
            $this->input = $input;
        } elseif (\is_string($input)) {
            $this->inputBuffer = $input;
        } else {
            $this->inputBuffer = (string) $input;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        foreach ($this->pipes as $pipe) {
            fclose($pipe);
        }
        $this->pipes = array();
    }

    /**
     * Returns true if a system call has been interrupted.
     *
     * @return bool
     */
    protected function hasSystemCallBeenInterrupted()
    {
        $lastError = $this->lastError;
        $this->lastError = null;

        // stream_select returns false when the `select` system call is interrupted by an incoming signal
        return null !== $lastError && false !== stripos($lastError, 'interrupted system call');
    }

    /**
     * Unblocks streams.
     */
    protected function unblock()
    {
        if (!$this->blocked) {
            return;
        }

        foreach ($this->pipes as $pipe) {
            stream_set_blocking($pipe, 0);
        }
        if (\is_resource($this->input)) {
            stream_set_blocking($this->input, 0);
        }

        $this->blocked = false;
    }

    /**
     * Writes input to stdin.
     *
     * @throws InvalidArgumentException When an input iterator yields a non supported value
     */
    protected function write()
    {
        if (!isset($this->pipes[0])) {
            return;
        }
        $input = $this->input;

        if ($input instanceof \Iterator) {
            if (!$input->valid()) {
                $input = null;
            } elseif (\is_resource($input = $input->current())) {
                stream_set_blocking($input, 0);
            } elseif (!isset($this->inputBuffer[0])) {
                if (!\is_string($input)) {
                    if (!is_scalar($input)) {
                        throw new InvalidArgumentException(sprintf('%s yielded a value of type "%s", but only scalars and stream resources are supported', \get_class($this->input), \gettype($input)));
                    }
                    $input = (string) $input;
                }
                $this->inputBuffer = $input;
                $this->input->next();
                $input = null;
            } else {
                $input = null;
            }
        }

        $r = $e = array();
        $w = array($this->pipes[0]);

        // let's have a look if something changed in streams
        if (false === @stream_select($r, $w, $e, 0, 0)) {
            return;
        }

        foreach ($w as $stdin) {
            if (isset($this->inputBuffer[0])) {
                $written = fwrite($stdin, $this->inputBuffer);
                $this->inputBuffer = substr($this->inputBuffer, $written);
                if (isset($this->inputBuffer[0])) {
                    return array($this->pipes[0]);
                }
            }

            if ($input) {
                for (;;) {
                    $data = fread($input, self::CHUNK_SIZE);
                    if (!isset($data[0])) {
                        break;
                    }
                    $written = fwrite($stdin, $data);
                    $data = substr($data, $written);
                    if (isset($data[0])) {
                        $this->inputBuffer = $data;

                        return array($this->pipes[0]);
                    }
                }
                if (feof($input)) {
                    if ($this->input instanceof \Iterator) {
                        $this->input->next();
                    } else {
                        $this->input = null;
                    }
                }
            }
        }

        // no input to read on resource, buffer is empty
        if (!isset($this->inputBuffer[0]) && !($this->input instanceof \Iterator ? $this->input->valid() : $this->input)) {
            $this->input = null;
            fclose($this->pipes[0]);
            unset($this->pipes[0]);
        } elseif (!$w) {
            return array($this->pipes[0]);
        }
    }

    /**
     * @internal
     */
    public function handleError($type, $msg)
    {
        $this->lastError = $msg;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Output;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;

/**
 * StreamOutput writes the output to a given stream.
 *
 * Usage:
 *
 * $output = new StreamOutput(fopen('php://stdout', 'w'));
 *
 * As `StreamOutput` can use any stream, you can also use a file:
 *
 * $output = new StreamOutput(fopen('/path/to/output.log', 'a', false));
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class StreamOutput extends Output
{
    private $stream;

    /**
     * @param resource                      $stream    A stream resource
     * @param int                           $verbosity The verbosity level (one of the VERBOSITY constants in OutputInterface)
     * @param bool|null                     $decorated Whether to decorate messages (null for auto-guessing)
     * @param OutputFormatterInterface|null $formatter Output formatter instance (null to use default OutputFormatter)
     *
     * @throws InvalidArgumentException When first argument is not a real stream
     */
    public function __construct($stream, int $verbosity = self::VERBOSITY_NORMAL, bool $decorated = null, OutputFormatterInterface $formatter = null)
    {
        if (!\is_resource($stream) || 'stream' !== get_resource_type($stream)) {
            throw new InvalidArgumentException('The StreamOutput class needs a stream as its first argument.');
        }

        $this->stream = $stream;

        if (null === $decorated) {
            $decorated = $this->hasColorSupport();
        }

        parent::__construct($verbosity, $decorated, $formatter);
    }

    /**
     * Gets the stream attached to this StreamOutput instance.
     *
     * @return resource A stream resource
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * {@inheritdoc}
     */
    protected function doWrite($message, $newline)
    {
        if (false === @fwrite($this->stream, $message) || ($newline && (false === @fwrite($this->stream, PHP_EOL)))) {
            // should never happen
            throw new RuntimeException('Unable to write output.');
        }

        fflush($this->stream);
    }

    /**
     * Returns true if the stream supports colorization.
     *
     * Colorization is disabled if not supported by the stream:
     *
     * This is tricky on Windows, because Cygwin, Msys2 etc emulate pseudo
     * terminals via named pipes, so we can only check the environment.
     *
     * Reference: Composer\XdebugHandler\Process::supportsColor
     * https://github.com/composer/xdebug-handler
     *
     * @return bool true if the stream supports colorization, false otherwise
     */
    protected function hasColorSupport()
    {
        if ('Hyper' === getenv('TERM_PROGRAM')) {
            return true;
        }

        if (\DIRECTORY_SEPARATOR === '\\') {
            return (\function_exists('sapi_windows_vt100_support')
                && @sapi_windows_vt100_support($this->stream))
                || false !== getenv('ANSICON')
                || 'ON' === getenv('ConEmuANSI')
                || 'xterm' === getenv('TERM');
        }

        if (\function_exists('stream_isatty')) {
            return @stream_isatty($this->stream);
        }

        if (\function_exists('posix_isatty')) {
            return @posix_isatty($this->stream);
        }

        $stat = @fstat($this->stream);
        // Check if formatted mode is S_IFCHR
        return $stat ? 0020000 === ($stat['mode'] & 0170000) : false;
    }
}
                                                                                                                                                                                                                              <?php

namespace Egulias\EmailValidator\Parser;

use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\Exception\AtextAfterCFWS;
use Egulias\EmailValidator\Exception\ConsecutiveDot;
use Egulias\EmailValidator\Exception\CRLFAtTheEnd;
use Egulias\EmailValidator\Exception\CRLFX2;
use Egulias\EmailValidator\Exception\CRNoLF;
use Egulias\EmailValidator\Exception\ExpectedQPair;
use Egulias\EmailValidator\Exception\ExpectingATEXT;
use Egulias\EmailValidator\Exception\ExpectingCTEXT;
use Egulias\EmailValidator\Exception\UnclosedComment;
use Egulias\EmailValidator\Exception\UnclosedQuotedString;
use Egulias\EmailValidator\Warning\CFWSNearAt;
use Egulias\EmailValidator\Warning\CFWSWithFWS;
use Egulias\EmailValidator\Warning\Comment;
use Egulias\EmailValidator\Warning\QuotedPart;
use Egulias\EmailValidator\Warning\QuotedString;

abstract class Parser
{
    protected $warnings = [];
    protected $lexer;
    protected $openedParenthesis = 0;

    public function __construct(EmailLexer $lexer)
    {
        $this->lexer = $lexer;
    }

    public function getWarnings()
    {
        return $this->warnings;
    }

    abstract public function parse($str);

    /** @return int */
    public function getOpenedParenthesis()
    {
        return $this->openedParenthesis;
    }

    /**
     * validateQuotedPair
     */
    protected function validateQuotedPair()
    {
        if (!($this->lexer->token['type'] === EmailLexer::INVALID
            || $this->lexer->token['type'] === EmailLexer::C_DEL)) {
            throw new ExpectedQPair();
        }

        $this->warnings[QuotedPart::CODE] =
            new QuotedPart($this->lexer->getPrevious()['type'], $this->lexer->token['type']);
    }

    protected function parseComments()
    {
        $this->openedParenthesis = 1;
        $this->isUnclosedComment();
        $this->warnings[Comment::CODE] = new Comment();
        while (!$this->lexer->isNextToken(EmailLexer::S_CLOSEPARENTHESIS)) {
            if ($this->lexer->isNextToken(EmailLexer::S_OPENPARENTHESIS)) {
                $this->openedParenthesis++;
            }
            $this->warnEscaping();
            $this->lexer->moveNext();
        }

        $this->lexer->moveNext();
        if ($this->lexer->isNextTokenAny(array(EmailLexer::GENERIC, EmailLexer::S_EMPTY))) {
            throw new ExpectingATEXT();
        }

        if ($this->lexer->isNextToken(EmailLexer::S_AT)) {
            $this->warnings[CFWSNearAt::CODE] = new CFWSNearAt();
        }
    }

    protected function isUnclosedComment()
    {
        try {
            $this->lexer->find(EmailLexer::S_CLOSEPARENTHESIS);
            return true;
        } catch (\RuntimeException $e) {
            throw new UnclosedComment();
        }
    }

    protected function parseFWS()
    {
        $previous = $this->lexer->getPrevious();

        $this->checkCRLFInFWS();

        if ($this->lexer->token['type'] === EmailLexer::S_CR) {
            throw new CRNoLF();
        }

        if ($this->lexer->isNextToken(EmailLexer::GENERIC) && $previous['type']  !== EmailLexer::S_AT) {
            throw new AtextAfterCFWS();
        }

        if ($this->lexer->token['type'] === EmailLexer::S_LF || $this->lexer->token['type'] === EmailLexer::C_NUL) {
            throw new ExpectingCTEXT();
        }

        if ($this->lexer->isNextToken(EmailLexer::S_AT) || $previous['type']  === EmailLexer::S_AT) {
            $this->warnings[CFWSNearAt::CODE] = new CFWSNearAt();
        } else {
            $this->warnings[CFWSWithFWS::CODE] = new CFWSWithFWS();
        }
    }

    protected function checkConsecutiveDots()
    {
        if ($this->lexer->token['type'] === EmailLexer::S_DOT && $this->lexer->isNextToken(EmailLexer::S_DOT)) {
            throw new ConsecutiveDot();
        }
    }

    protected function isFWS()
    {
        if ($this->escaped()) {
            return false;
        }

        if ($this->lexer->token['type'] === EmailLexer::S_SP ||
            $this->lexer->token['type'] === EmailLexer::S_HTAB ||
            $this->lexer->token['type'] === EmailLexer::S_CR ||
            $this->lexer->token['type'] === EmailLexer::S_LF ||
            $this->lexer->token['type'] === EmailLexer::CRLF
        ) {
            return true;
        }

        return false;
    }

    protected function escaped()
    {
        $previous = $this->lexer->getPrevious();

        if ($previous['type'] === EmailLexer::S_BACKSLASH
            &&
            $this->lexer->token['type'] !== EmailLexer::GENERIC
        ) {
            return true;
        }

        return false;
    }

    protected function warnEscaping()
    {
        if ($this->lexer->token['type'] !== EmailLexer::S_BACKSLASH) {
            return false;
        }

        if ($this->lexer->isNextToken(EmailLexer::GENERIC)) {
            throw new ExpectingATEXT();
        }

        if (!$this->lexer->isNextTokenAny(array(EmailLexer::S_SP, EmailLexer::S_HTAB, EmailLexer::C_DEL))) {
            return false;
        }

        $this->warnings[QuotedPart::CODE] =
            new QuotedPart($this->lexer->getPrevious()['type'], $this->lexer->token['type']);
        return true;

    }

    protected function checkDQUOTE($hasClosingQuote)
    {
        if ($this->lexer->token['type'] !== EmailLexer::S_DQUOTE) {
            return $hasClosingQuote;
        }
        if ($hasClosingQuote) {
            return $hasClosingQuote;
        }
        $previous = $this->lexer->getPrevious();
        if ($this->lexer->isNextToken(EmailLexer::GENERIC) && $previous['type'] === EmailLexer::GENERIC) {
            throw new ExpectingATEXT();
        }

        try {
            $this->lexer->find(EmailLexer::S_DQUOTE);
            $hasClosingQuote = true;
        } catch (\Exception $e) {
            throw new UnclosedQuotedString();
        }
        $this->warnings[QuotedString::CODE] = new QuotedString($previous['value'], $this->lexer->token['value']);

        return $hasClosingQuote;
    }

    protected function checkCRLFInFWS()
    {
        if ($this->lexer->token['type'] !== EmailLexer::CRLF) {
            return;
        }

        if (!$this->lexer->isNextTokenAny(array(EmailLexer::S_SP, EmailLexer::S_HTAB))) {
            throw new CRLFX2();
        }

        if (!$this->lexer->isNextTokenAny(array(EmailLexer::S_SP, EmailLexer::S_HTAB))) {
            throw new CRLFAtTheEnd();
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php

namespace Illuminate\Contracts\Notifications;

interface Factory
{
    /**
     * Get a channel instance by name.
     *
     * @param  string|null  $name
     * @return mixed
     */
    public function channel($name = null);

    /**
     * Send the given notification to the given notifiable entities.
     *
     * @param  \Illuminate\Support\Collection|array|mixed  $notifiables
     * @param  mixed  $notification
     * @return void
     */
    public function send($notifiables, $notification);

    /**
     * Send the given notification immediately.
     *
     * @param  \Illuminate\Support\Collection|array|mixed  $notifiables
     * @param  mixed  $notification
     * @return void
     */
    public function sendNow($notifiables, $notification);
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php

namespace Illuminate\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Pagination\AbstractPaginator;

trait CollectsResources
{
    /**
     * Map the given collection resource into its individual resources.
     *
     * @param  mixed  $resource
     * @return mixed
     */
    protected function collectResource($resource)
    {
        if ($resource instanceof MissingValue) {
            return $resource;
        }

        $collects = $this->collects();

        $this->collection = $collects && ! $resource->first() instanceof $collects
            ? $resource->mapInto($collects)
            : $resource->toBase();

        return $resource instanceof AbstractPaginator
                    ? $resource->setCollection($this->collection)
                    : $this->collection;
    }

    /**
     * Get the resource that this resource collects.
     *
     * @return string|null
     */
    protected function collects()
    {
        if ($this->collects) {
            return $this->collects;
        }

        if (Str::endsWith(class_basename($this), 'Collection') &&
            class_exists($class = Str::replaceLast('Collection', '', get_class($this)))) {
            return $class;
        }
    }

    /**
     * Get an iterator for the resource collection.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return $this->collection->getIterator();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      {
    "name": "illuminate/translation",
    "description": "The Illuminate Translation package.",
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
        "php": "^7.1.3",
        "illuminate/contracts": "5.7.*",
        "illuminate/filesystem": "5.7.*",
        "illuminate/support": "5.7.*"
    },
    "autoload": {
        "psr-4": {
            "Illuminate\\Translation\\": ""
        }
    },
    "extra": {
        "branch-alias": {
            "dev-master": "5.7-dev"
        }
    },
    "config": {
        "sort-packages": true
    },
    "minimum-stability": "dev"
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Assignments
-----
<?php
// simple assign
$a = $b;

// combined assign
$a &= $b;
$a |= $b;
$a ^= $b;
$a .= $b;
$a /= $b;
$a -= $b;
$a %= $b;
$a *= $b;
$a += $b;
$a <<= $b;
$a >>= $b;
$a **= $b;

// chained assign
$a = $b *= $c **= $d;

// by ref assign
$a =& $b;

// list() assign
list($a) = $b;
list($a, , $b) = $c;
list($a, list(, $c), $d) = $e;

// inc/dec
++$a;
$a++;
--$a;
$a--;
-----
array(
    0: Stmt_Expression(
        expr: Expr_Assign(
            var: Expr_Variable(
                name: a
                comments: array(
                    0: // simple assign
                )
            )
            expr: Expr_Variable(
                name: b
            )
            comments: array(
                0: // simple assign
            )
        )
        comments: array(
            0: // simple assign
        )
    )
    1: Stmt_Expression(
        expr: Expr_AssignOp_BitwiseAnd(
            var: Expr_Variable(
                name: a
                comments: array(
                    0: // combined assign
                )
            )
            expr: Expr_Variable(
                name: b
            )
            comments: array(
                0: // combined assign
            )
        )
        comments: array(
            0: // combined assign
        )
    )
    2: Stmt_Expression(
        expr: Expr_AssignOp_BitwiseOr(
            var: Expr_Variable(
                name: a
            )
            expr: Expr_Variable(
                name: b
            )
        )
    )
    3: Stmt_Expression(
        expr: Expr_AssignOp_BitwiseXor(
            var: Expr_Variable(
                name: a
            )
            expr: Expr_Variable(
                name: b
            )
        )
    )
    4: Stmt_Expression(
        expr: Expr_AssignOp_Concat(
            var: Expr_Variable(
                name: a
            )
            expr: Expr_Variable(
                name: b
            )
        )
    )
    5: Stmt_Expression(
        expr: Expr_AssignOp_Div(
            var: Expr_Variable(
                name: a
            )
            expr: Expr_Variable(
                name: b
            )
        )
    )
    6: Stmt_Expression(
        expr: Expr_AssignOp_Minus(
            var: Expr_Variable(
                name: a
            )
            expr: Expr_Variable(
                name: b
            )
        )
    )
    7: Stmt_Expression(
        expr: Expr_AssignOp_Mod(
            var: Expr_Variable(
                name: a
            )
            expr: Expr_Variable(
                name: b
            )
        )
    )
    8: Stmt_Expression(
        expr: Expr_AssignOp_Mul(
            var: Expr_Variable(
                name: a
            )
            expr: Expr_Variable(
                name: b
            )
        )
    )
    9: Stmt_Expression(
        expr: Expr_AssignOp_Plus(
            var: Expr_Variable(
                name: a
            )
            expr: Expr_Variable(
                name: b
            )
        )
    )
    10: Stmt_Expression(
        expr: Expr_AssignOp_ShiftLeft(
            var: Expr_Variable(
                name: a
            )
            expr: Expr_Variable(
                name: b
            )
        )
    )
    11: Stmt_Expression(
        expr: Expr_AssignOp_ShiftRight(
            var: Expr_Variable(
                name: a
            )
            expr: Expr_Variable(
                name: b
            )
        )
    )
    12: Stmt_Expression(
        expr: Expr_AssignOp_Pow(
            var: Expr_Variable(
                name: a
            )
            expr: Expr_Variable(
                name: b
            )
        )
    )
    13: Stmt_Expression(
        expr: Expr_Assign(
            var: Expr_Variable(
                name: a
                comments: array(
                    0: // chained assign
                )
            )
            expr: Expr_AssignOp_Mul(
                var: Expr_Variable(
                    name: b
                )
                expr: Expr_AssignOp_Pow(
                    var: Expr_Variable(
                        name: c
                    )
                    expr: Expr_Variable(
                        name: d
                    )
                )
            )
            comments: array(
                0: // chained assign
            )
        )
        comments: array(
            0: // chained assign
        )
    )
    14: Stmt_Expression(
        expr: Expr_AssignRef(
            var: Expr_Variable(
                name: a
                comments: array(
                    0: // by ref assign
                )
            )
            expr: Expr_Variable(
                name: b
            )
            comments: array(
                0: // by ref assign
            )
        )
        comments: array(
            0: // by ref assign
        )
    )
    15: Stmt_Expression(
        expr: Expr_Assign(
            var: Expr_List(
                items: array(
                    0: Expr_ArrayItem(
                        key: null
                        value: Expr_Variable(
                            name: a
                        )
                        byRef: false
                    )
                )
                comments: array(
                    0: // list() assign
                )
            )
            expr: Expr_Variable(
                name: b
            )
            comments: array(
                0: // list() assign
            )
        )
        comments: array(
            0: // list() assign
        )
    )
    16: Stmt_Expression(
        expr: Expr_Assign(
            var: Expr_List(
                items: array(
                    0: Expr_ArrayItem(
                        key: null
                        value: Expr_Variable(
                            name: a
                        )
                        byRef: false
                    )
                    1: null
                    2: Expr_ArrayItem(
                        key: null
                        value: Expr_Variable(
                            name: b
                        )
                        byRef: false
                    )
                )
            )
            expr: Expr_Variable(
                name: c
            )
        )
    )
    17: Stmt_Expression(
        expr: Expr_Assign(
            var: Expr_List(
                items: array(
                    0: Expr_ArrayItem(
                        key: null
                        value: Expr_Variable(
                            name: a
                        )
                        byRef: false
                    )
                    1: Expr_ArrayItem(
                        key: null
                        value: Expr_List(
                            items: array(
                                0: null
                                1: Expr_ArrayItem(
                                    key: null
                                    value: Expr_Variable(
                                        name: c
                                    )
                                    byRef: false
                                )
                            )
                        )
                        byRef: false
                    )
                    2: Expr_ArrayItem(
                        key: null
                        value: Expr_Variable(
                            name: d
                        )
                        byRef: false
                    )
                )
            )
            expr: Expr_Variable(
                name: e
            )
        )
    )
    18: Stmt_Expression(
        expr: Expr_PreInc(
            var: Expr_Variable(
                name: a
            )
            comments: array(
                0: // inc/dec
            )
        )
        comments: array(
            0: // inc/dec
        )
    )
    19: Stmt_Expression(
        expr: Expr_PostInc(
            var: Expr_Variable(
                name: a
            )
        )
    )
    20: Stmt_Expression(
        expr: Expr_PreDec(
            var: Expr_Variable(
                name: a
            )
        )
    )
    21: Stmt_Expression(
        expr: Expr_PostDec(
            var: Expr_Variable(
                name: a
            )
        )
    )
)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2018 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Test\Exception;

use Psy\Exception\ErrorException;

class ErrorExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testInstance()
    {
        $e = new ErrorException();

        $this->assertInstanceOf('Psy\Exception\Exception', $e);
        $this->assertInstanceOf('ErrorException', $e);
        $this->assertInstanceOf('Psy\Exception\ErrorException', $e);
    }

    public function testMessage()
    {
        $e = new ErrorException('foo');

        $this->assertContains('foo', $e->getMessage());
        $this->assertSame('foo', $e->getRawMessage());
    }

    /**
     * @dataProvider getLevels
     */
    public function testErrorLevels($level, $type)
    {
        $e = new ErrorException('foo', 0, $level);
        $this->assertContains('PHP ' . $type, $e->getMessage());
    }

    /**
     * @dataProvider getLevels
     */
    public function testThrowException($level, $type)
    {
        try {
            ErrorException::throwException($level, '{whot}', '{file}', '13');
        } catch (ErrorException $e) {
            $this->assertContains('PHP ' . $type, $e->getMessage());
            $this->assertContains('{whot}', $e->getMessage());
            $this->assertContains('in {file}', $e->getMessage());
            $this->assertContains('on line 13', $e->getMessage());
        }
    }

    public function getLevels()
    {
        return [
            [E_WARNING,           'Warning'],
            [E_CORE_WARNING,      'Warning'],
            [E_COMPILE_WARNING,   'Warning'],
            [E_USER_WARNING,      'Warning'],
            [E_STRICT,            'Strict error'],
            [E_DEPRECATED,        'Deprecated'],
            [E_USER_DEPRECATED,   'Deprecated'],
            [E_RECOVERABLE_ERROR, 'Recoverable fatal error'],
            [0,                   'Error'],
        ];
    }

    /**
     * @dataProvider getUserLevels
     */
    public function testThrowExceptionAsErrorHandler($level, $type)
    {
        \set_error_handler(['Psy\Exception\ErrorException', 'throwException']);
        try {
            \trigger_error('{whot}', $level);
        } catch (ErrorException $e) {
            $this->assertContains('PHP ' . $type, $e->getMessage());
            $this->assertContains('{whot}', $e->getMessage());
        }
        \restore_error_handler();
    }

    public function getUserLevels()
    {
        return [
            [E_USER_ERROR,      'Error'],
            [E_USER_WARNING,    'Warning'],
            [E_USER_NOTICE,     'Notice'],
            [E_USER_DEPRECATED, 'Deprecated'],
        ];
    }

    public function testIgnoreExecutionLoopFilename()
    {
        $e = new ErrorException('{{message}}', 0, 1, '/fake/path/to/Psy/ExecutionLoop.php');
        $this->assertEmpty($e->getFile());

        $e = new ErrorException('{{message}}', 0, 1, 'c:\fake\path\to\Psy\ExecutionLoop.php');
        $this->assertEmpty($e->getFile());

        $e = new ErrorException('{{message}}', 0, 1, '/fake/path/to/Psy/File.php');
        $this->assertNotEmpty($e->getFile());
    }

    public function testFromError()
    {
        if (\version_compare(PHP_VERSION, '7.0.0', '<')) {
            $this->markTestSkipped();
        }

        $error = new \Error('{{message}}', 0);
        $exception = ErrorException::fromError($error);

        $this->assertContains('PHP Error:  {{message}}', $exception->getMessage());
        $this->assertEquals(0, $exception->getCode());
        $this->assertEquals($error->getFile(), $exception->getFile());
        $this->assertSame($exception->getPrevious(), $error);
    }
}
                                                                                                                                                                                                                                                                                     INDX( 	                 (   �  �                            l    h X     l    ����b����W��s��b�����b�        �               A d d r e s s . p h p l    h X     l    7-��b����W���K��b�0-��b��      �               C o m p a n y . p h p l    p Z     l    ?Z��b����W���t��b�:Z��b�(      $               I n t e r n e t . p h p       l    h X     l    2���b����W������b�,���b�       �               P a y m e n t . p h p  l    h V     l    )���b����W��rƧ�b�&���b� p      �m              
 P e r s o n . p h p   !l    p `     l    ѧ�b����W��"姭b�ѧ�b�`      [               P h o n e N u m b e r . p h p                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php
namespace Hamcrest\Core;

/*
 Copyright (c) 2009 hamcrest.org
 */

use Hamcrest\BaseMatcher;
use Hamcrest\Description;
use Hamcrest\Util;

abstract class ShortcutCombination extends BaseMatcher
{

    /**
     * @var array<\Hamcrest\Matcher>
     */
    private $_matchers;

    public function __construct(array $matchers)
    {
        Util::checkAllAreMatchers($matchers);

        $this->_matchers = $matchers;
    }

    protected function matchesWithShortcut($item, $shortcut)
    {
        /** @var $matcher \Hamcrest\Matcher */
        foreach ($this->_matchers as $matcher) {
            if ($matcher->matches($item) == $shortcut) {
                return $shortcut;
            }
        }

        return !$shortcut;
    }

    public function describeToWithOperator(Description $description, $operator)
    {
        $description->appendList('(', ' ' . $operator . ' ', ')', $this->_matchers);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php
/**
* Whoops - php errors for cool kids
* @author Filipe Dobreira <http://github.com/filp>
* Plaintext handler for command line and logs.
* @author Pierre-Yves Landuré <https://howto.biapy.com/>
*/

namespace Whoops\Handler;

use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Whoops\Exception\Frame;

/**
* Handler outputing plaintext error messages. Can be used
* directly, or will be instantiated automagically by Whoops\Run
* if passed to Run::pushHandler
*/
class PlainTextHandler extends Handler
{
    const VAR_DUMP_PREFIX = '   | ';

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var callable
     */
    protected $dumper;

    /**
     * @var bool
     */
    private $addTraceToOutput = true;

    /**
     * @var bool|integer
     */
    private $addTraceFunctionArgsToOutput = false;

    /**
     * @var integer
     */
    private $traceFunctionArgsOutputLimit = 1024;

    /**
     * @var bool
     */
    private $loggerOnly = false;

    /**
     * Constructor.
     * @throws InvalidArgumentException     If argument is not null or a LoggerInterface
     * @param  \Psr\Log\LoggerInterface|null $logger
     */
    public function __construct($logger = null)
    {
        $this->setLogger($logger);
    }

    /**
     * Set the output logger interface.
     * @throws InvalidArgumentException     If argument is not null or a LoggerInterface
     * @param  \Psr\Log\LoggerInterface|null $logger
     */
    public function setLogger($logger = null)
    {
        if (! (is_null($logger)
            || $logger instanceof LoggerInterface)) {
            throw new InvalidArgumentException(
                'Argument to ' . __METHOD__ .
                " must be a valid Logger Interface (aka. Monolog), " .
                get_class($logger) . ' given.'
            );
        }

        $this->logger = $logger;
    }

    /**
     * @return \Psr\Log\LoggerInterface|null
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * Set var dumper callback function.
     *
     * @param  callable $dumper
     * @return void
     */
    public function setDumper(callable $dumper)
    {
        $this->dumper = $dumper;
    }

    /**
     * Add error trace to output.
     * @param  bool|null  $addTraceToOutput
     * @return bool|$this
     */
    public function addTraceToOutput($addTraceToOutput = null)
    {
        if (func_num_args() == 0) {
            return $this->addTraceToOutput;
        }

        $this->addTraceToOutput = (bool) $addTraceToOutput;
        return $this;
    }

    /**
     * Add error trace function arguments to output.
     * Set to True for all frame args, or integer for the n first frame args.
     * @param  bool|integer|null $addTraceFunctionArgsToOutput
     * @return null|bool|integer
     */
    public function addTraceFunctionArgsToOutput($addTraceFunctionArgsToOutput = null)
    {
        if (func_num_args() == 0) {
            return $this->addTraceFunctionArgsToOutput;
        }

        if (! is_integer($addTraceFunctionArgsToOutput)) {
            $this->addTraceFunctionArgsToOutput = (bool) $addTraceFunctionArgsToOutput;
        } else {
            $this->addTraceFunctionArgsToOutput = $addTraceFunctionArgsToOutput;
        }
    }

    /**
     * Set the size limit in bytes of frame arguments var_dump output.
     * If the limit is reached, the var_dump output is discarded.
     * Prevent memory limit errors.
     * @var integer
     */
    public function setTraceFunctionArgsOutputLimit($traceFunctionArgsOutputLimit)
    {
        $this->traceFunctionArgsOutputLimit = (integer) $traceFunctionArgsOutputLimit;
    }

    /**
     * Create plain text response and return it as a string
     * @return string
     */
    public function generateResponse()
    {
        $exception = $this->getException();
        return sprintf(
            "%s: %s in file %s on line %d%s\n",
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            $this->getTraceOutput()
        );
    }

    /**
     * Get the size limit in bytes of frame arguments var_dump output.
     * If the limit is reached, the var_dump output is discarded.
     * Prevent memory limit errors.
     * @return integer
     */
    public function getTraceFunctionArgsOutputLimit()
    {
        return $this->traceFunctionArgsOutputLimit;
    }

    /**
     * Only output to logger.
     * @param  bool|null $loggerOnly
     * @return null|bool
     */
    public function loggerOnly($loggerOnly = null)
    {
        if (func_num_args() == 0) {
            return $this->loggerOnly;
        }

        $this->loggerOnly = (bool) $loggerOnly;
    }

    /**
     * Test if handler can output to stdout.
     * @return bool
     */
    private function canOutput()
    {
        return !$this->loggerOnly();
    }

    /**
     * Get the frame args var_dump.
     * @param  \Whoops\Exception\Frame $frame [description]
     * @param  integer                 $line  [description]
     * @return string
     */
    private function getFrameArgsOutput(Frame $frame, $line)
    {
        if ($this->addTraceFunctionArgsToOutput() === false
            || $this->addTraceFunctionArgsToOutput() < $line) {
            return '';
        }

        // Dump the arguments:
        ob_start();
        $this->dump($frame->getArgs());
        if (ob_get_length() > $this->getTraceFunctionArgsOutputLimit()) {
            // The argument var_dump is to big.
            // Discarded to limit memory usage.
            ob_clean();
            return sprintf(
                "\n%sArguments dump length greater than %d Bytes. Discarded.",
                self::VAR_DUMP_PREFIX,
                $this->getTraceFunctionArgsOutputLimit()
            );
        }

        return sprintf(
            "\n%s",
            preg_replace('/^/m', self::VAR_DUMP_PREFIX, ob_get_clean())
        );
    }

    /**
     * Dump variable.
     *
     * @param mixed $var
     * @return void
     */
    protected function dump($var)
    {
        if ($this->dumper) {
            call_user_func($this->dumper, $var);
        } else {
            var_dump($var);
        }
    }

    /**
     * Get the exception trace as plain text.
     * @return string
     */
    private function getTraceOutput()
    {
        if (! $this->addTraceToOutput()) {
            return '';
        }
        $inspector = $this->getInspector();
        $frames = $inspector->getFrames();

        $response = "\nStack trace:";

        $line = 1;
        foreach ($frames as $frame) {
            /** @var Frame $frame */
            $class = $frame->getClass();

            $template = "\n%3d. %s->%s() %s:%d%s";
            if (! $class) {
                // Remove method arrow (->) from output.
                $template = "\n%3d. %s%s() %s:%d%s";
            }

            $response .= sprintf(
                $template,
                $line,
                $class,
                $frame->getFunction(),
                $frame->getFile(),
                $frame->getLine(),
                $this->getFrameArgsOutput($frame, $line)
            );

            $line++;
        }

        return $response;
    }

    /**
     * @return int
     */
    public function handle()
    {
        $response = $this->generateResponse();

        if ($this->getLogger()) {
            $this->getLogger()->error($response);
        }

        if (! $this->canOutput()) {
            return Handler::DONE;
        }

        echo $response;

        return Handler::QUIT;
    }

    /**
     * @return string
     */
    public function contentType()
    {
        return 'text/plain';
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                    <?php
/*
 * This file is part of the php-code-coverage package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\CodeCoverage\Report\Html;

use SebastianBergmann\CodeCoverage\Node\AbstractNode as Node;
use SebastianBergmann\CodeCoverage\Node\Directory as DirectoryNode;

/**
 * Renders a directory node.
 */
final class Directory extends Renderer
{
    /**
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function render(DirectoryNode $node, string $file): void
    {
        $template = new \Text_Template($this->templatePath . 'directory.html', '{{', '}}');

        $this->setCommonTemplateVariables($template, $node);

        $items = $this->renderItem($node, true);

        foreach ($node->getDirectories() as $item) {
            $items .= $this->renderItem($item);
        }

        foreach ($node->getFiles() as $item) {
            $items .= $this->renderItem($item);
        }

        $template->setVar(
            [
                'id'    => $node->getId(),
                'items' => $items
            ]
        );

        $template->renderTo($file);
    }

    protected function renderItem(Node $node, bool $total = false): string
    {
        $data = [
            'numClasses'                   => $node->getNumClassesAndTraits(),
            'numTestedClasses'             => $node->getNumTestedClassesAndTraits(),
            'numMethods'                   => $node->getNumFunctionsAndMethods(),
            'numTestedMethods'             => $node->getNumTestedFunctionsAndMethods(),
            'linesExecutedPercent'         => $node->getLineExecutedPercent(false),
            'linesExecutedPercentAsString' => $node->getLineExecutedPercent(),
            'numExecutedLines'             => $node->getNumExecutedLines(),
            'numExecutableLines'           => $node->getNumExecutableLines(),
            'testedMethodsPercent'         => $node->getTestedFunctionsAndMethodsPercent(false),
            'testedMethodsPercentAsString' => $node->getTestedFunctionsAndMethodsPercent(),
            'testedClassesPercent'         => $node->getTestedClassesAndTraitsPercent(false),
            'testedClassesPercentAsString' => $node->getTestedClassesAndTraitsPercent()
        ];

        if ($total) {
            $data['name'] = 'Total';
        } else {
            if ($node instanceof DirectoryNode) {
                $data['name'] = \sprintf(
                    '<a href="%s/index.html">%s</a>',
                    $node->getName(),
                    $node->getName()
                );

                $data['icon'] = '<span class="glyphicon glyphicon-folder-open"></span> ';
            } else {
                $data['name'] = \sprintf(
                    '<a href="%s.html">%s</a>',
                    $node->getName(),
                    $node->getName()
                );

                $data['icon'] = '<span class="glyphicon glyphicon-file"></span> ';
            }
        }

        return $this->renderItemTemplate(
            new \Text_Template($this->templatePath . 'directory_item.html', '{{', '}}'),
            $data
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use PHPUnit\Framework\TestCase;

class ExceptionInTest extends TestCase
{
    public $setUp                = false;

    public $assertPreConditions  = false;

    public $assertPostConditions = false;

    public $tearDown             = false;

    public $testSomething        = false;

    protected function setUp(): void
    {
        $this->setUp = true;
    }

    protected function tearDown(): void
    {
        $this->tearDown = true;
    }

    public function testSomething(): void
    {
        $this->testSomething = true;

        throw new Exception;
    }

    protected function assertPreConditions(): void
    {
        $this->assertPreConditions = true;
    }

    protected function assertPostConditions(): void
    {
        $this->assertPostConditions = true;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Util\TestDox;

use PHPUnit\Framework\TestCase;

class NamePrettifierTest extends TestCase
{
    /**
     * @var NamePrettifier
     */
    private $namePrettifier;

    protected function setUp(): void
    {
        $this->namePrettifier = new NamePrettifier;
    }

    protected function tearDown(): void
    {
        $this->namePrettifier = null;
    }

    public function testTitleHasSensibleDefaults(): void
    {
        $this->assertEquals('Foo', $this->namePrettifier->prettifyTestClass('FooTest'));
        $this->assertEquals('Foo', $this->namePrettifier->prettifyTestClass('TestFoo'));
        $this->assertEquals('Foo', $this->namePrettifier->prettifyTestClass('TestFooTest'));
        $this->assertEquals('Foo', $this->namePrettifier->prettifyTestClass('Test\FooTest'));
        $this->assertEquals('Foo', $this->namePrettifier->prettifyTestClass('Tests\FooTest'));
    }

    public function testTestNameIsConvertedToASentence(): void
    {
        $this->assertEquals('This is a test', $this->namePrettifier->prettifyTestMethod('testThisIsATest'));
        $this->assertEquals('This is a test', $this->namePrettifier->prettifyTestMethod('testThisIsATest2'));
        $this->assertEquals('This is a test', $this->namePrettifier->prettifyTestMethod('this_is_a_test'));
        $this->assertEquals('This is a test', $this->namePrettifier->prettifyTestMethod('test_this_is_a_test'));
        $this->assertEquals('Foo for bar is 0', $this->namePrettifier->prettifyTestMethod('testFooForBarIs0'));
        $this->assertEquals('Foo for baz is 1', $this->namePrettifier->prettifyTestMethod('testFooForBazIs1'));
        $this->assertEquals('This has a 123 in its name', $this->namePrettifier->prettifyTestMethod('testThisHasA123InItsName'));
        $this->assertEquals('', $this->namePrettifier->prettifyTestMethod('test'));
    }

    /**
     * @ticket 224
     */
    public function testTestNameIsNotGroupedWhenNotInSequence(): void
    {
        $this->assertEquals('Sets redirect header on 301', $this->namePrettifier->prettifyTestMethod('testSetsRedirectHeaderOn301'));
        $this->assertEquals('Sets redirect header on 302', $this->namePrettifier->prettifyTestMethod('testSetsRedirectHeaderOn302'));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

namespace DeepCopy;

use DateInterval;
use DateTimeInterface;
use DateTimeZone;
use DeepCopy\Exception\CloneException;
use DeepCopy\Filter\Filter;
use DeepCopy\Matcher\Matcher;
use DeepCopy\TypeFilter\Date\DateIntervalFilter;
use DeepCopy\TypeFilter\Spl\SplDoublyLinkedListFilter;
use DeepCopy\TypeFilter\TypeFilter;
use DeepCopy\TypeMatcher\TypeMatcher;
use ReflectionObject;
use ReflectionProperty;
use DeepCopy\Reflection\ReflectionHelper;
use SplDoublyLinkedList;

/**
 * @final
 */
class DeepCopy
{
    /**
     * @var object[] List of objects copied.
     */
    private $hashMap = [];

    /**
     * Filters to apply.
     *
     * @var array Array of ['filter' => Filter, 'matcher' => Matcher] pairs.
     */
    private $filters = [];

    /**
     * Type Filters to apply.
     *
     * @var array Array of ['filter' => Filter, 'matcher' => Matcher] pairs.
     */
    private $typeFilters = [];

    /**
     * @var bool
     */
    private $skipUncloneable = false;

    /**
     * @var bool
     */
    private $useCloneMethod;

    /**
     * @param bool $useCloneMethod   If set to true, when an object implements the __clone() function, it will be used
     *                               instead of the regular deep cloning.
     */
    public function __construct($useCloneMethod = false)
    {
        $this->useCloneMethod = $useCloneMethod;

        $this->addTypeFilter(new DateIntervalFilter(), new TypeMatcher(DateInterval::class));
        $this->addTypeFilter(new SplDoublyLinkedListFilter($this), new TypeMatcher(SplDoublyLinkedList::class));
    }

    /**
     * If enabled, will not throw an exception when coming across an uncloneable property.
     *
     * @param $skipUncloneable
     *
     * @return $this
     */
    public function skipUncloneable($skipUncloneable = true)
    {
        $this->skipUncloneable = $skipUncloneable;

        return $this;
    }

    /**
     * Deep copies the given object.
     *
     * @param mixed $object
     *
     * @return mixed
     */
    public function copy($object)
    {
        $this->hashMap = [];

        return $this->recursiveCopy($object);
    }

    public function addFilter(Filter $filter, Matcher $matcher)
    {
        $this->filters[] = [
            'matcher' => $matcher,
            'filter'  => $filter,
        ];
    }

    public function addTypeFilter(TypeFilter $filter, TypeMatcher $matcher)
    {
        $this->typeFilters[] = [
            'matcher' => $matcher,
            'filter'  => $filter,
        ];
    }

    private function recursiveCopy($var)
    {
        // Matches Type Filter
        if ($filter = $this->getFirstMatchedTypeFilter($this->typeFilters, $var)) {
            return $filter->apply($var);
        }

        // Resource
        if (is_resource($var)) {
            return $var;
        }

        // Array
        if (is_array($var)) {
            return $this->copyArray($var);
        }

        // Scalar
        if (! is_object($var)) {
            return $var;
        }

        // Object
        return $this->copyObject($var);
    }

    /**
     * Copy an array
     * @param array $array
     * @return array
     */
    private function copyArray(array $array)
    {
        foreach ($array as $key => $value) {
            $array[$key] = $this->recursiveCopy($value);
        }

        return $array;
    }

    /**
     * Copies an object.
     *
     * @param object $object
     *
     * @throws CloneException
     *
     * @return object
     */
    private function copyObject($object)
    {
        $objectHash = spl_object_hash($object);

        if (isset($this->hashMap[$objectHash])) {
            return $this->hashMap[$objectHash];
        }

        $reflectedObject = new ReflectionObject($object);
        $isCloneable = $reflectedObject->isCloneable();

        if (false === $isCloneable) {
            if ($this->skipUncloneable) {
                $this->hashMap[$objectHash] = $object;

                return $object;
            }

            throw new CloneException(
                sprintf(
                    'The class "%s" is not cloneable.',
                    $reflectedObject->getName()
                )
            );
        }

        $newObject = clone $object;
        $this->hashMap[$objectHash] = $newObject;

        if ($this->useCloneMethod && $reflectedObject->hasMethod('__clone')) {
            return $newObject;
        }

        if ($newObject instanceof DateTimeInterface || $newObject instanceof DateTimeZone) {
            return $newObject;
        }

        foreach (ReflectionHelper::getProperties($reflectedObject) as $property) {
            $this->copyObjectProperty($newObject, $property);
        }

        return $newObject;
    }

    private function copyObjectProperty($object, ReflectionProperty $property)
    {
        // Ignore static properties
        if ($property->isStatic()) {
            return;
        }

        // Apply the filters
        foreach ($this->filters as $item) {
            /** @var Matcher $matcher */
            $matcher = $item['matcher'];
            /** @var Filter $filter */
            $filter = $item['filter'];

            if ($matcher->matches($object, $property->getName())) {
                $filter->apply(
                    $object,
                    $property->getName(),
                    function ($object) {
                        return $this->recursiveCopy($object);
                    }
                );

                // If a filter matches, we stop processing this property
                return;
            }
        }

        $property->setAccessible(true);
        $propertyValue = $property->getValue($object);

        // Copy the property
        $property->setValue($object, $this->recursiveCopy($propertyValue));
    }

    /**
     * Returns first filter that matches variable, `null` if no such filter found.
     *
     * @param array $filterRecords Associative array with 2 members: 'filter' with value of type {@see TypeFilter} and
     *                             'matcher' with value of type {@see TypeMatcher}
     * @param mixed $var
     *
     * @return TypeFilter|null
     */
    private function getFirstMatchedTypeFilter(array $filterRecords, $var)
    {
        $matched = $this->first(
            $filterRecords,
            function (array $record) use ($var) {
                /* @var TypeMatcher $matcher */
                $matcher = $record['matcher'];

                return $matcher->matches($var);
            }
        );

        return isset($matched) ? $matched['filter'] : null;
    }

    /**
     * Returns first element that matches predicate, `null` if no such element found.
     *
     * @param array    $elements Array of ['filter' => Filter, 'matcher' => Matcher] pairs.
     * @param callable $predicate Predicate arguments are: element.
     *
     * @return array|null Associative array with 2 members: 'filter' with value of type {@see TypeFilter} and 'matcher'
     *                    with value of type {@see TypeMatcher} or `null`.
     */
    private function first(array $elements, callable $predicate)
    {
        foreach ($elements as $element) {
            if (call_user_func($predicate, $element)) {
                return $element;
            }
        }

        return null;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     x�Ny4ԍ��f�����!1�_��]�˾$>kc)�+*Yb>Z0�첄aHB&#Kd߳�&���!�wϽ�9�����=�=��>�y|�����(�('�' ���� ���t����8�78 P  tN�M���/��*��qʀNf�� 
�A�`0&V��E�01� ��pΆd�7�l�HN6^^�Ɯ� fffv6vA$R��Ň�[������,! . ��p�Nh���~0t��?��!0&f � �#�~�!P ����'(3��/�)��*q�x�혽ŔUx����:#�p�Ώ[���>ϗ�}�~���!P��@\`�Yn%;���xb'�W����4��քp� }�1�$c"[��eо�o��f�7�'pM���pii��_���4W��DŌu��p�Cэ�k�\r1���L�6F6'�����8B�E�hj�ކy�	&��H�\(��Fy<�Y^)J&�8��kX�+~�k���ʤՋ=���.z�]��)���k1-�WLa��2���y�/�&/^%��EG��M~���+Q������V���uG|g�����?�Zk�<8H8~l�G�}UD}ε��.���s��ו�ң��T1�O+E/�CӲ�5�Ÿ����M�Q/�m�=��K$��)�Q�O��m��'��9�+�^u=J�eM�Q� 4�an���TN.!l
�k���g�ވ���<�;.�κ���0��O;��`�z<��^8j��Å��DK�ï���j�|�D?l%��O�g�E�
3;Xu"!��_�T�-���tu3�W��"d=(��_����46�{: 
���~ys�E�8�?;�-_+�.��y���$#�9]��-*;g`J�s�C���~Y�k�D�4D���~�l�����Y[���c.P9�H6�)3�[R5[gV�4���T]�4��<V�	N΅�ڂ0�`�6E����b6?����}�zw���/�ʗi���U�>��X�"G��%̾)��w$C+��%�!eJ���0QP^;WȞu�I�������;>;��)�g����q�����Է��4v���粱%3�2�~Ԧ�ma�H)��?�
E�>i�Z�_BЬ��{i��5�q�q��������ZY8BR-*�֫��L�p('>�-o�/�q���a�pK:x=t�s���f�/.���"_�/.�,�+�c�"�cU߿ꮺ8�chŸ�����mY���N9�˫@TC�����Px0�����@���w7��=�56�=Up"�J4� h͂q�D�pEٿ�I5f\G�eD�t\f�l��\˥�wpg_W��o�ڎ�{�54'��Am� ^~2���{;S��
�(ը�$j`�ʏ
I�S֡ؗ�#��!��[�v�J˶TԒ�Qyx��Į�g�z���>��@�j�ec�US�p����H��8y)��)9G��+!�F���0���QY6����G�ZV4�$֔n���/�>����N8P䈜����g��Zۢ�����.�