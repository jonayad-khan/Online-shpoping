 (class_exists($fullName) || interface_exists($fullName) || ($includeFunctions && function_exists($fullName))) {
                return $fullName;
            }
        }

        return $name;
    }

    /**
     * Get a Reflector and documentation for a function, class or instance, constant, method or property.
     *
     * @param string $valueName Function, class, variable, constant, method or property name
     * @param bool   $classOnly True if the name should only refer to a class, function or instance
     *
     * @return array (value, Reflector)
     */
    protected function getTargetAndReflector($valueName, $classOnly = false)
    {
        list($value, $member, $kind) = $this->getTarget($valueName, $classOnly);

        return array($value, Mirror::get($value, $member, $kind));
    }

    /**
     * Return a variable instance from the current scope.
     *
     * @throws \InvalidArgumentException when the requested variable does not exist in the current scope
     *
     * @param string $name
     *
     * @return mixed Variable instance
     */
    protected function resolveInstance($name)
    {
        $value = $this->getScopeVariable($name);
        if (!is_object($value)) {
            throw new RuntimeException('Unable to inspect a non-object');
        }

        return $value;
    }

    /**
     * Get a variable from the current shell scope.
     *
     * @param string $name
     *
     * @return mixed
     */
    protected function getScopeVariable($name)
    {
        return $this->context->get($name);
    }

    /**
     * Get all scope variables from the current shell scope.
     *
     * @return array
     */
    protected function getScopeVariables()
    {
        return $this->context->getAll();
    }

    /**
     * Given a Reflector instance, set command-scope variables in the shell
     * execution context. This is used to inject magic $__class, $__method and
     * $__file variables (as well as a handful of others).
     *
     * @param \Reflector $reflector
     */
    protected function setCommandScopeVariables(\Reflector $reflector)
    {
        $vars = array();

        switch (get_class($reflector)) {
            case 'ReflectionClass':
            case 'ReflectionObject':
                $vars['__class'] = $reflector->name;
                if ($reflector->inNamespace()) {
                    $vars['_