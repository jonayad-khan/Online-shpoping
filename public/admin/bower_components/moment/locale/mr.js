<?php
/*
 * This file is part of sebastian/environment.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SebastianBergmann\Environment;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SebastianBergmann\Environment\Console
 */
final class ConsoleTest extends TestCase
{
    /**
     * @var \SebastianBergmann\Environment\Console
     */
    private $console;

    protected function setUp()/*: void*/
    {
        $this->console = new Console;
    }

    /**
     * @todo Now that this component is PHP 7-only and uses return type declarations
     * this test makes even less sense than before
     */
    public function testCanDetectIfStdoutIsInteractiveByDefault()/*: void*/
    {
        $this->assertInternalType('boolean', $this->console->isInteractive());
    }

    /**
     * @todo Now that this component is PHP 7-only and uses return type declarations
     * this test makes even less sense than before
     */
    public function testCanDetectIfFileDescriptorIsInteractive()/*: void*/
    {
        $this->assertInternalType('boolean', $this->console->isInteractive(STDOUT));
    }

    /**
     * @todo Now that this component is PHP 7-only and uses return type declarations
     * this test makes even less sense than before
     */
    public function testCanDetectColorSupport()/*: void*/
    {
        $this->assertInternalType('boolean', $this->console->hasColorSupport());
    }

    /**
     * @todo Now that this component is PHP 7-only and uses return type declarations
     * this test makes even less sense than before
     */
    public function testCanDetectNumberOfColumns()/*: void*/
    {
        $this->assertInternalType('integer', $this->console->getNumberOfColumns());
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\DataCollector\Util;

@trigger_error('The '.__NAMESPACE__.'\ValueExporter class is deprecated since version 3.2 and will be removed in 4.0. Use the VarDumper component instead.', E_USER_DEPRECATED);

/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 *
 * @deprecated since version 3.2, to be removed in 4.0. Use the VarDumper component instead.
 */
class ValueExporter
{
    /**
     * Converts a PHP value to a string.
     *
     * @param mixed $value The PHP value
     * @param int   $depth only for internal usage
     * @param bool  $deep  only for internal usage
     *
     * @return string The string representation of the given value
     */
    public function exportValue($value, $depth = 1, $deep = false)
    {
        if ($value instanceof \__PHP_Incomplete_Class) {
            return sprintf('__PHP_Incomplete_Class(%s)', $this->getClassNameFromIncomplete($value));
        }

        if (is_object($value)) {
            if ($value instanceof \DateTimeInterface) {
                return sprintf('Object(%s) - %s', get_class($value), $value->format(\DateTime::ATOM));
            }

            return sprintf('Object(%s)', get_class($value));
        }

        if (is_array($value)) {
            if (empty($value)) {
                return '[]';
            }

            $indent = str_repeat('  ', $depth);

            $a = array();
            foreach ($value as $k => $v) {
                if (is_array($v)) {
                    $deep = true;
                }
    