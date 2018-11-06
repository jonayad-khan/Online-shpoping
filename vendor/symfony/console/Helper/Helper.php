rg)-1, 1) == ']') {
                $parts = explode('[', $arg);
                if (!class_exists($parts[0], true) && !interface_exists($parts[0], true)) {
                    throw new \Mockery\Exception('Can only create a partial mock from'
                    . ' an existing class or interface');
                }
                $class = $parts[0];
                $parts[1] = str_replace(' ', '', $parts[1]);
                $partialMethods = explode(',', strtolower(rtrim($parts[1], ']')));
                $builder->addTarget($class);
                $builder->setWhiteListedMethods($partialMethods);
                array_shift($args);
                continue;
            } elseif (is_string($arg) && (class_exists($arg, true) || interface_exists($arg, true) || trait_exists($arg, true))) {
                $class = array_shift($args);
                $builder->addTarget($class);
                continue;
            } elseif (is_string($arg) && !\Mockery::getConfiguration()->mockingNonExistentMethodsAllowed() && (!class_exists($arg, true) && !interface_exists($arg, true))) {
                throw new \Mockery\Exception("Mockery can't find '$arg' so can't mock it");
            } elseif (is_string($arg)) {
                if (!$this->isValidClassName($arg)) {
                    throw new \Mockery\Exception('Class name contains invalid characters');
                }
                $class = array_shift($args);
                $builder->addTarget($class);
                continue;
            } elseif (is_object($arg)) {
                $partial = array_shift($args);
                $builder->addTarget($partial);
                continue;
            } elseif (is_array($arg) && !empty($arg) && array_keys($arg) !== range(0, count($arg) - 1)) {
                // if associative array
                if (array_key_exists(self::BLOCKS, $arg)) {
                    $blocks = $arg[self::BLOCKS];
                }
                unset($arg[self::BLOCKS]);
                $quickdefs = array_shift($args);
                continue;
            } elseif (is_array($arg)) {
                $constructorArgs = array_shift($args);
                continue;
            }

            throw new \Mockery\Exception(
                'Unable to parse arguments sent to '
                . get_class($this) . '::mock()'
            );
        }

        $builder->addBlackListedMethods($blocks);

        if (defined('HHVM_VERSION')
            && isset($class)
            && ($class === 'Exception' || is_subclass_of($class, 'Exception'))) {
            $builder->addBlackListedMethod("setTraceOptions");
            $builder->addBlackListedMethod("getTraceOptions");
        }

        if (!is_null($constructorArgs)) {
            $builder->addBlackListedMethod("__construct"); // we need to pass through
        } else {
            $builder->setMockOriginalDestructor(true);
        }

        if (!empty($partialMethods) && $constructorArgs === null) {
            $constructorArgs = array();
        }

        $config = $builder->getMockConfiguration();

        $this->checkForNamedMockClashes($config);

        $def = $this->getGenerator()->generate($config);

        if (class_exists($def->getClassName(), $attemptAutoload = false)) {
            $rfc = new \ReflectionClass($def->getClassName());
            if (!$rfc->implementsInterface("Mockery\MockInterface")) {
                throw new \Mockery\Exception\RuntimeException("Could not load mock {$def->getClassName()}, class already exists");
            }
        }

        $this->getLoader()->load($def);

        $mock = $this->_getInstance($def->getClassName(), $constructorArgs);
        $mock->mockery_init($this, $config->getTargetObject());

        if (!empty($quickdefs)) {
            $mock->shouldReceive($quickdefs)->byDefault();
        }
        if (!empty($expectationClosure)) {
            $expectationClosure($mock);
        }
        $this->rememberMock($mock);
    