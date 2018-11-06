<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Cloner;

use Symfony\Component\VarDumper\Caster\Caster;
use Symfony\Component\VarDumper\Exception\ThrowingCasterException;

/**
 * AbstractCloner implements a generic caster mechanism for objects and resources.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
abstract class AbstractCloner implements ClonerInterface
{
    public static $defaultCasters = array(
        '__PHP_Incomplete_Class' => array('Symfony\Component\VarDumper\Caster\Caster', 'castPhpIncompleteClass'),

        'Symfony\Component\VarDumper\Caster\CutStub' => array('Symfony\Component\VarDumper\Caster\StubCaster', 'castStub'),
        'Symfony\Component\VarDumper\Caster\CutArrayStub' => array('Symfony\Component\VarDumper\Caster\StubCaster', 'castCutArray'),
        'Symfony\Component\VarDumper\Caster\ConstStub' => array('Symfony\Component\VarDumper\Caster\StubCaster', 'castStub'),
        'Symfony\Component\VarDumper\Caster\EnumStub' => array('Symfony\Component\VarDumper\Caster\StubCaster', 'castEnum'),

        'Closure' => array('Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castClosure'),
        'Generator' => array('Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castGenerator'),
        'ReflectionType' => array('Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castType'),
        'ReflectionGenerator