node->class;
            $args = array(
                is_string($class) ? new String_($class) : $class,
                is_string($node->name) ? new String_($node->name) : $node->name,
            );

            return $this->prepareCall(self::CLASS_CONST_FETCH, $args);
        }
    }

    private function prepareCall($method, $args)
    {
        return new StaticCall(new FullyQualifiedName(self::SUDO_CLASS), $method, array_map(function ($arg) {
            return new Arg($arg);
        }, $args));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        