#!/usr/bin/env php
<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Starts a dump server to collect and output dumps on a single place with multiple formats support.
 *
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 */

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\VarDumper\Command\ServerDumpCommand;
use Symfony\Component\VarDumper\Server\DumpServer;

function includeIfExists(string $file): bool
{
    return file_exists($file) && include $file;
}

if (
    !includeIfExists(__DIR__ . '/../../../../autoload.php') &&
    !includeIfExists(__DIR__ . '/../../vendor/autoload.php') &&
    !includeIfExists(__DIR__ . '/../../../../../../vendor/autoload.php')
) {
    fwrite(STDERR, 'Install dependencies using Composer.'.PHP_EOL);
    exit(1);
}

if (!class_exists(Application::class)) {
    fwrite(STDERR, 'You need the "symfony/console" component in order to run the VarDumper server.'.PHP_EOL);
    exit(1);
}

$input = new ArgvInput();
$output = new ConsoleOutput();
$defaultHost = '127.0.0.1:9912';
$host = $input->getParameterOption(['--host'], $_SERVER['VAR_DUMPER_SERVER'] ?? $defaultHost, true);
$logger = interface_exists(LoggerInterface::class) ? new ConsoleLogger($output->getErrorOutput()) : null;

$app = new Applicatio