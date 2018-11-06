<?php declare(strict_types=1);
/*
 * This file is part of sebastian/diff.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\Diff;

use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
abstract class LongestCommonSubsequenceTest extends TestCase
{
    /**
     * @var LongestCommonSubsequenceCalculator
     */
    private $implementation;

    /**
     * @var string
     */
    private $memoryLimit;

    /**
     * @var int[]
     */
    private $stress_sizes = [1, 2, 3, 100, 500, 1000, 2000];

    protected function setUp()
    {
        $this->memoryLimit = \ini_get('memory_limit');
        \ini_set('memory_limit', '256M');

        $this->implementation = $this->createImplementation();