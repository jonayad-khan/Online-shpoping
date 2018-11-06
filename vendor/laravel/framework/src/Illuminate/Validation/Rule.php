lCount++;
        if (true === $this->_passthru) {
            return $this->_mock->mockery_callSubjectMethod($this->_name, $args);
        }

        $return = $this->_getReturnValue($args);
        $this->throwAsNecessary($return);
        $this->_setValues();

        return $return;
    }

    /**
     * Throws an exception if the expectation has been configured to do so
     *
     * @throws \Exception|\Throwable
     * @return void
     */
    private function throwAsNecessary($return)
    {
        if (!$this->_throw) {
            return;
        }

        $type = version_compare(PHP_VERSION, '7.0.0') >= 0
            ? "\Throwable"
            : "\Exception";

        if ($return instanceof $type) {
            throw $return;
        }

        return;
    }

    /**
     * Sets public properties with queued values to the mock object
     *
     * @param array $args
     * @return mixed
     */
    protected function _setValues()
    {
        $mockClass = get_class($this->_mock);
        $container = $this->_mock->mockery_getContainer();
        $mocks = $container->getMocks();
        foreach ($this->_setQueue as $name => &$values) {
            if (count($values) > 0) {
                $value = array_shift($values);
                foreach ($mocks as $mock) {
                    if (is_a($mock, $mockClass)) {
                        $mock->{$name} = $value;
                    }
                }
            }
        }
    }

    /**
     * Fetch the return value for the matching args
     *
     * @param array $args
     * @return mixed
     */
    protecte