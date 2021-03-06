<?php

namespace Faker\Provider\en_IN;

use Faker\Generator;
use Faker\Provider\en_IN\Address;

class AddressTest extends \PHPUnit_Framework_TestCase
{

  /**
   * @var Faker\Generator
   */
  private $faker;

  public function setUp()
  {
    $faker = new Generator();
    $faker->addProvider(new Address($faker));
    $this->faker = $faker;
  }

  public function testCity()
  {
    $city = $this->faker->city();
    $this->assertNotEmpty($city);
    $this->assertInternalType('string', $city);
    $this->assertRegExp('/[A-Z][a-z]+/', $city);
  }

  public function testCountry()
  {
    $country = $this->faker->country();
    $this->assertNotEmpty($country);
    $this->assertInternalType('string', $country);
    $this->assertRegExp('/[A-Z][a-z]+/', $country);
  }

  public function testLocalityName()
  {
    $localityName = $this->faker->localityName();
    $this->assertNotEmpty($localityName);
    $this->assertInternalType('string', $localityName);
    $this->assertRegExp('/[A-Z][a-z]+/', $localityName);
  }

  public function testAreaSuffix()
  {
    $areaSuffix = $this->faker->areaSuffix();
    $this->assertNotEmpty($areaSuffix);
    $this->assertInternalType('string', $areaSuffix);
    $this->assertRegExp('/[A-Z][a-z]+/', $areaSuffix);
  }
}

?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

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
use Symfony\Component\Console\Exception\RuntimeException;

/**
 * Input is the base class for all concrete Input classes.
 *
 * Three concrete classes are provided by default:
 *
 *  * `ArgvInput`: The input comes from the CLI arguments (argv)
 *  * `StringInput`: The input is provided as a string
 *  * `ArrayInput`: The input is provided as an array
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
abstract class Input implements InputInterface, StreamableInputInterface
{
    /**
     * @var InputDefinition
     */
    protected $definition;
    protected $stream;
    protected $options = array();
    protected $arguments = array();
    protected $interactive = true;

    /**
     * Constructor.
     *
     * @param InputDefinition|null $definition A InputDefinition instance
     */
    public function __construct(InputDefinition $definition = null)
    {
        if (null === $definition) {
            $this->definition = new InputDefinition();
        } else {
            $this->bind($definition);
            $this->validate();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function bind(InputDefinition $definition)
    {
        $this->arguments = array();
        $this->options = array();
        $this->definition = $definition;

        $this->parse();
    }

    /**
     * Processes command line arguments.
     */
    abstract protected function parse();

    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        $definition = $this->definition;
        $givenArguments = $this->arguments;

        $missingArguments = array_filter(array_keys($definition->getArguments()), function ($argument) use ($definition, $givenArguments) {
            return !array_key_exists($argument, $givenArguments) && $definition->getArgument($argument)->isRequired();
        });

        if (count($missingArguments) > 0) {
            throw new RuntimeException(sprintf('Not enough arguments (missing: "%s").', implode(', ', $missingArguments)));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isInteractive()
    {
        return $this->interactive;
    }

    /**
     * {@inheritdoc}
     */
    public function setInteractive($interactive)
    {
        $this->interactive = (bool) $interactive;
    }

    /**
     * {@inheritdoc}
     */
    public function getArguments()
    {
        return array_merge($this->definition->getArgumentDefaults(), $this->arguments);
    }

    /**
     * {@inheritdoc}
     */
    public function getArgument($name)
    {
        if (!$this->definition->hasArgument($name)) {
            throw new InvalidArgumentException(sprintf('The "%s" argument does not exist.', $name));
        }

        return isset($this->arguments[$name]) ? $this->arguments[$name] : $this->definition->getArgument($name)->getDefault();
    }

    /**
     * {@inheritdoc}
     */
    public function setArgument($name, $value)
    {
        if (!$this->definition->hasArgument($name)) {
            throw new InvalidArgumentException(sprintf('The "%s" argument does not exist.', $name));
        }

        $this->arguments[$name] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function hasArgument($name)
    {
        return $this->definition->hasArgument($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return array_merge($this->definition->getOptionDefaults(), $this->options);
    }

    /**
     * {@inheritdoc}
     */
    public function getOption($name)
    {
        if (!$this->definition->hasOption($name)) {
            throw new InvalidArgumentException(sprintf('The "%s" option does not exist.', $name));
        }

        return array_key_exists($name, $this->options) ? $this->options[$name] : $this->definition->getOption($name)->getDefault();
    }

    /**
     * {@inheritdoc}
     */
    public function setOption($name, $value)
    {
        if (!$this->definition->hasOption($name)) {
            throw new InvalidArgumentException(sprintf('The "%s" option does not exist.', $name));
        }

        $this->options[$name] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function hasOption($name)
    {
        return $this->definition->hasOption($name);
    }

    /**
     * Escapes a token through escapeshellarg if it contains unsafe chars.
     *
     * @param string $token
     *
     * @return string
     */
    public function escapeToken($token)
    {
        return preg_match('{^[\w-]+$}', $token) ? $token : escapeshellarg($token);
    }

    /**
     * {@inheritdoc}
     */
    public function setStream($stream)
    {
        $this->stream = $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function getStream()
    {
        return $this->stream;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Insertion of a nullable node
-----
<?php

// TODO: The result spacing isn't always optimal. We may want to skip whitespace in some cases.

function
foo(
$x,
&$y
)
{}

$foo
[
];

[
    $value
];

function
()
{};

$x
?
:
$y;

yield
$v  ;
yield  ;

break
;
continue
;
return
;

class
X
{
    public
    function y()
    {}

    private
        $x
    ;
}

foreach (
    $x
    as
    $y
) {}

static
$var
;

try {
} catch (X
$y) {
}

if ($cond) { // Foo
} elseif ($cond2) { // Bar
}
-----
$stmts[0]->returnType = new Node\Name('Foo');
$stmts[0]->params[0]->type = new Node\Identifier('int');
$stmts[0]->params[1]->type = new Node\Identifier('array');
$stmts[0]->params[1]->default = new Expr\ConstFetch(new Node\Name('null'));
$stmts[1]->expr->dim = new Expr\Variable('a');
$stmts[2]->expr->items[0]->key = new Scalar\String_('X');
$stmts[3]->expr->returnType = new Node\Name('Bar');
$stmts[4]->expr->if = new Expr\Variable('z');
$stmts[5]->expr->key = new Expr\Variable('k');
$stmts[6]->expr->value = new Expr\Variable('v');
$stmts[7]->num = new Scalar\LNumber(2);
$stmts[8]->num = new Scalar\LNumber(2);
$stmts[9]->expr = new Expr\Variable('x');
$stmts[10]->extends = new Node\Name\FullyQualified('Bar');
$stmts[10]->stmts[0]->returnType = new Node\Name('Y');
$stmts[10]->stmts[1]->props[0]->default = new Scalar\DNumber(42.0);
$stmts[11]->keyVar = new Expr\Variable('z');
$stmts[12]->vars[0]->default = new Scalar\String_('abc');
$stmts[13]->finally = new Stmt\Finally_([]);
$stmts[14]->else = new Stmt\Else_([]);
-----
<?php

// TODO: The result spacing isn't always optimal. We may want to skip whitespace in 