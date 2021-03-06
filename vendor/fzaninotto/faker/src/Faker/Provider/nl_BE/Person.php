<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Finder\Tests\Iterator;

use Symfony\Component\Finder\Iterator\DepthRangeFilterIterator;

class DepthRangeFilterIteratorTest extends RealIteratorTestCase
{
    /**
     * @dataProvider getAcceptData
     */
    public function testAccept($minDepth, $maxDepth, $expected)
    {
        $inner = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->toAbsolute(), \FilesystemIterator::SKIP_DOTS), \RecursiveIteratorIterator::SELF_FIRST);

        $iterator = new DepthRangeFilterIterator($inner, $minDepth, $maxDepth);

        $actual = array_keys(iterator_to_array($iterator));
        sort($expected);
        sort($actual);
        $this->assertEquals($expected, $actual);
    }

    public function getAcceptData()
    {
        $lessThan1 = array(
            '.git',
            'test.py',
            'foo',
            'test.php',
            'toto',
            '.foo',
            '.bar',
            'foo bar',
        );

        $lessThanOrEqualTo1 = array(
            '.git',
            'test.py',
            'foo',
            'foo/bar.tmp',
            'test.php',
            'toto',
            'toto/.git',
            '.foo',
            '.foo/.bar',
            '.bar',
            'foo bar',
            '.foo/bar',
        );

        $graterThanOrEqualTo1 = array(
            'toto/.git',
            'foo/bar.tmp',
            '.foo/.bar',
            '.foo/bar',
        );

        $equalTo1 = array(
            'toto/.git',
            'foo/bar.tmp',
            '.foo/.bar',
            '.foo/bar',
        );

        return array(
            array(0, 0, $this->toAbsolute($lessThan1)),
            array(0, 1, $this->toAbsolute($lessThanOrEqualTo1)),
            array(2, PHP_INT_MAX, array()),
            array(1, PHP_INT_MAX, $this->toAbsolute($graterThanOrEqualTo1)),
            array(1, 1, $this->toAbsolute($equalTo1)),
        );
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             INDX( 	                 (   �  �      E �                   75    h V     65    ����b�$�<=����b�����b�(       "               
 . g i t i g n o r e   >5    ` N     65    ����b�袹<=�x��b�����b�                        C a s t e r   85    p Z     65    
���b�$�<=�E���b����b��       �                C H A N G E L O G . m d       X5    ` N     65    ���b���<=�=�b����b�                        C l o n e r   95    p \     65    ����b��+�<=E s���b�����b�       �               c o m p o s e r . j s o n     `5    ` N     65    �F�b���<=�/d�b��F�b�                        D u m p e r   e5    h T     65    �n�b��g�<=����b��n�b�                       	 E x c e p t i o n     :5    ` P     65    r��b��g�<=����b�p��b�       )              