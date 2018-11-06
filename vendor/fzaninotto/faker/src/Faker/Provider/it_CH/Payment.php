<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Util;

use Composer\Autoload\ClassLoader;
use DeepCopy\DeepCopy;
use Doctrine\Instantiator\Instantiator;
use File_Iterator;
use PHP_Token;
use phpDocumentor\Reflection\DocBlock;
use PHPUnit\Framework\MockObject\Generator;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use ReflectionClass;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Diff\Dif