s->testSuiteLevel];
        }

        $this->testSuiteLevel--;
    }

    /**
     * A test started.
     *
     * @param Test $test
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function startTest(Test $test): void
    {
        $testCase = $this->document->createElement('testcase');
        $testCase->setAttribute('name', $test->getName());

        if ($test instanceof TestCase) {
            $class      = new ReflectionClass($test);
            $methodName = $test->getName(!$test->usesDataProvider());

            if ($class->hasMethod($methodName)) {
                $method = $class->getMethod($methodName);

                $testCase->setAttribute('class', $class->getName());
                $testCase->setAttribute('classname', \str_replace('\\', '.', $class->getName()));
                $testCase->setAttribute('file', $class->getFileName());
                $testCase->setAttribute('line', $method->getStartLine());
            }
        }

        $this->currentTestCase = $testCase;
    }

    /**
     * A test ended.
     *
     * @param Test  $test
     * @param float $time
     */
    public function endTest(Test $test, float $time): void
    {
        if ($test instanceof TestCase) {
            $numAssertions = $test->getNumAssertions();
            $this->testSuiteAssertions[$this->testSuiteLevel] += $numAssertions;

            $this->currentTestCase->setAttribute(
                'assertions',
                $numAssertions
            );
        }

        $this->currentTestCase->setAttribute(
            'time',
            \sprintf('%F', $time)
        );

        $this->testSuites[$this->testSuiteLevel]->appendChild(
            $this->currentTestCase
        );

        $this->testSuiteTests[$this->testSuiteLevel]++;
        $this->testSuiteTimes[$this->testSuiteLevel] += $time;

        if (\method_exists($test, 'hasOutput') && $test->hasOutput()) {
            $systemOut = $this->document->createElement(
                'system-out',
                Xml::prepareString($test->getActualOutput())
            );

            $this->currentTestCase->appendChild($systemOut);
        }

        $this->currentTestCase = null;
    }

    /**
     * Returns the XML as a string.
     *
     * @return string
     */
    public function getXML(): string
    {
        return $this->document->saveXML();
    }

    /**
     * Enables or disables the writing of the document
     * in flush().
     *
     * This is a "hack" needed for the integration of
     * PHPUnit with Phing.
     *
     * @param mixed $flag
     *
     * @return string
     */
    public function setWriteDocument($flag): ?string
    {
        if (\is_bool($flag)) {
            $this->writeDocument = $flag;
        }
    }

    