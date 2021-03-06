<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prophecy\PhpDocumentor;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tag\MethodTag as LegacyMethodTag;

/**
 * @author Théo FIDRY <theo.fidry@gmail.com>
 *
 * @internal
 */
final class LegacyClassTagRetriever implements MethodTagRetrieverInterface
{
    /**
     * @param \ReflectionClass $reflectionClass
     *
     * @return LegacyMethodTag[]
     */
    public function getTagList(\ReflectionClass $reflectionClass)
    {
        $phpdoc = new DocBlock($reflectionClass->getDocComment());

        return $phpdoc->getTagsByName('method');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php
use PHPUnit\Framework\TestCase;
use SebastianBergmann\CodeCoverage\CodeCoverage;

if (!defined('STDOUT')) {
    // php://stdout does not obey output buffering. Any output would break
    // unserialization of child process results in the parent process.
    define('STDOUT', fopen('php://temp', 'w+b'));
    define('STDERR', fopen('php://stderr', 'wb'));
}

{iniSettings}
ini_set('display_errors', 'stderr');
set_include_path('{include_path}');

$composerAutoload = {composerAutoload};
$phar             = {phar};

ob_start();

if ($composerAutoload) {
    require_once $composerAutoload;
    define('PHPUNIT_COMPOSER_INSTALL', $composerAutoload);
} else if ($phar) {
    require $phar;
}

function __phpunit_run_isolated_test()
{
    if (!class_exists('{className}')) {
        require_once '{filename}';
    }

    $result = new PHPUnit\Framework\TestResult;

    if ({collectCodeCoverageInformation}) {
        $result->setCodeCoverage(
            new CodeCoverage(
                null,
                unserialize('{codeCoverageFilter}')
            )
        );
    }

    $result->beStrictAboutTestsThatDoNotTestAnything({isStrictAboutTestsThatDoNotTestAnything});
    $result->beStrictAboutOutputDuringTests({isStrictAboutOutputDuringTests});
    $result->enforceTimeLimit({enforcesTimeLimit});
    $result->beStrictAboutTodoAnnotatedTests({isStrictAboutTodoAnnotatedTests});
    $result->beStrictAboutResourceUsageDuringSmallTests({isStrictAboutResourceUsageDuringSmallTests});

    /** @var TestCase $test */
    $test = new {className}('{methodName}', unserialize('{data}'), '{dataName}');
    $test->setDependencyInput(unserialize('{dependencyInput}'));
    $test->setInIsolation(TRUE);

    ob_end_clean();
    $test->run($result);
    $output = '';
    if (!$test->hasExpectationOnOutput()) {
        $output = $test->getActualOutput();
    }

    @rewind(STDOUT); /* @ as not every STDOUT target stream is rewindable */
    if ($stdout = stream_get_contents(STDOUT)) {
        $output = $stdout . $output;
        $streamMetaData = stream_get_meta_data(STDOUT);
        if (!empty($streamMetaData['stream_type']) && 'STDIO' === $streamMetaData['stream_type']) {
            @ftruncate(STDOUT, 0);
            @rewind(STDOUT);
        }
    }

    print serialize(
      array(
        'testResult'    => $test->getResult(),
        'numAssertions' => $test->getNumAssertions(),
        'result'        => $result,
        'output'        => $output
      )
    );
}

$configurationFilePath = '{configurationFilePath}';

if ('' !== $configurationFilePath) {
    $configuration = PHPUnit\Util\Configuration::getInstance($configurationFilePath);
    $configuration->handlePHPConfiguration();
    unset($configuration);
}

function __phpunit_error_handler($errno, $errstr, $errfile, $errline, $errcontext)
{
   return true;
}

set_error_handler('__phpunit_error_handler');

{constants}
{included_files}
{globals}

restore_error_handler();

if (isset($GLOBALS['__PHPUNIT_BOOTSTRAP'])) {
    require_once $GLOBALS['__PHPUNIT_BOOTSTRAP'];
    unset($GLOBALS['__PHPUNIT_BOOTSTRAP']);
}

__phpunit_run_isolated_test();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php

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
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Expr\Instanceof_;
use PhpParser\Node\Scalar;
use PhpParser\Node\Scalar\Encapsed;
use Psy\Exception\FatalErrorException;

/**
 * Validate that the instanceof statement does not receive a scalar value or a non-class constant.
 *
 * @author Martin Hasoň <martin.hason@gmail.com>
 */
class InstanceOfPass extends CodeCleanerPass
{
    const EXCEPTION_MSG = 'instanceof expects an object instance, constant given';

    /**
     * Validate that the instanceof statement does not receive a scalar value or a non-class constant.
     *
     * @throws FatalErrorException if a scalar or a non-class constant is given
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Instanceof_) {
            return;
        }

        if (($node->expr instanceof Scalar && !$node->expr instanceof Encapsed) || $node->expr instanceof ConstFetch) {
            throw new FatalErrorException(self::EXCEPTION_MSG, 0, E_ERROR, null, $node->getLine());
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       