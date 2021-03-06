s})";
    }

    /**
     * Create the column definition for a boolean type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeBoolean(Fluent $column)
    {
        return 'boolean';
    }

    /**
     * Create the column definition for an enum type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeEnum(Fluent $column)
    {
        $allowed = array_map(function ($a) {
            return "'{$a}'";
        }, $column->allowed);

        return "varchar(255) check (\"{$column->name}\" in (".implode(', ', $allowed).'))';
    }

    /**
     * Create the column definition for a json type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeJson(Fluent $column)
    {
        return 'json';
    }

    /**
     * Create the column definition for a jsonb type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeJsonb(Fluent $column)
    {
        return 'jsonb';
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
        return "timestamp($column->precision) without time zone";
    }

    /**
     * Create the column definition for a date-time type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeDateTimeTz(Fluent $column)
    {
        return "timestamp($column->precision) with time zone";
    }

    /**
     * Create the column definition for a time type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeTime(Fluent $column)
    {
        return 'time(0) without time zone';
    }

    /**
     * Create the column definition for a time type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeTimeTz(Fluent $column)
    {
        return 'time(0) with time zone';
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
            return "timestamp($column->precision) without time zone default CURRENT_TIMESTAMP($column->precision)";
        }

        return "timestamp($column->precision) without time zone";
    }

    /**
     * Create the column definition for a timestamp type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeTimestampTz(Fluent $column)
    {
        if ($column->useCurrent) {
            return "timestamp($column->precision) with time zone default CURRENT_TIMESTAMP($column->precision)";
        }

        return "timestamp($column->precision) with time zone";
    }

    /**
     * Create the column definition for a binary type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeBinary(Fluent $column)
    {
        return 'bytea';
    }

    /**
     * Create the column definition for a uuid type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeUuid(Fluent $column)
    {
        return 'uuid';
    }

    /**
     * Create the column definition for an IP address type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeIpAddress(Fluent $column)
    {
        return 'inet';
    }

    /**
     * Create the column definition for a MAC address type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeMacAddress(Fluent $column)
    {
        return 'macaddr';
    }

    /**
     * Create the column definition for a geometry type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @throws \Exception
     */
    protected function typeGeometry(Fluent $column)
    {
        throw new Exception('Geometry data type not supported for current database engine.');
    }

    /**
     * Create the column definition for a point type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typePoint(Fluent $column)
    {
        return $this->formatPostGisType('point');
    }

    /**
     * Create the column definition for a linestring type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeLinestring(Fluent $column)
    {
        return $this->formatPostGisType('linestring');
    }

    /**
     * Create the column definition for a polygon type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typePolygon(Fluent $column)
    {
        return $this->formatPostGisType('polygon');
    }

    /**
     * Create the column definition for a geometrycollection type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeGeometrycollection(Fluent $column)
    {
        return $this->formatPostGisType('geometrycollection');
    }

    /**
     * Create the column definition for a multipoint type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeMultipoint(Fluent $column)
    {
        return $this->formatPostGisType('multipoint');
    }

    /**
     * Create the column definition for a multilinestring type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    public function typeMultilinestring(Fluent $column)
    {
        return $this->formatPostGisType('multilinestring');
    }

    /**
     * Create the column definition for a multipolygon type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeMultipolygon(Fluent $column)
    {
        return $this->formatPostGisType('multipolygon');
    }

    /**
     * @param  string  $type
     * @return string
     */
    private function formatPostGisType(string $type)
    {
        return "geography({$type}, 4326)";
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
            return ' primary key';
        }
    }
}
                                                                                                                                                                                                                  <?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prophecy\Promise;

use Prophecy\Exception\InvalidArgumentException;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\MethodProphecy;

/**
 * Return argument promise.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class ReturnArgumentPromise implements PromiseInterface
{
    /**
     * @var int
     */
    private $index;

    /**
     * Initializes callback promise.
     *
     * @param int $index The zero-indexed number of the argument to return
     *
     * @throws \Prophecy\Exception\InvalidArgumentException
     */
    public function __construct($index = 0)
    {
        if (!is_int($index) || $index < 0) {
            throw new InvalidArgumentException(sprintf(
                'Zero-based index expected as argument to ReturnArgumentPromise, but got %s.',
                $index
            ));
        }
        $this->index = $index;
    }

    /**
     * Returns nth argument if has one, null otherwise.
     *
     * @param array          $args
     * @param ObjectProphecy $object
     * @param MethodProphecy $method
     *
     * @return null|mixed
     */
    public function execute(array $args, ObjectProphecy $object, MethodProphecy $method)
    {
        return count($args) > $this->index ? $args[$this->index] : null;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Framework;

class SuiteTest extends TestCase
{
    /**
     * @var TestResult
     */
    private $result;

    protected function setUp()
    {
        $this->result = new TestResult;
    }

    public static function suite()
    {
        $suite = new TestSuite;

        $suite->addTest(new self('testAddTestSuite'));
        $suite->addTest(new self('testInheritedTests'));
        $suite->addTest(new self('testNoTestCases'));
        $suite->addTest(new self('testNoTestCaseClass'));
        $suite->addTest(new self('testNotExistingTestCase'));
        $suite->addTest(new self('testNotPublicTestCase'));
        $suite->addTest(new self('testNotVoidTestCase'));
        $suite->addTest(new self('testOneTestCase'));
        $suite->addTest(new self('testShadowedTests'));
        $suite->addTest(new self('testBeforeClassAndAfterClassAnnotations'));
        $suite->addTest(new self('testBeforeClassWithDataProviders'));
        $suite->addTest(new self('testBeforeAnnotation'));
        $suite->addTest(new self('testTestWithAnnotation'));
        $suite->addTest(new self('testSkippedTestDataProvider'));
        $suite->addTest(new self('testTestDataProviderDependency'));
        $suite->addTest(new self('testIncompleteTestDataProvider'));
        $suite->addTest(new self('testRequirementsBeforeClassHook'));
        $suite->addTest(new self('testDoNotSkipInheritedClass'));

        return $suite;
    }

    public function testAddTestSuite()
    {
        $suite = new TestSuite(\OneTestCase::class);

        $suite->run($this->result);

        $this->assertCount(1, $this->result);
    }

    public function testInheritedTests()
    {
        $suite = new TestSuite(\InheritedTestCase::class);

        $suite->run($this->result);

        $this->assertTrue($this->result->wasSuccessful());
        $this->assertCount(2, $this->result);
    }

    public function testNoTestCases()
    {
        $suite = new TestSuite(\NoTestCases::class);

        $suite->run($this->result);

        $this->assertNotTrue($this->result->wasSuccessful());
        $this->assertEquals(0, $this->result->failureCount());
        $this->assertEquals(1, $this->result->warningCount());
        $this->assertCount(1, $this->result);
    }

    public function testNoTestCaseClass()
    {
        $this->expectException(Exception::class);

        new TestSuite(\NoTestCaseClass::class);
    }

    public function testNotExistingTestCase()
    {
        $suite = new self('notExistingMethod');

        $suite->run($this->result);

        $this->assertEquals(0, $this->result->errorCount());
        $this->assertEquals(1, $this->result->failureCount());
        $this->assertCount(1, $this->result);
    }

    public function testNotPublicTestCase()
    {
        $suite = new TestSuite(\NotPublicTestCase::class);

        $this->assertCount(2, $suite);
    }

    public function testNotVoidTestCase()
    {
        $suite = new TestSuite(\NotVoidTestCase::class);

        $this->assertCount(1, $suite);
    }

    public function testOneTestCase()
    {
        $suite = new TestSuite(\OneTestCase::class);

        $suite->run($this->result);

        $this->assertEquals(0, $this->result->errorCount());
        $this->assertEquals(0, $this->result->failureCount());
        $this->assertCount(1, $this->result);
        $this->assertTrue($this->result->wasSuccessful());
    }

    public function testShadowedTests()
    {
        $suite = new TestSuite(\OverrideTestCase::class);

        $suite->run($this->result);

        $this->assertCount(1, $this->result);
    }

    public function testBeforeClassAndAfterClassAnnotations()
    {
        $suite = new TestSuite(\BeforeClassAndAfterClassTest::class);

        \BeforeClassAndAfterClassTest::resetProperties();
        $suite->run($this->result);

        $this->assertEquals(1, \BeforeClassAndAfterClassTest::$beforeClassWasRun, '@beforeClass method was not run once for the whole suite.');
        $this->assertEquals(1, \BeforeClassAndAfterClassTest::$afterClassWasRun, '@afterClass method was not run once for the whole suite.');
    }

    public function testBeforeClassWithDataProviders()
    {
        $suite = new TestSuite(\BeforeClassWithOnlyDataProviderTest::class);

        \BeforeClassWithOnlyDataProviderTest::resetProperties();
        $suite->run($this->result);

        $this->assertTrue(\BeforeClassWithOnlyDataProviderTest::$setUpBeforeClassWasCalled, 'setUpBeforeClass method was not run.');
        $this->assertTrue(\BeforeClassWithOnlyDataProviderTest::$beforeClassWasCalled, '@beforeClass method was not run.');
    }

    public function testBeforeAnnotation()
    {
        $test = new TestSuite(\BeforeAndAfterTest::class);

        \BeforeAndAfterTest::resetProperties();
        $test->run();

        $this->assertEquals(2, \BeforeAndAfterTest::$beforeWasRun);
        $this->assertEquals(2, \BeforeAndAfterTest::$afterWasRun);
    }

    public function testTestWithAnnotation()
    {
        $test = new TestSuite(\TestWithTest::class);

        \BeforeAndAfterTest::resetProperties();
        $result = $test->run();

        $this->assertCount(4, $result->passed());
    }

    public function testSkippedTestDataProvider()
    {
        $suite = new TestSuite(\DataProviderSkippedTest::class);

        $suite->run($this->result);

        $this->assertEquals(3, $this->result->count());
        $this->assertEquals(1, $this->result->skippedCount());
    }

    public function testTestDataProviderDependency()
    {
        $suite = new TestSuite(\DataProviderDependencyTest::class);

        $suite->run($this->result);

        $skipped           = $this->result->skipped();
        $lastSkippedResult = \array_pop($skipped);
        $message           = $lastSkippedResult->thrownException()->getMessage();

        $this->assertContains('Test for DataProviderDependencyTest::testDependency skipped by data provider', $message);
    }

    public function testIncompleteTestDataProvider()
    {
        $suite = new TestSuite(\DataProviderIncompleteTest::class);

        $suite->run($this->result);

        $this->assertEquals(3, $this->result->count());
        $this->assertEquals(1, $this->result->notImplementedCount());
    }

    public function testRequirementsBeforeClassHook()
    {
        $suite = new TestSuite(\RequirementsClassBeforeClassHookTest::class);

        $suite->run($this->result);

        $this->assertEquals(0, $this->result->errorCount());
        $this->assertEquals(1, $this->result->skippedCount());
    }

    public function testDoNotSkipInheritedClass()
    {
        $suite = new TestSuite(
            'DontSkipInheritedClass'
        );

        $dir = \dirname(__DIR__) . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'Inheritance' . DIRECTORY_SEPARATOR;

        $suite->addTestFile($dir . 'InheritanceA.php');
        $suite->addTestFile($dir . 'InheritanceB.php');

        $result = $suite->run();

        $this->assertCount(2, $result);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

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
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Stmt\Do_;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Stmt\If_;
use PhpParser\Node\Stmt\Switch_;
use PhpParser\Node\Stmt\While_;
use Psy\Exception\FatalErrorException;

/**
 * Validate that function calls will succeed.
 *
 * This pass throws a FatalErrorException rather than letting PHP run
 * headfirst into a real fatal error and die.
 */
class ValidFunctionNamePass extends NamespaceAwarePass
{
    private $conditionalScopes = 0;

    /**
     * Store newly defined function names on the way in, to allow recursion.
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        parent::enterNode($node);

        if (self::isConditional($node)) {
            $this->conditionalScopes++;
        } elseif ($node instanceof Function_) {
            $name = $this->getFullyQualifiedName($node->name);

            // @todo add an "else" here which adds a runtime check for instances where we can't tell
            // whether a function is being redefined by static analysis alone.
            if ($this->conditionalScopes === 0) {
                if (function_exists($name) ||
                    isset($this->currentScope[strtolower($name)])) {
                    $msg = sprintf('Cannot redeclare %s()', $name);
                    throw new FatalErrorException($msg, 0, E_ERROR, null, $node->getLine());
                }
            }

            $this->currentScope[strtolower($name)] = true;
        }
    }

    /**
     * Validate that function calls will succeed.
     *
     * @throws FatalErrorException if a function is redefined
     * @throws FatalErrorException if the function name is a string (not an expression) and is not defined
     *
     * @param Node $node
     */
    public function leaveNode(Node $node)
    {
        if (self::isConditional($node)) {
            $this->conditionalScopes--;
        } elseif ($node instanceof FuncCall) {
            // if function name is an expression or a variable, give it a pass for now.
            $name = $node->name;
            if (!$name instanceof Expr && !$name instanceof Variable) {
                $shortName = implode('\\', $name->parts);
                $fullName  = $this->getFullyQualifiedName($name);
                $inScope = isset($this->currentScope[strtolower($fullName)]);
                if (!$inScope && !function_exists($shortName) && !function_exists($fullName)) {
                    $message = sprintf('Call to undefined function %s()', $name);
                    throw new FatalErrorException($message, 0, E_ERROR, null, $node->getLine());
                }
            }
        }
    }

    private static function isConditional(Node $node)
    {
        return $node instanceof If_ ||
            $node instanceof While_ ||
            $node instanceof Do_ ||
            $node instanceof Switch_;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php
$header = <<<'EOF'
This file is part of object-reflector.

(c) Sebastian Bergmann <sebastian@phpunit.de>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules(
        [
            'array_syntax' => ['syntax' => 'short'],
            'binary_operator_spaces' => [
                'align_double_arrow' => true,
                'align_equals' => true
            ],
            'blank_line_after_namespace' => true,
            'blank_line_before_return' => true,
            'braces' => true,
            'cast_spaces' => true,
            'concat_space' => ['spacing' => 'one'],
            'declare_strict_types' => true,
            'elseif' => true,
            'encoding' => true,
            'full_opening_tag' => true,
            'function_declaration' => true,
            #'header_comment' => ['header' => $header, 'separate' => 'none'],
            'indentation_type' => true,
            'line_ending' => true,
            'lowercase_constants' => true,
            'lowercase_keywords' => true,
            'method_argument_space' => true,
            'no_alias_functions' => true,
            'no_blank_lines_after_class_opening' => true,
            'no_blank_lines_after_phpdoc' => true,
            'no_closing_tag' => true,
            'no_empty_phpdoc' => true,
            'no_empty_statement' => true,
            'no_extra_consecutive_blank_lines' => true,
            'no_leading_namespace_whitespace' => true,
            'no_singleline_whitespace_before_semicolons' => true,
            'no_spaces_after_function_name' => true,
            'no_spaces_inside_parenthesis' => true,
            'no_trailing_comma_in_list_call' => true,
            'no_trailing_whitespace' => true,
            'no_unused_imports' => true,
            'no_whitespace_in_blank_line' => true,
            'phpdoc_align' => true,
            'phpdoc_indent' => true,
            'phpdoc_no_access' => true,
            'phpdoc_no_empty_return' => true,
            'phpdoc_no_package' => true,
            'phpdoc_scalar' => true,
            'phpdoc_separation' => true,
            'phpdoc_to_comment' => true,
            'phpdoc_trim' => true,
            'phpdoc_types' => true,
            'phpdoc_var_without_name' => true,
            'self_accessor' => true,
            'simplified_null_return' => true,
            'single_blank_line_at_eof' => true,
            'single_import_per_statement' => true,
            'single_line_after_imports' => true,
            'single_quote' => true,
            'ternary_operator_spaces' => true,
            'trim_array_spaces' => true,
            'visibility_required' => true,
        ]
    )
    ->setFinder(
        PhpCsFixer\Finder::create()
        ->files()
        ->in(__DIR__ . '/src')
        ->in(__DIR__ . '/tests')
        ->name('*.php')
    );
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    {
    "name": "symfony/console",
    "type": "library",
    "description": "Symfony Console Component",
    "keywords": [],
    "homepage": "https://symfony.com",
    "license": "MIT",
    "authors": [
        {
            "name": "Fabien Potencier",
            "email": "fabien@symfony.com"
        },
        {
            "name": "Symfony Community",
            "homepage": "https://symfony.com/contributors"
        }
    ],
    "require": {
        "php": "^5.5.9|>=7.0.8",
        "symfony/polyfill-mbstring": "~1.0",
        "symfony/debug": "~2.8|~3.0"
    },
    "require-dev": {
        "symfony/config": "~3.3",
        "symfony/event-dispatcher": "~2.8|~3.0",
        "symfony/dependency-injection": "~3.3",
        "symfony/filesystem": "~2.8|~3.0",
        "symfony/process": "~2.8|~3.0",
        "psr/log": "~1.0"
    },
    "suggest": {
        "symfony/event-dispatcher": "",
        "symfony/filesystem": "",
        "symfony/process": "",
        "psr/log": "For using the console logger"
    },
    "conflict": {
        "symfony/dependency-injection": "<3.3"
    },
    "autoload": {
        "psr-4": { "Symfony\\Component\\Console\\": "" },
        "exclude-from-classmap": [
            "/Tests/"
        ]
    },
    "minimum-stability": "dev",
    "extra": {
        "branch-alias": {
            "dev-master": "3.3-dev"
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

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
 * The EventDispatcherInterface is the central point of Symfony's event listener system.
 * Listeners are registered on the manager and events are dispatched through the
 * manager.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
interface EventDispatcherInterface
{
    /**
     * Dispatches an event to all registered listeners.
     *
     * @param string $eventName The name of the event to dispatch. The name of