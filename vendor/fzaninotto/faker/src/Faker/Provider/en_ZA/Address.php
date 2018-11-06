    }

        $this->exitWithErrorMessage(
            \sprintf(
                'Could not use "%s" as loader.',
                $loaderClass
            )
        );

        return null;
    }

    /**
     * Handles the loading of the PHPUnit\Util\Printer implementation.
     *
     * @param string $printerClass
     * @param string $printerFile
     *
     * @return null|Printer|string
     */
    protected function handlePrinter($printerClass, $printerFile = '')
    {
        if (!\class_exists($printerClass, false)) {
            if ($printerFile == '') {
                $printerFile = Filesystem::classNameToFilename(
                    $printerClass
                );
            }

            $printerFile = \stream_resolve_include_path($printerFile);

            if ($printerFile) {
                require $printerFile;
            }
        }

        if (!\class_exists($printerClass)) {
            $this->exitWithErrorMessage(
                \sprintf(
                    'Could not use "%s" as printer: class does not exist',
                    $printerClass
                )
            );
        }

        $class = new ReflectionClass($printerClass);

        if (!$class->implementsInterface(TestListener::class)) {
            $this->exitWithErrorMessage(
                \sprintf(
                    'Could not use "%s" as printer: class does not implement %s',
                    $printerClass,
                    TestListener::class
                )
            );
        }

        if (!$class->isSubclassOf(Printer::class)) {
            $this->exitWithErrorMessage(
                \sprintf(
                    'Could not use "%s" as printer: class does not extend %s',
                    $printerClass,
                    Printer::class
                )
            );
        }

        if (!$class->isInstantiable()) {
            $this->exitWithErrorMessage(
                \sprintf(
                    'Could not use "%s" as printer: class cannot be instantiated',
                    $printerClass
                )
            );
        }

        if ($class->isSubclassOf(ResultPrinter::class)) {
            return $printerClass;
        }

        $outputStream = isset($this->arguments['stderr']) ? 'php://stderr' : null;

        return $class->newInstance($outputStream);
    }

    /**
     * Loads a bootstrap file.
     *
     * @param string $filename
     */
    protected function handleBootstrap($filename): void
    {
        try {
            FileLoader::checkAndLoad($filename);
        } catch (Exception $e) {
            $this->exitWithErrorMessage($e->getMessage());
        }
    }

    protected function handleVersionCheck(): void
    {
        $this->printVersionString();

        $latestVersion = \file_get_contents('https://phar.phpunit.de/latest-version-of/phpunit');
        $isOutdated    = \version_compare($latestVersion, Version::id(), '>');

        if ($isOutdated) {
            \printf(
                'You are not using the latest version of PHPUnit.' . PHP_EOL .
                'The latest version is PHPUnit %s.' . PHP_EOL,
                $latestVersion
            );
        } else {
            print 'You are using the latest version of PHPUnit.' . PHP_EOL;
        }

        exit(TestRunner::SUCCESS_EXIT);
    }

    /**
     * Show the help message.
     */
    protected function showHelp(): void
    {
        $this->printVersionString();

        print <<<EOT
Usage: phpunit [options] UnitTest [UnitTest.php]
       phpunit [options] <directory>

Code Coverage Options:

  --coverage-clover <file>    Generate code coverage report in Clover XML format.
  --coverage-crap4j <file>    Generate code coverage report in Crap4J XML format.
  --coverage-html <dir>       Generate code coverage report in HTML format.
  --coverage-php <file>       Export PHP_CodeCoverage object to file.
  --coverage-text=<file>      Generate code coverage report in text format.
                              Default: Standard output.
  --coverage-xml <dir>        Generate code coverage report in PHPUnit XML format.
  --whitelist <dir>           Whitelist <dir> for code coverage analysis.
  --disable-coverage-ignore   Disable annotations for ignoring code coverage.

Logging Options:

  --log-junit <file>          Log test execution in JUnit XML format to file.
  --log-teamcity <file>       Log test execution in TeamCity format to file.
