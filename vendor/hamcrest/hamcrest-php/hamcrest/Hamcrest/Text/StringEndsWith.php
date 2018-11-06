<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Caster;

use Symfony\Component\VarDumper\Cloner\Stub;

/**
 * Represents the main properties of a PHP variable, pre-casted by a caster.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class CutStub extends Stub
{
    public function __construct($value)
    {
        $this->value = $value;

        switch (gettype($value)) {
            case 'object':
                $this->type = self::TYPE_OBJECT;
                $this->class = get_class($value);
                $this->cut