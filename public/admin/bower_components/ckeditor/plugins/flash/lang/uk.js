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

use PHPUnit\Framework\Exception;

/**
 * Command-line options parsing class.
 */
final class Getopt
{
    /**
     * @param array      $args
     * @param string     $short_options
     * @param null|array $long_options
     *
     * @throws Exception
     *
     * @return array
     */
    public static function getopt(array $args, string $short_options, array $long_options = null): array
    {
        if (empty($args)) {
            return [[], []];
        }

        $opts     = [];
        $non_opts = [];

        if ($long_options) {
            \sort($long_options);
        }

        if (isset($args[0][0]) && $args[0][0] !== '-') {
            \array_shift($args);
        }

        \reset($args);

        $args = \array_map('trim', $args);

        /* @noinspection ComparisonOperandsOrderInspection */
        while (false !== $arg = \current($args)) {
            $i = \key($args);
            \next($args);

            if ($arg === '') {
                continue;
            }

            if ($arg === '--') {
                $non_opts = \array_merge($non_opts, \array_slice($args, $i + 1));

                break;
            }

            if ($arg[0] !== '-' || (\strlen($arg) > 1 && $arg[1] === '-' && !$long_options)) {
                $non_opts[] = $args[$i];

                continue;
            }
            if (\