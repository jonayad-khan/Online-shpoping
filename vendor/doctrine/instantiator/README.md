Notice|Warning|Error|Critical|Alert|Emergency)(.*)/', $method, $matches) > 0) {
            $genericMethod = $matches[1] . ('Records' !== $matches[3] ? 'Record' : '') . $matches[3];
            $level = constant('Monolog\Logger::' . strtoupper($matches[2]));
            if (method_exists($this, $genericMethod)) {
                $args[] = $level;

                return call_user_func_array(array($this, $genericMethod), $args);
            }
        }

        throw new \BadMethodCallException('Call to undefined method ' . get_class($this) . '::' . $method . '()');
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       