ies() as $cookie) {
            if ($cookie->getName() == $name) {
                return $cookie;
            }
        }

        throw new \InvalidArgumentException(sprintf('Cookie named "%s" is not in response', $name));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       