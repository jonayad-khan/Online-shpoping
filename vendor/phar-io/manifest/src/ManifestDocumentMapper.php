      $code = '<?php' . "\n" . $prettyPrinter->prettyPrint($stmts);
        $ppTime += microtime(true) - $startTime;

        try {
            $startTime = microtime(true);
            $ppStmts = $parser->parse($code);
            $reparseTime += microtime(true) - $startTime;

            $startTime = microtime(true);
            $same = $nodeDumper->dump($stmts) == $nodeDumper->dump($ppStmts);
            $compareTime += microtime(true) - $startTime;

            if (!$same) {
                echo $file, ":\n    Result of initial parse and parse after pretty print differ\n";
                if ($verbose) {
                    echo "Pretty printer output:\n=====\n$code\n=====\n\n";
                }

                ++$compareFail;
            }
        } catch (PhpParser\Error $e) {
            echo $file, ":\n    Parse of pretty print failed with message: {$e->getMessage()}\n";
            if ($verbose) {
                echo "Pretty printer output:\n=====\n$code\n=====\n\n";
            }

            ++$ppFail;
        }
    } catch (PhpParser\Error $e) {
        echo $file, ":\n    Parse failed with message: {$e->getMessage()}\n";

        ++$parseFail;
    }
}

if (0 === $parseFail && 0 === $ppFail && 0 === $compareFail) {
    $exit = 0;
    echo "\n\n", 'All tests passed.', "\n";
} else {
    $exit = 1;
    echo "\n\n", '==========', "\n\n", 'There were: ', "\n";
    if (0 !== $parseFail) {
        echo '    ', $parseFail,   ' parse failures.',        "\n";
    }
    if (0 !== $ppFail) {
        echo '    ', $ppFail,      ' pretty print failures.', "\n";
    }
    if (0 !== $compareFail) {
        echo '    ', $compareFail, ' compare failures.',      "\n";
    }
}

echo "\n",
     'Tested files:         ', $count,        "\n",
     "\n",
     'Reading files took:   ', $readTime,    "\n",
     'Parsing took:         ', $parseTime,   "\n",
     'Pretty printing took: ', $ppTime,      "\n",
     'Reparsing took:       ', $reparseTime, "\n",
     'Comparing took:       ', $compareTime, "\n",
     "\n",
     'Total time:           ', microtime(true) - $totalStartTime, "\n",
     'Maximum memory usage: ', memory_get_peak_usage(true), "\n";

exit($exit);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              <?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prophecy\Exception\Call;

use Prophecy\Exception\Prophecy\ObjectProphecyException;
use Prophecy\Prophecy\ObjectProphecy;

class UnexpectedCallException extends ObjectProphecyException
{
    private $methodName;
    private $arguments;

    public function __construct($message, ObjectProphecy $objectProphecy,
                                $methodName, array $arguments)
    {
        parent::__construct($message, $objectProphecy);

        $this->methodName = $methodName;
        $this->arguments = $arguments;
    }

    public function getMethodName()
    {
        return $this->methodName;
    }

    public function getArguments()
    {
        return $this->arguments;
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               