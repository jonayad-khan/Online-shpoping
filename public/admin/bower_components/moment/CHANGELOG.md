<?php
/*
 * This file is part of the phpunit-mock-objects package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\MockObject\Builder;

use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\MockObject\Matcher;
use PHPUnit\Framework\MockObject\Matcher\Invocation;
use PHPUnit\Framework\MockObject\RuntimeException;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\MockObject\Stub\MatcherCollection;

/**
 * Builder for mocked or stubbed invocations.
 *
 * Provides methods for building expectations without having to resort to
 * instantiating the various matchers manually. These methods also form a
 * more natural way of reading the expectation. This class should be together
 * with the test case PHPUnit\Framework\MockObject\TestCase.
 */
class InvocationMocker implements MethodNameMatch
{
    /**
     * @var MatcherCollection
     */
    private $collection;

    /**
     * @var Matcher
     */
    private $matcher;

    /**
     * @var string[]
     */
    private $configurableMethods = [];

    /**
     * @param MatcherCollection $collection
     * @param Invocation        $invocationMatcher
     * @param array             $configurableMethods
     */
    public function __construct(MatcherCollection $collection, Invocation $invocationMatcher, array $configurableMethods)
    {
        $this->collection = $collection;
        $this->matcher    = new Matcher($invocationMatcher);

        $this->collection->addMatcher($this->matcher);

        $this->configurableMethods = $configurableMethods;
    }

    /**
     * @return Matcher
     */
    public function getMatcher()
    {
        return $this->matcher;
    }

    /**
     * @param mixed $id
     *
     * @return InvocationMocker
     */
    public function id($id)
    {
        $this->collection->registerId($id, $this);

        return $this;
    }

    /**
     * @param Stub $stub
     *
     * @return InvocationMocker
     */
    public function will(Stub $stub)
    {
        $this->matcher->setStub($stub);

        return $this;
    }

    /**
     * @param mixed $value
     * @param mixed $nextValues, ...
     *
     * @return InvocationMocker
     */
    public function willReturn($value, ...$nextValues)
    {
        if (\count($nextValues) === 0) {
            $stub = new Stub\ReturnStub($value);
        } else {
            $stub = new Stub\ConsecutiveCalls(
                \array_merge([$value], $nextValues)
            );
        }

        return $this->will($stub);
    }

    /**
     * @param mixed $reference
     *
     * @return InvocationMocker
     */
    public function willReturnReference(&$reference)
    {
        $stub = new Stub\ReturnReference($reference);

        return $this->will($stub);
    }

    /**
     * @param array $valueMap
     *
     * @return InvocationMocker
     */
    public function willReturnMap(array $valueMap)
    {
        $stub = new Stub\ReturnValueMap($valueMap);

        return $this->will($stub);
    }

    /**
     * @param mixed $argumentIndex
     *
     * @return InvocationMocker
     */
    public function willReturnArgument($argumentIndex)
    {
        $stub = new Stub\ReturnArgument($argumentIndex);

        return $this->will($stub);
    }

    /**
     * @param callable $callback
     *
     * @return InvocationMocker
     */
    public function willReturnCallback($callback)
    {
        $stub = new Stub\ReturnCallback($callback);

        return $this->will($stub);
    }

    /**
     * @return InvocationMocker
     */
    public function willReturnSelf()
    {
        $stub = new Stub\ReturnSelf;

        return $this->will($stub);
    }

    /**
     * @param mixed $values, ...
     *
     * @return InvocationMocker
     */
    public function willReturnOnConsecutiveCalls(...$values)
    {
        $stub = new Stub\ConsecutiveCalls($values);

        return $this->will($stub);
    }

    /**
     * @param \Exception $exception
     *
     * @return InvocationMocker
     */
    public function willThrowException(\Exception $exception)
    {
        $stub = new Stub\Exception($exception);

        return $this->will($stub);
    }

    /**
     * @param mixed $id
     *
     * @return InvocationMocker
     */
    public function after($id)
    {
        $this->matcher->setAfterMatchBuilderId($id);

        return $this;
    }

    /**
     * @param array ...$arguments
     *
     * @throws RuntimeException
     *
     * @return InvocationMocker
     */
    public function with(...$arguments)
    {
        $this->canDefineParameters();

        $this->matcher->setParametersMatcher(new Matcher\Parameters($arguments));

        return $this;
    }

    /**
     * @param array ...$arguments
     *
     * @throws RuntimeException
     *
     * @return InvocationMocker
     */
    public function withConsecutive(...$arguments)
    {
        $this->canDefineParameters();

        $this->matcher->setParametersMatcher(new Matcher\ConsecutiveParameters($arguments));

        return $this;
    }

    /**
     * @throws RuntimeException
     *
     * @return InvocationMocker
     */
    public function withAnyParameters()
    {
        $this->canDefineParameters();

        $this->matcher->setParametersMatcher(new Matcher\AnyParameters);

        return $this;
    }

    /**
     * @param Constraint|string $constraint
     *
     * @throws RuntimeException
     *
     * @return InvocationMocker
     */
    public function method($constraint)
    {
        if ($this->matcher->hasMethodNameMatcher()) {
            throw new RuntimeException(
                'Method name matcher is already defined, cannot redefine'
            );
        }

        if (\is_string($constraint) && !\in_array(\strtolower($constraint), $this->configurableMethods)) {
            throw new RuntimeException(
                \sprintf(
                    'Trying to configure method "%s" which cannot be configured because it does not exist, has not been specified, is final, or is static',
                    $constraint
                )
            );
        }

        $this->matcher->setMethodNameMatcher(new Matcher\MethodName($constraint));

        return $this;
    }

    /**
     * Validate that a parameters matcher can be defined, throw exceptions otherwise.
     *
     * @throws RuntimeException
     */
    private function canDefineParameters()
    {
        if (!$this->matcher->hasMethodNameMatcher()) {
            throw new RuntimeException(
                'Method name matcher is not defined, cannot define parameter ' .
                'matcher without one'
            );
        }

        if ($this->matcher->hasParametersMatcher()) {
            throw new RuntimeException(
                'Parameter matcher is already defined, cannot redefine'
            );
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prophecy\Argument\Token;

/**
 * Logical AND token.
 *
 * @author Boris Mikhaylov <kaguxmail@gmail.com>
 */
class LogicalAndToken implements TokenInterface
{
    private $tokens = array();

    /**
     * @param array $arguments exact values or tokens
     */
    public function __construct(array $arguments)
    {
        foreach ($arguments as $argument) {
            if (!$argument instanceof TokenInterface) {
                $argument = new ExactValueToken($argument);
            }
            $this->tokens[] = $argument;
        }
    }

    /**
     * Scores maximum score from scores returned by tokens for this argument if all of them score.
     *
     * @param $argument
     *
     * @return bool|int
     */
    public function scoreArgument($argument)
    {
        if (0 === count($this->tokens)) {
            return false;
        }

        $maxScore = 0;
        foreach ($this->tokens as $token) {
            $score = $token->scoreArgument($argument);
            if (false === $score) {
                return false;
            }
            $maxScore = max($score, $maxScore);
        }

        return $maxScore;
    }

    /**
     * Returns false.
     *
     * @return boolean
     */
    public function isLast()
    {
        return false;
    }

    /**
     * Returns string representation for token.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('bool(%s)', implode(' AND ', $this->tokens));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ���� JFIF   d d  �� Ducky     <  �� &Adobe d�    
  �  L  �  ��� � 		



��  P < �� �                                     !01"A#$ 
        !1AQaq2�"𑡱Bb#3��R               `       !1AQaq���� ������    ��5��Y��/k!0F���|X�M�2Vw5�C��-�j�ߌ��r#����}�|��}��j���tV�f���
a�4�V�&�-�gS��Xh��~'8)�K�emި��lqLs��d�[Ir�^o9)�|�?��2���o�c����K)�
MVmKg��  l*�U<L�|����bWJ���瑜3�y,ܨ׆1���xo"2pW��[�e��8��BYr��aN8�p�n��#��/��ҍ}�儶`��O��Y���f'Ǉ�}�
e:%x�G���y����}>@-��k��Y��5��r�gp��%�p���18���=��܉���򼀩�W�N�i��Xe���n��4�p�vD�J��ׅ,�^�W3���YM�2�>?��  􊎏��C����ShUh�hGC�5�6�FF=,�%�&�
�=(�N::��  ����ud�ɐ��!.�>�X�����:���I=���I�RCG�ADzr2�� ?!�� ?!�� ?���*�
x�i½���Q�?+�ةӽk_A;�xg��m(J���W82�<zO�4;�@�+�,-:������(�UCE.�\)�9Fq� @�
2"�zb+�mP�A�|�D��� G����� �yi�ē��iw�7�	���K �2g��D
��N����Q��9~C�
���&�"Ի�g���u'�{��x򏻆}'�^&0�]�e�R��!+ϵ� �l�2|W�˩"G�E��K�u�r��]3�9&��3h�g�0�AZw�/A�s�����P�<�����uUم���)Uk{�|��?R�j�ܼI~S�	ǧ&��js
��Wleډ�u�%wCqZ��&��yi�
PnKB���cG����_E�J��;A	���� ?!����x�&.V���b�]/�Q�� �g	7ϕ̠�s�����c��0V�F"��y��s�9�Ř�"�>�˗��}�����eL��6��*��rs(�]q蹃/[2Y��+E	hrUb1�_�!*hzT��r�O�op���&(нb;[dV2���C�T���=%�5pbU�텩��5��%�c�HJ���L��R�.2����⧭ս��d��ҩA��v��(F��T�����W��R��T��r�\o�f��nۛ��a�.��a�W$L8��C�gk%���-�>�W���r��T��T\Qq����Db�Кr���/唯i^�I��f˲�wk�9���5W[��������K3�y�'}U���s�1��k�ܻV��F�\��iSK�ⷮ#>�N?s!
|��=�J9Կ!�����P6��li�*����A*\�?l]���� ?!�uL���0u�Kt	�іkSH�n�d��t9�w
L�Nf�K�-.g)(#��&��B\�8�x��
���dN���� ?!�W���锾��i��Q��\��f\z�N%�,LD�M*ԹYG!9�s<�ciͩi�ʠ[#���T�x격�},����    {�>k��A~9%�<I�4*F�:�4�7�� ?�ܜ%m�Y1�e���m�%]� � �F��%�����O$
:S� 0��m�%���ü_
�qS�M[K��qE�� m��8g�a�s2�ᷓgqvra����x����������]������ų;�� ����1��I�y���x�%�¾�Cw#�5�%��w��8|DG��G�b���^#+��2T��!���7�,�j�2B+@{������l�T��
�IS���5�s�f� �~{�ƛ�yo�2���n�9��앱D=�p�PU�B���v`����"��-X}��R��,��q���޸*� "E�C�05F�vdKa<�h�@"�#�Մ֦I�RYUVO�����P�F�&.��`i�C����_�@x���d��r��G�e����n�(���<#,�@Xp�o��T�1��;J7J���%:}��;�p����k�Cl�����e�x��� b���z������+�X��a�(-P&�1�{v����2���0j��4/�)�ͯ�J�����7�E���Ad��fW�*����im�xK�w��k�mk�%���ϋ.��pK]%�*脭�^��Y�_��� [v�9�0j��@��=<����iߔ�_�� ?wBQ��7%Ԥw1u�aN�E��TNm�s�&���N#ha�h��P@�--P�P�YZNS(}""��~�V��+�Y�u<L�M@~`n�@�7S9�>�.��oi�[YETY�8���081�K���0b8�F]��-��+�
\�%-Gr����� ?5	F���R�T�7W�.`W|DM�eu��-��QQf��B�3��&Dx,�c�Em�rN�	�+���8fhJC�+B ��Q�C�"Q��K����a�����Z�.�4��zHM�7H�w�W�p�Q�C�ٴK%=�(�����E��bZ�{����                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php

namespace Faker\Provider\ro_MD;

class Payment extends \Faker\Provider\Payment
{
    /**
     * International Bank Account Number (IBAN)
     * @link http://en.wikipedia.org/wiki/International_Bank_Account_Number
     * @param  string  $prefix      for generating bank account number of a specific bank
     * @param  string  $countryCode ISO 3166-1 alpha-2 country code
     * @param  integer $length      total length without country code and 2 check digits
     * @return string
     */
    public static function bankAccountNumber($prefix = '', $countryCode = 'MD', $length = null)
    {
        return static::iban($countryCode, $prefix, $length);
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php
namespace Hamcrest\Text;

class IsEqualIgnoringWhiteSpaceTest extends \Hamcrest\AbstractMatcherTest
{

    private $_matcher;

    public function setUp()
    {
        $this->_matcher = \Hamcrest\Text\IsEqualIgnoringWhiteSpace::equalToIgnoringWhiteSpace(
            "Hello World   how\n are we? "
        );
    }

    protected function createMatcher()
    {
        return $this->_matcher;
    }

    public function testPassesIfWordsAreSameButWhitespaceDiffers()
    {
        assertThat('Hello World how are we?', $this->_matcher);
        assertThat("   Hello \rWorld \t  how are\nwe?", $this->_matcher);
    }

    public function testFailsIfTextOtherThanWhitespaceDiffers()
    {
        assertThat('Hello PLANET how are we?', not($this->_matcher));
        assertThat('Hello World how are we', not($this->_matcher));
    }

    public function testFailsIfWhitespaceIsAddedOrRemovedInMidWord()
    {
        assertThat('HelloWorld how are we?', not($this->_matcher));
        assertThat('Hello Wo rld how are we?', not($this->_matcher));
    }

    public function testFailsIfMatchingAgainstNull()
    {
        assertThat(null, not($this->_matcher));
    }

    public function testHasAReadableDescription()
    {
        $this->assertDescription(
            "equalToIgnoringWhiteSpace(\"Hello World   how\\n are we? \")",
            $this->_matcher
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

namespace Illuminate\Database\Schema;

use Closure;
use Illuminate\Support\Fluent;
use Illuminate\Database\Connection;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Database\Schema\Grammars\Grammar;

class Blueprint
{
    use Macroable;

    /**
     * The table the blueprint describes.
     *
     * @var string
     */
    protected $table;

    /**
     * The columns that should be added to the table.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * The commands that should be run for the table.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * The storage engine that should be used for the table.
     *
     * @var string
     */
    public $engine;

    /**
     * The default character set that should be used for the table.
     */
    public $charset;

    /**
     * The collation that should be used for the table.
     */
    public $collation;

    /**
     * Whether to make the table temporary.
     *
     * @var bool
     */
    public $temporary = false;

    /**
     * Create a new schema blueprint.
     *
     * @param  string  $table
     * @param  \Closure|null  $callback
     * @return void
     */
    public function __construct($table, Closure $callback = null)
    {
        $this->table = $table;

        if (! is_null($callback)) {
            $callback($this);
        }
    }

    /**
     * Execute the blueprint against the database.
     *
     * @param  \Illuminate\Database\Connection  $connection
     * @param  \Illuminate\Database\Schema\Grammars\Grammar $grammar
     * @return void
     */
    public function build(Connection $connection, Grammar $grammar)
    {
        foreach ($this->toSql($connection, $grammar) as $statement) {
            $connection->statement($statement);
        }
    }

    /**
     * Get the raw SQL statements for the blueprint.
     *
     * @param  \Illuminate\Database\Connection  $connection
     * @param  \Illuminate\Database\Schema\Grammars\Grammar  $grammar
     * @return array
     */
    public function toSql(Connection $connection, Grammar $grammar)
    {
        $this->addImpliedCommands();

        $statements = [];

        // Each type of command has a corresponding compiler function on the schema
        // grammar which is used to build the necessary SQL statements to build
        // the blueprint element, so we'll just call that compilers function.
        foreach ($this->commands as $command) {
            $method = 'compile'.ucfirst($command->name);

            if (method_exists($grammar, $method)) {
                if (! is_null($sql = $grammar->$method($this, $command, $connection))) {
                    $statements = array_merge($statements, (array) $sql);
                }
            }
        }

        return $statements;
    }

    /**
     * Add the commands that are implied by the blueprint's state.
     *
     * @return void
     */
    protected function addImpliedCommands()
    {
        if (count($this->getAddedColumns()) > 0 && ! $this->creating()) {
            array_unshift($this->commands, $this->createCommand('add'));
        }

        if (count($this->getChangedColumns()) > 0 && ! $this->creating()) {
            array_unshift($this->commands, $this->createCommand('change'));
        }

        $this->addFluentIndexes();
    }

    /**
     * Add the index commands fluently specified on columns.
     *
     * @return void
     */
    protected function addFluentIndexes()
    {
        foreach ($this->columns as $column) {
            foreach (['primary', 'unique', 'index', 'spatialIndex'] as $index) {
                // If the index has been specified on the given column, but is simply equal
                // to "true" (boolean), no name has been specified for this index so the
                // index method can be called without a name and it will generate one.
                if ($column->{$index} === true) {
                    $this->{$index}($column->name);

                    continue 2;
                }

                // If the index has been specified on the given column, and it has a string
                // value, we'll go ahead and call the index method and pass the name for
                // the index since the developer specified the explicit name for this.
                elseif (isset($column->{$index})) {
                    $this->{$index}($column->name, $column->{$index});

                    continue 2;
                }
            }
        }
    }

    /**
     * Determine if the blueprint has a create command.
     *
     * @return bool
     */
    protected function creating()
    {
        return collect($this->commands)->contains(function ($command) {
            return $command->name == 'create';
        });
    }

    /**
     * Indicate that the table needs to be created.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function create()
    {
        return $this->addCommand('create');
    }

    /**
     * Indicate that the table needs to be temporary.
     *
     * @return void
     */
    public function temporary()
    {
        $this->temporary = true;
    }

    /**
     * Indicate that the table should be dropped.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function drop()
    {
        return $this->addCommand('drop');
    }

    /**
     * Indicate that the table should be dropped if it exists.
     *
     * @return \Illuminate\Support\Fluent
     */
    public function dropIfExists()
    {
        return $this->addCommand('dropIfExists');
    }

    /**
     * Indicate that the given columns should be dropped.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Support\Fluent
     */
    public function dropColumn($columns)
    {
        $columns = is_array($columns) ? $columns : func_get_args();

        return $this->addCommand('dropColumn', compact('columns'));
    }

    /**
     * Indicate that the given columns should be renamed.
     *
     * @param  string  $from
     * @param  string  $to
     * @return \Illuminate\Support\Fluent
     */
    public function renameColumn($from, $to)
    {
        return $this->addCommand('renameColumn', compact('from', 'to'));
    }

    /**
     * Indicate that the given primary key should be dropped.
     *
     * @param  string|array  $index
     * @return \Illuminate\Support\Fluent
     */
    public function dropPrimary($index = null)
    {
        return $this->dropIndexCommand('dropPrimary', 'primary', $index);
    }

    /**
     * Indicate that the given unique key should be dropped.
     *
     * @param  string|array  $index
     * @return \Illuminate\Support\Fluent
     */
    public function dropUnique($index)
    {
        return $this->dropIndexCommand('dropUnique', 'unique', $index);
    }

    /**
     * Indicate that the given index should be dropped.
     *
     * @param  string|array  $index
     * @return \Illuminate\Support\Fluent
     */
    public function dropIndex($index)
    {
        return $this->dropIndexCommand('dropIndex', 'index', $index);
    }

    /**
     * Indicate that the given foreign key should be dropped.
     *
     * @param  string|array  $index
     * @return \Illuminate\Support\Fluent
     */
    public function dropForeign($index)
    {
        return $this->dropIndexCommand('dropForeign', 'foreign', $index);
    }

    /**
     * Indicate that the timestamp columns should be dropped.
     *
     * @return void
     */
    public function dropTimestamps()
    {
        $this->dropColumn('created_at', 'updated_at');
    }

    /**
     * Indicate that the timestamp columns should be dropped.
     *
     * @return void
     */
    public function dropTimestampsTz()
    {
        $this->dropTimestamps();
    }

    /**
     * Indicate that the soft delete column should be dropped.
     *
     * @return void
     */
    public function dropSoftDeletes()
    {
        $this->dropColumn('deleted_at');
    }

    /**
     * Indicate that the soft delete column should be dropped.
     *
     * @return void
     */
    public function dropSoftDeletesTz()
    {
        $this->dropSoftDeletes();
    }

    /**
     * Indicate that the remember token column should be dropped.
     *
     * @return void
     */
    public function dropRememberToken()
    {
        $this->dropColumn('remember_token');
    }

    /**
     * Rename the table to a given name.
     *
     * @param  string  $to
     * @return \Illuminate\Support\Fluent
     */
    public function rename($to)
    {
        return $this->addCommand('rename', compact('to'));
    }

    /**
     * Specify the primary key(s) for the table.
     *
     * @param  string|array  $columns
     * @param  string  $name
     * @param  string|null  $algorithm
     * @return \Illuminate\Support\Fluent
     */
    public function primary($columns, $name = null, $algorithm = null)
    {
        return $this->indexCommand('primary', $columns, $name, $algorithm);
    }

    /**
     * Specify a unique index for the table.
     *
     * @param  string|array  $columns
     * @param  string  $name
     * @param  string|null  $algorithm
     * @return \Illuminate\Support\Fluent
     */
    public function unique($columns, $name = null, $algorithm = null)
    {
        return $this->indexCommand('unique', $columns, $name, $algorithm);
    }

    /**
     * Specify an index for the table.
     *
     * @param  string|array  $columns
     * @param  string  $name
     * @param  string|null  $algorithm
     * @return \Illuminate\Support\Fluent
     */
    public function index($columns, $name = null, $algorithm = null)
    {
        return $this->indexCommand('index', $columns, $name, $algorithm);
    }

    /**
     * Specify a spatial index for the table.
     *
     * @param  string|array  $columns
     * @param  string        $name
     * @return \Illuminate\Support\Fluent
     */
    public function spatialIndex($columns, $name = null)
    {
        return $this->indexCommand('spatialIndex', $columns, $name);
    }

    /**
     * Specify a foreign key for the table.
     *
     * @param  string|array  $columns
     * @param  string  $name
     * @return \Illuminate\Support\Fluent
     */
    public function foreign($columns, $name = null)
    {
        return $this->indexCommand('foreign', $columns, $name);
    }

    /**
     * Create a new auto-incrementing integer (4-byte) column on the table.
     *
     * @param  string  $column
   