ic function toString(): string
    {
        $exporter = new Exporter;

        return \sprintf(
            '%s::%s(%s)%s',
            $this->className,
            $this->methodName,
            \implode(
                ', ',
                \array_map(
                    [$exporter, 'shortenedExport'],
                    $this->parameters
                )
            ),
            $this->returnType ? \sprintf(': %s', $this->returnType) : ''
        );
    }

    /**
     * @param object $original
     *
     * @return object
     */
    private function cloneObject($original)
    {
        $cloneable = null;
        $object    = new ReflectionObject($original);

        // Check the blacklist before asking PHP reflection to work around
        // https://bugs.php.net/bug.php?id=53967
        if ($object->isInternal() &&
            isset(self::$uncloneableExtensions[$object->getExtensionName()])) {
            $cloneable = false;
        }

        if ($cloneable === null) {
            foreach (self::$uncloneableClasses as $class) {
                if ($original instanceof $class) {
                    $cloneable = false;

                    break;
                }
            }
        }

        if ($cloneable === null) {
            $cloneable = $object->isCloneable();
        }

        if ($cloneable === null && $object->hasMethod('__clone')) {
            $method    = $object->getMethod('__clone');
            $cloneable = $method->isPublic();
        }

        if ($cloneable === null) {
            $cloneable = true;
        }

        if ($cloneable) {
            try {
                return clone $original;
            } catch (\Exception $e) {
                return $original;
            }
        } else {
            return $original;
        }
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      