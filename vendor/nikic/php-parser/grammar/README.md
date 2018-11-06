<?php

error_reporting(E_ALL | E_STRICT);
ini_set('short_open_tag', false);

if ('cli' !== php_sapi_name()) {
    die('This script is designed for running on the command line.');
}

function showHelp($error) {
    die($error . "\n\n" .
<<<OUTPUT
This script has to be called with the following signature:

    php run.php [--no-progress] testType pathToTestFiles

The test type must be one of: PHP5, PHP7 or Symfony.

The following options are available:

    --no-progress    Disables showing which file is currently tested.

OUTPUT
    );
}

$options = array();
$arguments = array();

// remove script name from argv
array_shift($argv);

foreach ($argv as $arg) {
    if ('-' === $arg[0]) {
        $options[] = $arg;
    } else {
        $arguments[] = $arg;
    }
}

if (count($arguments) !== 2) {
    showHelp('Too little arguments passed!');
}

$showProgress = true;
$verbose = false;
foreach ($options as $option) {
    if ($option === '--no-progress') {
        $showProgress = false;
    } elseif ($option === '--verbose') {
        $verbose = true;
    } else {
        showHelp('Invalid option passed!');
    }
}

$testType = $arguments[0];
$dir = $arguments[1];

switch ($testType) {
    case 'Symfony':
        $version = 'Php5';
        $fileFilter = function($path) {
            return preg