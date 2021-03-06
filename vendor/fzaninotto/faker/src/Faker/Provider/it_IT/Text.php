u!
Împăratul, înfuriat, porunci să-l lege de gât cu un fir lung de mătase şi-l coborî de-l înecă în puţul din curtea domnească.

Aşa sfârşi bietul Neghiniţă.
EOT;
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php
namespace Hamcrest\Type;

class IsArrayTest extends \Hamcrest\AbstractMatcherTest
{

    protected function createMatcher()
    {
        return \Hamcrest\Type\IsArray::arrayValue();
    }

    public function testEvaluatesToTrueIfArgumentMatchesType()
    {
        assertThat(array('5', 5), arrayValue());
        assertThat(array(), arrayValue());
    }

    public function testEvaluatesToFalseIfArgumentDoesntMatchType()
    {
        assertThat(false, not(arrayValue()));
        assertThat(5, not(arrayValue()));
        assertThat('foo', not(arrayValue()));
    }

    public function testHasAReadableDescription()
    {
        $this->assertDescription('an array', arrayValue());
    }

    public function testDecribesActualTypeInMismatchMessage()
    {
        $this->assertMismatchDescription('was null', arrayValue(), null);
        $this->assertMismatchDescription('was a string "foo"', arrayValue(), 'foo');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

namespace Illuminate\Database\Schema\Grammars;

use Illuminate\Support\Fluent;
use Illuminate\Database\Schema\Blueprint;

class SqlServerGrammar extends Grammar
{
    /**
     * The possible column modifiers.
     *
     * @var array
     */
    protected $modifiers = ['Increment', 'Collate', 'Nullable', 'Default'];

    /**
     * The columns available as serials.
     *
     * @var array
     */
    protected $serials = ['tinyInteger', 'smallInteger', 'mediumInteger', 'integer', 'bigInteger'];

    /**
     * Compile the query to determine if a table exists.
     *
     * @return string
     */
    public function compileTableExists()
    {
        return "select * from sysobjects where type = 'U' and name = ?";
    }

    /**
     * Compile the query to determine the list of columns.
     *
     * @param  string  $table
     * @return string
     */
    public function compileColumnListing($table)
    {
        return "select col.name from sys.columns as col
                join sys.objects as obj on col.object_id = obj.object_id
                where obj.type = 'U' and obj.name = '$table'";
    }

    /**
     * Compile a create table command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileCreate(Blueprint $blueprint, Fluent $command)
    {
        $columns = implode(', ', $this->getColumns($blueprint));

        return 'create table '.$this->wrapTable($blueprint)." ($columns)";
    }

    /**
     * Compile a column addition table command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileAdd(Blueprint $blueprint, Fluent $command)
    {
        return sprintf('alter table %s add %s',
            $this->wrapTable($blueprint),
            implode(', ', $this->getColumns($blueprint))
        );
    }

    /**
     * Compile a primary key command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compilePrimary(Blueprint $blueprint, Fluent $command)
    {
        return sprintf('alter table %s add constraint %s primary key (%s)',
            $this->wrapTable($blueprint),
            $this->wrap($command->index),
            $this->columnize($command->columns)
        );
    }

    /**
     * Compile a unique key command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileUnique(Blueprint $blueprint, Fluent $command)
    {
        return sprintf('create unique index %s on %s (%s)',
            $this->wrap($command->index),
            $this->wrapTable($blueprint),
            $this->columnize($command->columns)
        );
    }

    /**
     * Compile a plain index key command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileIndex(Blueprint $blueprint, Fluent $command)
    {
        return sprintf('create index %s on %s (%s)',
            $this->wrap($command->index),
            $this->wrapTable($blueprint),
            $this->columnize($command->columns)
        );
    }

    /**
     * Compile a drop table command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileDrop(Blueprint $blueprint, Fluent $command)
    {
        return 'drop table '.$this->wrapTable($blueprint);
    }

    /**
     * Compile a drop table (if exists) command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileDropIfExists(Blueprint $blueprint, Fluent $command)
    {
        return sprintf('if exists (select * from INFORMATION_SCHEMA.TABLES where TABLE_NAME = %s) drop table %s',
            "'".str_replace("'", "''", $this->getTablePrefix().$blueprint->getTable())."'",
            $this->wrapTable($blueprint)
        );
    }

    /**
     * Compile the SQL needed to drop all tables.
     *
     * @return string
     */
    public function compileDropAllTables()
    {
        return "EXEC sp_msforeachtable 'DROP TABLE ?'";
    }

    /**
     * Compile a drop column command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileDropColumn(Blueprint $blueprint, Fluent $command)
    {
        $columns = $this->wrapArray($command->columns);

        return 'alter table '.$this->wrapTable($blueprint).' drop column '.implode(', ', $columns);
    }

    /**
     * Compile a drop primary key command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileDropPrimary(Blueprint $blueprint, Fluent $command)
    {
        $index = $this->wrap($command->index);

        return "alter table {$this->wrapTable($blueprint)} drop constraint {$index}";
    }

    /**
     * Compile a drop unique key command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileDropUnique(Blueprint $blueprint, Fluent $command)
    {
        $index = $this->wrap($command->index);

        return "drop index {$index} on {$this->wrapTable($blueprint)}";
    }

    /**
     * Compile a drop index command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileDropIndex(Blueprint $blueprint, Fluent $command)
    {
        $index = $this->wrap($command->index);

        return "drop index {$index} on {$this->wrapTable($blueprint)}";
    }

    /**
     * Compile a drop foreign key command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileDropForeign(Blueprint $blueprint, Fluent $command)
    {
        $index = $this->wrap($command->index);

        return "alter table {$this->wrapTable($blueprint)} drop constraint {$index}";
    }

    /**
     * Compile a rename table command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileRename(Blueprint $blueprint, Fluent $command)
    {
        $from = $this->wrapTable($blueprint);

        return "sp_rename {$from}, ".$this->wrapTable($command->to);
    }

    /**
     * Compile the command to enable foreign key constraints.
     *
     * @return string
     */
    public function compileEnableForeignKeyConstraints()
    {
        return 'EXEC sp_msforeachtable @command1="print \'?\'", @command2="ALTER TABLE ? WITH CHECK CHECK CONSTRAINT all";';
    }

    /**
     * Compile the command to disable foreign key constraints.
     *
     * @return string
     */
    public function compileDisableForeignKeyConstraints()
    {
        return 'EXEC sp_msforeachtable "ALTER TABLE ? NOCHECK CONSTRAINT all";';
    }

    /**
     * Create the column definition for a char type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeChar(Fluent $column)
    {
        return "nchar({$column->length})";
    }

    /**
     * Create the column definition for a string type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeString(Fluent $column)
    {
        return "nvarchar({$column->length})";
    }

    /**
     * Create the column definition for a text type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeText(Fluent $column)
    {
        return 'nvarchar(max)';
    }

    /**
     * Create the column definition for a medium text type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeMediumText(Fluent $column)
    {
        return 'nvarchar(max)';
    }

    /**
     * Create the column definition for a long text type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeLongText(Fluent $column)
    {
        return 'nvarchar(max)';
    }

    /**
     * Create the column definition for an integer type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeInteger(Fluent $column)
    {
        return 'int';
    }

    /**
     * Create the column definition for a big integer type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeBigInteger(Fluent $column)
    {
        return 'bigint';
    }

    /**
     * Create the column definition for a medium integer type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeMediumInteger(Fluent $column)
    {
        return 'int';
    }

    /**
     * Create the column definition for a tiny integer type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeTinyInteger(Fluent $column)
    {
        return 'tinyint';
    }

    /**
     * Create the column definition for a small integer type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeSmallInteger(Fluent $column)
    {
        return 'smallint';
    }

    /**
     * Create the column definition for a float type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeFloat(Fluent $column)
    {
        return 'float';
    }

    /**
     * Create the column definition for a double type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeDouble(Fluent $column)
    {
        return 'float';
    }

    /**
     * Create the column definition for a decimal type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeDecimal(Fluent $column)
    {
        return "decimal({$column->total}, {$column->places})";
    }

    /**
     * Create the column definition for a boolean type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeBoolean(Fluent $column)
    {
        return 'bit';
    }

    /**
     * Create the column definition for an enum type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeEnum(Fluent $column)
    {
        return 'nvarchar(255)';
    }

    /**
     * Create the column definition for a json type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeJson(Fluent $column)
    {
        return 'nvarchar(max)';
    }

    /**
     * Create the column definition for a jsonb type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeJsonb(Fluent $column)
    {
        return 'nvarchar(max)';
    }

    /**
     * Create the column definition for a date type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeDate(Fluent $column)
    {
        return 'date';
    }

    /**
     * Create the column definition for a date-time type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeDateTime(Fluent $column)
    {
        return $column->precision ? "datetime2($column->precision)" : 'datetime';
    }

    /**
     * Create the column definition for a date-time type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeDateTimeTz(Fluent $column)
    {
        return $column->precision ? "datetimeoffset($column->precision)" : 'datetimeoffset';
    }

    /**
     * Create the column definition for a time type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeTime(Fluent $column)
    {
        return 'time';
    }

    /**
     * Create the column definition for a time type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeTimeTz(Fluent $column)
    {
        return 'time';
    }

    /**
     * Create the column definition for a timestamp type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeTimestamp(Fluent $column)
    {
        if ($column->useCurrent) {
            return $column->precision
                    ? "datetime2($column->precision) default CURRENT_TIMESTAMP"
                    : 'datetime default CURRENT_TIMESTAMP';
        }

        return $column->precision ? "datetime2($column->precision)" : 'datetime';
    }

    /**
     * Create the column definition for a timestamp type.
     *
     * @link https://msdn.microsoft.com/en-us/library/bb630289(v=sql.120).aspx
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeTimestampTz(Fluent $column)
    {
        if ($column->useCurrent) {
            return $column->precision
                    ? "datetimeoffset($column->precision) default CURRENT_TIMESTAMP"
                    : 'datetimeoffset default CURRENT_TIMESTAMP';
        }

        return "datetimeoffset($column->precision)";
    }

    /**
     * Create the column definition for a binary type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeBinary(Fluent $column)
    {
        return 'varbinary(max)';
    }

    /**
     * Create the column definition for a uuid type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeUuid(Fluent $column)
    {
        return 'uniqueidentifier';
    }

    /**
     * Create the column definition for an IP address type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeIpAddress(Fluent $column)
    {
        return 'nvarchar(45)';
    }

    /**
     * Create the column definition for a MAC address type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeMacAddress(Fluent $column)
    {
        return 'nvarchar(17)';
    }

    /**
     * Get the SQL for a collation column modifier.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $column
     * @return string|null
     */
    protected function modifyCollate(Blueprint $blueprint, Fluent $column)
    {
        if (! is_null($column->collation)) {
            return ' collate '.$column->collation;
        }
    }

    /**
     * Get the SQL for a nullable column modifier.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $column
     * @return string|null
     */
    protected function modifyNullable(Blueprint $blueprint, Fluent $column)
    {
        return $column->nullable ? ' null' : ' not null';
    }

    /**
     * Get the SQL for a default column modifier.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $column
     * @return string|null
     */
    protected function modifyDefault(Blueprint $blueprint, Fluent $column)
    {
        if (! is_null($column->default)) {
            return ' default '.$this->getDefaultValue($column->default);
        }
    }

    /**
     * Get the SQL for an auto-increment column modifier.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $column
     * @return string|null
     */
    protected function modifyIncrement(Blueprint $blueprint, Fluent $column)
    {
        if (in_array($column->type, $this->serials) && $column->autoIncrement) {
            return ' identity primary key';
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prophecy\Promise;

use Doctrine\Instantiator\Instantiator;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Exception\InvalidArgumentException;
use ReflectionClass;

/**
 * Throw promise.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class ThrowPromise implements PromiseInterface
{
    private $exception;

    /**
     * @var \Doctrine\Instantiator\Instantiator
     */
    private $instantiator;

    /**
     * Initializes promise.
     *
     * @param string|\Exception|\Throwable $exception Exception class name or instance
     *
     * @throws \Prophecy\Exception\InvalidArgumentException
     */
    public function __construct($exception)
    {
        if (is_string($exception)) {
            if (!class_exists($exception) || !$this->isAValidThrowable($exception)) {
                throw new InvalidArgumentException(sprintf(
                    'Exception / Throwable class or instance expected as argument to ThrowPromise, but got %s.',
                    $exception
                ));
            }
        } elseif (!$exception instanceof \Exception && !$exception instanceof \Throwable) {
            throw new InvalidArgumentException(sprintf(
                'Exception / Throwable class or instance expected as argument to ThrowPromise, but got %s.',
                is_object($exception) ? get_class($exception) : gettype($exception)
            ));
        }

        $this->exception = $exception;
    }

    /**
     * Throws predefined exception.
     *
     * @param array          $args
     * @param ObjectProphecy $object
     * @param MethodProphecy $method
     *
     * @throws object
     */
    public function execute(array $args, ObjectProphecy $object, MethodProphecy $method)
    {
        if (is_string($this->exception)) {
            $classname   = $this->exception;
            $reflection  = new ReflectionClass($classname);
            $constructor = $reflection->getConstructor();

            if ($constructor->isPublic() && 0 == $constructor->getNumberOfRequiredParameters()) {
                throw $reflection->newInstance();
            }

            if (!$this->instantiator) {
                $this->instantiator = new Instantiator();
            }

            throw $this->instantiator->instantiate($classname);
        }

        throw $this->exception;
    }

    /**
     * @param string $exception
     *
     * @return bool
     */
    private function isAValidThrowable($exception)
    {
        return is_a($exception, 'Exception', true) || is_subclass_of($exception, 'Throwable', true);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Framework;

class TestListenerTest extends TestCase implements TestListener
{
    protected $endCount;
    protected $errorCount;
    protected $failureCount;
    protected $warningCount;
    protected $notImplementedCount;
    protected $riskyCount;
    protected $skippedCount;
    protected $result;
    protected $startCount;

    public function addError(Test $test, \Exception $e, $time)
    {
        $this->errorCount++;
    }

    public function addWarning(Test $test, Warning $e, $time)
    {
        $this->warningCount++;
    }

    public function addFailure(Test $test, AssertionFailedError $e, $time)
    {
        $this->failureCount++;
    }

    public function addIncompleteTest(Test $test, \Exception $e, $time)
    {
        $this->notImplementedCount++;
    }

    public function addRiskyTest(Test $test, \Exception $e, $time)
    {
        $this->riskyCount++;
    }

    public function addSkippedTest(Test $test, \Exception $e, $time)
    {
        $this->skippedCount++;
    }

    public function startTestSuite(TestSuite $suite)
    {
    }

    public function endTestSuite(TestSuite $suite)
    {
    }

    public function startTest(Test $test)
    {
        $this->startCount++;
    }

    public function endTest(Test $test, $time)
    {
        $this->endCount++;
    }

    protected function setUp()
    {
        $this->result = new TestResult;
        $this->result->addListener($this);

        $this->endCount            = 0;
        $this->failureCount        = 0;
        $this->notImplementedCount = 0;
        $this->riskyCount          = 0;
        $this->skippedCount        = 0;
        $this->startCount          = 0;
    }

    public function testError()
    {
        $test = new \TestError;
        $test->run($this->result);

        $this->assertEquals(1, $this->errorCount);
        $this->assertEquals(1, $this->endCount);
    }

    public function testFailure()
    {
        $test = new \Failure;
        $test->run($this->result);

        $this->assertEquals(1, $this->failureCount);
        $this->assertEquals(1, $this->endCount);
    }

    public function testStartStop()
    {
        $test = new \Success;
        $test->run($this->result);

        $this->assertEquals(1, $this->startCount);
        $this->assertEquals(1, $this->endCount);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          INDX( 	                 (   �  �      B . �t                 �+    x d     �+    A�b���d=��8A�b�A�b�       �               B u f f e r C o m m a n d . p h p     �+    x b     �+    %HA�b���d=��dA�b�$HA�b�                      C l e a r C o m m a n d . p h p       �+    h X     �+    �tA�b���d=���A�b��tA�b�        �               C o m m a n d . p h p �+    p ^     �+    �A�b���d=��A�b��A�b�       �               D o c C o m m a n d B p h p   �+    p `     �+    ��A�b���d=���A�b���A�b�       �               D u m p C o m m a n d . p h p �+    p `     �+    ��A�b���d=�oB�b���A�b�       G               E x i t C o m m a n d . p h p �+    p `     �+    �(B�b���d=�8EB�b��(B�b�       �
               H e l p C o m m a n d . p h p �+    x f     �+    �SB�b���d=�zrB�b��SB�b�        �               H i s t o r y C o m m a n d . p h p   ,    h X     �+    ZD�b�Ne�d=�D�F�bB 
ZD�b�                        L i s t C o m m a n d �+    p `     �+    S�B�b���d=�-�B�b�N�B�b� 0      �'               L i s t C o m m a n d . p h p �+    x b     �+    �B�b�Ne�d=��B�b��B�b�        ;               P a r s e C o m m a n d . p h p       �+    � l     �+    T�B�b�Ne�d=��B�b�R�B�b�       �               P s y V e r s i o n C o m m a n d . p h p     �+    � l     �+    $C�b�Ne�d=��1C�b�$C�b� 0      �"               R e f l e c B i n g C o m m a n d . p h p     �+    p `     �+    ?AC�b�Ne�d=�ecC�b�8AC�b� 0      �"               S h o w C o m m a n d . p h p �+    p `     �+    QrC�b�Ne�d=�ɏC�b�HrC�b�       �               S u d o C o m m a n d . p h p �+    x f     �+     �C�b�Ne�d=��C�b���C�b�       �               T h r o w U p C o m m a n d . p h p    ,    x b     �+    W�C�b�Ne�d=���C�b�R�C�b�        �               T r a c e C o m m a n d . p h p       ,    x h   B �+    +�C�b�Ne�d=��D�b�(�C�b�       �               W h e r e a m i C o m m a n d . p h p ,    p ^     �+    �'D�b�*ȶd=�;ED�b��'D�b�       <               W t f C o m m a n d . p h p                                                                                                                                                                                                                                                                                                       B                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               B                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               B                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               B {
    "name": "sebastian/object-reflector",
    "description": "Allows reflection of object attributes, including inherited and non-public ones",
    "homepage": "https://github.com/sebastianbergmann/object-reflector/",
    "license": "BSD-3-Clause",
    "authors": [
        {
            "name": "Sebastian Bergmann",
            "email": "sebastian@phpunit.de"
        }
    ],
    "require": {
        "php": "^7.0"
    },
    "require-dev": {
        "phpunit/phpunit": "^6.0"
    },
    "autoload": {
        "classmap": [
            "src/"
        ]
    },
    "autoload-dev": {
        "classmap": [
            "tests/_fixture/"
        ]
    },
    "extra": {
        "branch-alias": {
            "dev-master": "1.1-dev"
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 Console Component
=================

The Console component eases the creation of beautiful and testable command line
interfaces.

Resources
---------

  * [Documentation](https://symfony.com/doc/current/components/console/index.html)
  * [Contributing](https://symfony.com/doc/current/contributing/index.html)
  * [Report issues](https://github.com/symfony/symfony/issues) and
    [send Pull Requests](https://github.com/symfony/symfony/pulls)
    in the [main Symfony repository](https://github.com/symfony/symfony)

Credits
-------

`Resources/bin/hiddeninput.exe` is a third party binary provided within this
component. Find sources and license at https://github.com/Seldaek/hidden-input.
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher;

/**
 * A read-only proxy for an event dispatcher.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class ImmutableEventDispatcher implements EventDispatcherInterface
{
    /**
     * The proxied dispatcher.
     *
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * Creates an unmodifiable proxy for an event dispatcher.
     *
     * @param EventDispatcherInterface $dispatcher The proxied event dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch($eventName, Event $event = null)
    {
        return $this->dispatcher->dispatch($eventName, $event);
    }

    /**
     * {@inheritdoc}
     */
    public function addListener($eventName, $listener, $priority = 0)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
     * {@inheritdoc}
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
     * {@inheritdoc}
     */
    public function removeListener($eventName, $listener)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
     * {@inheritdoc}
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
     * {@inheritdoc}
     */
    public function getListeners($eventName = null)
    {
        return $this->dispatcher->getListeners($eventName);
    }

    /**
     * {@inheritdoc}
     */
    public function getListenerPriority($eventName, $listener)
    {
        return $this->dispatcher->getListenerPriority($eventName, $listener);
    }

    /**
     * {@inheritdoc}
     */
    public function hasListeners($eventName = null)
    {
        return $this->dispatcher->hasListeners($eventName);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Fragment;

use Symfony\Component\HttpKernel\Controller\ControllerReference;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\EventListener\FragmentListener;

/**
 * Adds the possibility to generate a fragment URI for a given Controller.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
abstract class RoutableFragmentRenderer implements FragmentRendererInterface
{
    private $fragmentPath = '/_fragment';

    /**
     * Sets the fragment path that triggers the fragment listener.
     *
     * @param string $path The path
     *
     * @see FragmentListener
     */
    public function setFragmentPath($path)
    {
        $this->fragmentPath = $path;
    }

    /**
     * Generates a fragment URI for a given controller.
     *
     * @param ControllerReference $reference A ControllerReference instance
     * @param Request             $request   A Request instance
     * @param bool                $absolute  Whether to generate an absolute URL or not
     * @param bool                $strict    Whether to allow non-scalar attributes or not
     *
     * @return string A fragment URI
     */
    protected function generateFragmentUri(ControllerReference $reference, Request $request, $absolute = false, $strict = true)
    {
        if ($strict) {
            $this->checkNonScalar($reference->attributes);
        }

        // We need to forward the current _format and _locale values as we don't have
        // a proper routing pattern to do the job for us.
        // This makes things inconsistent if you switch from rendering a controller
        // to rendering a route if the route pattern does not contain the special
        // _format and _locale placeholders.
        if (!isset($reference->attributes['_format'])) {
            $reference->attributes['_format'] = $request->getRequestFormat();
        }
        if (!isset($reference->attributes['_locale'])) {
            $reference->attributes['_locale'] = $request->getLocale();
        }

        $reference->attributes['_controller'] = $reference->controller;

        $reference->query['_path'] = http_build_query($reference->attributes, '', '&');

        $path = $this->fragmentPath.'?'.http_build_query($reference->query, '', '&');

        if ($absolute) {
            return $request->getUriForPath($path);
        }

        return $request->getBaseUrl().$path;
    }

    private function checkNonScalar($values)
    {
        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $this->checkNonScalar($value);
            } elseif (!is_scalar($value) && null !== $value) {
                throw new \LogicException(sprintf('Controller attributes cannot contain non-scalar/non-null values (value for key "%s" is not a scalar or null).', $key));
            }
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?xml version="1.0" encoding="UTF-8"?>

<!--

May-19-2004:
- Changed the <choice> for ElemType_header, moving minOccurs="0" maxOccurs="unbounded" from its elements 
to <choice> itself.
- Added <choice> for ElemType_trans-unit to allow "any order" for <context-group>, <count-group>, <prop-group>, <note>, and
<alt-trans>.

Oct-2005
- updated version info to 1.2
- equiv-trans attribute to <trans-unit> element 
- merged-trans attribute for <group> element
- Add the <seg-source> element as optional in the <trans-unit> and <alt-trans> content models, at the same level as <source> 
- Create a new value "seg" for the mtype attribute of the <mrk> element
- Add mid as an optional attribute for the <alt-trans> element

Nov-14-2005
- Changed name attribute for <context-group> from required to optional
- Added extension point at <xliff>

Jan-9-2006
- Added alttranstype type attribute to <alt-trans>, and values

Jan-10-2006
- Corrected error with overwritten purposeValueList
- Corrected name="AttrType_Version",  attribute should have been "name"

-->
<xsd:schema xmlns:xlf="urn:oasis:names:tc:xliff:document:1.2" xmlns:xsd="http://www.w3.org/2001/XMLSchema" elementFormDefault="qualified" targetNamespace="urn:oasis:names:tc:xliff:document:1.2" xml:lang="en">
  <!-- Import for xml:lang and xml:space -->
  <xsd:import namespace="http://www.w3.org/XML/1998/namespace" schemaLocation="http://www.w3.org/2001/xml.xsd"/>
  <!-- Attributes Lists -->
  <xsd:simpleType name="XTend">
    <xsd:restriction base="xsd:string">
      <xsd:pattern value="x-[^\s]+"/>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="context-typeValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'context-type'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="database">
        <xsd:annotation>
          <xsd:documentation>Indicates a database content.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="element">
        <xsd:annotation>
          <xsd:documentation>Indicates the content of an element within an XML document.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="elementtitle">
        <xsd:annotation>
          <xsd:documentation>Indicates the name of an element within an XML document.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="linenumber">
        <xsd:annotation>
          <xsd:documentation>Indicates the line number from the sourcefile (see context-type="sourcefile") where the &lt;source&gt; is found.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="numparams">
        <xsd:annotation>
          <xsd:documentation>Indicates a the number of parameters contained within the &lt;source&gt;.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="paramnotes">
        <xsd:annotation>
          <xsd:documentation>Indicates notes pertaining to the parameters in the &lt;source&gt;.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="record">
        <xsd:annotation>
          <xsd:documentation>Indicates the content of a record within a database.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="recordtitle">
        <xsd:annotation>
          <xsd:documentation>Indicates the name of a record within a database.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="sourcefile">
        <xsd:annotation>
          <xsd:documentation>Indicates the original source file in the case that multiple files are merged to form the original file from which the XLIFF file is created. This differs from the original &lt;file&gt; attribute in that this sourcefile is one of many that make up that file.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="count-typeValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'count-type'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="num-usages">
        <xsd:annotation>
          <xsd:documentation>Indicates the count units are items that are used X times in a certain context; example: this is a reusable text unit which is used 42 times in other texts.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="repetition">
        <xsd:annotation>
          <xsd:documentation>Indicates the count units are translation units existing already in the same document.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="total">
        <xsd:annotation>
          <xsd:documentation>Indicates a total count.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="InlineDelimitersValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'ctype' when used other elements than &lt;ph&gt; or &lt;x&gt;.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="bold">
        <xsd:annotation>
          <xsd:documentation>Indicates a run of bolded text.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="italic">
        <xsd:annotation>
          <xsd:documentation>Indicates a run of text in italics.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="underlined">
        <xsd:annotation>
          <xsd:documentation>Indicates a run of underlined text.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="link">
        <xsd:annotation>
          <xsd:documentation>Indicates a run of hyper-text.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="InlinePlaceholdersValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'ctype' when used with &lt;ph&gt; or &lt;x&gt;.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="image">
        <xsd:annotation>
          <xsd:documentation>Indicates a inline image.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="pb">
        <xsd:annotation>
          <xsd:documentation>Indicates a page break.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="lb">
        <xsd:annotation>
          <xsd:documentation>Indicates a line break.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="mime-typeValueList">
    <xsd:restriction base="xsd:string">
      <xsd:pattern value="(text|multipart|message|application|image|audio|video|model)(/.+)*"/>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="datatypeValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'datatype'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="asp">
        <xsd:annotation>
          <xsd:documentation>Indicates Active Server Page data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="c">
        <xsd:annotation>
          <xsd:documentation>Indicates C source file data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="cdf">
        <xsd:annotation>
          <xsd:documentation>Indicates Channel Definition Format (CDF) data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="cfm">
        <xsd:annotation>
          <xsd:documentation>Indicates ColdFusion data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="cpp">
        <xsd:annotation>
          <xsd:documentation>Indicates C++ source file data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="csharp">
        <xsd:annotation>
          <xsd:documentation>Indicates C-Sharp data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="cstring">
        <xsd:annotation>
          <xsd:documentation>Indicates strings from C, ASM, and driver files data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="csv">
        <xsd:annotation>
          <xsd:documentation>Indicates comma-separated values data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="database">
        <xsd:annotation>
          <xsd:documentation>Indicates database data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="documentfooter">
        <xsd:annotation>
          <xsd:documentation>Indicates portions of document that follows data and contains metadata.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="documentheader">
        <xsd:annotation>
          <xsd:documentation>Indicates portions of document that precedes data and contains metadata.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="filedialog">
        <xsd:annotation>
          <xsd:documentation>Indicates data from standard UI file operations dialogs (e.g., Open, Save, Save As, Export, Import).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="form">
        <xsd:annotation>
          <xsd:documentation>Indicates standard user input screen data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="html">
        <xsd:annotation>
          <xsd:documentation>Indicates HyperText Markup Language (HTML) data - document instance.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="htmlbody">
        <xsd:annotation>
          <xsd:documentation>Indicates content within an HTML document’s &lt;body&gt; element.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="ini">
        <xsd:annotation>
          <xsd:documentation>Indicates Windows INI file data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="interleaf">
        <xsd:annotation>
          <xsd:documentation>Indicates Interleaf data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="javaclass">
        <xsd:annotation>
          <xsd:documentation>Indicates Java source file data (extension '.java').</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="javapropertyresourcebundle">
        <xsd:annotation>
          <xsd:documentation>Indicates Java property resource bundle data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="javalistresourcebundle">
        <xsd:annotation>
          <xsd:documentation>Indicates Java list resource bundle data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="javascript">
        <xsd:annotation>
          <xsd:documentation>Indicates JavaScript source file data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="jscript">
        <xsd:annotation>
          <xsd:documentation>Indicates JScript source file data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="layout">
        <xsd:annotation>
          <xsd:documentation>Indicates information relating to formatting.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="lisp">
        <xsd:annotation>
          <xsd:documentation>Indicates LISP source file data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="margin">
        <xsd:annotation>
          <xsd:documentation>Indicates information relating to margin formats.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="menufile">
        <xsd:annotation>
          <xsd:documentation>Indicates a file containing menu.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="messagefile">
        <xsd:annotation>
          <xsd:documentation>Indicates numerically identified string table.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="mif">
        <xsd:annotation>
          <xsd:documentation>Indicates Maker Interchange Format (MIF) data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="mimetype">
        <xsd:annotation>
          <xsd:documentation>Indicates that the datatype attribute value is a MIME Type value and is defined in the mime-type attribute.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="mo">
        <xsd:annotation>
          <xsd:documentation>Indicates GNU Machine Object data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="msglib">
        <xsd:annotation>
          <xsd:documentation>Indicates Message Librarian strings created by Novell's Message Librarian Tool.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="pagefooter">
        <xsd:annotation>
          <xsd:documentation>Indicates information to be displayed at the bottom of each page of a document.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="pageheader">
        <xsd:annotation>
          <xsd:documentation>Indicates information to be displayed at the top of each page of a document.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="parameters">
        <xsd:annotation>
          <xsd:documentation>Indicates a list of property values (e.g., settings within INI files or preferences dialog).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="pascal">
        <xsd:annotation>
          <xsd:documentation>Indicates Pascal source file data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="php">
        <xsd:annotation>
          <xsd:documentation>Indicates Hypertext Preprocessor data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="plaintext">
        <xsd:annotation>
          <xsd:documentation>Indicates plain text file (no formatting other than, possibly, wrapping).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="po">
        <xsd:annotation>
          <xsd:documentation>Indicates GNU Portable Object file.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="report">
        <xsd:annotation>
          <xsd:documentation>Indicates dynamically generated user defined document. e.g. Oracle Report, Crystal Report, etc.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="resources">
        <xsd:annotation>
          <xsd:documentation>Indicates Windows .NET binary resources.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="resx">
        <xsd:annotation>
          <xsd:documentation>Indicates Windows .NET Resources.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="rtf">
        <xsd:annotation>
          <xsd:documentation>Indicates Rich Text Format (RTF) data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="sgml">
        <xsd:annotation>
          <xsd:documentation>Indicates Standard Generalized Markup Language (SGML) data - document instance.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="sgmldtd">
        <xsd:annotation>
          <xsd:documentation>Indicates Standard Generalized Markup Language (SGML) data - Document Type Definition (DTD).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="svg">
        <xsd:annotation>
          <xsd:documentation>Indicates Scalable Vector Graphic (SVG) data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="vbscript">
        <xsd:annotation>
          <xsd:documentation>Indicates VisualBasic Script source file.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="warning">
        <xsd:annotation>
          <xsd:documentation>Indicates warning message.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="winres">
        <xsd:annotation>
          <xsd:documentation>Indicates Windows (Win32) resources (i.e. resources extracted from an RC script, a message file, or a compiled file).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="xhtml">
        <xsd:annotation>
          <xsd:documentation>Indicates Extensible HyperText Markup Language (XHTML) data - document instance.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="xml">
        <xsd:annotation>
          <xsd:documentation>Indicates Extensible Markup Language (XML) data - document instance.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="xmldtd">
        <xsd:annotation>
          <xsd:documentation>Indicates Extensible Markup Language (XML) data - Document Type Definition (DTD).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="xsl">
        <xsd:annotation>
          <xsd:documentation>Indicates Extensible Stylesheet Language (XSL) data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="xul">
        <xsd:annotation>
          <xsd:documentation>Indicates XUL elements.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="mtypeValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'mtype'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="abbrev">
        <xsd:annotation>
          <xsd:documentation>Indicates the marked text is an abbreviation.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="abbreviated-form">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.8: A term resulting from the omission of any part of the full term while designating the same concept.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="abbreviation">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.8.1: An abbreviated form of a simple term resulting from the omission of some of its letters (e.g. 'adj.' for 'adjective').</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="acronym">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.8.4: An abbreviated form of a term made up of letters from the full form of a multiword term strung together into a sequence pronounced only syllabically (e.g. 'radar' for 'radio detecting and ranging').</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="appellation">
        <xsd:annotation>
          <xsd:documentation>ISO-12620: A proper-name term, such as the name of an agency or other proper entity.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="collocation">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.18.1: A recurrent word combination characterized by cohesion in that the components of the collocation must co-occur within an utterance or series of utterances, even though they do not necessarily have to maintain immediate proximity to one another.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="common-name">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.5: A synonym for an international scientific term that is used in general discourse in a given language.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="datetime">
        <xsd:annotation>
          <xsd:documentation>Indicates the marked text is a date and/or time.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="equation">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.15: An expression used to represent a concept based on a statement that two mathematical expressions are, for instance, equal as identified by the equal sign (=), or assigned to one another by a similar sign.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="expanded-form">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.7: The complete representation of a term for which there is an abbreviated form.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="formula">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.14: Figures, symbols or the like used to express a concept briefly, such as a mathematical or chemical formula.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="head-term">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.1: The concept designation that has been chosen to head a terminological record.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="initialism">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.8.3: An abbreviated form of a term consisting of some of the initial letters of the words making up a multiword term or the term elements making up a compound term when these letters are pronounced individually (e.g. 'BSE' for 'bovine spongiform encephalopathy').</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="international-scientific-term">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.4: A term that is part of an international scientific nomenclature as adopted by an appropriate scientific body.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="internationalism">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.6: A term that has the same or nearly identical orthographic or phonemic form in many languages.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="logical-expression">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.16: An expression used to represent a concept based on mathematical or logical relations, such as statements of inequality, set relationships, Boolean operations, and the like.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="materials-management-unit">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.17: A unit to track object.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="name">
        <xsd:annotation>
          <xsd:documentation>Indicates the marked text is a name.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="near-synonym">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.3: A term that represents the same or a very similar concept as another term in the same language, but for which interchangeability is limited to some contexts and inapplicable in others.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="part-number">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.17.2: A unique alphanumeric designation assigned to an object in a manufacturing system.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="phrase">
        <xsd:annotation>
          <xsd:documentation>Indicates the marked text is a phrase.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="phraseological-unit">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.18: Any group of two or more words that form a unit, the meaning of which frequently cannot be deduced based on the combined sense of the words making up the phrase.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="protected">
        <xsd:annotation>
          <xsd:documentation>Indicates the marked text should not be translated.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="romanized-form">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.12: A form of a term resulting from an operation whereby non-Latin writing systems are converted to the Latin alphabet.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="seg">
        <xsd:annotation>
          <xsd:documentation>Indicates that the marked text represents a segment.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="set-phrase">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.18.2: A fixed, lexicalized phrase.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="short-form">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.8.2: A variant of a multiword term that includes fewer words than the full form of the term (e.g. 'Group of Twenty-four' for 'Intergovernmental Group of Twenty-four on International Monetary Affairs').</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="sku">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.17.1: Stock keeping unit, an inventory item identified by a unique alphanumeric designation assigned to an object in an inventory control system.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="standard-text">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.19: A fixed chunk of recurring text.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="symbol">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.13: A designation of a concept by letters, numerals, pictograms or any combination thereof.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="synonym">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.2: Any term that represents the same or a very similar concept as the main entry term in a term entry.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="synonymous-phrase">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.18.3: Phraseological unit in a language that expresses the same semantic content as another phrase in that same language.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="term">
        <xsd:annotation>
          <xsd:documentation>Indicates the marked text is a term.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="transcribed-form">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.11: A form of a term resulting from an operation whereby the characters of one writing system are represented by characters from another writing system, taking into account the pronunciation of the characters converted.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="transliterated-form">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.10: A form of a term resulting from an operation whereby the characters of an alphabetic writing system are represented by characters from another alphabetic writing system.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="truncated-term">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.8.5: An abbreviated form of a term resulting from the omission of one or more term elements or syllables (e.g. 'flu' for 'influenza').</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="variant">
        <xsd:annotation>
          <xsd:documentation>ISO-12620 2.1.9: One of the alternate forms of a term.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="restypeValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'restype'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="auto3state">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC AUTO3STATE control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="autocheckbox">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC AUTOCHECKBOX control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="autoradiobutton">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC AUTORADIOBUTTON control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="bedit">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC BEDIT control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="bitmap">
        <xsd:annotation>
          <xsd:documentation>Indicates a bitmap, for example a BITMAP resource in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="button">
        <xsd:annotation>
          <xsd:documentation>Indicates a button object, for example a BUTTON control Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="caption">
        <xsd:annotation>
          <xsd:documentation>Indicates a caption, such as the caption of a dialog box.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="cell">
        <xsd:annotation>
          <xsd:documentation>Indicates the cell in a table, for example the content of the &lt;td&gt; element in HTML.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="checkbox">
        <xsd:annotation>
          <xsd:documentation>Indicates check box object, for example a CHECKBOX control in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="checkboxmenuitem">
        <xsd:annotation>
          <xsd:documentation>Indicates a menu item with an associated checkbox.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="checkedlistbox">
        <xsd:annotation>
          <xsd:documentation>Indicates a list box, but with a check-box for each item.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="colorchooser">
        <xsd:annotation>
          <xsd:documentation>Indicates a color selection dialog.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="combobox">
        <xsd:annotation>
          <xsd:documentation>Indicates a combination of edit box and listbox object, for example a COMBOBOX control in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="comboboxexitem">
        <xsd:annotation>
          <xsd:documentation>Indicates an initialization entry of an extended combobox DLGINIT resource block. (code 0x1234).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="comboboxitem">
        <xsd:annotation>
          <xsd:documentation>Indicates an initialization entry of a combobox DLGINIT resource block (code 0x0403).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="component">
        <xsd:annotation>
          <xsd:documentation>Indicates a UI base class element that cannot be represented by any other element.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="contextmenu">
        <xsd:annotation>
          <xsd:documentation>Indicates a context menu.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="ctext">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC CTEXT control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="cursor">
        <xsd:annotation>
          <xsd:documentation>Indicates a cursor, for example a CURSOR resource in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="datetimepicker">
        <xsd:annotation>
          <xsd:documentation>Indicates a date/time picker.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="defpushbutton">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC DEFPUSHBUTTON control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="dialog">
        <xsd:annotation>
          <xsd:documentation>Indicates a dialog box.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="dlginit">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC DLGINIT resource block.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="edit">
        <xsd:annotation>
          <xsd:documentation>Indicates an edit box object, for example an EDIT control in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="file">
        <xsd:annotation>
          <xsd:documentation>Indicates a filename.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="filechooser">
        <xsd:annotation>
          <xsd:documentation>Indicates a file dialog.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="fn">
        <xsd:annotation>
          <xsd:documentation>Indicates a footnote.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="font">
        <xsd:annotation>
          <xsd:documentation>Indicates a font name.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="footer">
        <xsd:annotation>
          <xsd:documentation>Indicates a footer.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="frame">
        <xsd:annotation>
          <xsd:documentation>Indicates a frame object.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="grid">
        <xsd:annotation>
          <xsd:documentation>Indicates a XUL grid element.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="groupbox">
        <xsd:annotation>
          <xsd:documentation>Indicates a groupbox object, for example a GROUPBOX control in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="header">
        <xsd:annotation>
          <xsd:documentation>Indicates a header item.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="heading">
        <xsd:annotation>
          <xsd:documentation>Indicates a heading, such has the content of &lt;h1&gt;, &lt;h2&gt;, etc. in HTML.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="hedit">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC HEDIT control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="hscrollbar">
        <xsd:annotation>
          <xsd:documentation>Indicates a horizontal scrollbar.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="icon">
        <xsd:annotation>
          <xsd:documentation>Indicates an icon, for example an ICON resource in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="iedit">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC IEDIT control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="keywords">
        <xsd:annotation>
          <xsd:documentation>Indicates keyword list, such as the content of the Keywords meta-data in HTML, or a K footnote in WinHelp RTF.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="label">
        <xsd:annotation>
          <xsd:documentation>Indicates a label object.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="linklabel">
        <xsd:annotation>
          <xsd:documentation>Indicates a label that is also a HTML link (not necessarily a URL).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="list">
        <xsd:annotation>
          <xsd:documentation>Indicates a list (a group of list-items, for example an &lt;ol&gt; or &lt;ul&gt; element in HTML).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="listbox">
        <xsd:annotation>
          <xsd:documentation>Indicates a listbox object, for example an LISTBOX control in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="listitem">
        <xsd:annotation>
          <xsd:documentation>Indicates an list item (an entry in a list).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="ltext">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC LTEXT control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="menu">
        <xsd:annotation>
          <xsd:documentation>Indicates a menu (a group of menu-items).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="menubar">
        <xsd:annotation>
          <xsd:documentation>Indicates a toolbar containing one or more tope level menus.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="menuitem">
        <xsd:annotation>
          <xsd:documentation>Indicates a menu item (an entry in a menu).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="menuseparator">
        <xsd:annotation>
          <xsd:documentation>Indicates a XUL menuseparator element.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="message">
        <xsd:annotation>
          <xsd:documentation>Indicates a message, for example an entry in a MESSAGETABLE resource in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="monthcalendar">
        <xsd:annotation>
          <xsd:documentation>Indicates a calendar control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="numericupdown">
        <xsd:annotation>
          <xsd:documentation>Indicates an edit box beside a spin control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="panel">
        <xsd:annotation>
          <xsd:documentation>Indicates a catch all for rectangular areas.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="popupmenu">
        <xsd:annotation>
          <xsd:documentation>Indicates a standalone menu not necessarily associated with a menubar.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="pushbox">
        <xsd:annotation>
          <xsd:documentation>Indicates a pushbox object, for example a PUSHBOX control in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="pushbutton">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC PUSHBUTTON control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="radio">
        <xsd:annotation>
          <xsd:documentation>Indicates a radio button object.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="radiobuttonmenuitem">
        <xsd:annotation>
          <xsd:documentation>Indicates a menuitem with associated radio button.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="rcdata">
        <xsd:annotation>
          <xsd:documentation>Indicates raw data resources for an application.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="row">
        <xsd:annotation>
          <xsd:documentation>Indicates a row in a table.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="rtext">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC RTEXT control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="scrollpane">
        <xsd:annotation>
          <xsd:documentation>Indicates a user navigable container used to show a portion of a document.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="separator">
        <xsd:annotation>
          <xsd:documentation>Indicates a generic divider object (e.g. menu group separator).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="shortcut">
        <xsd:annotation>
          <xsd:documentation>Windows accelerators, shortcuts in resource or property files.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="spinner">
        <xsd:annotation>
          <xsd:documentation>Indicates a UI control to indicate process activity but not progress.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="splitter">
        <xsd:annotation>
          <xsd:documentation>Indicates a splitter bar.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="state3">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC STATE3 control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="statusbar">
        <xsd:annotation>
          <xsd:documentation>Indicates a window for providing feedback to the users, like 'read-only', etc.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="string">
        <xsd:annotation>
          <xsd:documentation>Indicates a string, for example an entry in a STRINGTABLE resource in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="tabcontrol">
        <xsd:annotation>
          <xsd:documentation>Indicates a layers of controls with a tab to select layers.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="table">
        <xsd:annotation>
          <xsd:documentation>Indicates a display and edits regular two-dimensional tables of cells.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="textbox">
        <xsd:annotation>
          <xsd:documentation>Indicates a XUL textbox element.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="togglebutton">
        <xsd:annotation>
          <xsd:documentation>Indicates a UI button that can be toggled to on or off state.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="toolbar">
        <xsd:annotation>
          <xsd:documentation>Indicates an array of controls, usually buttons.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="tooltip">
        <xsd:annotation>
          <xsd:documentation>Indicates a pop up tool tip text.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="trackbar">
        <xsd:annotation>
          <xsd:documentation>Indicates a bar with a pointer indicating a position within a certain range.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="tree">
        <xsd:annotation>
          <xsd:documentation>Indicates a control that displays a set of hierarchical data.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="uri">
        <xsd:annotation>
          <xsd:documentation>Indicates a URI (URN or URL).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="userbutton">
        <xsd:annotation>
          <xsd:documentation>Indicates a Windows RC USERBUTTON control.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="usercontrol">
        <xsd:annotation>
          <xsd:documentation>Indicates a user-defined control like CONTROL control in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="var">
        <xsd:annotation>
          <xsd:documentation>Indicates the text of a variable.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="versioninfo">
        <xsd:annotation>
          <xsd:documentation>Indicates version information about a resource like VERSIONINFO in Windows.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="vscrollbar">
        <xsd:annotation>
          <xsd:documentation>Indicates a vertical scrollbar.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="window">
        <xsd:annotation>
          <xsd:documentation>Indicates a graphical window.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="size-unitValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'size-unit'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="byte">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in 8-bit bytes.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="char">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in Unicode characters.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="col">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in columns. Used for HTML text area.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="cm">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in centimeters.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="dlgunit">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in dialog units, as defined in Windows resources.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="em">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in 'font-size' units (as defined in CSS).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="ex">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in 'x-height' units (as defined in CSS).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="glyph">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in glyphs. A glyph is considered to be one or more combined Unicode characters that represent a single displayable text character. Sometimes referred to as a 'grapheme cluster'</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="in">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in inches.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="mm">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in millimeters.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="percent">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in percentage.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="pixel">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in pixels.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="point">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in point.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="row">
        <xsd:annotation>
          <xsd:documentation>Indicates a size in rows. Used for HTML text area.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="stateValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'state'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="final">
        <xsd:annotation>
          <xsd:documentation>Indicates the terminating state.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="needs-adaptation">
        <xsd:annotation>
          <xsd:documentation>Indicates only non-textual information needs adaptation.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="needs-l10n">
        <xsd:annotation>
          <xsd:documentation>Indicates both text and non-textual information needs adaptation.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="needs-review-adaptation">
        <xsd:annotation>
          <xsd:documentation>Indicates only non-textual information needs review.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="needs-review-l10n">
        <xsd:annotation>
          <xsd:documentation>Indicates both text and non-textual information needs review.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="needs-review-translation">
        <xsd:annotation>
          <xsd:documentation>Indicates that only the text of the item needs to be reviewed.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="needs-translation">
        <xsd:annotation>
          <xsd:documentation>Indicates that the item needs to be translated.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="new">
        <xsd:annotation>
          <xsd:documentation>Indicates that the item is new. For example, translation units that were not in a previous version of the document.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="signed-off">
        <xsd:annotation>
          <xsd:documentation>Indicates that changes are reviewed and approved.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="translated">
        <xsd:annotation>
          <xsd:documentation>Indicates that the item has been translated.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="state-qualifierValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'state-qualifier'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="exact-match">
        <xsd:annotation>
          <xsd:documentation>Indicates an exact match. An exact match occurs when a source text of a segment is exactly the same as the source text of a segment that was translated previously.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="fuzzy-match">
        <xsd:annotation>
          <xsd:documentation>Indicates a fuzzy match. A fuzzy match occurs when a source text of a segment is very similar to the source text of a segment that was translated previously (e.g. when the difference is casing, a few changed words, white-space discripancy, etc.).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="id-match">
        <xsd:annotation>
          <xsd:documentation>Indicates a match based on matching IDs (in addition to matching text).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="leveraged-glossary">
        <xsd:annotation>
          <xsd:documentation>Indicates a translation derived from a glossary.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="leveraged-inherited">
        <xsd:annotation>
          <xsd:documentation>Indicates a translation derived from existing translation.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="leveraged-mt">
        <xsd:annotation>
          <xsd:documentation>Indicates a translation derived from machine translation.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="leveraged-repository">
        <xsd:annotation>
          <xsd:documentation>Indicates a translation derived from a translation repository.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="leveraged-tm">
        <xsd:annotation>
          <xsd:documentation>Indicates a translation derived from a translation memory.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="mt-suggestion">
        <xsd:annotation>
          <xsd:documentation>Indicates the translation is suggested by machine translation.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="rejected-grammar">
        <xsd:annotation>
          <xsd:documentation>Indicates that the item has been rejected because of incorrect grammar.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="rejected-inaccurate">
        <xsd:annotation>
          <xsd:documentation>Indicates that the item has been rejected because it is incorrect.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="rejected-length">
        <xsd:annotation>
          <xsd:documentation>Indicates that the item has been rejected because it is too long or too short.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="rejected-spelling">
        <xsd:annotation>
          <xsd:documentation>Indicates that the item has been rejected because of incorrect spelling.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="tm-suggestion">
        <xsd:annotation>
          <xsd:documentation>Indicates the translation is suggested by translation memory.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="unitValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'unit'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="word">
        <xsd:annotation>
          <xsd:documentation>Refers to words.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="page">
        <xsd:annotation>
          <xsd:documentation>Refers to pages.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="trans-unit">
        <xsd:annotation>
          <xsd:documentation>Refers to &lt;trans-unit&gt; elements.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="bin-unit">
        <xsd:annotation>
          <xsd:documentation>Refers to &lt;bin-unit&gt; elements.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="glyph">
        <xsd:annotation>
          <xsd:documentation>Refers to glyphs.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="item">
        <xsd:annotation>
          <xsd:documentation>Refers to &lt;trans-unit&gt; and/or &lt;bin-unit&gt; elements.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="instance">
        <xsd:annotation>
          <xsd:documentation>Refers to the occurrences of instances defined by the count-type value.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="character">
        <xsd:annotation>
          <xsd:documentation>Refers to characters.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="line">
        <xsd:annotation>
          <xsd:documentation>Refers to lines.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="sentence">
        <xsd:annotation>
          <xsd:documentation>Refers to sentences.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="paragraph">
        <xsd:annotation>
          <xsd:documentation>Refers to paragraphs.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="segment">
        <xsd:annotation>
          <xsd:documentation>Refers to segments.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="placeable">
        <xsd:annotation>
          <xsd:documentation>Refers to placeables (inline elements).</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="priorityValueList">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'priority'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:positiveInteger">
      <xsd:enumeration value="1">
        <xsd:annotation>
          <xsd:documentation>Highest priority.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="2">
        <xsd:annotation>
          <xsd:documentation>High priority.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="3">
        <xsd:annotation>
          <xsd:documentation>High priority, but not as important as 2.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="4">
        <xsd:annotation>
          <xsd:documentation>High priority, but not as important as 3.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="5">
        <xsd:annotation>
          <xsd:documentation>Medium priority, but more important than 6.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="6">
        <xsd:annotation>
          <xsd:documentation>Medium priority, but less important than 5.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="7">
        <xsd:annotation>
          <xsd:documentation>Low priority, but more important than 8.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="8">
        <xsd:annotation>
          <xsd:documentation>Low priority, but more important than 9.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="9">
        <xsd:annotation>
          <xsd:documentation>Low priority.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="10">
        <xsd:annotation>
          <xsd:documentation>Lowest priority.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="reformatValueYesNo">
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="yes">
        <xsd:annotation>
          <xsd:documentation>This value indicates that all properties can be reformatted. This value must be used alone.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="no">
        <xsd:annotation>
          <xsd:documentation>This value indicates that no properties should be reformatted. This value must be used alone.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="reformatValueList">
    <xsd:list>
      <xsd:simpleType>
        <xsd:union memberTypes="xlf:XTend">
          <xsd:simpleType>
            <xsd:restriction base="xsd:string">
              <xsd:enumeration value="coord">
                <xsd:annotation>
                  <xsd:documentation>This value indicates that all information in the coord attribute can be modified.</xsd:documentation>
                </xsd:annotation>
              </xsd:enumeration>
              <xsd:enumeration value="coord-x">
                <xsd:annotation>
                  <xsd:documentation>This value indicates that the x information in the coord attribute can be modified.</xsd:documentation>
                </xsd:annotation>
              </xsd:enumeration>
              <xsd:enumeration value="coord-y">
                <xsd:annotation>
                  <xsd:documentation>This value indicates that the y information in the coord attribute can be modified.</xsd:documentation>
                </xsd:annotation>
              </xsd:enumeration>
              <xsd:enumeration value="coord-cx">
                <xsd:annotation>
                  <xsd:documentation>This value indicates that the cx information in the coord attribute can be modified.</xsd:documentation>
                </xsd:annotation>
              </xsd:enumeration>
              <xsd:enumeration value="coord-cy">
                <xsd:annotation>
                  <xsd:documentation>This value indicates that the cy information in the coord attribute can be modified.</xsd:documentation>
                </xsd:annotation>
              </xsd:enumeration>
              <xsd:enumeration value="font">
                <xsd:annotation>
                  <xsd:documentation>This value indicates that all the information in the font attribute can be modified.</xsd:documentation>
                </xsd:annotation>
              </xsd:enumeration>
              <xsd:enumeration value="font-name">
                <xsd:annotation>
                  <xsd:documentation>This value indicates that the name information in the font attribute can be modified.</xsd:documentation>
                </xsd:annotation>
              </xsd:enumeration>
              <xsd:enumeration value="font-size">
                <xsd:annotation>
                  <xsd:documentation>This value indicates that the size information in the font attribute can be modified.</xsd:documentation>
                </xsd:annotation>
              </xsd:enumeration>
              <xsd:enumeration value="font-weight">
                <xsd:annotation>
                  <xsd:documentation>This value indicates that the weight information in the font attribute can be modified.</xsd:documentation>
                </xsd:annotation>
              </xsd:enumeration>
              <xsd:enumeration value="css-style">
                <xsd:annotation>
                  <xsd:documentation>This value indicates that the information in the css-style attribute can be modified.</xsd:documentation>
                </xsd:annotation>
              </xsd:enumeration>
              <xsd:enumeration value="style">
                <xsd:annotation>
                  <xsd:documentation>This value indicates that the information in the style attribute can be modified.</xsd:documentation>
                </xsd:annotation>
              </xsd:enumeration>
              <xsd:enumeration value="ex-style">
                <xsd:annotation>
                  <xsd:documentation>This value indicates that the information in the exstyle attribute can be modified.</xsd:documentation>
                </xsd:annotation>
              </xsd:enumeration>
            </xsd:restriction>
          </xsd:simpleType>
        </xsd:union>
      </xsd:simpleType>
    </xsd:list>
  </xsd:simpleType>
  <xsd:simpleType name="purposeValueList">
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="information">
        <xsd:annotation>
          <xsd:documentation>Indicates that the context is informational in nature, specifying for example, how a term should be translated. Thus, should be displayed to anyone editing the XLIFF document.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="location">
        <xsd:annotation>
          <xsd:documentation>Indicates that the context-group is used to specify where the term was found in the translatable source. Thus, it is not displayed.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="match">
        <xsd:annotation>
          <xsd:documentation>Indicates that the context information should be used during translation memory lookups. Thus, it is not displayed.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="alttranstypeValueList">
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="proposal">
        <xsd:annotation>
          <xsd:documentation>Represents a translation proposal from a translation memory or other resource.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="previous-version">
        <xsd:annotation>
          <xsd:documentation>Represents a previous version of the target element.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="rejected">
        <xsd:annotation>
          <xsd:documentation>Represents a rejected version of the target element.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="reference">
        <xsd:annotation>
          <xsd:documentation>Represents a translation to be used for reference purposes only, for example from a related product or a different language.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
      <xsd:enumeration value="accepted">
        <xsd:annotation>
          <xsd:documentation>Represents a proposed translation that was used for the translation of the trans-unit, possibly modified.</xsd:documentation>
        </xsd:annotation>
      </xsd:enumeration>
    </xsd:restriction>
  </xsd:simpleType>
  <!-- Other Types -->
  <xsd:complexType name="ElemType_ExternalReference">
    <xsd:choice>
      <xsd:element ref="xlf:internal-file"/>
      <xsd:element ref="xlf:external-file"/>
    </xsd:choice>
  </xsd:complexType>
  <xsd:simpleType name="AttrType_purpose">
    <xsd:list>
      <xsd:simpleType>
        <xsd:union memberTypes="xlf:purposeValueList xlf:XTend"/>
      </xsd:simpleType>
    </xsd:list>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_datatype">
    <xsd:union memberTypes="xlf:datatypeValueList xlf:XTend"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_restype">
    <xsd:union memberTypes="xlf:restypeValueList xlf:XTend"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_alttranstype">
    <xsd:union memberTypes="xlf:alttranstypeValueList xlf:XTend"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_context-type">
    <xsd:union memberTypes="xlf:context-typeValueList xlf:XTend"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_state">
    <xsd:union memberTypes="xlf:stateValueList xlf:XTend"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_state-qualifier">
    <xsd:union memberTypes="xlf:state-qualifierValueList xlf:XTend"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_count-type">
    <xsd:union memberTypes="xlf:restypeValueList xlf:count-typeValueList xlf:datatypeValueList xlf:stateValueList xlf:state-qualifierValueList xlf:XTend"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_InlineDelimiters">
    <xsd:union memberTypes="xlf:InlineDelimitersValueList xlf:XTend"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_InlinePlaceholders">
    <xsd:union memberTypes="xlf:InlinePlaceholdersValueList xlf:XTend"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_size-unit">
    <xsd:union memberTypes="xlf:size-unitValueList xlf:XTend"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_mtype">
    <xsd:union memberTypes="xlf:mtypeValueList xlf:XTend"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_unit">
    <xsd:union memberTypes="xlf:unitValueList xlf:XTend"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_priority">
    <xsd:union memberTypes="xlf:priorityValueList"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_reformat">
    <xsd:union memberTypes="xlf:reformatValueYesNo xlf:reformatValueList"/>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_YesNo">
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="yes"/>
      <xsd:enumeration value="no"/>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_Position">
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="open"/>
      <xsd:enumeration value="close"/>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_assoc">
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="preceding"/>
      <xsd:enumeration value="following"/>
      <xsd:enumeration value="both"/>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_annotates">
    <xsd:restriction base="xsd:NMTOKEN">
      <xsd:enumeration value="source"/>
      <xsd:enumeration value="target"/>
      <xsd:enumeration value="general"/>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_Coordinates">
    <xsd:annotation>
      <xsd:documentation>Values for the attribute 'coord'.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:string">
      <xsd:pattern value="(-?\d+|#);(-?\d+|#);(-?\d+|#);(-?\d+|#)"/>
    </xsd:restriction>
  </xsd:simpleType>
  <xsd:simpleType name="AttrType_Version">
    <xsd:annotation>
      <xsd:documentation>Version values: 1.0 and 1.1 are allowed for backward compatibility.</xsd:documentation>
    </xsd:annotation>
    <xsd:restriction base="xsd:string">
      <xsd:enumeration value="1.2"/>
      <xsd:enumeration value="1.1"/>
      <xsd:enumeration value="1.0"/>
    </xsd:restriction>
  </xsd:simpleType>
  <!-- Groups -->
  <xsd:group name="ElemGroup_TextContent">
    <xsd:choice>
      <xsd:element ref="xlf:g"/>
      <xsd:element ref="xlf:bpt"/>
      <xsd:element ref="xlf:ept"/>
      <xsd:element ref="xlf:ph"/>
      <xsd:element ref="xlf:it"/>
      <xsd:element ref="xlf:mrk"/>
      <xsd:element ref="xlf:x"/>
      <xsd:element ref="xlf:bx"/>
      <xsd:element ref="xlf:ex"/>
    </xsd:choice>
  </xsd:group>
  <xsd:attributeGroup name="AttrGroup_TextContent">
    <xsd:attribute name="id" type="xsd:string" use="required"/>
    <xsd:attribute name="xid" type="xsd:string" use="optional"/>
    <xsd:attribute name="equiv-text" type="xsd:string" use="optional"/>
    <xsd:anyAttribute namespace="##other" processContents="strict"/>
  </xsd:attributeGroup>
  <!-- XLIFF Structure -->
  <xsd:element name="xliff">
    <xsd:complexType>
      <xsd:sequence maxOccurs="unbounded">
        <xsd:any maxOccurs="unbounded" minOccurs="0" namespace="##other" processContents="strict"/>
        <xsd:element ref="xlf:file"/>
      </xsd:sequence>
      <xsd:attribute name="version" type="xlf:AttrType_Version" use="required"/>
      <xsd:attribute ref="xml:lang" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="file">
    <xsd:complexType>
      <xsd:sequence>
        <xsd:element minOccurs="0" ref="xlf:header"/>
        <xsd:element ref="xlf:body"/>
      </xsd:sequence>
      <xsd:attribute name="original" type="xsd:string" use="required"/>
      <xsd:attribute name="source-language" type="xsd:language" use="required"/>
      <xsd:attribute name="datatype" type="xlf:AttrType_datatype" use="required"/>
      <xsd:attribute name="tool-id" type="xsd:string" use="optional"/>
      <xsd:attribute name="date" type="xsd:dateTime" use="optional"/>
      <xsd:attribute ref="xml:space" use="optional"/>
      <xsd:attribute name="category" type="xsd:string" use="optional"/>
      <xsd:attribute name="target-language" type="xsd:language" use="optional"/>
      <xsd:attribute name="product-name" type="xsd:string" use="optional"/>
      <xsd:attribute name="product-version" type="xsd:string" use="optional"/>
      <xsd:attribute name="build-num" type="xsd:string" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
    <xsd:unique name="U_group_id">
      <xsd:selector xpath=".//xlf:group"/>
      <xsd:field xpath="@id"/>
    </xsd:unique>
    <xsd:key name="K_unit_id">
      <xsd:selector xpath=".//xlf:trans-unit|.//xlf:bin-unit"/>
      <xsd:field xpath="@id"/>
    </xsd:key>
    <xsd:keyref name="KR_unit_id" refer="xlf:K_unit_id">
      <xsd:selector xpath=".//bpt|.//ept|.//it|.//ph|.//g|.//x|.//bx|.//ex|.//sub"/>
      <xsd:field xpath="@xid"/>
    </xsd:keyref>
    <xsd:key name="K_tool-id">
      <xsd:selector xpath="xlf:header/xlf:tool"/>
      <xsd:field xpath="@tool-id"/>
    </xsd:key>
    <xsd:keyref name="KR_file_tool-id" refer="xlf:K_tool-id">
      <xsd:selector xpath="."/>
      <xsd:field xpath="@tool-id"/>
    </xsd:keyref>
    <xsd:keyref name="KR_phase_tool-id" refer="xlf:K_tool-id">
      <xsd:selector xpath="xlf:header/xlf:phase-group/xlf:phase"/>
      <xsd:field xpath="@tool-id"/>
    </xsd:keyref>
    <xsd:keyref name="KR_alt-trans_tool-id" refer="xlf:K_tool-id">
      <xsd:selector xpath=".//xlf:trans-unit/xlf:alt-trans"/>
      <xsd:field xpath="@tool-id"/>
    </xsd:keyref>
    <xsd:key name="K_count-group_name">
      <xsd:selector xpath=".//xlf:count-group"/>
      <xsd:field xpath="@name"/>
    </xsd:key>
    <xsd:unique name="U_context-group_name">
      <xsd:selector xpath=".//xlf:context-group"/>
      <xsd:field xpath="@name"/>
    </xsd:unique>
    <xsd:key name="K_phase-name">
      <xsd:selector xpath="xlf:header/xlf:phase-group/xlf:phase"/>
      <xsd:field xpath="@phase-name"/>
    </xsd:key>
    <xsd:keyref name="KR_phase-name" refer="xlf:K_phase-name">
      <xsd:selector xpath=".//xlf:count|.//xlf:trans-unit|.//xlf:target|.//bin-unit|.//bin-target"/>
      <xsd:field xpath="@phase-name"/>
    </xsd:keyref>
    <xsd:unique name="U_uid">
      <xsd:selector xpath=".//xlf:external-file"/>
      <xsd:field xpath="@uid"/>
    </xsd:unique>
  </xsd:element>
  <xsd:element name="header">
    <xsd:complexType>
      <xsd:sequence>
        <xsd:element minOccurs="0" name="skl" type="xlf:ElemType_ExternalReference"/>
        <xsd:element minOccurs="0" ref="xlf:phase-group"/>
        <xsd:choice maxOccurs="unbounded" minOccurs="0">
          <xsd:element name="glossary" type="xlf:ElemType_ExternalReference"/>
          <xsd:element name="reference" type="xlf:ElemType_ExternalReference"/>
          <xsd:element ref="xlf:count-group"/>
          <xsd:element ref="xlf:note"/>
          <xsd:element ref="xlf:tool"/>
        </xsd:choice>
        <xsd:any maxOccurs="unbounded" minOccurs="0" namespace="##other" processContents="strict"/>
      </xsd:sequence>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="internal-file">
    <xsd:complexType>
      <xsd:simpleContent>
        <xsd:extension base="xsd:string">
          <xsd:attribute name="form" type="xsd:string"/>
          <xsd:attribute name="crc" type="xsd:NMTOKEN"/>
        </xsd:extension>
      </xsd:simpleContent>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="external-file">
    <xsd:complexType>
      <xsd:attribute name="href" type="xsd:string" use="required"/>
      <xsd:attribute name="crc" type="xsd:NMTOKEN"/>
      <xsd:attribute name="uid" type="xsd:NMTOKEN"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="note">
    <xsd:complexType>
      <xsd:simpleContent>
        <xsd:extension base="xsd:string">
          <xsd:attribute ref="xml:lang" use="optional"/>
          <xsd:attribute default="1" name="priority" type="xlf:AttrType_priority" use="optional"/>
          <xsd:attribute name="from" type="xsd:string" use="optional"/>
          <xsd:attribute default="general" name="annotates" type="xlf:AttrType_annotates" use="optional"/>
        </xsd:extension>
      </xsd:simpleContent>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="phase-group">
    <xsd:complexType>
      <xsd:sequence maxOccurs="unbounded">
        <xsd:element ref="xlf:phase"/>
      </xsd:sequence>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="phase">
    <xsd:complexType>
      <xsd:sequence maxOccurs="unbounded" minOccurs="0">
        <xsd:element ref="xlf:note"/>
      </xsd:sequence>
      <xsd:attribute name="phase-name" type="xsd:string" use="required"/>
      <xsd:attribute name="process-name" type="xsd:string" use="required"/>
      <xsd:attribute name="company-name" type="xsd:string" use="optional"/>
      <xsd:attribute name="tool-id" type="xsd:string" use="optional"/>
      <xsd:attribute name="date" type="xsd:dateTime" use="optional"/>
      <xsd:attribute name="job-id" type="xsd:string" use="optional"/>
      <xsd:attribute name="contact-name" type="xsd:string" use="optional"/>
      <xsd:attribute name="contact-email" type="xsd:string" use="optional"/>
      <xsd:attribute name="contact-phone" type="xsd:string" use="optional"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="count-group">
    <xsd:complexType>
      <xsd:sequence maxOccurs="unbounded" minOccurs="0">
        <xsd:element ref="xlf:count"/>
      </xsd:sequence>
      <xsd:attribute name="name" type="xsd:string" use="required"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="count">
    <xsd:complexType>
      <xsd:simpleContent>
        <xsd:extension base="xsd:string">
          <xsd:attribute name="count-type" type="xlf:AttrType_count-type" use="optional"/>
          <xsd:attribute name="phase-name" type="xsd:string" use="optional"/>
          <xsd:attribute default="word" name="unit" type="xlf:AttrType_unit" use="optional"/>
        </xsd:extension>
      </xsd:simpleContent>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="context-group">
    <xsd:complexType>
      <xsd:sequence maxOccurs="unbounded">
        <xsd:element ref="xlf:context"/>
      </xsd:sequence>
      <xsd:attribute name="name" type="xsd:string" use="optional"/>
      <xsd:attribute name="crc" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="purpose" type="xlf:AttrType_purpose" use="optional"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="context">
    <xsd:complexType>
      <xsd:simpleContent>
        <xsd:extension base="xsd:string">
          <xsd:attribute name="context-type" type="xlf:AttrType_context-type" use="required"/>
          <xsd:attribute default="no" name="match-mandatory" type="xlf:AttrType_YesNo" use="optional"/>
          <xsd:attribute name="crc" type="xsd:NMTOKEN" use="optional"/>
        </xsd:extension>
      </xsd:simpleContent>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="tool">
    <xsd:complexType mixed="true">
      <xsd:sequence>
        <xsd:any namespace="##any" processContents="strict" minOccurs="0" maxOccurs="unbounded"/>
      </xsd:sequence>
      <xsd:attribute name="tool-id" type="xsd:string" use="required"/>
      <xsd:attribute name="tool-name" type="xsd:string" use="required"/>
      <xsd:attribute name="tool-version" type="xsd:string" use="optional"/>
      <xsd:attribute name="tool-company" type="xsd:string" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="body">
    <xsd:complexType>
      <xsd:choice maxOccurs="unbounded" minOccurs="0">
        <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:group"/>
        <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:trans-unit"/>
        <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:bin-unit"/>
      </xsd:choice>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="group">
    <xsd:complexType>
      <xsd:sequence>
        <xsd:sequence>
          <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:context-group"/>
          <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:count-group"/>
          <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:note"/>
          <xsd:any maxOccurs="unbounded" minOccurs="0" namespace="##other" processContents="strict"/>
        </xsd:sequence>
        <xsd:choice maxOccurs="unbounded">
          <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:group"/>
          <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:trans-unit"/>
          <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:bin-unit"/>
        </xsd:choice>
      </xsd:sequence>
      <xsd:attribute name="id" type="xsd:string" use="optional"/>
      <xsd:attribute name="datatype" type="xlf:AttrType_datatype" use="optional"/>
      <xsd:attribute default="default" ref="xml:space" use="optional"/>
      <xsd:attribute name="restype" type="xlf:AttrType_restype" use="optional"/>
      <xsd:attribute name="resname" type="xsd:string" use="optional"/>
      <xsd:attribute name="extradata" type="xsd:string" use="optional"/>
      <xsd:attribute name="extype" type="xsd:string" use="optional"/>
      <xsd:attribute name="help-id" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="menu" type="xsd:string" use="optional"/>
      <xsd:attribute name="menu-option" type="xsd:string" use="optional"/>
      <xsd:attribute name="menu-name" type="xsd:string" use="optional"/>
      <xsd:attribute name="coord" type="xlf:AttrType_Coordinates" use="optional"/>
      <xsd:attribute name="font" type="xsd:string" use="optional"/>
      <xsd:attribute name="css-style" type="xsd:string" use="optional"/>
      <xsd:attribute name="style" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="exstyle" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute default="yes" name="translate" type="xlf:AttrType_YesNo" use="optional"/>
      <xsd:attribute default="yes" name="reformat" type="xlf:AttrType_reformat" use="optional"/>
      <xsd:attribute default="pixel" name="size-unit" type="xlf:AttrType_size-unit" use="optional"/>
      <xsd:attribute name="maxwidth" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="minwidth" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="maxheight" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="minheight" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="maxbytes" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="minbytes" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="charclass" type="xsd:string" use="optional"/>
      <xsd:attribute default="no" name="merged-trans" type="xlf:AttrType_YesNo" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="trans-unit">
    <xsd:complexType>
      <xsd:sequence>
        <xsd:element ref="xlf:source"/>
        <xsd:element minOccurs="0" ref="xlf:seg-source"/>
        <xsd:element minOccurs="0" ref="xlf:target"/>
        <xsd:choice maxOccurs="unbounded" minOccurs="0">
          <xsd:element ref="xlf:context-group"/>
          <xsd:element ref="xlf:count-group"/>
          <xsd:element ref="xlf:note"/>
          <xsd:element ref="xlf:alt-trans"/>
        </xsd:choice>
        <xsd:any maxOccurs="unbounded" minOccurs="0" namespace="##other" processContents="strict"/>
      </xsd:sequence>
      <xsd:attribute name="id" type="xsd:string" use="required"/>
      <xsd:attribute name="approved" type="xlf:AttrType_YesNo" use="optional"/>
      <xsd:attribute default="yes" name="translate" type="xlf:AttrType_YesNo" use="optional"/>
      <xsd:attribute default="yes" name="reformat" type="xlf:AttrType_reformat" use="optional"/>
      <xsd:attribute default="default" ref="xml:space" use="optional"/>
      <xsd:attribute name="datatype" type="xlf:AttrType_datatype" use="optional"/>
      <xsd:attribute name="phase-name" type="xsd:string" use="optional"/>
      <xsd:attribute name="restype" type="xlf:AttrType_restype" use="optional"/>
      <xsd:attribute name="resname" type="xsd:string" use="optional"/>
      <xsd:attribute name="extradata" type="xsd:string" use="optional"/>
      <xsd:attribute name="extype" type="xsd:string" use="optional"/>
      <xsd:attribute name="help-id" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="menu" type="xsd:string" use="optional"/>
      <xsd:attribute name="menu-option" type="xsd:string" use="optional"/>
      <xsd:attribute name="menu-name" type="xsd:string" use="optional"/>
      <xsd:attribute name="coord" type="xlf:AttrType_Coordinates" use="optional"/>
      <xsd:attribute name="font" type="xsd:string" use="optional"/>
      <xsd:attribute name="css-style" type="xsd:string" use="optional"/>
      <xsd:attribute name="style" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="exstyle" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute default="pixel" name="size-unit" type="xlf:AttrType_size-unit" use="optional"/>
      <xsd:attribute name="maxwidth" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="minwidth" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="maxheight" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="minheight" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="maxbytes" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="minbytes" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="charclass" type="xsd:string" use="optional"/>
      <xsd:attribute default="yes" name="merged-trans" type="xlf:AttrType_YesNo" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
    <xsd:unique name="U_tu_segsrc_mid">
      <xsd:selector xpath="./xlf:seg-source/xlf:mrk"/>
      <xsd:field xpath="@mid"/>
    </xsd:unique>
    <xsd:keyref name="KR_tu_segsrc_mid" refer="xlf:U_tu_segsrc_mid">
      <xsd:selector xpath="./xlf:target/xlf:mrk|./xlf:alt-trans"/>
      <xsd:field xpath="@mid"/>
    </xsd:keyref>
  </xsd:element>
  <xsd:element name="source">
    <xsd:complexType mixed="true">
      <xsd:group maxOccurs="unbounded" minOccurs="0" ref="xlf:ElemGroup_TextContent"/>
      <xsd:attribute ref="xml:lang" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
    <xsd:unique name="U_source_bpt_rid">
      <xsd:selector xpath=".//xlf:bpt"/>
      <xsd:field xpath="@rid"/>
    </xsd:unique>
    <xsd:keyref name="KR_source_ept_rid" refer="xlf:U_source_bpt_rid">
      <xsd:selector xpath=".//xlf:ept"/>
      <xsd:field xpath="@rid"/>
    </xsd:keyref>
    <xsd:unique name="U_source_bx_rid">
      <xsd:selector xpath=".//xlf:bx"/>
      <xsd:field xpath="@rid"/>
    </xsd:unique>
    <xsd:keyref name="KR_source_ex_rid" refer="xlf:U_source_bx_rid">
      <xsd:selector xpath=".//xlf:ex"/>
      <xsd:field xpath="@rid"/>
    </xsd:keyref>
  </xsd:element>
  <xsd:element name="seg-source">
    <xsd:complexType mixed="true">
      <xsd:group maxOccurs="unbounded" minOccurs="0" ref="xlf:ElemGroup_TextContent"/>
      <xsd:attribute ref="xml:lang" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
    <xsd:unique name="U_segsrc_bpt_rid">
      <xsd:selector xpath=".//xlf:bpt"/>
      <xsd:field xpath="@rid"/>
    </xsd:unique>
    <xsd:keyref name="KR_segsrc_ept_rid" refer="xlf:U_segsrc_bpt_rid">
      <xsd:selector xpath=".//xlf:ept"/>
      <xsd:field xpath="@rid"/>
    </xsd:keyref>
    <xsd:unique name="U_segsrc_bx_rid">
      <xsd:selector xpath=".//xlf:bx"/>
      <xsd:field xpath="@rid"/>
    </xsd:unique>
    <xsd:keyref name="KR_segsrc_ex_rid" refer="xlf:U_segsrc_bx_rid">
      <xsd:selector xpath=".//xlf:ex"/>
      <xsd:field xpath="@rid"/>
    </xsd:keyref>
  </xsd:element>
  <xsd:element name="target">
    <xsd:complexType mixed="true">
      <xsd:group maxOccurs="unbounded" minOccurs="0" ref="xlf:ElemGroup_TextContent"/>
      <xsd:attribute name="state" type="xlf:AttrType_state" use="optional"/>
      <xsd:attribute name="state-qualifier" type="xlf:AttrType_state-qualifier" use="optional"/>
      <xsd:attribute name="phase-name" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute ref="xml:lang" use="optional"/>
      <xsd:attribute name="resname" type="xsd:string" use="optional"/>
      <xsd:attribute name="coord" type="xlf:AttrType_Coordinates" use="optional"/>
      <xsd:attribute name="font" type="xsd:string" use="optional"/>
      <xsd:attribute name="css-style" type="xsd:string" use="optional"/>
      <xsd:attribute name="style" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="exstyle" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute default="yes" name="equiv-trans" type="xlf:AttrType_YesNo" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
    <xsd:unique name="U_target_bpt_rid">
      <xsd:selector xpath=".//xlf:bpt"/>
      <xsd:field xpath="@rid"/>
    </xsd:unique>
    <xsd:keyref name="KR_target_ept_rid" refer="xlf:U_target_bpt_rid">
      <xsd:selector xpath=".//xlf:ept"/>
      <xsd:field xpath="@rid"/>
    </xsd:keyref>
    <xsd:unique name="U_target_bx_rid">
      <xsd:selector xpath=".//xlf:bx"/>
      <xsd:field xpath="@rid"/>
    </xsd:unique>
    <xsd:keyref name="KR_target_ex_rid" refer="xlf:U_target_bx_rid">
      <xsd:selector xpath=".//xlf:ex"/>
      <xsd:field xpath="@rid"/>
    </xsd:keyref>
  </xsd:element>
  <xsd:element name="alt-trans">
    <xsd:complexType>
      <xsd:sequence>
        <xsd:element minOccurs="0" ref="xlf:source"/>
        <xsd:element minOccurs="0" ref="xlf:seg-source"/>
        <xsd:element maxOccurs="1" ref="xlf:target"/>
        <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:context-group"/>
        <xsd:element maxOccurs="unbounded" minOccurs="0" ref="xlf:note"/>
        <xsd:any maxOccurs="unbounded" minOccurs="0" namespace="##other" processContents="strict"/>
      </xsd:sequence>
      <xsd:attribute name="match-quality" type="xsd:string" use="optional"/>
      <xsd:attribute name="tool-id" type="xsd:string" use="optional"/>
      <xsd:attribute name="crc" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute ref="xml:lang" use="optional"/>
      <xsd:attribute name="origin" type="xsd:string" use="optional"/>
      <xsd:attribute name="datatype" type="xlf:AttrType_datatype" use="optional"/>
      <xsd:attribute default="default" ref="xml:space" use="optional"/>
      <xsd:attribute name="restype" type="xlf:AttrType_restype" use="optional"/>
      <xsd:attribute name="resname" type="xsd:string" use="optional"/>
      <xsd:attribute name="extradata" type="xsd:string" use="optional"/>
      <xsd:attribute name="extype" type="xsd:string" use="optional"/>
      <xsd:attribute name="help-id" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="menu" type="xsd:string" use="optional"/>
      <xsd:attribute name="menu-option" type="xsd:string" use="optional"/>
      <xsd:attribute name="menu-name" type="xsd:string" use="optional"/>
      <xsd:attribute name="mid" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="coord" type="xlf:AttrType_Coordinates" use="optional"/>
      <xsd:attribute name="font" type="xsd:string" use="optional"/>
      <xsd:attribute name="css-style" type="xsd:string" use="optional"/>
      <xsd:attribute name="style" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="exstyle" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="phase-name" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute default="proposal" name="alttranstype" type="xlf:AttrType_alttranstype" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
    <xsd:unique name="U_at_segsrc_mid">
      <xsd:selector xpath="./xlf:seg-source/xlf:mrk"/>
      <xsd:field xpath="@mid"/>
    </xsd:unique>
    <xsd:keyref name="KR_at_segsrc_mid" refer="xlf:U_at_segsrc_mid">
      <xsd:selector xpath="./xlf:target/xlf:mrk"/>
      <xsd:field xpath="@mid"/>
    </xsd:keyref>
  </xsd:element>
  <xsd:element name="bin-unit">
    <xsd:complexType>
      <xsd:sequence>
        <xsd:element ref="xlf:bin-source"/>
        <xsd:element minOccurs="0" ref="xlf:bin-target"/>
        <xsd:choice maxOccurs="unbounded" minOccurs="0">
          <xsd:element ref="xlf:context-group"/>
          <xsd:element ref="xlf:count-group"/>
          <xsd:element ref="xlf:note"/>
          <xsd:element ref="xlf:trans-unit"/>
        </xsd:choice>
        <xsd:any maxOccurs="unbounded" minOccurs="0" namespace="##other" processContents="strict"/>
      </xsd:sequence>
      <xsd:attribute name="id" type="xsd:string" use="required"/>
      <xsd:attribute name="mime-type" type="xlf:mime-typeValueList" use="required"/>
      <xsd:attribute name="approved" type="xlf:AttrType_YesNo" use="optional"/>
      <xsd:attribute default="yes" name="translate" type="xlf:AttrType_YesNo" use="optional"/>
      <xsd:attribute default="yes" name="reformat" type="xlf:AttrType_reformat" use="optional"/>
      <xsd:attribute name="restype" type="xlf:AttrType_restype" use="optional"/>
      <xsd:attribute name="resname" type="xsd:string" use="optional"/>
      <xsd:attribute name="phase-name" type="xsd:string" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="bin-source">
    <xsd:complexType>
      <xsd:choice>
        <xsd:element ref="xlf:internal-file"/>
        <xsd:element ref="xlf:external-file"/>
      </xsd:choice>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="bin-target">
    <xsd:complexType>
      <xsd:choice>
        <xsd:element ref="xlf:internal-file"/>
        <xsd:element ref="xlf:external-file"/>
      </xsd:choice>
      <xsd:attribute name="mime-type" type="xlf:mime-typeValueList" use="optional"/>
      <xsd:attribute name="state" type="xlf:AttrType_state" use="optional"/>
      <xsd:attribute name="state-qualifier" type="xlf:AttrType_state-qualifier" use="optional"/>
      <xsd:attribute name="phase-name" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="restype" type="xlf:AttrType_restype" use="optional"/>
      <xsd:attribute name="resname" type="xsd:string" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
  </xsd:element>
  <!-- Element for inline codes -->
  <xsd:element name="g">
    <xsd:complexType mixed="true">
      <xsd:group maxOccurs="unbounded" minOccurs="0" ref="xlf:ElemGroup_TextContent"/>
      <xsd:attribute name="ctype" type="xlf:AttrType_InlineDelimiters" use="optional"/>
      <xsd:attribute default="yes" name="clone" type="xlf:AttrType_YesNo" use="optional"/>
      <xsd:attributeGroup ref="xlf:AttrGroup_TextContent"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="x">
    <xsd:complexType>
      <xsd:attribute name="ctype" type="xlf:AttrType_InlinePlaceholders" use="optional"/>
      <xsd:attribute default="yes" name="clone" type="xlf:AttrType_YesNo" use="optional"/>
      <xsd:attributeGroup ref="xlf:AttrGroup_TextContent"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="bx">
    <xsd:complexType>
      <xsd:attribute name="rid" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="ctype" type="xlf:AttrType_InlineDelimiters" use="optional"/>
      <xsd:attribute default="yes" name="clone" type="xlf:AttrType_YesNo" use="optional"/>
      <xsd:attributeGroup ref="xlf:AttrGroup_TextContent"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="ex">
    <xsd:complexType>
      <xsd:attribute name="rid" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attributeGroup ref="xlf:AttrGroup_TextContent"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="ph">
    <xsd:complexType mixed="true">
      <xsd:sequence maxOccurs="unbounded" minOccurs="0">
        <xsd:element ref="xlf:sub"/>
      </xsd:sequence>
      <xsd:attribute name="ctype" type="xlf:AttrType_InlinePlaceholders" use="optional"/>
      <xsd:attribute name="crc" type="xsd:string" use="optional"/>
      <xsd:attribute name="assoc" type="xlf:AttrType_assoc" use="optional"/>
      <xsd:attributeGroup ref="xlf:AttrGroup_TextContent"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="bpt">
    <xsd:complexType mixed="true">
      <xsd:sequence maxOccurs="unbounded" minOccurs="0">
        <xsd:element ref="xlf:sub"/>
      </xsd:sequence>
      <xsd:attribute name="rid" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="ctype" type="xlf:AttrType_InlineDelimiters" use="optional"/>
      <xsd:attribute name="crc" type="xsd:string" use="optional"/>
      <xsd:attributeGroup ref="xlf:AttrGroup_TextContent"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="ept">
    <xsd:complexType mixed="true">
      <xsd:sequence maxOccurs="unbounded" minOccurs="0">
        <xsd:element ref="xlf:sub"/>
      </xsd:sequence>
      <xsd:attribute name="rid" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="crc" type="xsd:string" use="optional"/>
      <xsd:attributeGroup ref="xlf:AttrGroup_TextContent"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="it">
    <xsd:complexType mixed="true">
      <xsd:sequence maxOccurs="unbounded" minOccurs="0">
        <xsd:element ref="xlf:sub"/>
      </xsd:sequence>
      <xsd:attribute name="pos" type="xlf:AttrType_Position" use="required"/>
      <xsd:attribute name="rid" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="ctype" type="xlf:AttrType_InlineDelimiters" use="optional"/>
      <xsd:attribute name="crc" type="xsd:string" use="optional"/>
      <xsd:attributeGroup ref="xlf:AttrGroup_TextContent"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="sub">
    <xsd:complexType mixed="true">
      <xsd:group maxOccurs="unbounded" minOccurs="0" ref="xlf:ElemGroup_TextContent"/>
      <xsd:attribute name="datatype" type="xlf:AttrType_datatype" use="optional"/>
      <xsd:attribute name="ctype" type="xlf:AttrType_InlineDelimiters" use="optional"/>
      <xsd:attribute name="xid" type="xsd:string" use="optional"/>
    </xsd:complexType>
  </xsd:element>
  <xsd:element name="mrk">
    <xsd:complexType mixed="true">
      <xsd:group maxOccurs="unbounded" minOccurs="0" ref="xlf:ElemGroup_TextContent"/>
      <xsd:attribute name="mtype" type="xlf:AttrType_mtype" use="required"/>
      <xsd:attribute name="mid" type="xsd:NMTOKEN" use="optional"/>
      <xsd:attribute name="comment" type="xsd:string" use="optional"/>
      <xsd:anyAttribute namespace="##other" processContents="strict"/>
    </xsd:complexType>
  </xsd:element>
</xsd:schema>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Util\TestDox;

use DOMDocument;
use DOMElement;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;
use PHPUnit\Util\Printer;
use ReflectionClass;

class XmlResultPrinter extends Printer implements TestListener
{
    /**
     * @var DOMDocument
     */
    private $document;

    /**
     * @var DOMElement
     */
    private $root;

    /**
     * @var NamePrettifier
     */
    private $prettifier;

    /**
     * @var null|\Throwable
     */
    private $exception;

    /**
     * @param resource|string $out
     *
     * @throws Exception
     */
    public function __construct($out = null)
    {
        $this->document               = new DOMDocument('1.0', 'UTF-8');
        $this->document->formatOutput = true;

        $this->root = $this->document->createElement('tests');
        $this->document->appendChild($this->root);

        $this->prettifier = new NamePrettifier;

        parent::__construct($out);
    }

    /**
     * Flush buffer and close output.
     */
    public function flush(): void
    {
        $this->write($this->document->saveXML());

        parent::flush();
    }

    /**
     * An error occurred.
     */
    public function addError(Test $test, \Throwable $t, float $time): void
    {
        $this->exception = $t;
    }

    /**
     * A warning occurred.
     */
    public function addWarning(Test $test, Warning $e, float $time): void
    {
    }

    /**
     * A failure occurred.
     */
    public function addFailure(Test $test, AssertionFailedError $e, float $time): void
    {
        $this->exception = $e;
    }

    /**
     * Incomplete test.
     */
    public function addIncompleteTest(Test $test, \Throwable $t, float $time): void
    {
    }

    /**
     * Risky test.
     */
    public function addRiskyTest(Test $test, \Throwable $t, float $time): void
    {
    }

    /**
     * Skipped test.
     */
    public function addSkippedTest(Test $test, \Throwable $t, float $time): void
    {
    }

    /**
     * A test suite started.
     */
    public function startTestSuite(TestSuite $suite): void
    {
    }

    /**
     * A test suite ended.
     */
    public function endTestSuite(TestSuite $suite): void
    {
    }

    /**
     * A test started.
     */
    public function startTest(Test $test): void
    {
        $this->exception = null;
    }

    /**
     * A test ended.
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function endTest(Test $test, float $time): void
    {
        if (!$test instanceof TestCase) {
            return;
        }

        /* @var TestCase $test */

        $groups = \array_filter(
            $test->getGroups(),
            function ($group) {
                return !($group === 'small' || $group === 'medium' || $group === 'large');
            }
        );

        $node = $this->document->createElement('test');

        $node->setAttribute('className', \get_class($test));
        $node->setAttribute('methodName', $test->getName());
        $node->setAttribute('prettifiedClassName', $this->prettifier->prettifyTestClass(\get_class($test)));
        $node->setAttribute('prettifiedMethodName', $this->prettifier->prettifyTestMethod($test->getName()));
        $node->setAttribute('status', $test->getStatus());
        $node->setAttribute('time', $time);
        $node->setAttribute('size', $test->getSize());
        $node->setAttribute('groups', \implode(',', $groups));

        $inlineAnnotations = \PHPUnit\Util\Test::getInlineAnnotations(\get_class($test), $test->getName());

        if (isset($inlineAnnotations['given'], $inlineAnnotations['when'], $inlineAnnotations['then'])) {
            $node->setAttribute('given', $inlineAnnotations['given']['value']);
            $node->setAttribute('givenStartLine', $inlineAnnotations['given']['line']);
            $node->setAttribute('when', $inlineAnnotations['when']['value']);
            $node->setAttribute('whenStartLine', $inlineAnnotations['when']['line']);
            $node->setAttribute('then', $inlineAnnotations['then']['value']);
            $node->setAttribute('thenStartLine', $inlineAnnotations['then']['line']);
        }

        if ($this->exception !== null) {
            if ($this->exception instanceof Exception) {
                $steps = $this->exception->getSerializableTrace();
            } else {
                $steps = $this->exception->getTrace();
            }

            $class = new ReflectionClass($test);
            $file  = $class->getFileName();

            foreach ($steps as $step) {
                if (isset($step['file']) && $step['file'] === $file) {
                    $node->setAttribute('exceptionLine', $step['line']);

                    break;
                }
            }

            $node->setAttribute('exceptionMessage', $this->exception->getMessage());
        }

        $this->root->appendChild($node);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <?php
/*
 * This file is part of PharIo\Manifest.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PharIo\Manifest;

use PHPUnit\Framework\TestCase;

/**
 * @covers PharIo\Manifest\Email
 */
class EmailTest extends TestCase {
    public function testCanBeCreatedForValidEmail() {
        $this->assertInstanceOf(Email::class, new Email('user@example.com'));
    }

    public function testCanBeUsedAsString() {
        $this->assertEquals('user@example.com', new Email('user@example.com'));
    }

    /**
     * @covers PharIo\Manifest\InvalidEmailException
     */
    public function testCannotBeCreatedForInvalidEmail() {
        $this->expectException(InvalidEmailException::class);

        new Email('invalid');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\CssSelector\Tests\Parser\Shortcut;

use PHPUnit\Framework\TestCase;
use Symfony\Component\CssSelector\Node\SelectorNode;
use Symfony\Component\CssSelector\Parser\Shortcut\EmptyStringParser;

/**
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 */
class EmptyStringParserTest extends TestCase
{
    public function testParse()
    {
        $parser = new EmptyStringParser();
        $selectors = $parser->parse('');
        $this->assertCount(1, $selectors);

        /** @var SelectorNode $selector */
        $selector = $selectors[0];
        $this->assertEquals('Element[*]', (string) $selector->getTree());

        $selectors = $parser->parse('this will produce an empty array');
        $this->assertCount(0, $selectors);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Exception;

/**
 * @author Ben Ramsey <ben@benramsey.com>
 */
class GoneHttpException extends HttpException
{
    /**
     * @param string     $message  The internal exception message
     * @param \Exception $previous The previous exception
     * @param int        $code     The internal exception code
     * @param array      $headers
     */
    public function __construct(string $message = null, \Exception $previous = null, int $code = 0, array $headers = array())
    {
        parent::__construct(410, $message, $previous, $headers, $code);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Tests\Descriptor;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\BufferedOutput;

abstract class AbstractDescriptorTest extends TestCase
{
    /** @dataProvider getDescribeInputArgumentTestData */
    public function testDescribeInputArgument(InputArgument $argument, $expectedDescription)
    {
        $this->assertDescription($expectedDescription, $argument);
    }

    /** @dataProvider getDescribeInputOptionTestData */
    public function testDescribeInputOption(InputOption $option, $expectedDescription)
    {
        $this->assertDescription($expectedDescription, $option);
    }

    /** @dataProvider getDescribeInputDefinitionTestData */
    public function testDescribeInputDefinition(InputDefinition $definition, $expectedDescription)
    {
        $this->assertDescription($expectedDescription, $definition);
    }

    /** @dataProvider getDescribeCommandTestData */
    public function testDescribeCommand(Command $command, $expectedDescription)
    {
        $this->assertDescription($expectedDescription, $command);
    }

    /** @dataProvider getDescribeApplicationTestData */
    public function testDescribeApplication(Application $application, $expectedDescription)
    {
        // Replaces the dynamic placeholders of the command help text with a static version.
        // The placeholder %command.full_name% includes the script path that is not predictable
        // and can not be tested against.
        foreach ($application->all() as $command) {
            $command->setHelp(str_replace('%command.full_name%', 'app/console %command.name%', $command->getHelp()));
        }

        $this->assertDescription($expectedDescription, $application);
    }

    public function getDescribeInputArgumentTestData()
    {
        return $this->getDescriptionTestData(ObjectsProvider::getInputArguments());
    }

    public function getDescribeInputOptionTestData()
    {
        return $this->getDescriptionTestData(ObjectsProvider::getInputOptions());
    }

    public function getDescribeInputDefinitionTestData()
    {
        return $this->getDescriptionTestData(ObjectsProvider::getInputDefinitions());
    }

    public function getDescribeCommandTestData()
    {
        return $this->getDescriptionTestData(ObjectsProvider::getCommands());
    }

    public function getDescribeApplicationTestData()
    {
        return $this->getDescriptionTestData(ObjectsProvider::getApplications());
    }

    abstract protected function getDescriptor();

    abstract protected function getFormat();

    protected function getDescriptionTestData(array $objects)
    {
        $data = array();
        foreach ($objects as $name => $object) {
            $description = file_get_contents(sprintf('%s/../Fixtures/%s.%s', __DIR__, $name, $this->getFormat()));
            $data[] = array($object, $description);
        }

        return $data;
    }

    protected function assertDescription($expectedDescription, $describedObject, array $options = array())
    {
        $output = new BufferedOutput(BufferedOutput::VERBOSITY_NORMAL, true);
        $this->getDescriptor()->describe($output, $describedObject, $options + array('raw_output' => true));
        $this->assertEquals(trim($expectedDescription), trim(str_replace(PHP_EOL, "\n", $output->fetch())));
    }
}
                                                                                                                                                                                                                                                                        INDX( 	                 (   0  �                            ^_    h X     ]_    CՂ�b� �~ڞI�����b�<Ղ�b� `      P               h e a d e r s . r s t __    h T     ]_    ���b� �~ڞI�> ��b����b��       �               	 i n d e x . r s t     `_    x b     ]_     /��b� �~ڞI��I��b� /��b�       H               i n t r o d u c t i o n . r s t       a_    p Z     ]_    �V��b� �~ڞI�"p��b��V��b�(      (               j a p a n e s e . r s t       b_    p Z     ]_    B���b� �~ڞI����b�@���b� �      %�               m e s s a g e s . r s t       c_    h X     ]_    �ă�b� �~ڞI�B烪b��ă�b� @      D3               p l u g i n s . r s t d_    h X     ]_    D�b� �~ڞI����b�D�b� P      0B               s e n d i n g . r s t                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php

class Swift_StreamFilters_StringReplacementFilterTest extends \PHPUnit\Framework\TestCase
{
    public function testBasicReplacementsAreMade()
    {
        $filter = $this->createFilter('foo', 'bar');
        $this->assertEquals('XbarYbarZ', $filter->filter('XfooYfooZ'));
    }

    public function testShouldBufferReturnsTrueIfPartialMatchAtEndOfBuffer()
    {
        $filter = $this->createFilter('foo', 'bar');
        $this->assertTrue($filter->shouldBuffer('XfooYf'),
            '%s: Filter should buffer since "foo" is the needle and the ending '.
            '"f" could be from "foo"'
            );
    }

    public function testFilterCanMakeMultipleReplacements()
    {
        $filter = $this->createFilter(['a', 'b'], 'foo');
        $this->assertEquals('XfooYfooZ', $filter->filter('XaYbZ'));
    }

    public function testMultipleReplacementsCanBeDifferent()
    {
        $filter = $this->createFilter(['a', 'b'], ['foo', 'zip']);
        $this->assertEquals('XfooYzipZ', $filter->filter('XaYbZ'));
    }

    public function testShouldBufferReturnsFalseIfPartialMatchNotAtEndOfString()
    {
        $filter = $this->createFilter("\r\n", "\n");
        $this->assertFalse($filter->shouldBuffer("foo\r\nbar"),
            '%s: Filter should not buffer since x0Dx0A is the needle and is not at EOF'
            );
    }

    public function testShouldBufferReturnsTrueIfAnyOfMultipleMatchesAtEndOfString()
    {
        $filter = $this->createFilter(['foo', 'zip'], 'bar');
        $this->assertTrue($filter->shouldBuffer('XfooYzi'),
            '%s: Filter should buffer since "zip" is a needle and the ending '.
            '"zi" could be from "zip"'
            );
    }

    public function testShouldBufferReturnsFalseOnEmptyBuffer()
    {
        $filter = $this->createFilter("\r\n", "\n");
        $this->assertFalse($filter->shouldBuffer(''));
    }

    private function createFilter($search, $replace)
    {
        return new Swift_StreamFilters_StringReplacementFilter($search, $replace);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Monolog\TestCase;
use Monolog\Logger;

class DoctrineCouchDBHandlerTest extends TestCase
{
    protected function setup()
    {
        if (!class_exists('Doctrine\CouchDB\CouchDBClient')) {
            $this->markTestSkipped('The "doctrine/couchdb" package is not installed');
        }
    }

    public function testHandle()
    {
        $client = $this->getMockBuilder('Doctrine\\CouchDB\\CouchDBClient')
            ->setMethods(array('postDocument'))
            ->disableOriginalConstructor()
            ->getMock();

        $record = $this->getRecord(Logger::WARNING, 'test', array('data' => new \stdClass, 'foo' => 34));

        $expected = array(
            'message' => 'test',
            'context' => array('data' => '[object] (stdClass: {})', 'foo' => 34),
            'level' => Logger::WARNING,
            'level_name' => 'WARNING',
            'channel' => 'test',
            'datetime' => $record['datetime']->format('Y-m-d H:i:s'),
            'extra' => array(),
        );

        $client->expects($this->once())
            ->method('postDocument')
            ->with($expected);

        $handler = new DoctrineCouchDBHandler($client);
        $handler->handle($record);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <?php

namespace Illuminate\Contracts\Validation;

interface Factory
{
    /**
     * Create a new Validator instance.
     *
     * @param  array  $data
     * @param  array  $rules
     * @param  array  $messages
     * @param  array  $customAttributes
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function make(array $data, array $rules, array $messages = [], array $customAttributes = []);

    /**
     * Register a custom validator extension.
     *
     * @param  string  $rule
     * @param  \Closure|string  $extension
     * @param  string  $message
     * @return void
     */
    public function extend($rule, $extension, $message = null);

    /**
     * Register a custom implicit validator extension.
     *
     * @param  string   $rule
     * @param  \Closure|string  $extension
     * @param  string  $message
     * @return void
     */
    public function extendImplicit($rule, $extension, $message = null);

    /**
     * Register a custom implicit validator message replacer.
     *
     * @param  string   $rule
     * @param  \Closure|string  $replacer
     * @return void
     */
    public function replacer($rule, $replacer);
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php

namespace Illuminate\Mail;

use ReflectionClass;
use ReflectionProperty;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Container\Container;
use Illuminate\Support\Traits\Localizable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Contracts\Queue\Factory as Queue;
use Illuminate\Contracts\Mail\Mailer as MailerContract;
use Illuminate\Contracts\Mail\Mailable as MailableContract;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;

class Mailable implements MailableContract, Renderable
{
    use ForwardsCalls, Localizable;

    /**
     * The locale of the message.
     *
     * @var string
     */
    public $locale;

    /**
     * The person the message is from.
     *
     * @var array
     */
    public $from = [];

    /**
     * The "to" recipients of the message.
     *
     * @var array
     */
    public $to = [];

    /**
     * The "cc" recipients of the message.
     *
     * @var array
     */
    public $cc = [];

    /**
     * The "bcc" recipients of the message.
     *
     * @var array
     */
    public $bcc = [];

    /**
     * The "reply to" recipients of the message.
     *
     * @var array
     */
    public $replyTo = [];

    /**
     * The subject of the message.
     *
     * @var string
     */
    public $subject;

    /**
     * The Markdown template for the message (if applicable).
     *
     * @var string
     */
    protected $markdown;

    /**
     * The HTML to use for the message.
     *
     * @var string
     */
    protected $html;

    /**
     * The view to use for the message.
     *
     * @var string
     */
    public $view;

    /**
     * The plain text view to use for the message.
     *
     * @var string
     */
    public $textView;

    /**
     * The view data for the message.
     *
     * @var array
     */
    public $viewData = [];

    /**
     * The attachments for the message.
     *
     * @var array
     */
    public $attachments = [];

    /**
     * The raw attachments for the message.
     *
     * @var array
     */
    public $rawAttachments = [];

    /**
     * The attachments from a storage disk.
     *
     * @var array
     */
    public $diskAttachments = [];

    /**
     * The callbacks for the message.
     *
     * @var array
     */
    public $callbacks = [];

    /**
     * The callback that should be invoked while building the view data.
     *
     * @var callable
     */
    public static $viewDataCallback;

    /**
     * Send the message using the given mailer.
     *
     * @param  \Illuminate\Contracts\Mail\Mailer  $mailer
     * @return void
     */
    public function send(MailerContract $mailer)
    {
        $this->withLocale($this->locale, function () use ($mailer) {
            Container::getInstance()->call([$this, 'build']);

            $mailer->send($this->buildView(), $this->buildViewData(), function ($message) {
                $this->buildFrom($message)
                     ->buildRecipients($message)
                     ->buildSubject($message)
                     ->runCallbacks($message)
                     ->buildAttachments($message);
            });
        });
    }

    /**
     * Queue the message for sending.
     *
     * @param  \Illuminate\Contracts\Queue\Factory  $queue
     * @return mixed
     */
    public function queue(Queue $queue)
    {
        if (isset($this->delay)) {
            return $this->later($this->delay, $queue);
        }

        $connection = property_exists($this, 'connection') ? $this->connection : null;

        $queueName = property_exists($this, 'queue') ? $this->queue : null;

        return $queue->connection($connection)->pushOn(
            $queueName ?: null, new SendQueuedMailable($this)
        );
    }

    /**
     * Deliver the queued message after the given delay.
     *
     * @param  \DateTimeInterface|\DateInterval|int  $delay
     * @param  \Illuminate\Contracts\Queue\Factory  $queue
     * @return mixed
     */
    public function later($delay, Queue $queue)
    {
        $connection = property_exists($this, 'connection') ? $this->connection : null;

        $queueName = property_exists($this, 'queue') ? $this->queue : null;

        return $queue->connection($connection)->laterOn(
            $queueName ?: null, $delay, new SendQueuedMailable($this)
        );
    }

    /**
     * Render the mailable into a view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        Container::getInstance()->call([$this, 'build']);

        return Container::getInstance()->make('mailer')->render(
            $this->buildView(), $this->buildViewData()
        );
    }

    /**
     * Build the view for the message.
     *
     * @return array|string
     */
    protected function buildView()
    {
        if (isset($this->html)) {
            return array_filter([
                'html' => new HtmlString($this->html),
                'text' => $this->textView ?? null,
            ]);
        }

        if (isset($this->markdown)) {
            return $this->buildMarkdownView();
        }

        if (isset($this->view, $this->textView)) {
            return [$this->view, $this->textView];
        } elseif (isset($this->textView)) {
            return ['text' => $this->textView];
        }

        return $this->view;
    }

    /**
     * Build the Markdown view for the message.
     *
     * @return array
     */
    protected function buildMarkdownView()
    {
        $markdown = Container::getInstance()->make(Markdown::class);

        if (isset($this->theme)) {
            $markdown->theme($this->theme);
        }

        $data = $this->buildViewData();

        return [
            'html' => $markdown->render($this->markdown, $data),
            'text' => $this->buildMarkdownText($markdown, $data),
        ];
    }

    /**
     * Build the view data for the message.
     *
     * @return array
     */
    public function buildViewData()
    {
        $data = $this->viewData;

        if (static::$viewDataCallback) {
            $data = array_merge($data, call_user_func(static::$viewDataCallback, $this));
        }

        foreach ((new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            if ($property->getDeclaringClass()->getName() !== self::class) {
                $data[$property->getName()] = $property->getValue($this);
            }
        }

        return $data;
    }

    /**
     * Build the text view for a Markdown message.
     *
     * @param  \Illuminate\Mail\Markdown  $markdown
     * @param  array  $data
     * @return string
     */
    protected function buildMarkdownText($markdown, $data)
    {
        return $this->textView
                ?? $markdown->renderText($this->markdown, $data);
    }

    /**
     * Add the sender to the message.
     *
     * @param  \Illuminate\Mail\Message  $message
     * @return $this
     */
    protected function buildFrom($message)
    {
        if (! empty($this->from)) {
            $message->from($this->from[0]['address'], $this->from[0]['name']);
        }

        return $this;
    }

    /**
     * Add all of the recipients to the message.
     *
     * @param  \Illuminate\Mail\Message  $message
     * @return $this
     */
    protected function buildRecipients($message)
    {
        foreach (['to', 'cc', 'bcc', 'replyTo'] as $type) {
            foreach ($this->{$type} as $recipient) {
                $message->{$type}($recipient['address'], $recipient['name']);
            }
        }

        return $this;
    }

    /**
     * Set the subject for the message.
     *
     * @param  \Illuminate\Mail\Message  $message
     * @return $this
     */
    protected function buildSubject($message)
    {
        if ($this->subject) {
            $message->subject($this->subject);
        } else {
            $message->subject(Str::title(Str::snake(class_basename($this), ' ')));
        }

        return $this;
    }

    /**
     * Add all of the attachments to the message.
     *
     * @param  \Illuminate\Mail\Message  $message
     * @return $this
     */
    protected function buildAttachments($message)
    {
        foreach ($this->attachments as $attachment) {
            $message->attach($attachment['file'], $attachment['options']);
        }

        foreach ($this->rawAttachments as $attachment) {
            $message->attachData(
                $attachment['data'], $attachment['name'], $attachment['options']
            );
        }

        $this->buildDiskAttachments($message);

        return $this;
    }

    /**
     * Add all of the disk attachments to the message.
     *
     * @param  \Illuminate\Mail\Message  $message
     * @return void
     */
    protected function buildDiskAttachments($message)
    {
        foreach ($this->diskAttachments as $attachment) {
            $storage = Container::getInstance()->make(
                FilesystemFactory::class
            )->disk($attachment['disk']);

            return $message->attachData(
                $storage->get($attachment['path']),
                $attachment['name'] ?? basename($attachment['path']),
                array_merge(['mime' => $storage->mimeType($attachment['path'])], $attachment['options'])
            );
        }
    }

    /**
     * Run the callbacks for the message.
     *
     * @param  \Illuminate\Mail\Message  $message
     * @return $this
     */
    protected function runCallbacks($message)
    {
        foreach ($this->callbacks as $callback) {
            $callback($message->getSwiftMessage());
        }

        return $this;
    }

    /**
     * Set the locale of the message.
     *
     * @param  string  $locale
     * @return $this
     */
    public function locale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Set the priority of this message.
     *
     * The value is an integer where 1 is the highest priority and 5 is the lowest.
     *
     * @param  int  $level
     * @return $this
     */
    public function priority($level = 3)
    {
        $this->callbacks[] = function ($message) use ($level) {
            $message->setPriority($level);
        };

        return $this;
    }

    /**
     * Set the sender of the message.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @return $this
     */
    public function from($address, $name = null)
    {
        return $this->setAddress($address, $name, 'from');
    }

    /**
     * Determine if the given recipient is set on the mailable.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @return bool
     */
    public function hasFrom($address, $name = null)
    {
        return $this->hasRecipient($address, $name, 'from');
    }

    /**
     * Set the recipients of the message.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @return $this
     */
    public function to($address, $name = null)
    {
        return $this->setAddress($address, $name, 'to');
    }

    /**
     * Determine if the given recipient is set on the mailable.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @return bool
     */
    public function hasTo($address, $name = null)
    {
        return $this->hasRecipient($address, $name, 'to');
    }

    /**
     * Set the recipients of the message.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @return $this
     */
    public function cc($address, $name = null)
    {
        return $this->setAddress($address, $name, 'cc');
    }

    /**
     * Determine if the given recipient is set on the mailable.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @return bool
     */
    public function hasCc($address, $name = null)
    {
        return $this->hasRecipient($address, $name, 'cc');
    }

    /**
     * Set the recipients of the message.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @return $this
     */
    public function bcc($address, $name = null)
    {
        return $this->setAddress($address, $name, 'bcc');
    }

    /**
     * Determine if the given recipient is set on the mailable.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @return bool
     */
    public function hasBcc($address, $name = null)
    {
        return $this->hasRecipient($address, $name, 'bcc');
    }

    /**
     * Set the "reply to" address of the message.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @return $this
     */
    public function replyTo($address, $name = null)
    {
        return $this->setAddress($address, $name, 'replyTo');
    }

    /**
     * Determine if the given recipient is set on the mailable.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @return bool
     */
    public function hasReplyTo($address, $name = null)
    {
        return $this->hasRecipient($address, $name, 'replyTo');
    }

    /**
     * Set the recipients of the message.
     *
     * All recipients are stored internally as [['name' => ?, 'address' => ?]]
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @param  string  $property
     * @return $this
     */
    protected function setAddress($address, $name = null, $property = 'to')
    {
        foreach ($this->addressesToArray($address, $name) as $recipient) {
            $recipient = $this->normalizeRecipient($recipient);

            $this->{$property}[] = [
                'name' => $recipient->name ?? null,
                'address' => $recipient->email,
            ];
        }

        return $this;
    }

    /**
     * Convert the given recipient arguments to an array.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @return array
     */
    protected function addressesToArray($address, $name)
    {
        if (! is_array($address) && ! $address instanceof Collection) {
            $address = is_string($name) ? [['name' => $name, 'email' => $address]] : [$address];
        }

        return $address;
    }

    /**
     * Convert the given recipient into an object.
     *
     * @param  mixed  $recipient
     * @return object
     */
    protected function normalizeRecipient($recipient)
    {
        if (is_array($recipient)) {
            return (object) $recipient;
        } elseif (is_string($recipient)) {
            return (object) ['email' => $recipient];
        }

        return $recipient;
    }

    /**
     * Determine if the given recipient is set on the mailable.
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @param  string  $property
     * @return bool
     */
    protected function hasRecipient($address, $name = null, $property = 'to')
    {
        $expected = $this->normalizeRecipient(
            $this->addressesToArray($address, $name)[0]
        );

        $expected = [
            'name' => $expected->name ?? null,
            'address' => $expected->email,
        ];

        return collect($this->{$property})->contains(function ($actual) use ($expected) {
            if (! isset($expected['name'])) {
                return $actual['address'] == $expected['address'];
            }

            return $actual == $expected;
        });
    }

    /**
     * Set the subject of the message.
     *
     * @param  string  $subject
     * @return $this
     */
    public function subject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Set the Markdown template for the message.
     *
     * @param  string  $view
     * @param  array  $data
     * @return $this
     */
    public function markdown($view, array $data = [])
    {
        $this->markdown = $view;
        $this->viewData = array_merge($this->viewData, $data);

        return $this;
    }

    /**
     * Set the view and view data for the message.
     *
     * @param  string  $view
     * @param  array  $data
     * @return $this
     */
    public function view($view, array $data = [])
    {
        $this->view = $view;
        $this->viewData = array_merge($this->viewData, $data);

        return $this;
    }

    /**
     * Set the rendered HTML content for the message.
     *
     * @param  string  $html
     * @return $this
     */
    public function html($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Set the plain text view for the message.
     *
     * @param  string  $textView
     * @param  array  $data
     * @return $this
     */
    public function text($textView, array $data = [])
    {
        $this->textView = $textView;
        $this->viewData = array_merge($this->viewData, $data);

        return $this;
    }

    /**
     * Set the view data for the message.
     *
     * @param  string|array  $key
     * @param  mixed   $value
     * @return $this
     */
    public function with($key, $value = null)
    {
        if (is_array($key)) {
            $this->viewData = array_merge($this->viewData, $key);
        } else {
            $this->viewData[$key] = $value;
        }

        return $this;
    }

    /**
     * Attach a file to the message.
     *
     * @param  string  $file
     * @param  array  $options
     * @return $this
     */
    public function attach($file, array $options = [])
    {
        $this->attachments[] = compact('file', 'options');

        return $this;
    }

    /**
     * Attach a file to the message from storage.
     *
     * @param  string  $path
     * @param  string  $name
     * @param  array  $options
     * @return $this
     */
    public function attachFromStorage($path, $name = null, array $options = [])
    {
        return $this->attachFromStorageDisk(null, $path, $name, $options);
    }

    /**
     * Attach a file to the message from storage.
     *
     * @param  string  $disk
     * @param  string  $path
     * @param  string  $name
     * @param  array  $options
     * @return $this
     */
    public function attachFromStorageDisk($disk, $path, $name = null, array $options = [])
    {
        $this->diskAttachments[] = [
            'disk' => $disk,
            'path' => $path,
            'name' => $name ?? basename($path),
            'options' => $options,
        ];

        return $this;
    }

    /**
     * Attach in-memory data as an attachment.
     *
     * @param  string  $data
     * @param  string  $name
     * @param  array  $options
     * @return $this
     */
    public function attachData($data, $name, array $options = [])
    {
        $this->rawAttachments[] = compact('data', 'name', 'options');

        return $this;
    }

    /**
     * Register a callback to be called with the Swift message instance.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function withSwiftMessage($callback)
    {
        $this->callbacks[] = $callback;

        return $this;
    }

    /**
     * Register a callback to be called while building the view data.
     *
     * @param  callable  $callback
     * @return void
     */
    public static function buildViewDataUsing(callable $callback)
    {
        static::$viewDataCallback = $callback;
    }

    /**
     * Dynamically bind parameters to the message.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return $this
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if (Str::startsWith($method, 'with')) {
            return $this->with(Str::camel(substr($method, 4)), $parameters[0]);
        }

        static::throwBadMethodCallException($method);
    }
}
                                                                                                                                                                                                                                                                                                                                                             <?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace Whoops\Util;

class Misc
{
    /**
     * Can we at this point in time send HTTP headers?
     *
     * Currently this checks if we are even serving an HTTP request,
     * as opposed to running from a command line.
     *
     * If we are serving an HTTP request, we check if it's not too late.
     *
     * @return bool
     */
    public static function canSendHeaders()
    {
        return isset($_SERVER["REQUEST_URI"]) && !headers_sent();
    }

    public static function isAjaxRequest()
    {
        return (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    /**
     * Check, if possible, that this execution was triggered by a command line.
     * @return bool
     */
    public static function isCommandLine()
    {
        return PHP_SAPI == 'cli';
    }

    /**
     * Translate ErrorException code into the represented constant.
     *
     * @param int $error_code
     * @return string
     */
    public static function translateErrorCode($error_code)
    {
        $constants = get_defined_constants(true);
        if (array_key_exists('Core', $constants)) {
            foreach ($constants['Core'] as $constant => $value) {
                if (substr($constant, 0, 2) == 'E_' && $value == $error_code) {
                    return $constant;
                }
            }
        }
        return "E_UNKNOWN";
    }
    
    /**
     * Determine if an error level is fatal (halts execution)
     *
     * @param int $level
     * @return bool
     */
    public static function isLevelFatal($level)
    {
        $errors = E_ERROR;
        $errors |= E_PARSE;
        $errors |= E_CORE_ERROR;
        $errors |= E_CORE_WARNING;
        $errors |= E_COMPILE_ERROR;
        $errors |= E_COMPILE_WARNING;
        return ($level & $errors) > 0;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             /*!
 * Bootstrap v3.3.7 (http://getbootstrap.com)
 * Copyright 2011-2016 Twitter, Inc.
 * Licensed under the MIT license
 */
if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(a){"use strict";var b=a.fn.jquery.split(" ")[0].split(".");if(b[0]<2&&b[1]<9||1==b[0]&&9==b[1]&&b[2]<1||b[0]>3)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4")}(jQuery),+function(a){"use strict";function b(){var a=document.createElement("bootstrap"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return{end:b[c]};return!1}a.fn.emulateTransitionEnd=function(b){var c=!1,d=this;a(this).one("bsTransitionEnd",function(){c=!0});var e=function(){c||a(d).trigger(a.support.transition.end)};return setTimeout(e,b),this},a(function(){a.support.transition=b(),a.support.transition&&(a.event.special.bsTransitionEnd={bindType:a.support.transition.end,delegateType:a.support.transition.end,handle:function(b){if(a(b.target).is(this))return b.handleObj.handler.apply(this,arguments)}})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var c=a(this),e=c.data("bs.alert");e||c.data("bs.alert",e=new d(this)),"string"==typeof b&&e[b].call(c)})}var c='[data-dismiss="alert"]',d=function(b){a(b).on("click",c,this.close)};d.VERSION="3.3.7",d.TRANSITION_DURATION=150,d.prototype.close=function(b){function c(){g.detach().trigger("closed.bs.alert").remove()}var e=a(this),f=e.attr("data-target");f||(f=e.attr("href"),f=f&&f.replace(/.*(?=#[^\s]*$)/,""));var g=a("#"===f?[]:f);b&&b.preventDefault(),g.length||(g=e.closest(".alert")),g.trigger(b=a.Event("close.bs.alert")),b.isDefaultPrevented()||(g.removeClass("in"),a.support.transition&&g.hasClass("fade")?g.one("bsTransitionEnd",c).emulateTransitionEnd(d.TRANSITION_DURATION):c())};var e=a.fn.alert;a.fn.alert=b,a.fn.alert.Constructor=d,a.fn.alert.noConflict=function(){return a.fn.alert=e,this},a(document).on("click.bs.alert.data-api",c,d.prototype.close)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.button"),f="object"==typeof b&&b;e||d.data("bs.button",e=new c(this,f)),"toggle"==b?e.toggle():b&&e.setState(b)})}var c=function(b,d){this.$element=a(b),this.options=a.extend({},c.DEFAULTS,d),this.isLoading=!1};c.VERSION="3.3.7",c.DEFAULTS={loadingText:"loading..."},c.prototype.setState=function(b){var c="disabled",d=this.$element,e=d.is("input")?"val":"html",f=d.data();b+="Text",null==f.resetText&&d.data("resetText",d[e]()),setTimeout(a.proxy(function(){d[e](null==f[b]?this.options[b]:f[b]),"loadingText"==b?(this.isLoading=!0,d.addClass(c).attr(c,c).prop(c,!0)):this.isLoading&&(this.isLoading=!1,d.removeClass(c).removeAttr(c).prop(c,!1))},this),0)},c.prototype.toggle=function(){var a=!0,b=this.$element.closest('[data-toggle="buttons"]');if(b.length){var c=this.$element.find("input");"radio"==c.prop("type")?(c.prop("checked")&&(a=!1),b.find(".active").removeClass("active"),this.$element.addClass("active")):"checkbox"==c.prop("type")&&(c.prop("checked")!==this.$element.hasClass("active")&&(a=!1),this.$element.toggleClass("active")),c.prop("checked",this.$element.hasClass("active")),a&&c.trigger("change")}else this.$element.attr("aria-pressed",!this.$element.hasClass("active")),this.$element.toggleClass("active")};var d=a.fn.button;a.fn.button=b,a.fn.button.Constructor=c,a.fn.button.noConflict=function(){return a.fn.button=d,this},a(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(c){var d=a(c.target).closest(".btn");b.call(d,"toggle"),a(c.target).is('input[type="radio"], input[type="checkbox"]')||(c.preventDefault(),d.is("input,button")?d.trigger("focus"):d.find("input:visible,button:visible").first().trigger("focus"))}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(b){a(b.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(b.type))})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.carousel"),f=a.extend({},c.DEFAULTS,d.data(),"object"==typeof b&&b),g="string"==typeof b?b:f.slide;e||d.data("bs.carousel",e=new c(this,f)),"number"==typeof b?e.to(b):g?e[g]():f.interval&&e.pause().cycle()})}var c=function(b,c){this.$element=a(b),this.$indicators=this.$element.find(".carousel-indicators"),this.options=c,this.paused=null,this.sliding=null,this.interval=null,this.$active=null,this.$items=null,this.options.keyboard&&this.$element.on("keydown.bs.carousel",a.proxy(this.keydown,this)),"hover"==this.options.pause&&!("ontouchstart"in document.documentElement)&&this.$element.on("mouseenter.bs.carousel",a.proxy(this.pause,this)).on("mouseleave.bs.carousel",a.proxy(this.cycle,this))};c.VERSION="3.3.7",c.TRANSITION_DURATION=600,c.DEFAULTS={interval:5e3,pause:"hover",wrap:!0,keyboard:!0},c.prototype.keydown=function(a){if(!/input|textarea/i.test(a.target.tagName)){switch(a.which){case 37:this.prev();break;case 39:this.next();break;default:return}a.preventDefault()}},c.prototype.cycle=function(b){return b||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(a.proxy(this.next,this),this.options.interval)),this},c.prototype.getItemIndex=function(a){return this.$items=a.parent().children(".item"),this.$items.index(a||this.$active)},c.prototype.getItemForDirection=function(a,b){var c=this.getItemIndex(b),d="prev"==a&&0===c||"next"==a&&c==this.$items.length-1;if(d&&!this.options.wrap)return b;var e="prev"==a?-1:1,f=(c+e)%this.$items.length;return this.$items.eq(f)},c.prototype.to=function(a){var b=this,c=this.getItemIndex(this.$active=this.$element.find(".item.active"));if(!(a>this.$items.length-1||a<0))return this.sliding?this.$element.one("slid.bs.carousel",function(){b.to(a)}):c==a?this.pause().cycle():this.slide(a>c?"next":"prev",this.$items.eq(a))},c.prototype.pause=function(b){return b||(this.paused=!0),this.$element.find(".next, .prev").length&&a.support.transition&&(this.$element.trigger(a.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},c.prototype.next=function(){if(!this.sliding)return this.slide("next")},c.prototype.prev=function(){if(!this.sliding)return this.slide("prev")},c.prototype.slide=function(b,d){var e=this.$element.find(".item.active"),f=d||this.getItemForDirection(b,e),g=this.interval,h="next"==b?"left":"right",i=this;if(f.hasClass("active"))return this.sliding=!1;var j=f[0],k=a.Event("slide.bs.carousel",{relatedTarget:j,direction:h});if(this.$element.trigger(k),!k.isDefaultPrevented()){if(this.sliding=!0,g&&this.pause(),this.$indicators.length){this.$indicators.find(".active").removeClass("active");var l=a(this.$indicators.children()[this.getItemIndex(f)]);l&&l.addClass("active")}var m=a.Event("slid.bs.carousel",{relatedTarget:j,direction:h});return a.support.transition&&this.$element.hasClass("slide")?(f.addClass(b),f[0].offsetWidth,e.addClass(h),f.addClass(h),e.one("bsTransitionEnd",function(){f.removeClass([b,h].join(" ")).addClass("active"),e.removeClass(["active",h].join(" ")),i.sliding=!1,setTimeout(function(){i.$element.trigger(m)},0)}).emulateTransitionEnd(c.TRANSITION_DURATION)):(e.removeClass("active"),f.addClass("active"),this.sliding=!1,this.$element.trigger(m)),g&&this.cycle(),this}};var d=a.fn.carousel;a.fn.carousel=b,a.fn.carousel.Constructor=c,a.fn.carousel.noConflict=function(){return a.fn.carousel=d,this};var e=function(c){var d,e=a(this),f=a(e.attr("data-target")||(d=e.attr("href"))&&d.replace(/.*(?=#[^\s]+$)/,""));if(f.hasClass("carousel")){var g=a.extend({},f.data(),e.data()),h=e.attr("data-slide-to");h&&(g.interval=!1),b.call(f,g),h&&f.data("bs.carousel").to(h),c.preventDefault()}};a(document).on("click.bs.carousel.data-api","[data-slide]",e).on("click.bs.carousel.data-api","[data-slide-to]",e),a(window).on("load",function(){a('[data-ride="carousel"]').each(function(){var c=a(this);b.call(c,c.data())})})}(jQuery),+function(a){"use strict";function b(b){var c,d=b.attr("data-target")||(c=b.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,"");return a(d)}function c(b){return this.each(function(){var c=a(this),e=c.data("bs.collapse"),f=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b);!e&&f.toggle&&/show|hide/.test(b)&&(f.toggle=!1),e||c.data("bs.collapse",e=new d(this,f)),"string"==typeof b&&e[b]()})}var d=function(b,c){this.$element=a(b),this.options=a.extend({},d.DEFAULTS,c),this.$trigger=a('[data-toggle="collapse"][href="#'+b.id+'"],[data-toggle="collapse"][data-target="#'+b.id+'"]'),this.transitioning=null,this.options.parent?this.$parent=this.getParent():this.addAriaAndCollapsedClass(this.$element,this.$trigger),this.options.toggle&&this.toggle()};d.VERSION="3.3.7",d.TRANSITION_DURATION=350,d.DEFAULTS={toggle:!0},d.prototype.dimension=function(){var a=this.$element.hasClass("width");return a?"width":"height"},d.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var b,e=this.$parent&&this.$parent.children(".panel").children(".in, .collapsing");if(!(e&&e.length&&(b=e.data("bs.collapse"),b&&b.transitioning))){var f=a.Event("show.bs.collapse");if(this.$element.trigger(f),!f.isDefaultPrevented()){e&&e.length&&(c.call(e,"hide"),b||e.data("bs.collapse",null));var g=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded",!0),this.$trigger.removeClass("collapsed").attr("aria-expanded",!0),this.transitioning=1;var h=function(){this.$element.removeClass("collapsing").addClass("collapse in")[g](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return h.call(this);var i=a.camelCase(["scroll",g].join("-"));this.$element.one("bsTransitionEnd",a.proxy(h,this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])}}}},d.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var b=a.Event("hide.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",!1),this.$trigger.addClass("collapsed").attr("aria-expanded",!1),this.transitioning=1;var e=function(){this.transitioning=0,this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};return a.support.transition?void this.$element[c](0).one("bsTransitionEnd",a.proxy(e,this)).emulateTransitionEnd(d.TRANSITION_DURATION):e.call(this)}}},d.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()},d.prototype.getParent=function(){return a(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(a.proxy(function(c,d){var e=a(d);this.addAriaAndCollapsedClass(b(e),e)},this)).end()},d.prototype.addAriaAndCollapsedClass=function(a,b){var c=a.hasClass("in");a.attr("aria-expanded",c),b.toggleClass("collapsed",!c).attr("aria-expanded",c)};var e=a.fn.collapse;a.fn.collapse=c,a.fn.collapse.Constructor=d,a.fn.collapse.noConflict=function(){return a.fn.collapse=e,this},a(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(d){var e=a(this);e.attr("data-target")||d.preventDefault();var f=b(e),g=f.data("bs.collapse"),h=g?"toggle":e.data();c.call(f,h)})}(jQuery),+function(a){"use strict";function b(b){var c=b.attr("data-target");c||(c=b.attr("href"),c=c&&/#[A-Za-z]/.test(c)&&c.replace(/.*(?=#[^\s]*$)/,""));var d=c&&a(c);return d&&d.length?d:b.parent()}function c(c){c&&3===c.which||(a(e).remove(),a(f).each(function(){var d=a(this),e=b(d),f={relatedTarget:this};e.hasClass("open")&&(c&&"click"==c.type&&/input|textarea/i.test(c.target.tagName)&&a.contains(e[0],c.target)||(e.trigger(c=a.Event("hide.bs.dropdown",f)),c.isDefaultPrevented()||(d.attr("aria-expanded","false"),e.removeClass("open").trigger(a.Event("hidden.bs.dropdown",f)))))}))}function d(b){return this.each(function(){var c=a(this),d=c.data("bs.dropdown");d||c.data("bs.dropdown",d=new g(this)),"string"==typeof b&&d[b].call(c)})}var e=".dropdown-backdrop",f='[data-toggle="dropdown"]',g=function(b){a(b).on("click.bs.dropdown",this.toggle)};g.VERSION="3.3.7",g.prototype.toggle=function(d){var e=a(this);if(!e.is(".disabled, :disabled")){var f=b(e),g=f.hasClass("open");if(c(),!g){"ontouchstart"in document.documentElement&&!f.closest(".navbar-nav").length&&a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click",c);var h={relatedTarget:this};if(f.trigger(d=a.Event("show.bs.dropdown",h)),d.isDefaultPrevented())return;e.trigger("focus").attr("aria-expanded","true"),f.toggleClass("open").trigger(a.Event("shown.bs.dropdown",h))}return!1}},g.prototype.keydown=function(c){if(/(38|40|27|32)/.test(c.which)&&!/input|textarea/i.test(c.target.tagName)){var d=a(this);if(c.preventDefault(),c.stopPropagation(),!d.is(".disabled, :disabled")){var e=b(d),g=e.hasClass("open");if(!g&&27!=c.which||g&&27==c.which)return 27==c.which&&e.find(f).trigger("focus"),d.trigger("click");var h=" li:not(.disabled):visible a",i=e.find(".dropdown-menu"+h);if(i.length){var j=i.index(c.target);38==c.which&&j>0&&j--,40==c.which&&j<i.length-1&&j++,~j||(j=0),i.eq(j).trigger("focus")}}}};var h=a.fn.dropdown;a.fn.dropdown=d,a.fn.dropdown.Constructor=g,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=h,this},a(document).on("click.bs.dropdown.data-api",c).on("click.bs.dropdown.data-api",".dropdown form",function(a){a.stopPropagation()}).on("click.bs.dropdown.data-api",f,g.prototype.toggle).on("keydown.bs.dropdown.data-api",f,g.prototype.keydown).on("keydown.bs.dropdown.data-api",".dropdown-menu",g.prototype.keydown)}(jQuery),+function(a){"use strict";function b(b,d){return this.each(function(){var e=a(this),f=e.data("bs.modal"),g=a.extend({},c.DEFAULTS,e.data(),"object"==typeof b&&b);f||e.data("bs.modal",f=new c(this,g)),"string"==typeof b?f[b](d):g.show&&f.show(d)})}var c=function(b,c){this.options=c,this.$body=a(document.body),this.$element=a(b),this.$dialog=this.$element.find(".modal-dialog"),this.$backdrop=null,this.isShown=null,this.originalBodyPad=null,this.scrollbarWidth=0,this.ignoreBackdropClick=!1,this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,a.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};c.VERSION="3.3.7",c.TRANSITION_DURATION=300,c.BACKDROP_TRANSITION_DURATION=150,c.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},c.prototype.toggle=function(a){return this.isShown?this.hide():this.show(a)},c.prototype.show=function(b){var d=this,e=a.Event("show.bs.modal",{relatedTarget:b});this.$element.trigger(e),this.isShown||e.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.setScrollbar(),this.$body.addClass("modal-open"),this.escape(),this.resize(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.$dialog.on("mousedown.dismiss.bs.modal",function(){d.$element.one("mouseup.dismiss.bs.modal",function(b){a(b.target).is(d.$element)&&(d.ignoreBackdropClick=!0)})}),this.backdrop(function(){var e=a.support.transition&&d.$element.hasClass("fade");d.$element.parent().length||d.$element.appendTo(d.$body),d.$element.show().scrollTop(0),d.adjustDialog(),e&&d.$element[0].offsetWidth,d.$element.addClass("in"),d.enforceFocus();var f=a.Event("shown.bs.modal",{relatedTarget:b});e?d.$dialog.one("bsTransitionEnd",function(){d.$element.trigger("focus").trigger(f)}).emulateTransitionEnd(c.TRANSITION_DURATION):d.$element.trigger("focus").trigger(f)}))},c.prototype.hide=function(b){b&&b.preventDefault(),b=a.Event("hide.bs.modal"),this.$element.trigger(b),this.isShown&&!b.isDefaultPrevented()&&(this.isShown=!1,this.escape(),this.resize(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"),this.$dialog.off("mousedown.dismiss.bs.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",a.proxy(this.hideModal,this)).emulateTransitionEnd(c.TRANSITION_DURATION):this.hideModal())},c.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(a){document===a.target||this.$element[0]===a.target||this.$element.has(a.target).length||this.$element.trigger("focus")},this))},c.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keydown.dismiss.bs.modal",a.proxy(function(a){27==a.which&&this.hide()},this)):this.isShown||this.$element.off("keydown.dismiss.bs.modal")},c.prototype.resize=function(){this.isShown?a(window).on("resize.bs.modal",a.proxy(this.handleUpdate,this)):a(window).off("resize.bs.modal")},c.prototype.hideModal=function(){var a=this;this.$element.hide(),this.backdrop(function(){a.$body.removeClass("modal-open"),a.resetAdjustments(),a.resetScrollbar(),a.$element.trigger("hidden.bs.modal")})},c.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},c.prototype.backdrop=function(b){var d=this,e=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var f=a.support.transition&&e;if(this.$backdrop=a(document.createElement("div")).addClass("modal-backdrop "+e).appendTo(this.$body),this.$element.on("click.dismiss.bs.modal",a.proxy(function(a){return this.ignoreBackdropClick?void(this.ignoreBackdropClick=!1):void(a.target===a.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus():this.hide()))},this)),f&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!b)return;f?this.$backdrop.one("bsTransitionEnd",b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):b()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var g=function(){d.removeBackdrop(),b&&b()};a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):g()}else b&&b()},c.prototype.handleUpdate=function(){this.adjustDialog()},c.prototype.adjustDialog=function(){var a=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&a?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!a?this.scrollbarWidth:""})},c.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})},c.prototype.checkScrollbar=function(){var a=window.innerWidth;if(!a){var b=document.documentElement.getBoundingClientRect();a=b.right-Math.abs(b.left)}this.bodyIsOverflowing=document.body.clientWidth<a,this.scrollbarWidth=this.measureScrollbar()},c.prototype.setScrollbar=function(){var a=parseInt(this.$body.css("padding-right")||0,10);this.originalBodyPad=document.body.style.paddingRight||"",this.bodyIsOverflowing&&this.$body.css("padding-right",a+this.scrollbarWidth)},c.prototype.resetScrollbar=function(){this.$body.css("padding-right",this.originalBodyPad)},c.prototype.measureScrollbar=function(){var a=document.createElement("div");a.className="modal-scrollbar-measure",this.$body.append(a);var b=a.offsetWidth-a.clientWidth;return this.$body[0].removeChild(a),b};var d=a.fn.modal;a.fn.modal=b,a.fn.modal.Constructor=c,a.fn.modal.noConflict=function(){return a.fn.modal=d,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(c){var d=a(this),e=d.attr("href"),f=a(d.attr("data-target")||e&&e.replace(/.*(?=#[^\s]+$)/,"")),g=f.data("bs.modal")?"toggle":a.extend({remote:!/#/.test(e)&&e},f.data(),d.data());d.is("a")&&c.preventDefault(),f.one("show.bs.modal",function(a){a.isDefaultPrevented()||f.one("hidden.bs.modal",function(){d.is(":visible")&&d.trigger("focus")})}),b.call(f,g,this)})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tooltip"),f="object"==typeof b&&b;!e&&/destroy|hide/.test(b)||(e||d.data("bs.tooltip",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.type=null,this.options=null,this.enabled=null,this.timeout=null,this.hoverState=null,this.$element=null,this.inState=null,this.init("tooltip",a,b)};c.VERSION="3.3.7",c.TRANSITION_DURATION=150,c.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0}},c.prototype.init=function(b,c,d){if(this.enabled=!0,this.type=b,this.$element=a(c),this.options=this.getOptions(d),this.$viewport=this.options.viewport&&a(a.isFunction(this.options.viewport)?this.options.viewport.call(this,this.$element):this.options.viewport.selector||this.options.viewport),this.inState={click:!1,hover:!1,focus:!1},this.$element[0]instanceof document.constructor&&!this.options.selector)throw new Error("`selector` option must be specified when initializing "+this.type+" on the window.document object!");for(var e=this.options.trigger.split(" "),f=e.length;f--;){var g=e[f];if("click"==g)this.$element.on("click."+this.type,this.options.selector,a.proxy(this.toggle,this));else if("manual"!=g){var h="hover"==g?"mouseenter":"focusin",i="hover"==g?"mouseleave":"focusout";this.$element.on(h+"."+this.type,this.options.selector,a.proxy(this.enter,this)),this.$element.on(i+"."+this.type,this.options.selector,a.proxy(this.leave,this))}}this.options.selector?this._options=a.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.getOptions=function(b){return b=a.extend({},this.getDefaults(),this.$element.data(),b),b.delay&&"number"==typeof b.delay&&(b.delay={show:b.delay,hide:b.delay}),b},c.prototype.getDelegateOptions=function(){var b={},c=this.getDefaults();return this._options&&a.each(this._options,function(a,d){c[a]!=d&&(b[a]=d)}),b},c.prototype.enter=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusin"==b.type?"focus":"hover"]=!0),c.tip().hasClass("in")||"in"==c.hoverState?void(c.hoverState="in"):(clearTimeout(c.timeout),c.hoverState="in",c.options.delay&&c.options.delay.show?void(c.timeout=setTimeout(function(){"in"==c.hoverState&&c.show()},c.options.delay.show)):c.show())},c.prototype.isInStateTrue=function(){for(var a in this.inState)if(this.inState[a])return!0;return!1},c.prototype.leave=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);if(c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusout"==b.type?"focus":"hover"]=!1),!c.isInStateTrue())return clearTimeout(c.timeout),c.hoverState="out",c.options.delay&&c.options.delay.hide?void(c.timeout=setTimeout(function(){"out"==c.hoverState&&c.hide()},c.options.delay.hide)):c.hide()},c.prototype.show=function(){var b=a.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(b);var d=a.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(b.isDefaultPrevented()||!d)return;var e=this,f=this.tip(),g=this.getUID(this.type);this.setContent(),f.attr("id",g),this.$element.attr("aria-describedby",g),this.options.animation&&f.addClass("fade");var h="function"==typeof this.