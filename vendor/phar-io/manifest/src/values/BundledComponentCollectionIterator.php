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
 * Casts common resource types to array representation.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class ResourceCaster
{
    public static function castCurl($h, array $a, Stub $stub, $isNested)
    {
        return curl_getinfo($h);
    }

    public static function castDba($dba, array $a, Stub $stub, $isNested)
    {
        $list = dba_list();
        $a['file'] = $list[(int) $dba];

        return $a;
    }

    public static function castProcess($process, array $a, Stub $stub, $isNested)
    {
        return proc_get_status($process);
    }

    public static function castStream($stream, array $a, Stub $stub, $isNested)
    {
        $a = stream_get_meta_data($stream) + static::castStreamContext($stream, $a, $stub, $isNested);
        if (isset($a['uri'])) {
            $a['uri'] = new LinkStub($a['uri']);
        }

        return $a;
    }

    public static function cas